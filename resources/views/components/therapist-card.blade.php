<div class="card shadow-sm border-0 rounded-4 overflow-hidden mb-4" style="background:#f8fbff;">
  <div class="card-body d-flex gap-4">
    
    <!-- Profile Image -->
    <div class="flex-shrink-0">
      <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
           style="width:100px; height:100px; overflow:hidden;">
        @if($therapist->user->profile_photo_path ?? false)
          <img src="{{ asset('storage/'.$therapist->user->profile_photo_path) }}" 
               alt="profile" class="img-fluid">
        @else
          <span class="fs-3 fw-bold text-secondary">
            {{ strtoupper(substr($therapist->user->name,0,1)) }}
          </span>
        @endif
      </div>
    </div>

    <!-- Details -->
    <div class="flex-grow-1">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <h4 class="mb-1 fw-bold">{{ $therapist->user->name }}</h4>
          <p class="mb-2 text-muted">
            {{ $therapist->specialization }} • {{ $therapist->experience_years }} yrs exp
          </p>
        </div>
        <div class="text-end">
          <span class="badge bg-{{ $therapist->is_verified ? 'success' : 'secondary' }}">
            {{ $therapist->is_verified ? 'Verified' : 'Unverified' }}
          </span>
          <div class="fw-bold mt-2 text-warning">{{ $therapist->rating }}/5 ★</div>
        </div>
      </div>

      <p class="mt-2 small">{{ Str::limit($therapist->description, 120) }}</p>

      <div class="mb-2">
        @if($therapist->languages)
          @foreach(explode(',', $therapist->languages) as $lang)
            <span class="badge bg-light text-dark border me-1">{{ trim($lang) }}</span>
          @endforeach
        @else
          <span class="text-muted">No languages listed</span>
        @endif
      </div>

      <div class="d-flex gap-2">
        <a href="{{ route('bookings.create', $therapist->id) }}" class="btn btn-sm btn-primary rounded-pill">
          Book Session
        </a>
        <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">Message</a>
      </div>
    </div>
  </div>
</div>
