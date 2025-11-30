<?php
include "koneksi.php";

var_dump($_POST);
exit;

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $koneksi->prepare("SELECT password FROM login WHERE username = ?");
if (!$stmt) {
    die("Query error: " . $koneksi->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {

    $stmt->bind_result($pass_db);
    $stmt->fetch();

    if ($password === $pass_db) {
        echo "Login berhasil!";
    } else {
        echo "Password salah!";
    }

} else {
    echo "Username tidak ditemukan!";
}

$stmt->close();
$koneksi->close();
