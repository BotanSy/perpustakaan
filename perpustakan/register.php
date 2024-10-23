<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $level = $_POST['level'];

    $stmt = $mysqli->prepare("INSERT INTO user (id, username, password, email, nama_lengkap, alamat, level) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id, $username, $password, $email, $nama_lengkap, $alamat, $level);

    if ($stmt->execute()) {
        header("Location: buku1.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - Perpustakan</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Buat Akun</h3></div>
                                    <div class="card-body">
                                        <form action="register.php" method="post" name="form">
                                            <table width="50%" border="0" class="table">
                                                <tr>
                                                    <td>Username</td>
                                                    <td><input type="text" name="username" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Password</td>
                                                    <td><input type="text" name="password" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><input type="text" name="email" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama Lengkap</td>
                                                    <td><input type="text" name="nama_lengkap" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td><input type="text" name="alamat" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td>Level</td>
                                                    <td>
                                                        <select name="level" class="form-control" required> 
                                                            <option value="admin">Admin</option>
                                                            <option value="user">Anggota</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="hidden" name="id"></td>
                                                    <td><input type="submit" name="submit" value="Register" class="btn btn-primary"></td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">Sudah Ada Akun? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2024</div>
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
    </body>
</html>
