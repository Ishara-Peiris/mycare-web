<x-app-layout>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f9fafb;
        }
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #2E073F, #7A1CAC, #AD49E1);
            color: #fff;
            padding-top: 20px;
            position: fixed;
            width: 250px;
            transition: all 0.3s;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 700;
            color: #EBD3F8;
        }
        .sidebar a {
            display: block;
            color: #EBD3F8;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #fff;
        }
        .sidebar .active {
            background: rgba(255,255,255,0.2);
            border-left: 4px solid #fff;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
        }
        .profile-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .profile-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #AD49E1;
        }
        .profile-card h4 {
            margin-top: 15px;
            font-weight: 700;
            color: #2E073F;
        }
        .profile-card p {
            color: #6b7280;
            font-size: 0.9rem;
        }
        .btn-purple {
            background: #7A1CAC;
            color: #fff;
            border-radius: 30px;
            padding: 8px 20px;
            font-weight: 500;
        }
        .btn-purple:hover {
            background: #AD49E1;
        }
    </style>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Doctor Panel</h3>
            <a href="#" class="active"><i class="fas fa-calendar-plus me-2"></i>Add Time Slots</a>
            <a href="#"><i class="fas fa-comments me-2"></i>Join Discussion</a>
            <a href="#"><i class="fas fa-folder-plus me-2"></i>Add Resources</a>
            <a href="#"><i class="fas fa-user-circle me-2"></i>Profile</a>
            <a href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
        </div>

        <!-- Content -->
        <div class="content w-100">
            <div class="container">
                <div class="row">
                    <!-- Profile Card -->
                    <div class="col-lg-4 mb-4">
                        <div class="profile-card">
                            <img src="{{ asset('storage/resources/cardimg.jpg') }}" alt="Doctor">
                            <h4>Dr. Ishara Peiris</h4>
                            <p>Specialist in Mental Health</p>
                            <button class="btn btn-purple mt-2"><i class="fas fa-edit me-1"></i>Edit Profile</button>
                        </div>
                    </div>

                    <!-- Dashboard Widgets -->
                    <div class="col-lg-8">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 p-4">
                                    <h5><i class="fas fa-calendar-plus text-purple me-2"></i>Add Time Slots</h5>
                                    <p class="text-muted">Manage your availability and schedule appointments.</p>
                                    <a href="{{ route('availabilities.create') }}" class="btn btn-purple btn-sm">Manage</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 p-4">
                                    <h5><i class="fas fa-comments text-purple me-2"></i>Join Discussion</h5>
                                    <p class="text-muted">Engage with other professionals in discussions.</p>
                                    <a href="#" class="btn btn-purple btn-sm">Join Now</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 p-4">
                                    <h5><i class="fas fa-folder-plus text-purple me-2"></i>Add Resources</h5>
                                    <p class="text-muted">Share useful resources with your patients.</p>
                                    <a href="#" class="btn btn-purple btn-sm">Upload</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm border-0 p-4">
                                    <h5><i class="fas fa-user-circle text-purple me-2"></i>Profile</h5>
                                    <p class="text-muted">Update your profile and professional details.</p>
                                    <a href="#" class="btn btn-purple btn-sm">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Font Awesome & Bootstrap JS -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
