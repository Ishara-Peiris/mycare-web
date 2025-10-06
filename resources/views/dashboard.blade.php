<x-app-layout>
    <style>
        /* General Reset */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .navbar-custom {
            display: flex;
            justify-content: center;
            gap: 40px;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .navbar-custom a {
            text-decoration: none;
            font-weight: 600;
            color: #1f2937;
            transition: 0.3s;
        }

        .navbar-custom a:hover {
            color: #6b21a8;
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            padding: 80px 10%;
            background: linear-gradient(135deg, #7e22ce, #6b21a8, #4c1d95);
            color: #fff;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 40px 40px;
        }

        .hero-content {
            max-width: 500px;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .hero-content span {
            font-style: italic;
            font-family: 'Brush Script MT', cursive;
            font-size: 3.2rem;
        }

        .hero-content p {
            font-size: 1.1rem;
            margin-bottom: 25px;
        }

        .hero-content a {
            background: #fff;
            color: #6b21a8;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .hero-content a:hover {
            background: #f3e8ff;
        }

        /* Quick Access Section */
        .quick-access-section {
            padding: 60px 10%;
            display: flex;
            justify-content: center;
        }

        .quick-access-card {
            position: relative;
            display: flex;
            max-width: 1200px;
            height: 400px;
            width: 100%;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
            transition: transform 0.3s, box-shadow 0.3s;
            background: linear-gradient(135deg, #7e22ce, #b16aecff);
            color: #fff;
        }

        .quick-access-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.35);
        }

        .quick-access-card img {
    width: 40%;       /* Smaller image */
    object-fit: cover;
    height: 100%;
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
}

        .quick-access-card-content {
            padding: 40px 30px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .quick-access-card h3 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .quick-access-card p {
            font-size: 1.05rem;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .quick-access-card a {
            align-self: flex-start;
            background: #fff;
            color: #6b21a8;
            padding: 12px 30px;
            border-radius: 35px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .quick-access-card a:hover {
            background: #f3e8ff;
            color: #5b189b;
        }

        @media (max-width: 992px) {
            .quick-access-card {
                flex-direction: column;
                height: auto;
            }
            .quick-access-card img, .quick-access-card-content {
                width: 100%;
            }
        }

    </style>

    <!-- Navbar -->
    <nav class="navbar-custom">
        <a href="{{ url('/') }}">Home</a>
        <a href="#">Philosophy</a>
        <a href="#">Hours</a>
        <a href="#">Courses</a>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1><span>Mycare</span> <br>Where Support Meets Strength</h1>
            <p>Together, let’s walk the path to mental wellness and balance</p>
            <a href="#">Let’s Begin</a>
            <a href="{{ route('therapists.create') }}" class="btn btn-register btn-lg">Join as a Therapist</a>

        </div>
    </section>

    <!-- Quick Access Card Section -->
    <section class="quick-access-section">
        <div class="quick-access-card">
            <img src="{{ asset('storage/resources/cardimg.jpg') }}" alt="Therapists">
            <div class="quick-access-card-content">
                <h3>Meet Our Therapists</h3>
                <p>Explore verified therapists and book your session directly. Find the right therapist for your needs.</p>
                <a href="{{ route('therapists.index') }}">View Therapists</a>
            </div>
        </div>
    </section>




    <!-- Quick Access Card Section -->
    <section class="quick-access-section">
        <div class="quick-access-card">
            <img src="{{ asset('storage/resources/card2img.jpg') }}" alt="Therapists">
            <div class="quick-access-card-content">
                <h3>Find resources</h3>
                <p>Explore materials for mental wellness and self-care.</p>
                <a href="{{ route('resources.categories') }}">View Resources</a>
            </div>
        </div>
    </section>


    <!-- Quick Access Card Section -->
    <section class="quick-access-section">
        <div class="quick-access-card">
            <img src="{{ asset('storage/resources/card3img.jpg') }}" alt="Therapists">
            <div class="quick-access-card-content">
                <h3>Join Discussion</h3>
                <p>Engage with others on topics of mental wellness and self-care.</p>
            <a href="{{ route('home2.show') }}">Join Now</a>
            </div>
        </div>
    </section>

    <x-footer />

</x-app-layout>
