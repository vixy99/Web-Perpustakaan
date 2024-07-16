<?php
include "koneksi.php";

// Pastikan semua field POST ada
if(isset($_POST['nama_kategori'])) {
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

    if (isset($_POST['id_kategori'])) {
        // Update mode
        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
        $query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori'";
    } else {
        // Insert mode
        $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: data_kategori.php");
    } else {
        echo "Gagal memproses data kategori: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
