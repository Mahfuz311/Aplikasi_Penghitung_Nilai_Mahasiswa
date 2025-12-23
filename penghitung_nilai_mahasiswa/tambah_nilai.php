<?php 
session_start();
include 'koneksi.php';

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){ header("location:login.php"); exit; }
if($_SESSION['level'] == "Mahasiswa"){ echo "<script>alert('AKSES DITOLAK!'); window.location='penilaian.php';</script>"; exit; }

$is_dosen = ($_SESSION['level'] == 'Dosen');
$nidn_otomatis = "";
$nama_matkul = "";

if($is_dosen){
    $username = $_SESSION['username'];
    $q_dosen = mysqli_query($koneksi, "SELECT * FROM dosen JOIN users ON dosen.id_user=users.id_user WHERE users.username='$username'");
    $d_dosen = mysqli_fetch_array($q_dosen);
    $nidn_otomatis = $d_dosen['nidn'];
    $nama_matkul = $d_dosen['mata_kuliah'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Input Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body{font-family:'Poppins',sans-serif;background:#f4f6f9;}.card{border-radius:15px;box-shadow:0 10px 20px rgba(0,0,0,0.1);}</style>
</head>
<body class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white text-center py-3">
                    <h4 class="mb-0">Input Nilai Baru</h4>
                </div>
                <div class="card-body p-4">
                    
                    <?php if($is_dosen){ ?>
                        <div class="alert alert-info text-center small">
                            Anda login sebagai Dosen pengampu: <strong><?= $nama_matkul; ?></strong>.<br>
                            Sistem mengunci input NIDN Anda.
                        </div>
                    <?php } ?>

                    <form method="post">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIM Mahasiswa</label>
                                <input type="text" name="nim" class="form-control" required placeholder="Contoh: 312410412">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIDN Dosen</label>
                                <input type="text" name="nidn" class="form-control" 
                                       value="<?= $nidn_otomatis; ?>" 
                                       placeholder="Contoh: 04112233" 
                                       required 
                                       <?= ($is_dosen) ? 'readonly style="background-color:#e9ecef"' : ''; ?>>
                            </div>
                        </div>
                        
                        <div class="alert alert-light border text-center"><strong>Komponen Nilai (0-100)</strong></div>

                        <div class="row mb-4">
                            <div class="col-md-3"><label class="form-label">Absen (10%)</label><input type="number" name="absen" class="form-control text-center" required></div>
                            <div class="col-md-3"><label class="form-label">Tugas (30%)</label><input type="number" name="tugas" class="form-control text-center" required></div>
                            <div class="col-md-3"><label class="form-label">UTS (30%)</label><input type="number" name="uts" class="form-control text-center" required></div>
                            <div class="col-md-3"><label class="form-label">UAS (30%)</label><input type="number" name="uas" class="form-control text-center" required></div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" name="simpan" class="btn btn-danger rounded-pill fw-bold">Simpan & Hitung</button>
                            <a href="penilaian.php" class="btn btn-light rounded-pill border">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['simpan'])){
        $nim = $_POST['nim']; 
        $nidn = $_POST['nidn'];
        $ab = $_POST['absen']; $tg = $_POST['tugas']; $uts = $_POST['uts']; $uas = $_POST['uas'];
        
        $insert = mysqli_query($koneksi, "INSERT INTO penilaian (nim, nidn, nilai_absen, nilai_tugas, nilai_uts, nilai_uas, is_verified) VALUES ('$nim', '$nidn', '$ab', '$tg', '$uts', '$uas', 0)");
        
        if($insert) { echo "<script>alert('Berhasil!'); window.location='penilaian.php';</script>"; } 
        else { echo "<div class='alert alert-danger mt-3 text-center'>Gagal! Cek NIM. Error: ".mysqli_error($koneksi)."</div>"; }
    }
    ?>
</body>
</html>