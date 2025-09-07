<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Dashboard</title>

  <!-- Bootstrap & AdminKit -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@adminkit/core@3.4.0/dist/css/app.css" rel="stylesheet">

  <style>
    /* Sidebar */
    #sidebar {
      background: linear-gradient(180deg, #2E073F, #7A1CAC, #AD49E1);
    }
    #sidebar .sidebar-brand {
      color: #EBD3F8;
      font-weight: 700;
      text-align: center;
      margin-bottom: 1rem;
    }
    #sidebar .sidebar-nav .sidebar-item.active > .sidebar-link {
      background: rgba(255, 255, 255, 0.2);
      border-left: 4px solid #fff;
      color: #fff;
    }
    #sidebar .sidebar-link {
      color: #EBD3F8;
      transition: all 0.3s;
    }
    #sidebar .sidebar-link:hover {
      background: rgba(255,255,255,0.1);
      border-left: 4px solid #fff;
    }

    /* Navbar */
    .navbar-bg {
      background: #7A1CAC !important;
    }
    .navbar .nav-link, .navbar .btn {
      color: #EBD3F8 !important;
    }

    /* Cards */
    .card {
      border-radius: 15px;
      transition: transform 0.2s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .card-title {
      color: #2E073F;
      font-weight: 700;
    }
    .card-text {
      color: #6b7280;
    }

    /* Buttons */
    .btn-primary {
      background: #7A1CAC;
      border: none;
    }
    .btn-primary:hover {
      background: #AD49E1;
    }
    .btn-success {
      background: #AD49E1;
      border: none;
    }
    .btn-success:hover {
      background: #EBD3F8;
      color: #2E073F;
    }
    .btn-warning {
      background: #7A1CAC;
      border: none;
    }
    .btn-warning:hover {
      background: #AD49E1;
      color: #fff;
    }

    /* Footer */
    .footer {
      background: #2E073F;
      color: #EBD3F8;
      padding: 15px 0;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar js-sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="#">
          <span class="align-middle">Admin Panel</span>
        </a>
        <ul class="sidebar-nav">
          <li class="sidebar-item active">
            <a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="home"></i>
              <span class="align-middle">Dashboard</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="users"></i>
              <span class="align-middle">Therapists</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="book"></i>
              <span class="align-middle">Resource Hub</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="#">
              <i class="align-middle" data-feather="message-circle"></i>
              <span class="align-middle">Discussions</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main -->
    <div class="main">
      <!-- Navbar -->
      <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>
        <div class="navbar-collapse collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <span class="nav-link">Hello, Admin</span>
            </li>
            <li class="nav-item">
              <a href="#" class="btn btn-sm btn-danger">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Content -->
      <main class="content">
        <div class="container-fluid p-0">
          <h1 class="h3 mb-4">Welcome to Admin Dashboard</h1>

          <div class="row">
            <!-- Therapists -->
            <div class="col-md-4">
              <div class="card shadow-sm">
                <div class="card-body text-center">
                  <h5 class="card-title">Therapists</h5>
                  <p class="card-text">Manage therapist accounts and details.</p>
                  <a href="{{ route('admin.therapists') }}" class="btn btn-primary">Go</a>
                </div>
              </div>
            </div>

            <!-- Resource Hub -->
<div class="col-md-4">
  <div class="card shadow-sm">
    <div class="card-body text-center">
      <h5 class="card-title">Resource Hub</h5>
      <p class="card-text">Upload articles and videos for users.</p>
      <a href="{{ route('resources.create') }}" class="btn btn-success">Upload Resource</a>
    </div>
  </div>
</div>

            <!-- Discussions -->
            <div class="col-md-4">
              <div class="card shadow-sm">
                <div class="card-body text-center">
                  <h5 class="card-title">Discussions</h5>
                  <p class="card-text">Manage discussion posts and comments.</p>
                  <a href="#" class="btn btn-warning">Go</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="footer">
        <div class="container-fluid text-center">
          <small class="text-muted">© 2025 Admin Dashboard</small>
        </div>
      </footer>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@adminkit/core@3.4.0/dist/js/app.js"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <script>feather.replace()</script>
</body>
</html>
