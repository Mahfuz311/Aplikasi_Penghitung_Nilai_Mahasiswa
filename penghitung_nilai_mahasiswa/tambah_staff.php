<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='staff.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<body class="container mt-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-warning text-white">Tambah Staff</div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="user" class="form-control mb-2" placeholder="Username" required>
                <input type="text" name="id" class="form-control mb-2" placeholder="ID Staff" required>
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Staff" required>
                <button name="simpan" class="btn btn-warning w-100">Simpan</button>
                <a href="staff.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
            <?php if (isset($_POST['simpan'])) {
                $user = $_POST['user'];
                $id = $_POST['id'];
                $nama = $_POST['nama'];
                mysqli_query($koneksi, "INSERT INTO users VALUES (NULL,'$user','123456','Akademik')");
                $idu = mysqli_insert_id($koneksi);
                mysqli_query($koneksi, "INSERT INTO staff_akademik VALUES ('$id','$idu','$nama')");
                echo "<script>window.location='staff.php'</script>";
            } ?>
        </div>
    </div>
</body>

</html>