<?php
session_start();
session_unset();  // hapus semua session
session_destroy(); // hancurkan session

header("Location: menu home.php"); // arahkan kembali ke halaman login / home
exit();
?>
