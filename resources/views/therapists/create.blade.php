<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Therapist Profile</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">🩺 Create Therapist Profile</h3>

          <!-- Errors -->
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $err)
                  <li>{{ $err }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Form -->
          <form id="therapistForm" method="POST" action="{{ route('therapists.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label">Specialization *</label>
              <input type="text" name="specialization" class="form-control" value="{{ old('specialization') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Experience (Years) *</label>
              <input type="number" name="experience_years" class="form-control" value="{{ old('experience_years') }}" min="0" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Consultation Fee (USD) *</label>
              <input type="number" step="0.01" name="consultation_fee" class="form-control" value="{{ old('consultation_fee') }}" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Languages *</label>
              <input type="text" name="languages" class="form-control" value="{{ old('languages') }}" placeholder="e.g. English, Sinhala" required>
            </div>

           

            <div class="mb-3">
              <label class="form-label">Description / Bio</label>
              <textarea name="description" class="form-control" rows="4" placeholder="Write a short bio">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Profile Image</label>
              <input type="file" name="image" class="form-control">
            </div>

            <div class="d-flex justify-content-end">
              <button type="submit" class="btn btn-primary">Save Profile</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Alert for Pending Request -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('therapistForm');

    form.addEventListener('submit', function (e) {
      alert('✅ Your request is pending. We will review your profile shortly.');
      // Form will still submit to backend after alert
    });
  });
</script>

</body>
</html>
