<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='staff.php';</script>";
    exit;
}

mysqli_query($koneksi, "DELETE FROM staff_akademik WHERE id_staff='$_GET[id]'");
header("location:staff.php");
