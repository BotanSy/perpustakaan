<?php
include 'koneksi.php';

$result = mysqli_query($mysqli, "SELECT * FROM buku ORDER BY id_buku DESC");

if (!$result) {
    die("Query gagal: " . mysqli_error($mysqli));
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PERPUSTAKAN</title>
</head>
<body>
<a href="logout.php">Keluar</a><br/><br/>
    <table width="100%" border="1">
        <tr>
            <th>Judul buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun terbit</th>

        </tr>
    
        <?php
        // Periksa hasil query
        while($user_data = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>".$user_data['judul_buku']."</td>";
            echo "<td>".$user_data['pengarang']."</td>";
            echo "<td>".$user_data['penerbit']."</td>";  
            echo "<td>".$user_data['tahun_terbit']."</td>";
           
        }
        ?>
    </table>
</body>
</html>
