<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2E073F, #7A1CAC);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            color: #2E073F;
        }

        .card {
            background: #ffffff;
            border: none;
            border-radius: 25px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }

        h1 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1rem;
            color: #2E073F;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
            color: #2E073F;
        }

        .btn-login {
            background: linear-gradient(45deg, #7A1CAC, #AD49E1);
            color: white;
            font-weight: 600;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            transition: 0.3s;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(45deg, #AD49E1, #7A1CAC);
            transform: scale(1.05);
        }

        .btn-register {
            background: linear-gradient(45deg, #EBD3F8, #AD49E1);
            color: #2E073F;
            font-weight: 600;
            padding: 0.8rem 2.5rem;
            border-radius: 50px;
            transition: 0.3s;
            width: 100%;
        }

        .btn-register:hover {
            background: linear-gradient(45deg, #AD49E1, #EBD3F8);
            transform: scale(1.05);
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .hero-img {
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 200px;
            opacity: 0.1;
            transform: rotate(-20deg);
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Welcome to Your Healing Journey</h1>
    <p>We are glad you are here! Whether returning or just starting, your path to wellness begins today.</p>

    <div class="buttons">
        @if (Route::has('login'))
            <a href="{{ route('login') }}" class="btn btn-login btn-lg">Login</a>

            @if (Route::has('register'))
                <!-- Patient Registration -->
                <a href="{{ route('register', ['role' => 'patient']) }}" class="btn btn-register btn-lg">Register</a>

                <!-- Therapist Registration -->
<!-- Therapist Registration -->
            @endif
        @endif
    </div>

    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" 
         alt="Healing Illustration" class="hero-img">
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
