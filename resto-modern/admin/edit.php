<?php
include '../koneksi.php';
if(!isset($_SESSION['login'])){
    header("Location: ../login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM menu WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $kategori = $_POST['kategori'];

    mysqli_query($conn, "UPDATE menu SET 
        nama_menu='$nama',
        deskripsi='$deskripsi',
        harga='$harga',
        kategori='$kategori'
        WHERE id='$id'");

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Menu</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow p-4">
<h3 class="mb-4">✏ Edit Menu</h3>

<form method="POST">
    <div class="mb-3">
        <label>Nama Menu</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $d['nama_menu']; ?>">
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"><?php echo $d['deskripsi']; ?></textarea>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="form-control" value="<?php echo $d['harga']; ?>">
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="<?php echo $d['kategori']; ?>">
    </div>

    <button name="update" class="btn btn-primary">Update</button>
    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>

</body>
</html>