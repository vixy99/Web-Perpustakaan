<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID kategori telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data kategori berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$id'");
    $data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
				  <div class="card-header">
					Edit Kategori
				  </div>
					<div class="card-body">
						<div class="row">
							<div class="col">
								<form action="simpan_kategori.php" method="POST">
									<div class="form-group">
									<label for="">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" value="<?php echo $data['nama_kategori']; ?>" required>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="id_kategori">ID Kategori</label>
                                <input type="text" class="form-control" id="id_kategori" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_kategori']; ?>">
                                <input type="hidden" name="id_kategori" class="form-control" id="kode_buku" placeholder="Masukkan Nama Produk"  value="<?= $data['id_kategori']; ?>">
                                </div>
                                </div>
                                </div>
                                <br>
                                <a href="data_kategori.php" class="btn btn-danger">Batal</a>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include "footer.html";
} else {
    echo "ID Kategori tidak ditemukan";
}
?>
