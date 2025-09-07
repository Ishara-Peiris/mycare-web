<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #6a0dad, #9b59b6);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Inter', sans-serif;
    }
    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    .card-header {
      border-bottom: none;
      text-align: center;
      color: #fff;
    }
    .form-control {
      border-radius: 12px;
      padding: 12px;
      border: 1px solid #ddd;
    }
    .btn-purple {
      background: #6a0dad;
      color: #fff;
      font-weight: 600;
      border-radius: 12px;
      transition: all 0.3s ease;
    }
    .btn-purple:hover {
      background: #550a8a;
      color: #fff;
    }
    .text-link {
      color: #eee;
    }
    .text-link:hover {
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card p-4">
        <div class="card-header">
          <h3>Create Account</h3>
          <p class="text-light">Join our platform today</p>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label text-white">Name</label>
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
              @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label text-white">Email</label>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
              @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label text-white">Password</label>
              <input id="password" type="password" class="form-control" name="password" required>
              @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
              <label for="password_confirmation" class="form-label text-white">Confirm Password</label>
              <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
              @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <!-- Register Button -->
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-purple btn-lg">Register</button>
            </div>

            <!-- Login Link -->
            <div class="text-center">
              <p class="mb-0 text-light">Already registered? 
                <a href="{{ route('login') }}" class="text-link">Log in</a>
              </p>
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
