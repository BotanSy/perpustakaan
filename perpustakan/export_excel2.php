<?php
include_once("koneksi.php");

// Set header untuk output sebagai file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_pinjaman.csv');

// Buat output CSV
$output = fopen('php://output', 'w');

// Header kolom untuk file CSV
fputcsv($output, array('KD Pinjam', 'ID Anggota', 'ID Buku', 'Tanggal Pinjam', 'Tanggal Kembali'));

// Ambil data dari database
$result = mysqli_query($mysqli, "SELECT * FROM perpustakan_peminjaman ORDER BY kd_pinjam DESC");

// Loop dan tulis data ke CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Tutup output
fclose($output);
exit;
?>
