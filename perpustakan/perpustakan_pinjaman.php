<?php
include_once("koneksi.php");

// Mengambil data buku
$bukuQuery = "SELECT id_buku, judul_buku FROM buku";
$bukuResult = $mysqli->query($bukuQuery);

// Mengambil data anggota
$anggotaQuery = "SELECT id_anggota, nama_lengkap FROM anggota";
$anggotaResult = $mysqli->query($anggotaQuery);

if (isset($_POST['submit'])) {
    $id_buku = $_POST['id_buku'];
    $id_anggota = $_POST['id_anggota'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    // Mengambil nama lengkap anggota
    $anggotaQuery = "SELECT nama_lengkap FROM anggota WHERE id_anggota = '$id_anggota'";
    $anggotaResult = $mysqli->query($anggotaQuery);
    $anggotaData = $anggotaResult->fetch_assoc();
    $nama_lengkap = $anggotaData['nama_lengkap'];

    // Mengambil judul buku
    $bukuQuery = "SELECT judul_buku FROM buku WHERE id_buku = '$id_buku'";
    $bukuResult = $mysqli->query($bukuQuery);
    $bukuData = $bukuResult->fetch_assoc();
    $judul_buku = $bukuData['judul_buku'];

    // Memasukkan data peminjaman ke dalam tabel
    $result = mysqli_query($mysqli, "INSERT INTO perpustakan_peminjaman (id_buku, id_anggota, judul_buku, nama_lengkap, tgl_pinjam, tgl_kembali, status) 
                                     VALUES ('$id_buku', '$id_anggota', '$judul_buku', '$nama_lengkap', '$tgl_pinjam', '$tgl_kembali', 'dipinjam')");

    if (!$result) {
        die('Query Error: ' . mysqli_error($mysqli));
    }
}

// Mengambil data peminjaman dari database
$result = $mysqli->query("SELECT kd_pinjam, id_anggota, id_buku, judul_buku, nama_lengkap, tgl_pinjam, tgl_kembali, status 
                          FROM perpustakan_peminjaman WHERE status = 'dipinjam' ORDER BY kd_pinjam DESC");

if (!$result) {
    die('Query Error: ' . mysqli_error($mysqli));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand -->
        <a class="navbar-brand ps-3" href="buku1.php">Perpustakaan Nasional</a>
        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Apa yang kamu cari?" aria-label="Apa yang kamu cari?" aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
        <!-- Navbar -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu Utama</div>
                        <a class="nav-link" href="buku1.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            HOME
                        </a>
                        <div class="sb-sidenav-menu-heading">Menu Tambah Data</div>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="add.php">Tambah Data Buku</a>
                                        <a class="nav-link" href="perpustakan_pinjaman.php">Tambah Peminjam</a>
                                        <a class="nav-link" href="add_anggota.php">Tambah Data Anggota</a>
                                    </nav>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    
                                </div>
                               
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Menu Data</div>
                        <a class="nav-link" href="buku.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Buku
                        </a>
                        <a class="nav-link" href="perpustakan_pinjaman.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Peminjaman
                        </a>
                        <a class="nav-link" href="pengembalian.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Pengembalian
                        </a>
                        <a class="nav-link" href="anggota.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Data Anggota
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Administrator
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Peminjaman</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data Peminjam</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Peminjaman Buku
                        </div>
                        <div class="card-body">
                            <form method="post" action="perpustakan_pinjaman.php">
                                <label for="buku">Select Buku:</label>
                                <select name="id_buku" id="buku" class="form-control">
                                    <?php
                                    if ($bukuResult && $bukuResult->num_rows > 0) {
                                        while ($row = $bukuResult->fetch_assoc()) {
                                            echo "<option value='" . $row['id_buku'] . "'>" . $row['judul_buku'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Buku available</option>";
                                    }
                                    ?>
                                </select>
                                <br/>

                                <label for="anggota">Select Anggota:</label>
                                <select name="id_anggota" id="anggota" class="form-control">
                                    <?php
                                    if ($anggotaResult && $anggotaResult->num_rows > 0) {
                                        while ($row = $anggotaResult->fetch_assoc()) {
                                            echo "<option value='" . $row['id_anggota'] . "'>" . $row['nama_lengkap'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No anggota available</option>";
                                    }
                                    ?>
                                </select>
                                <br/>

                                <label for="tgl_pinjam">Tanggal Pinjam:</label>
                                <input type="date" name="tgl_pinjam" class="form-control" required>
                                <br/>

                                <label for="tgl_kembali">Tanggal Kembali:</label>
                                <input type="date" name="tgl_kembali" class="form-control" required>
                                <br/>

                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Peminjaman
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="table table-striped table-bordered">
                                <div class="mb-3">
                                    <a class="btn btn-success" href="export_excel2.php">Export ke Excel</a>
                                </div>
                                <thead>
                                    <tr>
                                        <th>KD Pinjam</th>
                                        <th>ID Anggota</th>
                                        <th>ID Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Nama Lengkap</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="data-body">
                                    <?php
                                    while ($user_data = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td><center>" . (isset($user_data['kd_pinjam']) ? $user_data['kd_pinjam'] :'') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['id_anggota']) ? $user_data['id_anggota'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['id_buku']) ? $user_data['id_buku'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['judul_buku']) ? $user_data['judul_buku'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['nama_lengkap']) ? $user_data['nama_lengkap'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['tgl_pinjam']) ? $user_data['tgl_pinjam'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['tgl_kembali']) ? $user_data['tgl_kembali'] : '') . "</center></td>";
                                        echo "<td><center>" . (isset($user_data['status']) ? $user_data['status'] : '') . "</center></td>";
                                        echo "<td><center>
                                                <a href='edit2.php?kd_pinjam=" . (isset($user_data['kd_pinjam']) ? $user_data['kd_pinjam'] : '') . "' class='btn btn-primary'>PERPANJANG</a> | 
                                                <a href='pengembalian.php?kd_pinjam=" . (isset($user_data['kd_pinjam']) ? $user_data['kd_pinjam'] : '') . "' class='btn btn-danger'>DI KEMBALIKAN</a>
                                              </center></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Voltage 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>
