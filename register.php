<?php
include 'koneksi.php';

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = mysqli_real_escape_string($koneksi, $_POST['role']);

    // Cek username
    $check = mysqli_query($koneksi, "SELECT id FROM user WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Username sudah digunakan!";
    } else {
        $query = mysqli_query($koneksi, "
            INSERT INTO user (username, email, no_hp, password, role)
            VALUES ('$username', '$email', '$no_hp', '$password', '$role')
        ");

        if ($query) {
            $success = "Pendaftaran berhasil! Silakan login.";
            header("refresh:2; url=menu home.php");
        } else {
            $error = "Gagal mendaftar!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Register</title>
<style>
*{box-sizing:border-box}
body{
    font-family:Arial, sans-serif;
    background:#e9efff;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}
.register-box{
    width:100%;
    max-width:420px;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}
.register-box h2{
    text-align:center;
    margin-bottom:20px;
}
label{
    font-size:14px;
    font-weight:bold;
}
input, select{
    width:100%;
    padding:10px;
    margin:6px 0 14px;
    border:1px solid #ccc;
    border-radius:6px;
}
input:focus, select:focus{
    outline:none;
    border-color:#3b82f6;
}
button{
    width:100%;
    padding:10px;
    background:#60a5fa;
    color:#fff;
    border:none;
    border-radius:6px;
    cursor:pointer;
}
button:hover{
    background:#3b82f6;
}
.alert{
    padding:8px;
    margin-bottom:12px;
    color:#fff;
    text-align:center;
    border-radius:5px;
}
.error{background:#ef4444}
.success{background:#22c55e}
.login-link{
    text-align:center;
    margin-top:15px;
}
</style>
</head>
<body>

<div class="register-box">
<h2>Register</h2>

<?php if ($error): ?>
<div class="alert error"><?= $error ?></div>
<?php endif; ?>

<?php if ($success): ?>
<div class="alert success"><?= $success ?></div>
<?php endif; ?>

<form method="POST">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>No HP</label>
    <input type="text" name="no_hp" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Role</label>
    <select name="role" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin">Admin</option>
        <option value="peserta">Peserta</option>
    </select>

    <button type="submit">Daftar</button>
</form>

<div class="login-link">
    Sudah punya akun? <a href="menu home.php">Login</a>
</div>
</div>

</body>
</html>
