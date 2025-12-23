<?php 
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($data);

if($cek > 0){
    $d = mysqli_fetch_assoc($data);
    $_SESSION['username'] = $username;
    $_SESSION['level'] = $d['level_akses'];
    $_SESSION['status'] = "login";
    header("location:index.php");
}else{
    header("location:login.php?pesan=gagal");
}
?>