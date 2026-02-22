<?php
include '../koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

// Menghitung total menu
$total = mysqli_query($conn, "SELECT COUNT(*) as total FROM menu");
$total_menu = mysqli_fetch_assoc($total)['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .img-thumbnail-custom {
            width: 70px;
            height: 50px;
            object-fit: cover;
            /* Agar gambar tidak gepeng */
        }
    </style>
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">🍽️ Admin Restoran</a>
            <div class="ms-auto">
                <a href="daftar.php" class="btn btn-success btn-sm me-2">
                    + Tambah Admin Baru
                </a>
                <a href="tambah.php" class="btn btn-success btn-sm me-2">+ Tambah Menu</a>
                <a href="../index.php" class="btn btn-outline-light btn-sm me-2" target="_blank">Lihat Menu</a>
                <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-primary text-white text-center">
                    <div class="card-body">
                        <h6 class="card-title">Total Menu</h6>
                        <h2 class="display-6 fw-bold"><?php echo $total_menu; ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="mb-3">📋 Kelola Data Menu</h4>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Gambar</th>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                                <th>Kategori</th>
                                <th width="160">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $data = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++; ?></td>
                                    <td class="text-center">
                                        <?php if ($d['gambar']): ?>
                                            <img src="../uploads/<?php echo $d['gambar']; ?>" class="rounded img-thumbnail-custom">
                                        <?php else: ?>
                                            <span class="text-muted small">No Image</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold"><?php echo $d['nama_menu']; ?></td>
                                    <td>Rp <?php echo number_format($d['harga'], 0, ',', '.'); ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?php echo $d['kategori']; ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-outline-primary btn-sm me-1">Edit</a>
                                        <a href="hapus.php?id=<?php echo $d['id']; ?>"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>