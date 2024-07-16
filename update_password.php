<?php
include "koneksi.php";
include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Query untuk mendapatkan kata sandi saat ini dari database
    $stmt = $koneksi->prepare('SELECT password FROM admin WHERE id_admin = ?');
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($password_db);
    $stmt->fetch();
    $stmt->close();
    
    // Memeriksa apakah kata sandi saat ini benar
    if (password_verify($current_password, $password_db)) {
        // Memeriksa apakah kata sandi baru dan konfirmasi kata sandi sama
        if ($new_password === $confirm_password) {
            // Mengenkripsi kata sandi baru
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            
            // Update kata sandi baru ke database
            $stmt = $koneksi->prepare('UPDATE admin SET password = ? WHERE id_admin = ?');
            $stmt->bind_param('si', $hashed_password, $_SESSION['id']);
            $stmt->execute();
            $stmt->close();
            
            // Redirect ke halaman profile dengan pesan sukses
            header("Location: profile.php?password_changed=true");
            exit();
        } else {
            // Redirect ke halaman change_password dengan pesan error
            header("Location: change_password.php?error=password_mismatch");
            exit();
        }
    } else {
        // Redirect ke halaman change_password dengan pesan error
        header("Location: change_password.php?error=incorrect_password");
        exit();
    }
} else {
    // Redirect ke halaman change_password jika tidak ada akses langsung
    header("Location: change_password.php");
    exit();
}
?>
