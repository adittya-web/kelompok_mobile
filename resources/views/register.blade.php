<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Laundry Berkah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #fbc2eb, #a6c1ee);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 450px;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="auth-card">
    <h4 class="mb-4 text-center text-primary">Daftar Akun Laundry Berkah</h4>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary">Daftar</button>
        </div>
    </form>

    <div class="text-center mt-3">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
    </div>
</div>

</body>
</html>
