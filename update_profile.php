<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $id_admin = $_SESSION['id'];

    $query = "UPDATE admin SET nama_lengkap=? WHERE id_admin=?";
    $stmt = mysqli_prepare($koneksi, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "si", $nama_lengkap, $id_admin);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($koneksi);
        header("Location: profile.php");
        exit();
    } else {
        echo "Oops! Terjadi kesalahan. Silakan coba lagi.";
    }
}
?>
