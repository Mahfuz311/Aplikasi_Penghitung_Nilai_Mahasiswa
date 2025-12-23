<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='dosen.php';</script>";
    exit;
}

$nidn = $_GET['nidn'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dosen WHERE nidn='$nidn'"));
?>
<!DOCTYPE html>
<html>

<body class="container mt-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-warning">Edit Dosen</div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="nidn" value="<?= $d['nidn'] ?>" class="form-control mb-2" readonly>
                <input type="text" name="nama" value="<?= $d['nama_dosen'] ?>" class="form-control mb-2">
                <input type="text" name="matkul" value="<?= $d['mata_kuliah'] ?>" class="form-control mb-2">
                <button name="update" class="btn btn-warning w-100">Update</button>
                <a href="dosen.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
            <?php if (isset($_POST['update'])) {
                $nidn = $_POST['nidn'];
                $nama = $_POST['nama'];
                $mk = $_POST['matkul'];
                mysqli_query($koneksi, "UPDATE dosen SET nama_dosen='$nama', mata_kuliah='$mk' WHERE nidn='$nidn'");
                echo "<script>window.location='dosen.php'</script>";
            } ?>
        </div>
    </div>
</body>

</html>