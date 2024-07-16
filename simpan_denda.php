<?php
include "koneksi.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    return str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
}

if(isset($_POST['id_peminjaman']) && isset($_POST['kode_buku']) && isset($_POST['judul']) && isset($_POST['id_santri']) && isset($_POST['nama_santri']) && isset($_POST['tgl_harus_kembali']) && isset($_POST['tgl_kmb']) && isset($_POST['jumlah'])) {
    $id_peminjaman = $_POST['id_peminjaman'];
    $kode_buku = $_POST['kode_buku'];
    $judul= $_POST['judul'];
    $id_santri = $_POST['id_santri'];
    $nama_santri = $_POST['nama_santri'];
    $tgl_harus_kembali = $_POST['tgl_harus_kembali'];
    $tgl_kmb = $_POST['tgl_kmb'];
    $jumlah = $_POST['jumlah'];

    // Validasi tanggal pengembalian
    $tglHarusKembali = strtotime($tgl_harus_kembali);
    $tglKembali = strtotime($tgl_kmb);
    if ($tglKembali <= $tglHarusKembali) {
        echo "Tanggal Pengembalian harus lebih dari Tanggal Harus Kembali.";
        exit();
    }
    else {
        if (isset($_POST['id_denda'])) {
            // Jika dalam mode edit, gunakan id_denda yang ada
            $id_denda = $_POST['id_denda'];
            $query = mysqli_query($koneksi, "UPDATE denda SET id_peminjaman='$id_peminjaman', kode_buku='$kode_buku', judul='$judul', id_santri='$id_santri', nama_santri='$nama_santri', tgl_harus_kembali='$tgl_harus_kembali', tgl_kmb='$tgl_kmb', jumlah='$jumlah'  WHERE id_denda='$id_denda'");
        } else {
            // Mode penambahan
            // Generate id_denda baru
            $id_denda = generateBarcode();
            $query = mysqli_query($koneksi, "INSERT INTO denda (id_denda, id_peminjaman, kode_buku, judul, id_santri, nama_santri, tgl_harus_kembali, tgl_kmb, jumlah) VALUES ('$id_denda', '$id_peminjaman', '$kode_buku', '$judul', '$id_santri', '$nama_santri', '$tgl_harus_kembali', '$tgl_kmb', '$jumlah')");
        }
        
        if ($query) {
            header("location:data_denda.php");
            exit();
        } else {
            echo "Gagal memproses data denda: " . mysqli_error($koneksi);
        }
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
