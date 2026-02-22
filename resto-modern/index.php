<?php
include 'koneksi.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Proteksi login dihapus agar publik bisa akses halaman ini
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Restoran Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1514362545857-3bc16c4c7d1b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: white;
        }

        /* Navbar Style */
        .navbar {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }

        .header-title {
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .card {
            border: none;
            border-radius: 20px;
            transition: all 0.4s ease;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.95);
            color: #333;
        }

        .card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .card-img-top {
            transition: transform 0.6s ease;
        }

        .card:hover .card-img-top {
            transform: scale(1.1);
        }

        .badge {
            border-radius: 50px;
            padding: 6px 15px;
            background-color: #ffc107 !important;
            color: #212529 !important;
            font-weight: 600;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: 700;
            color: #27ae60;
        }
        
        .btn-admin {
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">🍽️ Aksara Rasa</a>
    <div class="ms-auto">
        <?php if(isset($_SESSION['login'])): ?>
            <a href="admin/dashboard.php" class="btn btn-warning btn-sm btn-admin">Ke Dashboard</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-outline-light btn-sm btn-admin">🔐 Login Admin</a>
        <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container pb-5">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="header-title">Menu Restoran</h2>
        </div>
    </div>
    
    <div class="row">
    <?php
    $data = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
    while($d = mysqli_fetch_array($data)){
    ?>
        <div class="col-md-4 mb-5">
            <div class="card h-100 shadow">
                <div style="overflow: hidden; height: 230px;">
                    <img src="uploads/<?php echo $d['gambar']; ?>" class="card-img-top" alt="<?php echo $d['nama_menu']; ?>" style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                
                <div class="card-body p-4 d-flex flex-column">
                    <div class="mb-2">
                        <span class="badge"><?php echo $d['kategori']; ?></span>
                    </div>
                    
                    <h5 class="card-title fw-bold"><?php echo $d['nama_menu']; ?></h5>
                    
                    <p class="card-text text-muted flex-grow-1" style="font-size: 0.9rem;">
                        <?php echo $d['deskripsi']; ?>
                    </p>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="price-tag">Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>