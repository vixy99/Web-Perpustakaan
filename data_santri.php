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
                    Data Santri
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_santri.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_santri.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari nama santri" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>Id Santri</th>
								<th>Nama Santri</th>
								<th>Kelamin</th>
								<th>Tempat Lahir</th>
								<th>Tanggal Lahir</th>
								<th>NO HP</th>
								<th>Foto</th>
								<th>Aksi</th>
							</tr>
                            <?php
                            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                            if ($keyword != '') {
                            if (is_numeric($keyword)) {
                            $query = mysqli_query($koneksi, "SELECT * FROM santri WHERE id_santri = $keyword");
                            } else {
                            $query = mysqli_query($koneksi, "SELECT * FROM santri WHERE nama_santri LIKE '%$keyword%'");
                            }
                            } else {
                            $query = mysqli_query($koneksi, "SELECT * FROM santri");
                            }
                            $no = 1;
                            while ($ambil_data = mysqli_fetch_array($query)) {
                            
                            ?>

                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        
                                        <td><?php echo $ambil_data['id_santri']; ?></td>
                                        <td><?php echo $ambil_data['nama_santri']; ?></td>
                                        <td><?php echo $ambil_data['kelamin']; ?></td>
                                        <td><?php echo $ambil_data['tempat_lahir']; ?></td>
                                        <td><?php echo $ambil_data['tgl_lahir']; ?></td>
										<td><?php echo $ambil_data['no_hp']; ?></td>
                                        <td><img src="img/<?php echo $ambil_data['foto_santri']; ?>" width="100"></td>
                                        <td>
                                            <a href="edit_santri.php?id=<?php echo $ambil_data['id_santri']?>" class="btn btn-warning me-3">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="hapus_data_santri.php?id=<?php echo $ambil_data['id_santri']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                            <a href="cetak_santri.php?id=<?php echo $ambil_data['id_santri']?>" class="btn btn-default me-3"><i class="fas fa-print"></i> Cetak</a>
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
