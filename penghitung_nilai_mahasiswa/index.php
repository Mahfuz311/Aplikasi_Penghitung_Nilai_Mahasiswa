<?php 
session_start();
if($_SESSION['status'] != "login"){ header("location:login.php?pesan=belum_login"); }

$level = $_SESSION['level'];
$nama_user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .hero-section {
            background: <?php echo ($level == 'Mahasiswa') ? 'linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%)' : 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)'; ?>;
            color: white;
            padding: 60px 20px;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .card-menu {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
        }
        .card-menu:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .icon-box {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        .card-body { padding: 30px; }
        .btn-custom { border-radius: 50px; padding: 10px 30px; font-weight: 600; }
        
        footer { 
            margin-top: auto; 
            text-align: center; 
            color: #888; 
            font-size: 0.9rem; 
            padding: 20px 0; 
        }
    </style>
</head>
<body>

    <div class="hero-section text-center position-relative">
        <div class="position-absolute top-0 end-0 p-4">
            <a href="logout.php" class="btn btn-outline-light btn-sm rounded-pill" onclick="return confirm('Yakin ingin keluar?')">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>

        <h1 class="display-4 fw-bold"><i class="fas fa-university me-2"></i> Sistem Informasi Akademik</h1>
        <p class="lead">
            Selamat Datang, <strong><?= $nama_user; ?></strong> 
            <span class="badge bg-light text-dark rounded-pill ms-2"><?= $level; ?></span>
        </p>
    </div>

    <div class="container flex-grow-1">
        <div class="row g-4 justify-content-center">
            
            <?php if($level == 'Mahasiswa') { ?>
                
                <div class="col-md-5">
                    <a href="mahasiswa.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-primary">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <h3 class="card-title fw-bold">Data Mahasiswa</h3>
                                <p class="text-muted">Lihat Data Profil & Teman Sekelas</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 mb-3">
                                <span class="btn btn-outline-primary btn-custom">Buka Profil</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-5">
                    <a href="penilaian.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-danger">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h3 class="card-title fw-bold">Lihat Nilai</h3>
                                <p class="text-muted">Cek Kartu Hasil Studi (KHS) Anda</p>
                            </div>
                            <div class="card-footer bg-transparent border-0 mb-3">
                                <span class="btn btn-outline-danger btn-custom">Buka KHS</span>
                            </div>
                        </div>
                    </a>
                </div>

            <?php } else { ?>
                
                <div class="col-md-3">
                    <a href="mahasiswa.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-primary"><i class="fas fa-user-graduate"></i></div>
                                <h4 class="fw-bold">Mahasiswa</h4>
                                <p class="text-muted small">Kelola Data Mahasiswa</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="dosen.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-success"><i class="fas fa-chalkboard-teacher"></i></div>
                                <h4 class="fw-bold">Dosen</h4>
                                <p class="text-muted small">Kelola Data Dosen</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="staff.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-warning"><i class="fas fa-user-tie"></i></div>
                                <h4 class="fw-bold">Staff</h4>
                                <p class="text-muted small">Kelola Data Staff</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="penilaian.php" class="text-decoration-none text-dark">
                        <div class="card card-menu text-center">
                            <div class="card-body">
                                <div class="icon-box text-danger"><i class="fas fa-clipboard-list"></i></div>
                                <h4 class="fw-bold">Penilaian</h4>
                                <p class="text-muted small">Input & Hitung Nilai</p>
                            </div>
                        </div>
                    </a>
                </div>

            <?php } ?>

        </div>
    </div>

    <footer>
        &copy; 2025 Universitas Pelita Bangsa - Mahfuz Fauzi
    </footer>

</body>
</html>