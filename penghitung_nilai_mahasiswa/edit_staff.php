<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='staff.php';</script>";
    exit;
}

$id = $_GET['id'];
$d = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM staff_akademik WHERE id_staff='$id'"));
?>
<!DOCTYPE html>
<html>

<body class="container mt-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-primary text-white">Edit Staff</div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="id" value="<?= $d['id_staff'] ?>" class="form-control mb-2" readonly>
                <input type="text" name="nama" value="<?= $d['nama_staff'] ?>" class="form-control mb-2">
                <button name="update" class="btn btn-primary w-100">Update</button>
                <a href="staff.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
            <?php if (isset($_POST['update'])) {
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                mysqli_query($koneksi, "UPDATE staff_akademik SET nama_staff='$nama' WHERE id_staff='$id'");
                echo "<script>window.location='staff.php'</script>";
            } ?>
        </div>
    </div>
</body>

</html>