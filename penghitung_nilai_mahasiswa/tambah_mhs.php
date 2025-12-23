<?php 
session_start();
include 'koneksi.php';

if(!isset($_SESSION['status']) || $_SESSION['level'] != 'Akademik'){
    echo "<script>alert('AKSES DITOLAK! Anda bukan Admin.'); window.location='mahasiswa.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
        .card { border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card-header { border-radius: 15px 15px 0 0 !important; }
    </style>
</head>
<body class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Tambah Mahasiswa Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form method="post">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Username Login</label>
                            <input type="text" name="username" class="form-control" placeholder="Contoh: budi_santoso" required>
                        </div>
                        
                        <hr>

                        <div class="mb-3">
                            <label class="form-label fw-bold">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Contoh: 312410001" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama Mahasiswa" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Kelas</label>
                            <input type="text" name="kelas" class="form-control" placeholder="Contoh: TI.24.A.3" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="simpan" class="btn btn-primary rounded-pill fw-bold">Simpan Data</button>
                            <a href="mahasiswa.php" class="btn btn-light rounded-pill border">Batal</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['simpan'])){
        $user  = $_POST['username'];
        $nim   = $_POST['nim'];
        $nama  = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $pass_default = '123456';

        $query_user = mysqli_query($koneksi, "INSERT INTO users (username, password, level_akses) VALUES ('$user', '$pass_default', 'Mahasiswa')");
        
        if($query_user){
            $id_user_baru = mysqli_insert_id($koneksi);

            $query_mhs = mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, id_user, nama_mahasiswa, kelas) VALUES ('$nim', '$id_user_baru', '$nama', '$kelas')");

            if($query_mhs){
                echo "<script>alert('Berhasil! Mahasiswa ditambahkan.'); window.location='mahasiswa.php';</script>";
            } else {
                echo "<div class='alert alert-danger mt-3 text-center'>Gagal Simpan Biodata: ".mysqli_error($koneksi)."</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3 text-center'>Gagal Buat User: ".mysqli_error($koneksi)."</div>";
        }
    }
    ?>

</body>
</html>