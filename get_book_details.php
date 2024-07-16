<?php
include "koneksi.php";

if (isset($_GET['judul'])) {
    $judul = $_GET['judul'];
    $query = "SELECT kode_buku, jumlah FROM buku WHERE judul='$judul'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['kode_buku' => '', 'jumlah' => '']);
    }
}
?>
