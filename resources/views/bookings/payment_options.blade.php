{{-- resources/views/bookings/payment_options.blade.php (Simplified) --}}
<h1>Select Payment Method for Booking #{{ $booking->id }}</h1>
<p>Amount Due: ${{ number_format($booking->amount_paid, 2) }}</p>

<div class="row">
    {{-- Stripe Option --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Pay with Card (Stripe)</div>
            <div class="card-body">
                <p>Pay instantly and confirm your session immediately.</p>
                <form action="{{ route('stripe.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Pay Securely with Card</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Bank Deposit Option --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Bank Deposit</div>
            <div class="card-body">
                <p>Bank Name: ABC Bank</p>
                <p>Account No: 123456789</p>
                <p>Account Name: Your Company Name</p>
                
                <form action="{{ route('bank.deposit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="deposit_reference" class="form-label">Reference/Slip Number</label>
                        <input type="text" name="deposit_reference" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-secondary">I Have Paid (Mark as Pending)</button>
                </form>
            </div>
        </div>
    </div>
</div>