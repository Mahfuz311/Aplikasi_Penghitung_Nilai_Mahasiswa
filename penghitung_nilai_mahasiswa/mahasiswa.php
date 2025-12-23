<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php?pesan=belum_login");
    exit;
}

include 'koneksi.php';

$level = $_SESSION['level'];
$username_login = $_SESSION['username'];
$is_admin = ($level == 'Akademik');
$is_mahasiswa = ($level == 'Mahasiswa');

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .navbar { background: <?php echo ($is_mahasiswa) ? 'linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%)' : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'; ?>; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .profile-img { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php"><i class="fas fa-university me-2"></i> SIAKAD</a>
            <div class="ms-auto">
                <a href="index.php" class="btn btn-outline-light btn-sm rounded-pill"><i class="fas fa-home me-1"></i> Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="container">

        <?php if ($is_mahasiswa) { 

            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa 
                     JOIN users ON mahasiswa.id_user = users.id_user 
                     WHERE users.username = '$username_login'");
            $data = mysqli_fetch_array($query);
        ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 text-center">
                    <div class="mt-n5">
                        <img src="https://ui-avatars.com/api/?name=<?= $data['nama_mahasiswa']; ?>&background=0D8ABC&color=fff&size=150" class="profile-img mb-3">
                    </div>
                    
                    <h3 class="fw-bold text-primary mb-1"><?= $data['nama_mahasiswa']; ?></h3>
                    <p class="text-muted mb-4"><i class="fas fa-id-card me-1"></i> <?= $data['nim']; ?></p>
                    
                    <ul class="list-group list-group-flush text-start">
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-bold text-muted">Kelas</span>
                            <span class="badge bg-info text-dark rounded-pill fs-6"><?= $data['kelas']; ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-bold text-muted">Status</span>
                            <span class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> Aktif</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between py-3">
                            <span class="fw-bold text-muted">Program Studi</span>
                            <span>Teknik Informatika</span>
                        </li>
                    </ul>

                    <div class="mt-4">
                        <a href="penilaian.php" class="btn btn-primary w-100 rounded-pill shadow-sm">
                            <i class="fas fa-star me-1"></i> Lihat Kartu Hasil Studi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php } else { 

        ?>

        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary fw-bold"><i class="fas fa-user-graduate me-2"></i> Data Mahasiswa</h3>
                <?php if($is_admin){ ?>
                    <a href="tambah_mhs.php" class="btn btn-primary rounded-pill shadow"><i class="fas fa-plus me-1"></i> Tambah Data</a>
                <?php } ?>
            </div>

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Kelas</th>
                        <?php if($is_admin){ ?> <th>Aksi</th> <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nim ASC");
                while($d = mysqli_fetch_array($q)){
                ?>
                <tr>
                    <td class="fw-bold"><?= $d['nim'] ?></td>
                    <td><?= $d['nama_mahasiswa'] ?></td>
                    <td><span class="badge bg-info text-dark"><?= $d['kelas'] ?></span></td>
                    
                    <?php if($is_admin){ ?>
                    <td>
                        <a href="edit_mhs.php?nim=<?= $d['nim'] ?>" class="btn btn-warning btn-sm rounded-circle shadow-sm"><i class="fas fa-edit"></i></a>
                        <a href="hapus_mhs.php?nim=<?= $d['nim'] ?>" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger btn-sm rounded-circle shadow-sm"><i class="fas fa-trash"></i></a>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <?php } ?>

    </div>
</body>
</html>