<?php
include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['daftar'])){
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Cek apakah username sudah ada
    $cek_user = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user'");
    if(mysqli_num_rows($cek_user) > 0){
        $error = "Username sudah terdaftar!";
    } else {
        // Cek kecocokan password
        if($pass !== $confirm){
            $error = "Konfirmasi password tidak sesuai!";
        } else {
            // Enkripsi password dengan MD5 (sesuaikan dengan sistem loginmu)
            $pass_fix = md5($pass);
            $query = "INSERT INTO admin (username, password) VALUES ('$user', '$pass_fix')";
            
            if(mysqli_query($conn, $query)){
                echo "<script>alert('Admin Baru Berhasil Didaftarkan!'); window.location='dashboard.php';</script>";
            } else {
                $error = "Gagal mendaftar: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Admin Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: white;
        }
        .reg-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.3);
            color: #fff;
            box-shadow: none;
        }
        .btn-register {
            background: #27ae60;
            border: none;
            font-weight: 600;
        }
        .btn-register:hover {
            background: #219150;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">

<div class="reg-container text-center">
    <h3 class="mb-4">👤 Registrasi Admin</h3>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger py-2" style="font-size: 0.8rem; background: rgba(255,0,0,0.2); color: #ffb3b3; border: none;">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="small mb-1">Username Baru</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
            <label class="small mb-1">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-4 text-start">
            <label class="small mb-1">Konfirmasi Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button name="daftar" class="btn btn-success btn-register w-100 mb-3">DAFTARKAN ADMIN</button>
        <a href="dashboard.php" class="text-white-50 text-decoration-none small">← Batal & Kembali</a>
    </form>
</div>

</body>
</html>