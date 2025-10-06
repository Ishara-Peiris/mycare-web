<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\PostController;
use App\Models\Therapist;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VedioController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\Admin\TherapistController as AdminTherapistController;




use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.dashboard');
    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.dashboard');
});

// Fallback for all users
Route::get('/dashboard', function () {
    $therapists = Therapist::with('user')->where('is_verified', true)->get();
    return view('dashboard', compact('therapists'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin/therapists', [TherapistController::class, 'index'])->name('admin.therapists');


//resource hub routes 


// Protected routes (create, store, destroy)
Route::middleware(['auth'])->group(function() {
    Route::get('/resources/create', [ResourceController::class, 'create'])->name('resources.create');
    Route::post('/resources/store', [ResourceController::class, 'store'])->name('resources.store');
    Route::delete('/resources/{resource}', [ResourceController::class, 'destroy'])->name('resources.destroy');
});

// Public routes
Route::get('/resources', [ResourceController::class, 'categories'])->name('resources.categories');
Route::get('/resources/{category}', [ResourceController::class, 'showCategory'])->name('resources.show');


// Route to show all posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Therapist routes
Route::middleware(['auth'])->group(function () {
    
});
 Route::get('/therapists/create', [TherapistController::class, 'create'])->name('therapists.create');
    Route::post('/therapists', [TherapistController::class, 'store'])->name('therapists.store');
Route::get('/therapists', [TherapistController::class, 'index'])->name('therapists.index');
   
    Route::get('/therapists/{therapist}', [TherapistController::class, 'show'])->name('therapists.show');

///availability form

Route::middleware(['auth'])->group(function () {
    Route::get('/availabilities/create', [AvailabilityController::class, 'create'])->name('availabilities.create');
    Route::post('/availabilities', [AvailabilityController::class, 'store'])->name('availabilities.store');
});




// Booking routes (inside auth middleware)
Route::middleware(['auth'])->group(function () {

    // Show booking form (GET) - requires therapist ID
    Route::get('/bookings/create/{therapist}', [BookingController::class, 'create'])
        ->name('bookings.create');

    // Store booking (POST) - requires therapist ID
    Route::post('/bookings/{therapist}', [BookingController::class, 'store'])
        ->name('bookings.store');
});




Route::post('/send-offer', [VedioController::class, 'sendOffer']);
Route::post('/send-answer', [VedioController::class, 'sendAnswer']);
Route::post('/send-candidate', [VedioController::class, 'sendCandidate']);


Route::get('/video', function () {
    return view('video');
});


Route::get('/therapist/bookings', [TherapistController::class, 'myBookings'])
     ->middleware('auth')
     ->name('therapist.bookings');



    

Route::get('/bookings/{booking}/join', [BookingController::class, 'joinSession'])->name('bookings.join');



Route::get('/therapist/calendar', [CalendarController::class, 'index'])->name('therapist.calendar');
Route::get('/therapist/calendar/events', [CalendarController::class, 'getEvents'])->name('therapist.calendar.events');



Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/therapists', [AdminTherapistController::class, 'index'])->name('admin.therapists');
    Route::get('/therapists/{therapist}', [AdminTherapistController::class, 'show'])->name('admin.therapists.show');
    Route::post('/therapists/{therapist}/approve', [AdminTherapistController::class, 'approve'])->name('admin.therapists.approve');
    Route::post('/therapists/{therapist}/reject', [AdminTherapistController::class, 'reject'])->name('admin.therapists.reject');
});

// routes/web.php


// Step 1: User selects payment method (new view/action)
Route::post('/bookings/initiate', [BookingController::class, 'selectPaymentMethod'])->name('bookings.select_payment'); 

// --- Stripe Routes ---
// Step 2a: Redirect to Stripe Checkout
Route::post('/payment/stripe/checkout', [BookingController::class, 'stripeCheckout'])->name('stripe.checkout');
// Step 3a: Success/Failure redirect from Stripe
Route::get('/payment/stripe/success', [BookingController::class, 'stripeSuccess'])->name('stripe.success');
Route::get('/payment/stripe/cancel', [BookingController::class, 'stripeCancel'])->name('stripe.cancel');

// --- Bank Deposit Routes ---
// Step 2b: Process Bank Deposit Request
Route::post('/payment/bank-deposit', [BookingController::class, 'bankDeposit'])->name('bank.deposit');


Route::get('/home2', [HomeController::class, 'index'])->name('home2.show');