<?php
include "koneksi.php";

// Periksa apakah ID peminjaman telah diberikan
if (isset($_GET['id'])) {
    // Tangkap ID peminjaman dari URL
    $id_peminjaman = $_GET['id'];
    
    // Lakukan kueri untuk mengambil data peminjaman berdasarkan ID
    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id_peminjaman'");
    
    // Periksa apakah data peminjaman ditemukan
    if (mysqli_num_rows($query) > 0) {
        // Ambil data peminjaman
        $data = mysqli_fetch_assoc($query);
        ?>
        <div class="printarea">
            <h2 class="text-center">Detail Peminjaman</h2>
            <table class="table table-bordered">
                <tr>
                    <th>ID Peminjaman</th>
                    <td><?php echo $data['id_peminjaman']; ?></td>
                </tr>
                <tr>
                    <th>ID Santri</th>
                    <td><?php echo $data['id_santri']; ?></td>
                </tr>
                <tr>
                    <th>Kode Buku</th>
                    <td><?php echo $data['kode_buku']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td><?php echo $data['tgl_pinjam']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Harus Kembali</th>
                    <td><?php echo $data['tgl_harus_kembali']; ?></td>
                </tr>
                <tr>
                    <th>ID Admin</th>
                    <td><?php echo $data['id_admin']; ?></td>
                </tr>
                <tr>
                    <th>Status Pinjam</th>
                    <td><?php echo $data['status_pinjam']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><?php echo $data['jumlah']; ?></td>
                </tr>
            </table>
        </div>
        <?php
    } else {
        echo "Data peminjaman tidak ditemukan.";
    }
} else {
    echo "ID peminjaman tidak diberikan.";
}
?>
