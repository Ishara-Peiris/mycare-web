<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Availability</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #6a11cb, #8e44ad);
      font-family: 'Inter', sans-serif;
    }
    .card {
      border-radius: 18px;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #fff;
      width: 100%;
      max-width: 500px;
    }
    .card-body {
      padding: 2rem;
    }
    .card-title {
      font-size: 1.6rem;
      font-weight: 700;
      text-align: center;
      color: #fff;
      margin-bottom: 1.5rem;
    }
    .form-label {
      font-weight: 500;
      color: #f1f1f1;
    }
    .form-control {
      border-radius: 10px;
      border: 1px solid #ddd;
      padding: 0.75rem 1rem;
    }
    .form-control:focus {
      border-color: #6a11cb;
      box-shadow: 0 0 0 0.2rem rgba(106, 17, 203, 0.25);
    }
    .btn-primary {
      background: linear-gradient(135deg, #6a11cb, #8e44ad);
      border: none;
      border-radius: 12px;
      padding: 0.7rem 1.5rem;
      font-weight: 600;
      transition: all 0.2s ease;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg, #5a0fbf, #7a399f);
      transform: translateY(-2px);
      box-shadow: 0 6px 16px rgba(106,17,203,0.3);
    }
    .alert {
      border-radius: 12px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <h3 class="card-title">📅 Add Availability</h3>

        <!-- Flash Messages -->
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('availabilities.store') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">Available Date</label>
            <input type="date" name="available_date" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="time" name="end_time" class="form-control" required>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Availability</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
