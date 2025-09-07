<?php

namespace App\Http\Controllers;

use App\Models\Therapist;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    /**
     * Show all verified therapists (for users to browse)
     */
    public function index()
    {
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
     * Store therapist profile
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
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('therapist_images', 'public') : null;

        Therapist::create([
            'user_id'           => Auth::id(),
            'specialization'    => $request->specialization,
            'experience_years'  => $request->experience_years,
            'consultation_fee'  => $request->consultation_fee,
            'languages'         => $request->languages,
            'availability'      => $request->availability,
            'description'       => $request->description,
            'image'             => $imagePath,
        ]);

        return redirect()->route('therapists.index')->with('success', 'Therapist profile created successfully!');
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
     * Update therapist profile
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
        ]);

        // Update image only if a new one is uploaded
        if ($request->hasFile('image')) {
            $therapist->image = $request->file('image')->store('therapist_images', 'public');
        }

        $therapist->update([
            'specialization'    => $request->specialization,
            'experience_years'  => $request->experience_years,
            'consultation_fee'  => $request->consultation_fee,
            'languages'         => $request->languages,
            'availability'      => $request->availability,
            'description'       => $request->description,
            'image'             => $therapist->image,
        ]);

        return redirect()->route('therapists.show', $therapist)->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete therapist profile
     */
    public function destroy(Therapist $therapist)
    {
        $this->authorize('delete', $therapist);
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
