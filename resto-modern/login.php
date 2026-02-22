<?php
include 'koneksi.php';

// Jangan lupa session_start() jika belum ada di koneksi.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['login'])){
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    if(mysqli_num_rows($cek) > 0){
        $_SESSION['login'] = true;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Resto Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            /* Menggunakan background yang sama dengan index.php agar serasi */
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            /* Efek Kaca (Glassmorphism) */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }

        .login-container h3 {
            color: #fff;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 10px;
            color: #fff;
            padding: 12px 20px;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .btn-login {
            background: #e74c3c;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .back-to-home {
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .back-to-home:hover {
            color: #fff;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

<div class="login-container text-center">
    <div class="mb-4">
        <h3 class="mb-1">🔐 Admin Login</h3>
        <p class="text-white-50 small">Restoran Modern Management</p>
    </div>

    <?php if(isset($error)) { ?>
        <div class="alert alert-danger py-2" style="font-size: 0.85rem; background: rgba(220, 53, 69, 0.2); color: #ff8c94; border: none;">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="text-white-50 small mb-1 ms-1">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan username..." required>
        </div>

        <div class="mb-4 text-start">
            <label class="text-white-50 small mb-1 ms-1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
        </div>

        <button name="login" class="btn btn-primary btn-login w-100 shadow mb-3">Login</button>
        
        <a href="index.php" class="back-to-home">← Kembali ke Halaman Utama</a>
    </form>
</div>

</body>
</html>