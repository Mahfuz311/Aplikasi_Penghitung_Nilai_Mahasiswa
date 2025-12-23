<?php 
session_start();
include 'koneksi.php'; 

// --- SECURITY CHECK ---
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}
if($_SESSION['level'] == "Mahasiswa"){
    echo "<script>alert('AKSES DITOLAK! Anda tidak berhak mengedit nilai.'); window.location='penilaian.php';</script>";
    exit;
}
// ----------------------

$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM penilaian WHERE id_nilai='$id'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body{font-family:'Poppins',sans-serif;background:#f4f6f9;}.card{border-radius:15px;box-shadow:0 10px 20px rgba(0,0,0,0.1);}</style>
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-warning text-white text-center py-3" style="border-radius:15px 15px 0 0;">
                    <h4 class="mb-0">Edit Komponen Nilai</h4>
                </div>
                <div class="card-body p-4">
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $data['id_nilai'] ?>">
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">NIM Mahasiswa</label>
                                <input type="text" class="form-control bg-light" value="<?= $data['nim'] ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">NIDN Penilai</label>
                                <input type="text" class="form-control bg-light" value="<?= $data['nidn'] ?>" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Absen</label>
                                <input type="number" name="absen" class="form-control text-center border-warning" value="<?= $data['nilai_absen'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Tugas</label>
                                <input type="number" name="tugas" class="form-control text-center border-warning" value="<?= $data['nilai_tugas'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">UTS</label>
                                <input type="number" name="uts" class="form-control text-center border-warning" value="<?= $data['nilai_uts'] ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold">UAS</label>
                                <input type="number" name="uas" class="form-control text-center border-warning" value="<?= $data['nilai_uas'] ?>">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="update" class="btn btn-warning text-white rounded-pill fw-bold">Update & Hitung Ulang</button>
                            <a href="penilaian.php" class="btn btn-light rounded-pill border">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['update'])){
        $id = $_POST['id']; $ab = $_POST['absen']; $tg = $_POST['tugas']; $uts = $_POST['uts']; $uas = $_POST['uas'];
        
        $update = mysqli_query($koneksi, "UPDATE penilaian SET nilai_absen='$ab', nilai_tugas='$tg', nilai_uts='$uts', nilai_uas='$uas' WHERE id_nilai='$id'");
        
        if($update){
            echo "<script>alert('Berhasil! Nilai Akhir telah dihitung ulang.'); window.location='penilaian.php';</script>";
        } else {
            echo "Gagal: " . mysqli_error($koneksi);
        }
    }
    ?>
</body>
</html>