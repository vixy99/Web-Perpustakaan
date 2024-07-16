<?php
include "koneksi.php";

if (isset($_GET['kode_buku'])) {
    $kode_buku = $_GET['kode_buku'];
    
    // Dapatkan jumlah asli dari tabel buku
    $query = "SELECT jumlah FROM buku WHERE kode_buku='$kode_buku'";
    $result = mysqli_query($koneksi, $query);
    $data_buku = mysqli_fetch_assoc($result);
    $jumlah_buku = $data_buku['jumlah'];

    // Dapatkan jumlah peminjaman yang statusnya 'Pinjam'
    $query = "SELECT SUM(jumlah) AS jumlah_pinjam FROM peminjaman WHERE kode_buku='$kode_buku' AND status_pinjam='Pinjam'";
    $result = mysqli_query($koneksi, $query);
    $data_pinjam = mysqli_fetch_assoc($result);
    $jumlah_pinjam = $data_pinjam['jumlah_pinjam'] ? $data_pinjam['jumlah_pinjam'] : 0;

    // Hitung jumlah yang diperbarui untuk tabel pengadaan
    $jumlah_pengadaan = $jumlah_buku - $jumlah_pinjam;

    echo json_encode(['jumlah_pengadaan' => $jumlah_pengadaan]);
}
?>
