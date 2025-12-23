<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $hapus = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_nilai = '$id'");

    if ($hapus) {
        echo "<script>alert('Data Dihapus'); window.location='index.php';</script>";
    } else {
        echo "Gagal menghapus";
    }
}
?>