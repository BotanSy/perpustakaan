<?php
include 'koneksi.php';
$kd_pinjam = $_GET['kd_pinjam'];

$result = mysqli_query($mysqli, "DELETE FROM perpustakan_peminjaman WHERE kd_pinjam =$kd_pinjam");

header("Location: pengembalian.php");