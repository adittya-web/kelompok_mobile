<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e6f0ff, #d4f5e6);
            margin: 0;
            padding: 0;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 60px;
        }

        nav .logo {
            font-size: 28px;
            font-weight: bold;
            color: #3366cc;
        }

        nav .menu a {
            margin: 0 12px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav .menu a:hover {
            color: #0056b3;
        }

        .main-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 60px;
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
            color: #444;
            font-size: 18px;
            line-height: 1.6;
        }

        .main-text a.btn {
            padding: 12px 30px;
            background-color: #3366cc;
            color: white;
            border-radius: 50px;
            font-weight: bold;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .main-text a.btn:hover {
            background-color: #254b9b;
        }

        .main-image img {
            max-width: 400px;
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .main-section {
                flex-direction: column;
                text-align: center;
                padding: 30px;
            }

            nav {
                flex-direction: column;
                gap: 10px;
            }

            .main-image img {
                margin-top: 30px;
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
            <img src="{{ asset('/images/spals.png') }}" alt="Ilustrasi Laundry">
        </div>
    </section>

</body>
</html>
