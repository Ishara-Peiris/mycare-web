<footer class="footer text-white py-3 mt-5">
    <style>
        .footer {
            background: linear-gradient(135deg, #4c1d95, #6b21a8, #7e22ce);
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            font-size: 0.9rem;
        }
        .footer h5 {
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 1rem;
        }
        .footer a {
            color: #d1d5db;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }
        .footer a:hover {
            color: #ffffff;
        }
        .footer .social-icons a {
            font-size: 1.1rem;
            margin-right: 10px;
            display: inline-block;
            color: #d1d5db;
            transition: color 0.3s, transform 0.3s;
        }
        .footer .social-icons a:hover {
            color: #fff;
            transform: translateY(-2px);
        }
    </style>

    <div class="container">
        <div class="row align-items-center">
            <!-- Left Section -->
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <p class="small m-0">
                    MyCare is the largest healthcare appointment platform in Sri Lanka,
                    connecting patients with trusted doctors easily.
                </p>
            </div>

            <!-- Center Section -->
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <h5>Company</h5>
                <ul class="list-unstyled mb-0">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                    <li><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Right Section -->
            <div class="col-md-4 text-center text-md-end">
                <h5>Follow us</h5>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <!-- Bottom Note -->
        <div class="text-center small mt-3">
            © {{ date('Y') }} MyCare. All rights reserved.
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
</footer>
