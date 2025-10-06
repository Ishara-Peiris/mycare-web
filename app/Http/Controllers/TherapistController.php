<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Needed for file operations
use Illuminate\Support\Facades\Log; // For logging OCR errors
use thiagoalessio\TesseractOCR\TesseractOCR; // <-- TESSERACT OCR

class TherapistController extends Controller
{
    /**
     * Show all verified therapists (for users to browse)
     */
    public function index()
    {
        // Only show verified therapists to public users
        $therapists = Therapist::with('user')->where('is_verified', true)->get();
        return view('therapists.index', compact('therapists'));
    }

    /**
     * Show therapist creation form
     */
    public function create()
    {
        return view('therapists.create');
    }

    /**
     * Store therapist profile, including image and certificate.
     */
    public function store(Request $request)
    {
        $request->validate([
            'specialization'    => 'required|string|max:255',
            'experience_years'  => 'required|integer|min:0',
            'consultation_fee'  => 'required|numeric|min:0',
            'languages'         => 'required|string|max:255',
            'availability'      => 'nullable|json',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            
            // Certificate Validation
            'certificate'       => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
        ]);

        // 1. Handle File Uploads
        $imagePath = $request->hasFile('image') 
            ? $request->file('image')->store('therapist_images', 'public') 
            : null;

        $certificatePath = $request->file('certificate')->store('therapist_certificates', 'public');

        // --- OCR Logic ---
        $ocrText = '';
        $isKeywordFound = false;
        $absolutePath = Storage::disk('public')->path($certificatePath);

        try {
            // Run OCR on the uploaded certificate file
            $ocrText = (new TesseractOCR($absolutePath))
                ->lang('eng')
                ->run();
            
            // Check for required keywords
            $lowerText = strtolower($ocrText);
            $isKeywordFound = str_contains($lowerText, 'license') || 
                              str_contains($lowerText, 'certified') || 
                              str_contains($lowerText, 'board') || 
                              str_contains($lowerText, 'registration');

        } catch (\Exception $e) {
            // Log the error if Tesseract fails but allow submission to proceed
            Log::warning("OCR failed for certificate (Therapist ID: " . Auth::id() . "): " . $e->getMessage());
        }
        // --- End OCR Logic ---

        Therapist::create([
            'user_id'           => Auth::id(),
            'specialization'    => $request->specialization,
            'experience_years'  => $request->experience_years,
            'consultation_fee'  => $request->consultation_fee,
            'languages'         => $request->languages,
            'availability'      => $request->availability,
            'description'       => $request->description,
            'image'             => $imagePath,
            'certificate_path'  => $certificatePath, 
            
            // Save OCR Results
            'ocr_summary'       => substr($ocrText, 0, 1000), // Max 1000 chars for text field
            'is_keyword_found'  => $isKeywordFound,
            // is_verified remains FALSE by default for admin approval
        ]);

        // Change success message to reflect pending review status
        return redirect()->route('therapists.index')->with('success', 'Therapist profile created successfully. It is now pending admin review for qualification verification!');
    }

    /**
     * Show single therapist
     */
    public function show(Therapist $therapist)
    {
        return view('therapists.show', compact('therapist'));
    }

    /**
     * Show edit form
     */
    public function edit(Therapist $therapist)
    {
        $this->authorize('update', $therapist);
        return view('therapists.edit', compact('therapist'));
    }

    /**
     * Update therapist profile, including potential file updates.
     */
    public function update(Request $request, Therapist $therapist)
    {
        $this->authorize('update', $therapist);

        $request->validate([
            'specialization'    => 'required|string|max:255',
            'experience_years'  => 'required|integer|min:0',
            'consultation_fee'  => 'required|numeric|min:0',
            'languages'         => 'required|string|max:255',
            'availability'      => 'nullable|json',
            'description'       => 'nullable|string',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            
            // Certificate Validation (nullable for update)
            'certificate'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', 
        ]);

        $data = $request->only([
            'specialization', 'experience_years', 'consultation_fee', 
            'languages', 'availability', 'description'
        ]);

        // 1. Handle Profile Image Update
        if ($request->hasFile('image')) {
            // Delete old file if it exists
            if ($therapist->image) {
                Storage::disk('public')->delete($therapist->image);
            }
            $data['image'] = $request->file('image')->store('therapist_images', 'public');
        }

        // 2. Handle Certificate Update (and re-run OCR if updated)
        if ($request->hasFile('certificate')) {
            // Delete old file if it exists
            if ($therapist->certificate_path) {
                Storage::disk('public')->delete($therapist->certificate_path);
            }
            $certificatePath = $request->file('certificate')->store('therapist_certificates', 'public');
            $data['certificate_path'] = $certificatePath;
            
            // Re-run OCR on update
            $absolutePath = Storage::disk('public')->path($certificatePath);
            try {
                $ocrText = (new TesseractOCR($absolutePath))->lang('eng')->run();
                $lowerText = strtolower($ocrText);
                $isKeywordFound = str_contains($lowerText, 'license') || str_contains($lowerText, 'certified');
                
                $data['ocr_summary'] = substr($ocrText, 0, 1000);
                $data['is_keyword_found'] = $isKeywordFound;

            } catch (\Exception $e) {
                Log::warning("OCR failed on UPDATE for therapist " . $therapist->id . ": " . $e->getMessage());
                // Set OCR fields to null/false on failure
                $data['ocr_summary'] = null;
                $data['is_keyword_found'] = false;
            }
        }

        $therapist->update($data);

        return redirect()->route('therapists.show', $therapist)->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete therapist profile
     */
    public function destroy(Therapist $therapist)
    {
        $this->authorize('delete', $therapist);
        
        // Delete associated files before deleting record
        if ($therapist->image) {
            Storage::disk('public')->delete($therapist->image);
        }
        if ($therapist->certificate_path) {
            Storage::disk('public')->delete($therapist->certificate_path);
        }
        
        $therapist->delete();

        return redirect()->route('therapists.index')->with('success', 'Therapist profile deleted!');
    }

    /**
     * Show all confirmed bookings for logged-in therapist
     */
    public function myBookings()
    {
        $therapist = Therapist::where('user_id', Auth::id())->first();

        if (!$therapist) {
            return redirect()->back()->with('error', 'You are not registered as a therapist.');
        }

        $bookings = Booking::with('patient') // eager load patient details
            ->where('therapist_id', $therapist->id)
            ->where('status', 'confirmed')
            ->orderBy('session_date')
            ->orderBy('session_time')
            ->get();

        return view('therapists.bookings', compact('bookings'));
    }
}