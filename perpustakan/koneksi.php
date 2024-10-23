<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "perpustakan";

$mysqli = new mysqli($host, $username, $password, $database);

if (!$mysqli instanceof mysqli) {
    die("Objek koneksi tidak valid.");
}

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
