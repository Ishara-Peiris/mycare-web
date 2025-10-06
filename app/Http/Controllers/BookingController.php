<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapist;
use App\Models\Booking;
use App\Models\Availability;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\BookingNotification;

class BookingController extends Controller
{
    // Show booking form
    public function create($therapistId)
    {
        $therapist = Therapist::findOrFail($therapistId);
        return view('bookings.create', compact('therapist'));
    }

    // Store booking
    public function store(Request $request, $therapistId)
    {
        $request->validate([
            'availability_id' => 'required|exists:availabilities,id',
        ]);

        $availability = Availability::findOrFail($request->availability_id);

        if ($availability->is_booked) {
            return back()->withErrors(['availability_id' => 'This slot is already booked.']);
        }

        // Step 1: Create booking
        $booking = Booking::create([
            'therapist_id' => $therapistId,
            'user_id' => auth()->id(),
            'session_date' => $availability->available_date,
            'session_time' => $availability->start_time,
            'status' => 'confirmed',
        ]);

        // Step 2: Mark slot as booked
        $availability->update(['is_booked' => true]);

        // ✅ Step 3: Generate and save unique Jitsi meeting link
        $meetingId = Str::random(10);
        $meetingLink = "https://meet.jit.si/" . $meetingId;

        $booking->update(['meeting_link' => $meetingLink]);

        // ✅ Step 4: Send emails with meeting link
        Mail::to($booking->user->email)
            ->send(new BookingNotification($booking, 'patient'));

        Mail::to($booking->therapist->user->email)
            ->send(new BookingNotification($booking, 'therapist'));

        return redirect()->back()->with('success', 'Session booked successfully! Meeting link sent.');
    }

    // ✅ New: Join session view
    public function joinSession(Booking $booking)
    {
        return view('bookings.join-session', compact('booking'));
    }
}
