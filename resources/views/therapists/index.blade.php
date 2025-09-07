<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Therapists</title>

  <!-- Bootstrap CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body { 
      background: #f0e9f7;
      font-family: 'Poppins', sans-serif;
    }

    h2 { color: #2E073F; font-weight: 700; }

    .btn-success {
      background: #7A1CAC;
      border: none;
      border-radius: 50px;
      padding: 0.5rem 1.5rem;
      font-weight: 500;
      transition: all 0.3s;
    }
    .btn-success:hover { background: #AD49E1; }

    .search-bar {
      max-width: 520px;
      border-radius: 50px;
      border: 1px solid #AD49E1;
      padding-left: 1rem;
    }
    .search-bar:focus {
      outline: none;
      box-shadow: 0 0 10px rgba(122,28,172,0.4);
      border-color: #7A1CAC;
    }

    .card {
      border-radius: 20px;
      background: rgba(173,73,225,0.08);
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    }

    .card-title { color: #2E073F; font-weight: 600; }
    .card p { color: #4c1d95; font-weight: 500; margin-bottom: 0.3rem; }
    .rating { color: #ffb400; font-weight: 600; }
    .badge { font-weight: 500; }

    .btn-outline-primary {
      border-radius: 50px;
      border: 1.5px solid #7A1CAC;
      color: #7A1CAC;
      font-weight: 500;
      transition: all 0.3s;
    }
    .btn-outline-primary:hover {
      background: #7A1CAC;
      color: #fff;
    }

    /* Circular profile image */
    .therapist-image {
      width: 150px;
      height: 150px;
      object-fit: cover;   /* cover ensures it fills the circle without distortion */
      border-radius: 50%;  /* makes it circular */
      margin: 0 auto 0.75rem auto;
      display: block;
      border: 2px solid #AD49E1;
    }

    @media (max-width: 576px) { .card-body { padding: 1rem; } }
  </style>
</head>
<body>
<div class="container py-5">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
    <h2 class="mb-0">Therapists</h2>
    <a href="{{ route('therapists.create') }}" class="btn btn-success">Create Profile</a>
  </div>

  <!-- Search -->
  <div class="mb-4">
    <input id="searchInput" class="form-control search-bar" placeholder="Search by name, specialization or language">
  </div>

  <!-- Therapist List -->
  <div class="row" id="therapistList">
    @forelse($therapists as $therapist)
      <div class="col-md-6 col-lg-4 mb-4 therapist-card" 
           data-name="{{ strtolower($therapist->user->name) }}" 
           data-spec="{{ strtolower($therapist->specialization) }}" 
           data-lang="{{ strtolower($therapist->languages) }}">
        <div class="card h-100 shadow-sm p-3 d-flex flex-column">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <h5 class="card-title mb-0">{{ $therapist->user->name }}</h5>
            <span class="badge bg-{{ $therapist->is_verified ? 'primary' : 'secondary' }}">
              {{ $therapist->is_verified ? 'Verified' : 'Unverified' }}
            </span>
          </div>

          <!-- Circular Therapist Image -->
          <img src="{{ $therapist->image ? asset('storage/' . $therapist->image) : 'https://via.placeholder.com/150' }}" 
               alt="{{ $therapist->user->name }}" class="therapist-image">

          <p><strong>Specialization:</strong> {{ $therapist->specialization }}</p>
          <p><strong>Experience:</strong> {{ $therapist->experience_years }} yrs</p>
          <p><strong>Fee:</strong> LKR {{ number_format($therapist->consultation_fee,2) }}</p>
          <p><strong>Languages:</strong> {{ $therapist->languages }}</p>

          <div class="mt-auto d-flex justify-content-between align-items-center">
            <div><span class="rating">{{ $therapist->rating ?? 0 }}/5</span></div>
            <div>
              <a href="{{ route('therapists.show', $therapist->id) }}" class="btn btn-sm btn-outline-primary">View</a>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">No therapists found.</div>
      </div>
    @endforelse
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Simple client-side search -->
<script>
  (function(){
    const input = document.getElementById('searchInput');
    const cards = Array.from(document.querySelectorAll('.therapist-card'));

    input.addEventListener('input', function(e){
      const q = e.target.value.trim().toLowerCase();
      if(!q) { cards.forEach(c => c.style.display = ''); return; }
      cards.forEach(c => {
        const name = c.dataset.name || '';
        const spec = c.dataset.spec || '';
        const lang = c.dataset.lang || '';
        const show = name.includes(q) || spec.includes(q) || lang.includes(q);
        c.style.display = show ? '' : 'none';
      });
    });
  })();
</script>
</body>
</html>
