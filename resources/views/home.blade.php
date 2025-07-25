<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Laundry Berkah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      color: #00b39f;
    }
    .hero-section {
      background: linear-gradient(to right, #00b39f, #00e5b0);
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
      color: #00b39f;
    }
    .hero-image {
      max-width: 100%;
      border-radius: 10px;
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
<nav class="navbar navbar-expand-lg px-4 py-3">
  <a class="navbar-brand fw-bold" href="#">Laundry<span>Berkah</span></a>
  <div class="ms-auto">
    <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
  </div>
</nav>

<!-- Hero Section -->
<div class="container-fluid hero-section">
  <div class="container">
    <div class="row align-items-center">
      <!-- Left Text -->
      <div class="col-md-6 hero-text text-center text-md-start">
        <h1>Pakaian Bersih, Hidup Lebih Cerah</h1>
        <p>Nikmati layanan laundry cepat, bersih, dan wangi. Kami siap menjemput dan mengantar pakaian Anda!</p>
        <div class="mt-4">
          <a href="{{ route('login') }}" class="btn btn-light btn-rounded me-3">🧺 Login untuk Booking</a>
          <a href="#" class="btn btn-outline-white btn-rounded">Lihat Jadwal</a>
        </div>
      </div>
      <!-- Right Image -->
      <div class="col-md-6 text-center mt-4 mt-md-0">
        <img src="/assets/img/laundry-hero.png" alt="Laundry Image" class="hero-image">
      </div>
    </div>
  </div>
</div>

</body>
</html>
