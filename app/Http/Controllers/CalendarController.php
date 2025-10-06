<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class CalendarController extends Controller
{
    // Show calendar view
    public function index()
    {
        return view('therapists.calendar');
    }

    // Fetch bookings for logged-in therapist
    public function getEvents()
    {
        $therapist = Auth::user()->therapist;

        if (!$therapist) {
            return response()->json([]);
        }

        $bookings = Booking::where('therapist_id', $therapist->id)
            ->where('status', 'confirmed')
            ->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => 'Session with ' . $booking->user->name,
                'start' => $booking->session_date . 'T' . $booking->session_time,
                'url' => $booking->meeting_link, // opens meeting link
            ];
        });

        return response()->json($events);
    }
}
