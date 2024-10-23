<?php
include_once("koneksi.php");

if(isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    $result = mysqli_query($mysqli, "INSERT INTO perpustakan_peminjaman (id_buku, id_anggota, tgl_pinjam, tgl_kembali) VALUES ('$id_buku', '$id_anggota', '$tgl_pinjam', '$tgl_kembali')");
    
    if ($result()) {
        header ("Location: perpustakan_pinjaman.php");
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
    $stmt->close();
}
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Data Peminjam - Perpustakan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.html">Perpustakaan</a>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Peminjaman</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Peminjaman Buku
                        </div>
                        <div class="card-body">
                            <form method="post" action="perpustakan_pinjaman.php">
                                <label for="id_buku">Select Buku:</label>
                                <select name="id_buku" id="id_buku" class="form-control">
                                    <?php
                                    if ($bukuResult->num_rows > 0) {
                                        while($row = $bukuResult->fetch_assoc()) {
                                            echo "<option value='".$row['id_buku']."'>".$row['judul_buku']."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Buku available</option>";
                                    }
                                    ?>
                                </select><br/>

                                <label for="id_anggota">Select Anggota:</label>
                                <select name="id_anggota" id="id_anggota" class="form-control">
                                    <?php
                                    if ($anggotaResult->num_rows > 0) {
                                        while($row = $anggotaResult->fetch_assoc()) {
                                            echo "<option value='".$row['id_anggota']."'>".$row['nama_lengkap']."</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No anggota available</option>";
                                    }
                                    ?>
                                </select><br/>

                                <label for="tgl_pinjam">Tanggal Pinjam:</label>
                                <input type="date" name="tgl_pinjam" class="form-control"><br/>

                                <label for="tgl_kembali">Tanggal Kembali:</label>
                                <input type="date" name="tgl_kembali" class="form-control"><br/>

                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Peminjaman
                        </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="text-muted">Copyright &copy; Voltage 2024</div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
