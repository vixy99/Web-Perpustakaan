<?php
 include "koneksi.php";
 $id = $_GET['id'];
 $ambil_data = mysqli_query($koneksi, "DELETE FROM ebook WHERE id_ebook='$id'");
 header("location:data_ebook.php");

?>