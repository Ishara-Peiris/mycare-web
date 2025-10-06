<?php

namespace App\Http\Controllers;
use App\Models\Therapist;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
     // Show all therapists
    public function therapists()
    {
        $therapists = Therapist::with('user')->paginate(10);
        return view('admin.therapists.index', compact('therapists'));
    }

    // Approve therapist
    public function approveTherapist($id)
    {
        $therapist = Therapist::findOrFail($id);
        $therapist->is_verified = true;
        $therapist->save();

        return redirect()->route('admin.therapists')->with('success', 'Therapist approved successfully!');
    }

    // Reject therapist
    public function rejectTherapist($id)
    {
        $therapist = Therapist::findOrFail($id);
        $therapist->is_verified = false;
        $therapist->save();

        return redirect()->route('admin.therapists')->with('error', 'Therapist rejected successfully!');
    }
}
