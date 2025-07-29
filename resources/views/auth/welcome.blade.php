<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laundry Berkah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/png">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
    }
    .navbar {
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .navbar-brand span {
      color: #2a9df4;
    }
    .hero-section {
      background: linear-gradient(to right, #2a9df4, #2a9df4);
      color: white;
      padding: 80px 0;
    }
    .hero-text h1 {
      font-size: 48px;
      font-weight: 800;
    }
    .hero-text p {
      font-size: 18px;
      margin-top: 15px;
    }
    .btn-rounded {
      border-radius: 50px;
      padding: 10px 25px;
      font-weight: 600;
    }
    .btn-outline-white {
      border: 2px solid #fff;
      color: #fff;
      background: transparent;
    }
    .btn-outline-white:hover {
      background-color: #fff;
      color: #2a9df4;
    }
    .hero-image {
      max-width: 100%;
      border-radius: 10px;
    }
    footer {
      background: #fff;
      border-top: 1px solid #eee;
    }
    @media (max-width: 768px) {
      .hero-text h1 {
        font-size: 36px;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg px-4 py-3 container-fluid">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">Laundry<span>Berkah</span></a>
    <div class="ms-auto">
      <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container-fluid hero-section">
  <div class="container">
    <div class="row align-items-center">
      <!-- Left Text -->
      <div class="col-md-6 hero-text text-center text-md-start">
        <h1>Pakaian iky, Hidup Lebih Cerah</h1>
        <p>Nikmati layanan laundry cepat, bersih, dan wangi. Kami siap menjemput dan mengantar pakaian Anda!</p>
        <div class="mt-4">
          <a href="{{ route('login') }}" class="btn btn-light btn-rounded me-3">🧺 Login untuk Booking</a>
        </div>
      </div>
      <!-- Right Image -->
      <div class="col-md-6 text-center mt-4 mt-md-0">
        <i class="fas fa-tshirt fa-7x text-primary"></i> <!-- Ikon baju -->
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="text-center text-muted py-4">
  <small>&copy; {{ date('Y') }} Laundry Berkah. All rights reserved.</small>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
