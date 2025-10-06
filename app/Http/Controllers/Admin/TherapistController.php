<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Availability;
use Illuminate\Support\Facades\Auth;


use App\Models\Therapist;
use Illuminate\Http\Request;

class TherapistController extends Controller
{
    public function index()
    {
        $therapists = Therapist::with('user')->get(); // eager load user
        return view('admin.therapists.index', compact('therapists'));
    }

    public function show(Therapist $therapist)
    {
        return view('admin.therapists.show', compact('therapist'));
    }

    public function approve(Therapist $therapist)
    {
        $therapist->update(['is_verified' => true]);
        return back()->with('success', 'Therapist approved successfully.');
    }

    public function reject(Therapist $therapist)
    {
        $therapist->update(['is_verified' => false]);
        return back()->with('success', 'Therapist rejected.');
    }
}
