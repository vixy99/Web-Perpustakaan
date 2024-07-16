<?php
include "koneksi.php";

// Pastikan semua field POST ada
if(isset($_POST['nama_penulis'])) {
    $nama_penulis = mysqli_real_escape_string($koneksi, $_POST['nama_penulis']);

    if (isset($_POST['id_penulis'])) {
        // Update mode
        $id_penulis = mysqli_real_escape_string($koneksi, $_POST['id_penulis']);
        $query = "UPDATE penulis SET nama_penulis='$nama_penulis' WHERE id_penulis='$id_penulis'";
    } else {
        // Insert mode
        $query = "INSERT INTO penulis (nama_penulis) VALUES ('$nama_penulis')";
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: data_penulis.php");
    } else {
        echo "Gagal memproses data penulis: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
