<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $therapist->user->name }} — Profile</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      background: #f0e9f7;
      font-family: 'Poppins', sans-serif;
    }

    .profile-card {
      border-radius: 20px;
      backdrop-filter: blur(12px);
      background: rgba(173,73,225,0.1);
      border: none;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .profile-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .avatar-placeholder {
      width: 100px;
      height: 100px;
      border-radius: 15px;
      background: rgba(122,28,172,0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 600;
      color: #7A1CAC;
    }

    h3 {
      color: #2E073F;
      font-weight: 600;
    }

    .meta span {
      color: #4c1d95;
      font-weight: 500;
      font-size: 0.9rem;
    }

    hr {
      border-color: rgba(122,28,172,0.3);
    }

    .tag {
      display: inline-block;
      margin-right: 0.4rem;
      margin-bottom: 0.3rem;
      background: rgba(173,73,225,0.15);
      color: #2E073F;
      font-weight: 500;
    }

    .btn-primary, .btn-success {
      border-radius: 50px;
      font-weight: 500;
      padding: 0.5rem 1.5rem;
      transition: all 0.3s;
    }
    .btn-primary {
      background: rgba(122,28,172,0.85);
      border: none;
      color: #fff;
    }
    .btn-primary:hover {
      background: rgba(173,73,225,0.9);
    }
    .btn-success {
      background: rgba(173,73,225,0.85);
      border: none;
      color: #fff;
    }
    .btn-success:hover {
      background: rgba(122,28,172,0.9);
    }

    .btn-outline-secondary {
      border-radius: 50px;
    }

    pre {
      background: rgba(255,255,255,0.7);
      padding: 0.8rem;
      border-radius: 10px;
      font-size: 0.9rem;
    }

    .rating {
      color: #ffb400;
      font-weight: 600;
    }

    @media (max-width: 576px) {
      .d-flex.align-items-start.gap-4 { flex-direction: column; align-items: center; }
      .flex-grow-1 { width: 100%; text-align: center; }
      .text-end { text-align: center !important; margin-top: 15px; }
    }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <a href="{{ route('therapists.index') }}" class="btn btn-link mb-3">← Back to list</a>

      <div class="card profile-card shadow-sm p-4">
        <div class="d-flex align-items-start gap-4">
          <!-- Avatar -->
          <div class="avatar-placeholder">
            {{ strtoupper(substr($therapist->user->name,0,1)) }}
          </div>

          <!-- Profile Info -->
          <div class="flex-grow-1">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
              <div>
                <h3>{{ $therapist->user->name }}</h3>
                <div class="meta mb-2">
                  <span><strong>Specialization:</strong> {{ $therapist->specialization }}</span> •
                  <span><strong>Experience:</strong> {{ $therapist->experience_years }} yrs</span> •
                  <span><strong>Fee:</strong> LKR{{ number_format($therapist->consultation_fee,2) }}</span>
                </div>
              </div>

              <div class="text-end">
                <div><span class="badge bg-{{ $therapist->is_verified ? 'primary' : 'secondary' }}">{{ $therapist->is_verified ? 'Verified' : 'Unverified' }}</span></div>
                <div class="mt-2"><strong class="rating">{{ $therapist->rating ?? 0 }}/5</strong></div>
                <div class="mt-3 d-flex gap-2 flex-wrap justify-content-end">
                  <a href="{{ route('bookings.create', $therapist->id) }}" class="btn btn-success">Book a Session</a>
                <a href="{{ url('/chatify/' . $therapist->user->id) }}" class="btn btn-outline-secondary">Message</a>
                </div>
              </div>
            </div>

            <hr>

            <div>
              <h5>About</h5>
              <p>{{ $therapist->description ?? 'No description provided.' }}</p>
            </div>

            <div>
              <h6>Languages</h6>
              @if($therapist->languages)
                @foreach(explode(',', $therapist->languages) as $lang)
                  <span class="badge tag">{{ trim($lang) }}</span>
                @endforeach
              @else
                <span class="text-muted">Not specified</span>
              @endif
            </div>

            <div class="mt-3">
              <h6>Availability</h6>
              @if($therapist->availability)
                <pre>{{ is_array($therapist->availability) ? json_encode($therapist->availability, JSON_PRETTY_PRINT) : $therapist->availability }}</pre>
              @else
                <span class="text-muted">Not provided</span>
              @endif
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
