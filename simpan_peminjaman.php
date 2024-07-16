<?php 
// Include file koneksi database dan header
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan ID peminjaman otomatis dengan minimal 7 digit angka
function generateBarcode() {
    return str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
}

// Memeriksa apakah form telah disubmit
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Mendapatkan data dari form
    $id_santri = $_POST['id_santri'];
    $kode_buku = $_POST['kode_buku'];
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_harus_kembali = $_POST['tgl_harus_kembali'];
    $id_admin = $_POST['id_admin'];
    $status_pinjam = $_POST['status_pinjam'];
    $jumlah = $_POST['jumlah'];

    // Query untuk mendapatkan jumlah buku yang tersedia berdasarkan kode buku
    $query_jumlah_buku = mysqli_query($koneksi, "SELECT jumlah FROM buku WHERE kode_buku='$kode_buku'");
    $data_jumlah_buku = mysqli_fetch_assoc($query_jumlah_buku);
    $jumlah_buku_tersedia = $data_jumlah_buku['jumlah'];

    // Validasi jumlah yang dimasukkan agar tidak melebihi jumlah buku yang tersedia
    if ($jumlah > $jumlah_buku_tersedia) {
        echo '<script>alert("Jumlah yang dimasukkan melebihi jumlah buku yang tersedia."); window.location.href = "input_data_peminjaman.php";</script>';
    } else {
        // Query untuk menyimpan data peminjaman
        $id_peminjaman = generateBarcode(); // Generate ID peminjaman
        $query_peminjaman = "INSERT INTO peminjaman (id_peminjaman, id_santri, kode_buku, tgl_pinjam, tgl_harus_kembali, id_admin, status_pinjam, jumlah) VALUES ('$id_peminjaman', '$id_santri', '$kode_buku', '$tgl_pinjam', '$tgl_harus_kembali', '$id_admin', '$status_pinjam', '$jumlah')";

        // Menjalankan query penyimpanan data peminjaman
        if(mysqli_query($koneksi, $query_peminjaman)){
            // Menampilkan pesan sukses jika penyimpanan berhasil
            echo '<script>alert("Data peminjaman berhasil disimpan."); window.location.href = "data_peminjaman.php";</script>';
            
            // Periksa status peminjaman dan perbarui jumlah di tabel pengadaan
            if ($status_pinjam == 'Pinjam') {
                // Kurangi jumlah di tabel pengadaan
                $query_pengadaan = "UPDATE pengadaan SET jumlah = jumlah - $jumlah WHERE kode_buku = '$kode_buku'";
                mysqli_query($koneksi, $query_pengadaan);
            } elseif ($status_pinjam == 'Kembali') {
                // Tambahkan jumlah di tabel pengadaan
                $query_pengadaan = "UPDATE pengadaan SET jumlah = jumlah + $jumlah WHERE kode_buku = '$kode_buku'";
                mysqli_query($koneksi, $query_pengadaan);
            }
        } else {
            // Menampilkan pesan error jika penyimpanan gagal
            echo "Error: " . $query_peminjaman . "<br>" . mysqli_error($koneksi);
        }
    }
}
?>
