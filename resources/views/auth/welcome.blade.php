<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Admin | Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e6f0ff, #d4f5e6);
        }

        nav {
            display: flex;
            justify-content: space-between;
            padding: 20px 60px;
            background-color: transparent;
        }

        nav .logo {
            font-size: 24px;
            font-weight: bold;
            color: #3366cc;
        }

        nav .menu a {
            margin: 0 15px;
            color: #666;
            text-decoration: none;
            font-weight: 500;
        }

        .main-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 60px;
            flex-wrap: wrap;
        }

        .main-text {
            max-width: 500px;
        }

        .main-text h1 {
            font-size: 52px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .main-text p {
            margin: 20px 0;
            color: #555;
            font-size: 18px;
        }

        .main-text a.btn {
            padding: 12px 28px;
            background-color: #3366cc;
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
        }

        .main-image img {
            max-width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .main-section {
                flex-direction: column;
                text-align: center;
            }

            nav {
                flex-direction: column;
                align-items: center;
            }

            .main-text h1 {
                font-size: 36px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">Laundry</div>
        <div class="menu">
            <a href="#">Sign In</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="#">FAQ</a>
        </div>
    </nav>

    <section class="main-section">
        <div class="main-text">
            <h1>Laundry</h1>
            <p>Solusi terbaik untuk kebutuhan cucian Anda. Layanan laundry cepat, bersih, dan terpercaya dengan harga terjangkau.</p>

            <a href="{{ route('login') }}" class="btn">Login</a>
        </div>
        <div class="main-image">
            <img src="{{ asset('/screens.png') }}" alt="Laundry Illustration">
        </div>
    </section>

</body>
</html>
