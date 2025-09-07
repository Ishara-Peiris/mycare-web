<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Book a Session</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #f3f0ff 0%, #e6e0ff 100%);
      font-family: 'Poppins', sans-serif;
    }

    .card {
      border: none;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(128, 90, 213, 0.2);
    }

    .card-header {
      background: linear-gradient(90deg, #6a0dad, #9b30ff);
      color: #fff;
      font-weight: 600;
      text-align: center;
      font-size: 1.3rem;
    }

    .form-label {
      font-weight: 500;
      color: #4b0082;
    }

    .form-select {
      border-radius: 12px;
      padding: 12px;
      border: 1px solid #9b30ff;
    }

    .btn-primary {
      border-radius: 50px;
      padding: 12px 0;
      font-size: 1.1rem;
      font-weight: 600;
      background: #8a2be2;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: #6a0dad;
    }

    .alert-success {
      background-color: #d8b6ff;
      color: #4b0082;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .alert-danger {
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
  </style>
</head>
<body>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <div class="card shadow-sm">
        <div class="card-header">
          <h4 class="mb-0">Book a Session with {{ $therapist->user->name }}</h4>
        </div>
        <div class="card-body p-4">

          {{-- Show success / error messages --}}
          @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
          @endif
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('bookings.store', $therapist->id) }}" method="POST">
            @csrf

            <div class="mb-4">
              <label for="availability_id" class="form-label fw-semibold">Choose a Time Slot</label>
              <select name="availability_id" id="availability_id" class="form-select form-select-lg" required>
                @php
                  $slots = $therapist->availabilities()->where('is_booked', false)->orderBy('available_date')->get();
                @endphp

                @forelse($slots as $slot)
                  <option value="{{ $slot->id }}">
                    {{ \Carbon\Carbon::parse($slot->available_date)->format('M d, Y') }}
                    ({{ \Carbon\Carbon::parse($slot->start_time)->format('h:i A') }} - 
                     {{ \Carbon\Carbon::parse($slot->end_time)->format('h:i A') }})
                  </option>
                @empty
                  <option disabled>No available slots</option>
                @endforelse
              </select>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg shadow">Book Session</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
