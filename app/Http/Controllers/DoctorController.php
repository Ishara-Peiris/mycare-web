<?php

namespace App\Http\Controllers;
use App\Models\Therapist;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
     public function index()
    {
         $therapist = Auth::user()->therapist; // get logged-in therapist

        return view('doctor.dashboard', compact('therapist'));
    }
}
