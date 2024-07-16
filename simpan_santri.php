<?php
include "koneksi.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    return str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
}

// Pastikan semua field POST ada
if(isset($_POST['nama_santri']) && isset($_POST['kelamin']) && isset($_POST['tempat_lahir']) && isset($_POST['tgl_lahir']) && isset($_POST['no_hp'])) {
    $nama_santri = $_POST['nama_santri'];
    $kelamin = $_POST['kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $no_hp = $_POST['no_hp'];
   
    
    if (isset($_POST['id_santri'])) {
        // Jika dalam mode edit, gunakan kode buku yang ada
        $id_santri = $_POST['id_santri'];

        // Update mode
        $foto_lama = isset($_POST['foto_santri_lama']) ? $_POST['foto_santri_lama'] : '';

        if (isset($_FILES['foto_santri']) && $_FILES['foto_santri']['error'] == 0) {
            $target_dir = "img/";
            $foto_santri = basename($_FILES["foto_santri"]["name"]);
            $target_file = $target_dir . $foto_santri;
            move_uploaded_file($_FILES["foto_santri"]["tmp_name"], $target_file);
        } else {
            $foto = $foto_santri_lama;
        }

        $query = mysqli_query($koneksi, "UPDATE santri SET nama_santri='$nama_santri', kelamin='$kelamin', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', no_hp='$no_hp', foto_santri='$foto_santri' WHERE id_santri='$id_santri'");
    } else {
        // Insert mode
        // Generate new book code
        $id_santri = generateBarcode();

        if (isset($_FILES['foto_santri']) && $_FILES['foto_santri']['error'] == 0) {
            $target_dir = "img/";
            $foto_santri = basename($_FILES["foto_santri"]["name"]);
            $target_file = $target_dir . $foto_santri;
            move_uploaded_file($_FILES["foto_santri"]["tmp_name"], $target_file);
        } else {
            $foto = '';
        }

        $query = mysqli_query($koneksi, "INSERT INTO santri (id_santri, nama_santri, kelamin, tempat_lahir, tgl_lahir, no_hp, foto_santri) VALUES ('$id_santri', '$nama_santri', '$kelamin', '$tempat_lahir', '$tgl_lahir', '$no_hp', '$foto_santri')");
    }

    if ($query) {
        header("location:data_santri.php");
    } else {
        echo "Gagal memproses data buku: " . mysqli_error($koneksi);
    }
} else {
    echo "Data yang diperlukan tidak lengkap.";
}
