<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='mahasiswa.php';</script>";
    exit;
}

$nim = $_GET['nim'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'"));
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Mhs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-warning">Edit Mahasiswa</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-2">NIM: <input type="text" name="nim" class="form-control" value="<?= $d['nim'] ?>" readonly></div>
                <div class="mb-2">Nama: <input type="text" name="nama" class="form-control" value="<?= $d['nama_mahasiswa'] ?>" required></div>
                <div class="mb-2">Kelas: <input type="text" name="kelas" class="form-control" value="<?= $d['kelas'] ?>" required></div>
                <button name="update" class="btn btn-warning w-100 mt-3">Update</button>
                <a href="mahasiswa.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
            <?php if (isset($_POST['update'])) {
                $nim = $_POST['nim'];
                $nama = $_POST['nama'];
                $kls = $_POST['kelas'];
                mysqli_query($koneksi, "UPDATE mahasiswa SET nama_mahasiswa='$nama', kelas='$kls' WHERE nim='$nim'");
                echo "<script>window.location='mahasiswa.php'</script>";
            } ?>
        </div>
    </div>
</body>

</html>