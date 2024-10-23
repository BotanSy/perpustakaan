<?php
include_once("koneksi.php");

// Set header untuk output sebagai file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_anggota.csv');

// Buat output CSV
$output = fopen('php://output', 'w');

// Header kolom untuk file CSV
fputcsv($output, array('ID Anggota', 'Email', 'Nama Lengkap', 'Alamat', 'Level'));

// Ambil data dari database
$result = mysqli_query($mysqli, "SELECT * FROM anggota ORDER BY id_anggota DESC");

// Loop dan tulis data ke CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Tutup output
fclose($output);
exit;
?>
