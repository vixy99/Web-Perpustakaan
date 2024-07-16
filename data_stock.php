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
                    Stock
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_stock.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah List Stock
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_stock.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari Judul Buku" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>Id Stock</th>
								<th>Judul Buku</th>
								<th>Kode Buku</th>
								<th>Tanggal Pengadaan</th>
								<th>Stock</th>
								<th>ID Admin</th>
								<th>Aksi</th>
							</tr>
                            		<?php
                                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                    if ($keyword != '') {
                                        $query = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE judul LIKE '%$keyword%'");
                                    } else {
                                        $query = mysqli_query($koneksi, "SELECT * FROM pengadaan");
                                    }
                                    $no = 1;
                                    while ($ambil_data = mysqli_fetch_array($query)) {
                                	?>

                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        
                                        <td><?php echo $ambil_data['id_pengadaan']; ?></td>
                                        <td><?php echo $ambil_data['judul']; ?></td>
                                        <td><?php echo $ambil_data['kode_buku']; ?></td>
                                        <td><?php echo $ambil_data['tgl_pengadaan']; ?></td>
                                        <td><?php echo $ambil_data['jumlah']; ?></td>
										<td><?php echo $ambil_data['id_admin']; ?></td>
                                        <td>
                                            <a href="hapus_data_stock.php?id=<?php echo $ambil_data['id_pengadaan']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                            <a href="cetak_stock.php?id=<?php echo $ambil_data['id_pengadaan']?>" class="btn btn-default me-3"><i class="fas fa-print"></i> Cetak</a>
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

<?php
include "footer.html";
?>
