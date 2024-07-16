<?php
include "koneksi.php";
$judul_ebook = $_POST['judul_ebook'];
$source = $_POST['source'];
$deskripsi =$_POST['deskripsi'];
$foto   = $_POST['foto'];
$query = mysqli_query($koneksi,"insert into ebook values(null,'$judul_ebook','$source','$deskripsi','$foto')");
header('location:data_ebook.php');
?>