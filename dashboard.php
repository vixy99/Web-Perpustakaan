<?php 
include "koneksi.php";
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpustakaan Al-Maliki E-Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">Perpustakaan Al-Maliki</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Berita Tentang Al-Maliki</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori Kitab 1
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.html" aria-disabled="true">Login</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
  <!--akhir dari navbar-->

  <!--content-->

  <!--header-->
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mt-2">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <h1 class="display-3">Selamat Datang Di Perpustakaan Al-Maliki</h1>
            <p class="lead">Selamat membaca</p>
          </div>
        </div>
      </div>
    </div>
        <!-- Akhir dari Header Content-->
    <h1 class="text-center"> Kitab Tafsir </h1>
    <div class="row">
      <div class="col-sm-6">
        <table>
        <tr>
        <div class="col mt-2 p-3">
        <?php
            $query = mysqli_query($koneksi,"select *from ebook");
            while ($ambil_data=mysqli_fetch_array($query)){
          ?> 
        <td>
        <div class="col mt-2 p-3">
        <div class="card" style="width:200px">
          <img src="<?php echo $ambil_data['foto'];?>" class="card-img-top" style="width:90%">
          <div class="card-body">
            <h5 class="card-title"><?php echo $ambil_data['judul_ebook'];?></h5>
            <p class="card-text"><?php echo $ambil_data['deskripsi'];?></p>
            <a href="pdfview.php?id=<?php echo $ambil_data['source'];?>" class="btn btn-primary" id="pdfflip" target="_blank">lihat</a>
          </div>
        </div>
            </div>
        </td>
      <?php      
      }
      ?>
      </tr>
      </table>
    </div>
    <div class="row">

    </div>
  </div>



      <!--akhir content-->

      <footer class="mt-2 bg-dark p- text-center" style="color:white">
        <p> Perpustakaan Al Maliki &copy; 2023</p>
      </footer>
      <!-- Akhir Footer-->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>