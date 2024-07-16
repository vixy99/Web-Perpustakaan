<?php
include "koneksi.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    return str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
}

// Pastikan semua field POST ada
if(isset($_POST['tgl_pengadaan']) && isset($_POST['judul']) && isset($_POST['kode_buku']) && isset($_POST['jumlah']) && isset($_POST['id_admin'])) {
    $tgl_pengadaan = $_POST['tgl_pengadaan'];
    $judul = $_POST['judul'];
    $kode_buku = $_POST['kode_buku'];
    $jumlah = $_POST['jumlah'];
    $id_admin = $_POST['id_admin'];
    
    if (isset($_POST['id_pengadaan'])) {
        // Jika dalam mode edit, gunakan kode buku yang ada
        $id_pengadaan = $_POST['id_pengadaan'];

        $query = mysqli_query($koneksi, "UPDATE pengadaan SET tgl_pengadaan='$tgl_pengadaan', judul='$judul', kode_buku='$kode_buku', jumlah='$jumlah', id_admin='$id_admin' WHERE id_pengadaan='$id_pengadaan'");
    } else {

        $id_pengadaan = generateBarcode();

        $query = mysqli_query($koneksi, "INSERT INTO pengadaan (id_pengadaan, tgl_pengadaan, judul, kode_buku, jumlah, id_admin) VALUES ('$id_pengadaan', '$tgl_pengadaan', '$judul', '$kode_buku', '$jumlah', '$id_admin')");
    }

    if ($query) {
        header("location:data_stock.php");
    } else {
        echo "Gagal memproses data buku: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
