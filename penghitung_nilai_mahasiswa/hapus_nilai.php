<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}
if ($_SESSION['level'] == "Mahasiswa") {
    echo "<script>alert('AKSES DITOLAK! Anda tidak berhak menghapus nilai.'); window.location='penilaian.php';</script>";
    exit;
}

$id = $_GET['id'];
$hapus = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_nilai='$id'");

if ($hapus) {
    echo "<script>alert('Data Nilai Berhasil Dihapus'); window.location='penilaian.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
