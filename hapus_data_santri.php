<?php
include "koneksi.php";

$id_penerbit = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_santri = '$id_penerbit'");
$query = mysqli_query($koneksi, "DELETE FROM santri WHERE id_santri = '$id_penerbit'");

if ($query) {
    echo "<script>alert('Data berhasil dihapus');window.location='data_santri.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus');window.location='data_santri.php';</script>";
}
?>
