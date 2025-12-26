<?php
// download.php
if (!isset($_GET['file'])) {
    die("File tidak ditemukan");
}

$filename = basename($_GET['file']); // amankan nama file
$filepath = 'uploads/' . $filename;

if (!file_exists($filepath)) {
    die("File tidak ada di server");
}

// Header supaya browser tahu ini download file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepath));

readfile($filepath);
exit;
?>
