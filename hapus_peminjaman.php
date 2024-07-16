<?php
 include "koneksi.php";
 $id = $_GET['id'];
 $ambil_data = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");
 header("location:data_peminjaman.php");

?>