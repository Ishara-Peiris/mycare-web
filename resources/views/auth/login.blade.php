<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

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
    }
    .card-body {
      padding: 2rem;
    }
    .card-title {
      font-size: 1.6rem;
      font-weight: 700;
      color: #fff;
      text-align: center;
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
    .form-check-label {
      color: #eee;
    }
    .link-light {
      color: #ddd;
    }
    .link-light:hover {
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title"> Log in</h3>

            <!-- Session Status -->
            @if(session('status'))
              <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control" required>
              </div>

              <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Remember me</label>
              </div>

              <div class="d-flex justify-content-between align-items-center">
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="link-light text-decoration-underline">Forgot your password?</a>
                @endif
                <button type="submit" class="btn btn-primary">Log in</button>
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
