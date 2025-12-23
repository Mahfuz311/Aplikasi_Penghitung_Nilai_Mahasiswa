<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Nilai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h3>Input Nilai Baru</h3>
    
    <form action="" method="post">
        <div class="mb-3">
            <label>NIM Mahasiswa</label>
            <input type="text" name="nim" class="form-control" placeholder="Contoh: 312410412" required>
            <small class="text-muted">*Pastikan NIM sudah ada di tabel Mahasiswa</small>
        </div>
        <div class="mb-3">
            <label>NIDN Dosen</label>
            <input type="text" name="nidn" class="form-control" placeholder="Contoh: 04112233" required>
            <small class="text-muted">*Pastikan NIDN sudah ada di tabel Dosen</small>
        </div>
        
        <div class="row">
            <div class="col">
                <label>Nilai Absen</label>
                <input type="number" name="absen" class="form-control" required>
            </div>
            <div class="col">
                <label>Nilai Tugas</label>
                <input type="number" name="tugas" class="form-control" required>
            </div>
            <div class="col">
                <label>Nilai UTS</label>
                <input type="number" name="uts" class="form-control" required>
            </div>
            <div class="col">
                <label>Nilai UAS</label>
                <input type="number" name="uas" class="form-control" required>
            </div>
        </div>

        <button type="submit" name="simpan" class="btn btn-success mt-3">Simpan Nilai</button>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nim   = $_POST['nim'];
        $nidn  = $_POST['nidn'];
        $absen = $_POST['absen'];
        $tugas = $_POST['tugas'];
        $uts   = $_POST['uts'];
        $uas   = $_POST['uas'];

        $insert = mysqli_query($koneksi, "INSERT INTO penilaian 
        (nim, nidn, nilai_absen, nilai_tugas, nilai_uts, nilai_uas, is_verified)
        VALUES ('$nim', '$nidn', '$absen', '$tugas', '$uts', '$uas', 0)");

        if ($insert) {
            echo "<script>alert('Data Berhasil Disimpan! Nilai Akhir otomatis dihitung.'); window.location='index.php';</script>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Gagal! Pastikan NIM dan NIDN benar (terdaftar). <br>Error: ".mysqli_error($koneksi)."</div>";
        }
    }
    ?>
</body>
</html>