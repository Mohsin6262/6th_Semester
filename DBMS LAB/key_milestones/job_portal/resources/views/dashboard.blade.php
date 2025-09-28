<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Job Sphere Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar-brand img {
      height: 30px;
      margin-right: 8px;
    }

    .hero-section {
      background: url('https://images.unsplash.com/photo-1521791055366-0d553872125f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80') center/cover no-repeat;
      min-height: 85vh;
      color: white;
      position: relative;
      display: flex;
      align-items: center;
    }

    .hero-overlay {
      background: rgba(0, 0, 0, 0.65);
      width: 100%;
      padding: 60px 20px;
    }

    .hero-text h1 {
      font-size: 3rem;
      font-weight: 700;
    }

    .hero-text p {
      font-size: 1.25rem;
    }

    .btn-explore {
      background-color: #ff7300;
      border: none;
    }

    .btn-explore:hover {
      background-color: #e26000;
    }

    .mission-vision {
      background-color: #ffffff;
      margin-top: -50px;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
      <img src="https://cdn-icons-png.flaticon.com/512/3075/3075926.png" alt="Logo">
      <span>JOB SPHERE</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">
        <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('jobs.index') }}">View Jobs</a></li>

        @if(session('user') && session('user')->UserType === 'jobseeker')
          <li class="nav-item"><a class="nav-link" href="{{ route('jobseeker.applications') }}">My Applications</a></li>
        @endif

        @if(session('user') && session('user')->UserType === 'employer')
          <li class="nav-item"><a class="nav-link" href="{{ route('jobs.create') }}">Post Job</a></li>
        @endif

        {{-- ✅ Show Admin Panel only to UserID 13 who is employer --}}
@if(session('user') && session('user')->UserID == 13 && session('user')->UserType === 'employer')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.page') }}">Admin</a>
    </li>
@endif


        <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container hero-overlay text-center">
    <div class="hero-text">
      <h1>Welcome to JOB SPHERE</h1>
      <p class="mt-2">Hello, <strong>{{ session('user')->Name }}</strong>! 👋</p>
      <p>Connecting top talent with the best companies worldwide.</p>
      <a href="{{ route('jobs.index') }}" class="btn btn-explore btn-lg mt-4">Explore Job Openings</a>
    </div>
  </div>
</section>

<!-- Mission & Vision Section -->
<div class="container mission-vision mt-5">
  <div class="row text-center">
    <div class="col-md-6 mb-4">
      <h5>Our Vision</h5>
      <p>To be the most innovative and inclusive career platform globally, empowering job seekers and companies alike.</p>
    </div>
    <div class="col-md-6 mb-4">
      <h5>Our Mission</h5>
      <p>To deliver exceptional career opportunities through smart technology and personalized support.</p>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
