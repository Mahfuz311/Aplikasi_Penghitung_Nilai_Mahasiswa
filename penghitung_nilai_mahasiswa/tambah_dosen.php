<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik') {
    echo "<script>alert('AKSES DITOLAK!'); window.location='dosen.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html>

<body class="container mt-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="card w-50 mx-auto">
        <div class="card-header bg-success text-white">Tambah Dosen</div>
        <div class="card-body">
            <form method="post">
                <input type="text" name="user" class="form-control mb-2" placeholder="Username" required>
                <input type="text" name="nidn" class="form-control mb-2" placeholder="NIDN" required>
                <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
                <input type="text" name="matkul" class="form-control mb-2" placeholder="Mata Kuliah" required>
                <button name="simpan" class="btn btn-success w-100">Simpan</button>
                <a href="dosen.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
            <?php if (isset($_POST['simpan'])) {
                $user = $_POST['user'];
                $nidn = $_POST['nidn'];
                $nama = $_POST['nama'];
                $mk = $_POST['matkul'];
                mysqli_query($koneksi, "INSERT INTO users VALUES (NULL,'$user','123456','Dosen')");
                $id = mysqli_insert_id($koneksi);
                mysqli_query($koneksi, "INSERT INTO dosen VALUES ('$nidn','$id','$nama','$mk')");
                echo "<script>window.location='dosen.php'</script>";
            } ?>
        </div>
    </div>
</body>

</html>