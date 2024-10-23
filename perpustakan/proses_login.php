<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$login = mysqli_query($mysqli,"SELECT * FROM user WHERE username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if($cek > 0){
    $data = mysqli_fetch_assoc($login);
    
    if($data['level']=="admin"){
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";

        header("location:buku1.php");
    }else if($data['level']=="anggota"){
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "anggota";

        header("location:user_buku1.php");

    }else{
        header("location:index.php?pesan=gagal");
    }
    }else{
        header("location:index.php?pesan=gagal");
    }
?>