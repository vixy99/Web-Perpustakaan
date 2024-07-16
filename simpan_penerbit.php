<?php
include "koneksi.php";

// Pastikan semua field POST ada
if(isset($_POST['nama_penerbit']) && isset($_POST['kota'])) {
    $nama_penerbit = mysqli_real_escape_string($koneksi, $_POST['nama_penerbit']);
    $kota = mysqli_real_escape_string($koneksi, $_POST['kota']);

    if (isset($_POST['id_penerbit'])) {
        // Update mode
        $id_penerbit = mysqli_real_escape_string($koneksi, $_POST['id_penerbit']);
        $query = "UPDATE penerbit SET nama_penerbit='$nama_penerbit', kota='$kota' WHERE id_penerbit='$id_penerbit'";
    } else {
        // Insert mode
        $query = "INSERT INTO penerbit (nama_penerbit, kota) VALUES ('$nama_penerbit', '$kota')";
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("Location: data_penerbit.php");
    } else {
        echo "Gagal memproses data penerbit: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
