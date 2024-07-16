<?php
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan kode penulis otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

$kode_penulis = generateBarcode(); // Menggunakan fungsi generateBarcode untuk mendapatkan kode penulis otomatis
?>

<div class="container">
	<div class="row">
		<div class="col-lg-12 mt-2" style="min-height: 500px">
			<div class="card">
				  <div class="card-header">
					Data Kategori
				  </div>
				  <div class="card-body">
                    <div class="row">
                        <div class="col">
							<a href="input_data_kategori.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_kategori.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari kategori" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
					<div class="row mt-3">
						<div class="col">
							<table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>Kode kategori</th>
								<th>Nama Kategori</th>
								<th>Aksi</th>
								</tr>
							<?php
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                if ($keyword != '') {
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori LIKE '%$keyword%'");
                                } else {
                                    $query = mysqli_query($koneksi, "SELECT * FROM kategori");
                                }
                                $no = 1;
                                while ($ambil_data = mysqli_fetch_array($query)) {
                                ?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $ambil_data['id_kategori'];?></td>
								<td><?php echo $ambil_data['nama_kategori'];?></td>
								<td>
										<a href="edit_kategori.php?id=<?php echo $ambil_data['id_kategori']?>" class="btn btn-warning me-4">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="hapus_data_kategori.php?id=<?php echo $ambil_data['id_kategori']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
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

<?php
	include "footer.html";
?>
