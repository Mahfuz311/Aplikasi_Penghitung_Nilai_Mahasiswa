<?php 
session_start();
if($_SESSION['status']!="login"){ header("location:login.php"); }
include 'koneksi.php';

$is_admin = ($_SESSION['level'] == 'Akademik');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>body{font-family:'Poppins',sans-serif;background:#f8f9fa}.navbar{background:linear-gradient(135deg,#f2994a 0%,#f2c94c 100%)}</style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4 shadow-sm"><div class="container"><a class="navbar-brand fw-bold" href="index.php">SIMAHFUZ</a><a href="index.php" class="btn btn-outline-light btn-sm rounded-pill">Dashboard</a></div></nav>
    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between mb-4">
                <h3 class="text-warning fw-bold">Data Staff</h3>
                <?php if($is_admin){ ?>
                    <a href="tambah_staff.php" class="btn btn-warning text-white rounded-pill shadow">Tambah Staff</a>
                <?php } ?>
            </div>
            <table class="table table-hover">
                <thead class="table-light"><tr><th>ID Staff</th><th>Nama Staff</th><?php if($is_admin){ ?><th>Aksi</th><?php } ?></tr></thead>
                <tbody>
                <?php $q=mysqli_query($koneksi,"SELECT * FROM staff_akademik"); while($d=mysqli_fetch_array($q)){ ?>
                <tr>
                    <td class="fw-bold"><?=$d['id_staff']?></td>
                    <td><?=$d['nama_staff']?></td>
                    <?php if($is_admin){ ?>
                    <td>
                        <a href="edit_staff.php?id=<?=$d['id_staff']?>" class="btn btn-primary btn-sm rounded-circle"><i class="fas fa-edit"></i></a>
                        <a href="hapus_staff.php?id=<?=$d['id_staff']?>" onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm rounded-circle"><i class="fas fa-trash"></i></a>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>