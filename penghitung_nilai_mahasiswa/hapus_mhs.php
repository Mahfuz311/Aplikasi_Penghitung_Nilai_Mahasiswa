<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='mahasiswa.php';</script>";
    exit;
}

mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$_GET[nim]'");
header("location:mahasiswa.php");
