<?php
include '../koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga     = $_POST['harga'];
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);

    // Proses Gambar
    $gambar    = $_FILES['gambar']['name'];
    $tmp       = $_FILES['gambar']['tmp_name'];
    
    // Simpan ke folder uploads yang ada di luar folder admin
    $path      = "../uploads/" . $gambar;

    if(move_uploaded_file($tmp, $path)){
        // Gunakan nama kolom agar tidak error jika ada ID auto_increment
        $query = "INSERT INTO menu (nama_menu, deskripsi, harga, kategori, gambar) 
                  VALUES ('$nama', '$deskripsi', '$harga', '$kategori', '$gambar')";
        
        if(mysqli_query($conn, $query)){
            echo "<script>alert('Data Berhasil Ditambah!'); window.location='dashboard.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Gagal Upload Gambar! Pastikan folder uploads sudah ada.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Menu - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h3 class="mb-4 text-center">➕ Tambah Menu Baru</h3>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: Nasi Goreng Spesial" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Ceritakan kelezatan menumu..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="Indonesian Food">Indonesian Food</option>
                                    <option value="Western">Western</option>
                                    <option value="Drinks">Drinks</option>
                                    <option value="Dessert">Dessert</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Menu</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button name="simpan" class="btn btn-primary">Simpan Menu</button>
                            <a href="dashboard.php" class="btn btn-outline-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>