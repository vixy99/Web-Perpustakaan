<?php
include "koneksi.php";
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: login.html');
  exit;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Al-Maliki</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Perpustakaan Al-Maliki</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Beranda</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Perpustakaan
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="data_buku.php">Buku</a></li>
            <li><a class="dropdown-item" href="data_penulis.php">Penulis</a></li>
            <li><a class="dropdown-item" href="data_penerbit.php">Penerbit</a></li>
			<li><a class="dropdown-item" href="data_kategori.php">Kategori</a></li>
			<li><a class="dropdown-item" href="data_santri.php">Santri</a></li>
          </ul>
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Data Transaksi
          </a>
       <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="data_peminjaman.php">Peminjaman</a></li>
            <li><a class="dropdown-item" href="data_stock.php">Pengadaan</a></li>
            <li><a class="dropdown-item" href="data_denda.php">Keterlambatan</a></li>
          </ul>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="data_ebook.php"></a>
        </li>
		  <li class="nav-item">
			<a class="nav-link" href="profile.php" tabindex="-1" aria-disabled="true"> Admin</a>
		  </li>
			<li class="nav-item"> 
			<a class="nav-link" href="logout.php">Logout</a>
			</li>
      </ul>
    </div>
  </div>
  </div>
</nav>