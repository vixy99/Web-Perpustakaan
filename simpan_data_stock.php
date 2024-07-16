<?php
include "koneksi.php";

$id_pengadaan = $_POST['id_pengadaan'];
$tgl_pengadaan = $_POST['tgl_pengadaan'];
$kode_buku = $_POST['kode_buku'];
$asal_buku = $_POST['asal_buku'];
$jumlah = $_POST['jumlah'];
$id_admin = $_POST['id_admin'];

$query = mysqli_query($koneksi, "INSERT INTO pengadaan (id_pengadaan, tgl_pengadaan, kode_buku, asal_buku, jumlah, id_admin) VALUES ('$id_pengadaan', '$tgl_pengadaan', '$kode_buku', '$asal_buku', '$jumlah', '$id_admin')");

if ($query) {
    header('Location: data_stock.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
