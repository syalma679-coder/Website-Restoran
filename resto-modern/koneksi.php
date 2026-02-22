<?php
$conn = mysqli_connect("localhost", "root", "", "restoran_modern");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
session_start();
?>