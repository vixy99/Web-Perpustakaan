<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID penulis telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data penulis berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit='$id'");
    $data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
					Edit Penerbit
				  </div>
					<div class="card-body">
						<div class="row">
							<div class="col">
								<form action="simpan_penerbit.php" method="POST">
									<div class="form-group">
									<label for="">Nama Penerbit</label>
									<input type="text" class="form-control"  name="nama_penerbit" value ="<?php echo $data['nama_penerbit']?>">
									</div>
									<div class="form-group">
									<label for="">Kota</label>
									<input type="text" class="form-control"  name="kota" value ="<?php echo $data['kota']?>"
									></div>
                                	<div class="row">
                                	<div class="col-md-6">
                                	<div class="form-group">
                                	<label for="id_penerbit">ID Penerbit</label>
                                	<input type="text" class="form-control" id="id_penerbit" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_penerbit']; ?>">
                                	<input type="hidden" name="id_penerbit" class="form-control" id="id_penerbit" placeholder="Masukkan Nama Produk"  value="<?= $data['id_penerbit']; ?>">
                                	</div>
                                	</div>
                                	</div>
                                	<br>
									<a href="data_penerbit.php"><input class="btn btn-danger" value ="batal"></a>
									<input type="submit"  class="btn btn-primary" value="simpan">
								</form>
							</div>
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
    echo "ID penulis tidak ditemukan";
}
?>
