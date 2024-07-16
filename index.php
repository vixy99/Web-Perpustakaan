<?php
	include "koneksi.php";
	$data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman"));
	$data1 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM denda"));
	$data2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
	$data3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM santri"));
	//echo $data;
	session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Al-Maliki</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
<!--Akhir NavBar-->

<!--Content-->
	
	<div class="container">
		<!--header-->
		<div class="row">
			<div class="col-lg-12 mt-2">
			<div class="jumbotron jumbotron-fluid">
				  <div class="container">
					<h1 class="display-4">Selamat Datang Di Perpus Al-Maliki</h1>
					<p class="lead">Semangat untuk kalian yang ingin belajar kitab disini.</p>
				  </div>
				</div>
			</div>
		<!--Content 1-->
			<div class="row">
			<div class="col mt-2">
			<div class="card">
			<div class="card-body">
			<img src="img/rekrutmen.jpg" class="card-img-top" alt="...">
			<h5 class="card-title">Peminjaman</h5>
			<p class="card-text">Hay, mau pinjam buku. Monggo.</p>
			<p> <?php echo $data ?> </p></br>
			<a href="data_peminjaman.php" class="btn btn-primary">Data Peminjaman</a>
			</div>
			</div>
			</div>
			<div class="col mt-2">
			<div class="card" >
			  <div class="card-body">
			  <img src="img/rekrutmen.jpg" class="card-img-top" alt="...">
				<h5 class="card-title">Keterlambatan</h5>
				<p class="card-text">Harap segera dapat mengembalikan buku yang sudah di pinjam</p>
				<p> <?php echo $data1 ?> </p></br>
				<a href="data_denda.php" class="btn btn-primary">Data pengembalian</a>
			  </div>
			</div>
			</div>
			<div class="col mt-2">
			<div class="card" >
			  <div class="card-body">
				<img src="img/rekrutmen.jpg" class="card-img-top" alt="...">
				<h5 class="card-title">Buku</h5>
				<p class="card-text">Carilah Kitab yang sesuai dengan kelasmu</p>
				<p> <?php echo $data2 ?> </p></br>
				<a href="data_buku.php" class="btn btn-primary">Data Buku</a>
			  </div>
			</div>
			</div>
			<div class="col mt-2">
			<div class="card">
			  <div class="card-body">
			  <img src="img/rekrutmen.jpg" class="card-img-top" alt="...">
				<h5 class="card-title">Santri</h5>
				<p class="card-text">Santri Kalong ataupun Santri</p>
				<p> <?php echo $data3 ?> </p></br>
				<a href="data_santri.php" class="btn btn-primary">Data Santri</a>
			  </div>
			</div>
			</div>
			</div>
			</div>
		<!--content 2-->
</div>		
	
<!--akhirContent-->
<!--Footer-->
	<footer class="mt-2 bg-dark p-3 text-center" style="color:white">
	<p> Perpustakaan Al Maliki &copy; 2023</p>
	</footer>
<!-- Akhir Footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
