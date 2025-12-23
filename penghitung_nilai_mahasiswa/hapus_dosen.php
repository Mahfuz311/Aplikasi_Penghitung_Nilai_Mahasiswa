<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='dosen.php';</script>";
    exit;
}

mysqli_query($koneksi, "DELETE FROM dosen WHERE nidn='$_GET[nidn]'");
header("location:dosen.php");
