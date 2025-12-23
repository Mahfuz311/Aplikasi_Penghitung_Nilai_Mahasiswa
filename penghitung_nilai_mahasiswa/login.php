<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login SIMAHFUZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-login { border: none; border-radius: 20px; box-shadow: 0 15px 30px rgba(0,0,0,0.2); width: 400px; overflow: hidden; }
        .card-header { background: white; border: none; padding-top: 40px; text-align: center; }
        .btn-login { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 50px; padding: 12px; font-weight: 600; }
        .form-control { border-radius: 50px; padding: 12px 20px; background: #f4f6f9; border: none; }
    </style>
</head>
<body>
    <div class="card card-login p-4">
        <div class="card-header">
            <i class="fas fa-university fa-3x text-primary mb-3"></i>
            <h4 class="fw-bold">LOGIN SIMAHFUZ</h4>
            <p class="text-muted small">Universitas MAHFUZ</p>
        </div>
        <div class="card-body">
            <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan']=="gagal") echo "<div class='alert alert-danger p-2 small text-center'>Login Gagal! Cek Username/Password.</div>";
                if($_GET['pesan']=="belum_login") echo "<div class='alert alert-warning p-2 small text-center'>Silakan Login Terlebih Dahulu.</div>";
                if($_GET['pesan']=="logout") echo "<div class='alert alert-success p-2 small text-center'>Anda Telah Logout.</div>";
            }
            ?>
            <form action="cek_login.php" method="post">
                <div class="mb-3"><input type="text" name="username" class="form-control" placeholder="Username" required></div>
                <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password" required></div>
                <div class="d-grid mt-4"><button type="submit" class="btn btn-primary btn-login text-white">MASUK</button></div>
            </form>
        </div>
        <div class="text-center pb-4"><small class="text-muted">&copy; 2025 Mahfuz Fauzi</small></div>
    </div>
</body>
</html>