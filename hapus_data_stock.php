<?php
include "koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM pengadaan WHERE id_pengadaan='$id'");

if ($query) {
    header('Location: data_stock.php');
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
