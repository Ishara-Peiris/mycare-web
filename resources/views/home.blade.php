<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 80px 20px;
            background: url('https://source.unsplash.com/1600x900/?technology') no-repeat center center/cover;
            color: #fff;
        }

        .hero h1 {
            font-size: 2.8rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.1rem;
            margin-bottom: 25px;
            text-shadow: 1px 1px 6px rgba(0,0,0,0.5);
        }

        .hero a {
            text-decoration: none;
            padding: 12px 25px;
            background-color: #6b21a8; /* purple theme */
            color: #fff;
            font-weight: bold;
            border-radius: 6px;
            transition: 0.3s;
        }

        .hero a:hover {
            background-color: #4c1d95;
        }

        /* Features Section */
        .features {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
            padding: 60px 20px;
        }

        .card-custom {
            background-color: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
            width: 250px;
            transition: 0.3s;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .card-custom img {
            width: 70px;
            margin-bottom: 15px;
        }

        .card-custom h3 {
            margin-bottom: 12px;
            color: #6b21a8;
        }

        .card-custom p {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 25px 20px;
            background-color: #6b21a8;
            color: #fff;
            margin-top: 40px;
        }
    </style>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>Creative mind. Passionate about IT + Management. UI/UX enthusiast.</p>
        <a href="#">Explore Dashboard</a>
    </section>

    <!-- Features -->
    <section class="features">
        <div class="card-custom">
            <img src="https://source.unsplash.com/100x100/?schedule" alt="Slots">
            <h3>Add Time Slots</h3>
            <p>Set your available time slots and manage your schedule easily.</p>
        </div>

        <div class="card-custom">
            <img src="https://source.unsplash.com/100x100/?profile" alt="Profile">
            <h3>Profile</h3>
            <p>Update your personal information and manage your profile settings.</p>
        </div>

        <div class="card-custom">
            <img src="https://source.unsplash.com/100x100/?appointments" alt="Appointments">
            <h3>View Appointments</h3>
            <p>Keep track of your upcoming and past appointments.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} My System. All rights reserved.</p>
    </footer>
</x-app-layout>
