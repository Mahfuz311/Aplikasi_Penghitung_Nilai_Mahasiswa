<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include 'koneksi.php'; 

$level_user = $_SESSION['level'];
$username_login = $_SESSION['username'];
$is_mahasiswa = ($level_user == 'Mahasiswa');
$is_dosen     = ($level_user == 'Dosen');
$is_admin     = ($level_user == 'Akademik');

$where_clause = "";

if($is_mahasiswa){
    $mhs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT nama_mahasiswa FROM mahasiswa 
           JOIN users ON mahasiswa.id_user = users.id_user 
           WHERE users.username = '$username_login'"));
    $nama_mhs = $mhs['nama_mahasiswa'];
    $where_clause = " WHERE nama_mahasiswa = '$nama_mhs'";
}

if($is_dosen){
    $dsn = mysqli_fetch_array(mysqli_query($koneksi, "SELECT mata_kuliah FROM dosen 
           JOIN users ON dosen.id_user = users.id_user 
           WHERE users.username = '$username_login'"));
    $matkul_dosen = $dsn['mata_kuliah'];
    
    $where_clause = " WHERE mata_kuliah = '$matkul_dosen'";
}

if(isset($_POST['cari'])){
    $keyword = $_POST['keyword'];
    $operator = ($where_clause == "") ? " WHERE " : " AND ";
    $where_clause .= $operator . "(nama_mahasiswa LIKE '%$keyword%' OR mata_kuliah LIKE '%$keyword%')";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">SIAKAD</a>
            <div class="ms-auto">
                <a href="index.php" class="btn btn-outline-light btn-sm rounded-pill">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-danger fw-bold"><i class="fas fa-clipboard-check me-2"></i> Data Nilai</h3>
                
                <div>
                    <?php if($is_admin) { ?>
                        <a href="cetak_nilai.php" target="_blank" class="btn btn-dark rounded-pill shadow-sm me-2">Download Laporan</a>
                    <?php } ?>

                    <?php if(!$is_mahasiswa) { ?>
                        <a href="tambah_nilai.php" class="btn btn-danger rounded-pill shadow"><i class="fas fa-plus me-1"></i> Input Nilai</a>
                    <?php } ?>
                </div>
            </div>

            <?php if($is_dosen){ ?>
                <div class="alert alert-info py-2 small">
                    <i class="fas fa-info-circle me-1"></i> Anda Login sebagai Dosen <strong><?= $matkul_dosen; ?></strong>. Hanya menampilkan data mata kuliah tersebut.
                </div>
            <?php } ?>

            <form method="post" class="mb-4">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari Nama Mahasiswa..." autocomplete="off">
                    <button type="submit" name="cari" class="btn btn-secondary">Cari</button>
                    <a href="penilaian.php" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th class="text-center">Nilai Akhir</th>
                            <th>Status</th>
                            <?php if(!$is_mahasiswa) { ?> <th>Aksi</th> <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM view_rekap_nilai $where_clause ORDER BY id_nilai DESC";
                        $q = mysqli_query($koneksi, $query);
                        $no = 1;
                        
                        if(mysqli_num_rows($q) == 0){ echo "<tr><td colspan='6' class='text-center py-4'>Data tidak ditemukan.</td></tr>"; }

                        while($d = mysqli_fetch_array($q)){
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="fw-bold"><?= $d['nama_mahasiswa'] ?></td>
                            <td><?= $d['mata_kuliah'] ?> <br><small class="text-muted"><?= $d['nama_dosen'] ?></small></td>
                            <td class="text-center fw-bold text-primary"><?= $d['nilai_akhir'] ?></td>
                            <td><span class="badge bg-<?= ($d['keterangan_lulus']=='LULUS'?'success':'danger') ?>"><?= $d['keterangan_lulus'] ?></span></td>
                            
                            <?php if(!$is_mahasiswa) { ?>
                            <td>
                                <a href="edit_nilai.php?id=<?= $d['id_nilai'] ?>" class="btn btn-warning btn-sm rounded-circle shadow-sm"><i class="fas fa-edit"></i></a>
                                <a href="hapus_nilai.php?id=<?= $d['id_nilai'] ?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm rounded-circle shadow-sm"><i class="fas fa-trash"></i></a>
                            </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>