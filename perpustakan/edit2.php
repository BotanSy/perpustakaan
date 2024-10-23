<?php
include_once("koneksi.php");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

/**
 * Fungsi untuk memperpanjang pinjaman berdasarkan id_buku.
 */
function perpanjangPinjamanBerdasarkanBuku($mysqli, $kd_pinjam) {
    $query = "SELECT * FROM perpustakan_peminjaman WHERE kd_pinjam = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $kd_pinjam);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $tgl_kembali = new DateTime($data['tgl_kembali']);
        $tgl_kembali->modify('+3 day');
        
        $update_query = "UPDATE perpustakan_peminjaman SET tgl_kembali = ? WHERE kd_pinjam = ?";
        $update_stmt = $mysqli->prepare($update_query);
        $new_tgl_kembali = $tgl_kembali->format('Y-m-d');
        $update_stmt->bind_param("ss", $new_tgl_kembali, $kd_pinjam);
        
        if ($update_stmt->execute()) {
            return true; // Kembalikan true jika berhasil
        } else {
            return "Error dalam memperpanjang pinjaman: " . $update_stmt->error;
        }
    } else {
        return "Data pinjaman tidak ditemukan untuk buku ID: " . $kd_pinjam;
    }
}

$kd_pinjam = isset($_GET['kd_pinjam']) ? $_GET['kd_pinjam'] : '';
if (empty($kd_pinjam)) {
    die("ID Buku tidak ada dalam parameter URL.");
}

$result = perpanjangPinjamanBerdasarkanBuku($mysqli, $kd_pinjam);

if ($result === true) {
    echo "<script>
            alert('Perpanjangan berhasil, tanggal kembali pinjaman diperpanjang hingga 3 hari kedepan!');
            window.location.href = 'perpustakan_pinjaman.php';
          </script>";
} else {
    echo "<script>
            alert('$result');
            window.location.href = 'perpustakan_pinjaman.php';
          </script>";
}
exit();
?>
