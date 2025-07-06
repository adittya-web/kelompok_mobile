<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            padding: 100px 20px;
            text-align: center;
            background-color: #f0f8ff;
        }
        .feature {
            text-align: center;
            padding: 40px 20px;
        }
        .feature-icon {
            font-size: 40px;
            margin-bottom: 15px;
            color: #007bff;
        }
        .navbar-brand span {
            color: #007bff;
        }
        .navbar .nav-link {
            margin-left: 10px;
        }
    </style>
</head>
<body>

<!-- NAVIGATION -->
<nav class="navbar navbar-expand-lg navbar-light bg-light px-4">
    <a class="navbar-brand fw-bold" href="#">Laundry<span>Berkah</span></a>
    <div class="ms-auto">
        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Sign In</a>
        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
    </div>
</nav>

<!-- HERO SECTION -->
<div class="hero">
    <h1 class="display-5 fw-bold">Selamat Datang di <span class="text-primary">Laundry Berkah</span></h1>
    <p class="lead mt-3">Solusi mudah dan cepat untuk mencuci pakaian Anda. Kami siap menjemput dan mengantar kembali dengan bersih dan wangi!</p>
</div>

<!-- FITUR -->
<div class="container">
    <div class="row">
        <div class="col-md-4 feature">
            <div class="feature-icon">👕</div>
            <h5>Layanan Cepat</h5>
            <p>Proses laundry dalam waktu singkat dengan hasil bersih maksimal.</p>
        </div>
        <div class="col-md-4 feature">
            <div class="feature-icon">🚚</div>
            <h5>Jemput Antar</h5>
            <p>Kami menjemput pakaian Anda dan mengantarkannya kembali.</p>
        </div>
        <div class="col-md-4 feature">
            <div class="feature-icon">⭐</div>
            <h5>Kualitas Terbaik</h5>
            <p>Pakaian bersih, harum, dan disetrika rapi oleh tenaga profesional.</p>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="text-center mt-5 mb-4 text-muted">
    &copy; {{ date('Y') }} Laundry Berkah
</footer>

</body>
</html>
