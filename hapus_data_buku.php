<?php
include "koneksi.php";

$id_penerbit = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM buku WHERE kode_buku = '$id_penerbit'");
$query = mysqli_query($koneksi, "DELETE FROM buku WHERE kode_buku = '$id_penerbit'");

if ($query) {
    echo "<script>alert('Data berhasil dihapus');window.location='data_buku.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus');window.location='data_buku.php';</script>";
}
?>
