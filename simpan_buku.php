<?php
include "koneksi.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    return str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
}

// Pastikan semua field POST ada
if(isset($_POST['judul']) && isset($_POST['id_penulis']) && isset($_POST['id_penerbit']) && isset($_POST['id_kategori']) && isset($_POST['tahun']) && isset($_POST['sinopsis']) && isset($_POST['jumlah'])) {
    // Escape input
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $id_penulis = mysqli_real_escape_string($koneksi, $_POST['id_penulis']);
    $id_penerbit = mysqli_real_escape_string($koneksi, $_POST['id_penerbit']);
    $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $sinopsis = mysqli_real_escape_string($koneksi, $_POST['sinopsis']);
    $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    
    if (isset($_POST['kode_buku'])) {
        // Jika dalam mode edit, gunakan kode buku yang ada
        $kode_buku = mysqli_real_escape_string($koneksi, $_POST['kode_buku']);

        // Update mode
        $foto_lama = mysqli_real_escape_string($koneksi, isset($_POST['foto_lama']) ? $_POST['foto_lama'] : '');

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "uploads/cover/";
            $foto = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $foto;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        } else {
            $foto = $foto_lama;
        }

        $query = "UPDATE buku SET judul='$judul', id_penulis='$id_penulis', id_penerbit='$id_penerbit', id_kategori='$id_kategori', tahun='$tahun', sinopsis='$sinopsis', jumlah='$jumlah', foto='$foto' WHERE kode_buku='$kode_buku'";
    } else {
        // Insert mode
        // Generate new book code
        $kode_buku = generateBarcode();

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "uploads/cover/";
            $foto = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $foto;
            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
        } else {
            $foto = '';
        }

        $foto = mysqli_real_escape_string($koneksi, $foto);

        $query = "INSERT INTO buku (kode_buku, judul, id_penulis, id_penerbit, id_kategori, tahun, sinopsis, jumlah, foto) VALUES ('$kode_buku', '$judul', '$id_penulis', '$id_penerbit', '$id_kategori', '$tahun', '$sinopsis', '$jumlah', '$foto')";
    }

    // Tampilkan query SQL untuk debugging
    echo $query;

    if (mysqli_query($koneksi, $query)) {
        header("location:data_buku.php");
    } else {
        echo "Gagal memproses data buku: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
?>
