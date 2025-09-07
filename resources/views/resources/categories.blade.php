<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Categories</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #2E073F, #7A1CAC, #AD49E1);
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .container {
            z-index: 2;
            position: relative;
        }

        h2 {
            font-size: 2.5rem;
            text-shadow: 1px 1px 10px rgba(0,0,0,0.3);
        }

        /* Search Bar */
        .search-bar {
            max-width: 500px;
            margin: 0 auto 40px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 15px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .search-bar input {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 1.1rem;
        }
        .search-bar input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* Category Cards */
        .card {
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.05);
            box-shadow: 0 15px 25px rgba(0,0,0,0.3);
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            background-color: rgba(235, 211, 248, 0.8);
            color: #7A1CAC;
            font-size: 28px;
            font-weight: bold;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.2rem;
        }

        .card-text {
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .link-purple {
            color: #EBD3F8;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .link-purple:hover {
            text-decoration: underline;
            color: #fff;
        }

        @media (max-width: 576px) {
            .card-title { font-size: 1rem; }
            .card-text { font-size: 0.85rem; }
            .icon-circle { width: 60px; height: 60px; font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Browse Categories</h2>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control" placeholder="Search categories...">
        </div>

        <!-- Categories Grid -->
        <div class="row g-4" id="categoryGrid">
            @foreach($categories as $category)
                <div class="col-12 col-sm-6 col-md-4 category-card">
                    <a href="{{ route('resources.show', $category->id) }}" class="text-decoration-none">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body text-center">
                                <!-- Circle Placeholder -->
                                <div class="icon-circle">
                                    {{ strtoupper(substr($category->name, 0, 1)) }}
                                </div>

                                <!-- Category Title -->
                                <h5 class="card-title">
                                    {{ $category->name }}
                                </h5>

                                <!-- Description -->
                                <p class="card-text">
                                    Explore helpful resources and support for <strong>{{ $category->name }}</strong>.
                                </p>

                                <!-- Learn More -->
                                <span class="link-purple">Learn More →</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Search Script -->
    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let cards = document.querySelectorAll(".category-card");

            cards.forEach(function(card) {
                let title = card.querySelector(".card-title").innerText.toLowerCase();
                if (title.includes(filter)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
