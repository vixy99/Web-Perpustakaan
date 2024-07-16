<?php
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

$kode_buku = generateBarcode(); // Menggunakan fungsi generateBarcode untuk mendapatkan kode buku otomatis
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Buku
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_buku.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_buku.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari judul buku" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Tahun</th>
                                    <th>Sinopsis</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                if ($keyword != '') {
                                    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE judul LIKE '%$keyword%'");
                                } else {
                                    $query = mysqli_query($koneksi, "SELECT * FROM buku");
                                }
                                $no = 1;
                                while ($ambil_data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                    <td>
                                        <?php echo $no++ ?></td>
                                        <td><img src="uploads/cover/<?php echo $ambil_data['foto']; ?>" width="100"></td>
                                        <td><?php echo $ambil_data['kode_buku']; ?></td>
                                        <td style="word-break: break-word;"><?php echo $ambil_data['judul']; ?></td>
                                        <td><?php echo $ambil_data['tahun']; ?></td>
                                        <td style="word-break: break-word;"><?php echo $ambil_data['sinopsis']; ?></td>
                                        <td><?php echo $ambil_data['jumlah']; ?></td>
                                        <td>
                                        <a href="edit_buku.php?id=<?php echo $ambil_data['kode_buku']?>" class="btn btn-warning mb-4">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        
                                        <a href="hapus_data_buku.php?id=<?php echo $ambil_data['kode_buku']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table td, .table th {
        word-wrap: break-word;
        max-width: 100px; /* Sesuaikan lebar maksimal sesuai kebutuhan Anda */
    }
</style>

<?php
include "footer.html";
?>
