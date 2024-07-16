<?php
include "koneksi.php";

$id_denda = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM denda WHERE id_denda = '$id_denda'");
$query = mysqli_query($koneksi, "DELETE FROM denda WHERE id_denda = '$id_denda'");

if ($query) {
    echo "<script>alert('Data berhasil dihapus');window.location='data_denda.php';</script>";
} else {
    echo "<script>alert('Data gagal dihapus');window.location='data_denda.php';</script>";
}
?>
