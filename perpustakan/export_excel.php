<?php
include_once("koneksi.php");

// Set header untuk output sebagai file CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_buku.csv');

// Buat output CSV
$output = fopen('php://output', 'w');

// Header kolom untuk file CSV
fputcsv($output, array('ID Buku', 'Judul Buku', 'Pengarang', 'Penerbit', 'Tahun Terbit'));

// Ambil data dari database
$result = mysqli_query($mysqli, "SELECT * FROM buku ORDER BY id_buku DESC");

// Loop dan tulis data ke CSV
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Tutup output
fclose($output);
exit;
?>
