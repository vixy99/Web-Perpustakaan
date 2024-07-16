<?php 
	include "header.php";
	$id = $_GET['id'];
	$ambil_data = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE id_pengadaan='$id'");
	$data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 mt-2" style="min-height: 500px">
			<div class="card">
				  <div class="card-header">
					Data Stock
				  </div>
					<div class="card-body">
						<div class="row">
							<div class="col">
								<form action="simpan_data_stock.php" method="POST">
									<div class="form-group">
									<label for="">ID_Pengadaan</label>
									<input type="" class="form-control" placeholder="Judul_Buku" name="id_pengadaan" value ="<?php echo $data['id_pengadaan']?>">
									</div>
                                    <div class="form-group">
									<label for="">Tanggal Pengadaan Baru</label>
									<input type="date" class="form-control" placeholder="Judul_Buku" name="tgl_pengadaan" value ="<?php echo $data['tgl_pengadaan']?>">
									</div>
                                    <div class="form-group">
									<label for="">Kode Buku</label>
									<input type="text" class="form-control" placeholder="Judul_Buku" name="kode_buku" value ="<?php echo $data['kode_buku']?>">
									</div>
                                    <div class="form-group">
									<label for="">Asal Buku</label>
									<input type="text" class="form-control" placeholder="Judul_Buku" name="asal_buku" value ="<?php echo $data['asal_buku']?>">
									</div>
                                    <div class="form-group">
									<label for="">Jumlah</label>
									<input type="text" class="form-control" placeholder="Judul_Buku" name="jumlah" value ="<?php echo $data['jumlah']?>">
									</div>
                                    <div class="form-group">
									<label for="">Keterangan</label>
									<input type="text" class="form-control" placeholder="Judul_Buku" name="keterangan" value ="<?php echo $data['keterangan']?>">
									</div>
                                    <div class="form-group">
									<label for="">ID_Admin</label>
									<input type="text" class="form-control" placeholder="Judul_Buku" name="id_admin" value ="<?php echo $data['id_pengadaan']?>">
									</div>
									<br>
									<a href="data_stock.php"><input class="btn btn-danger" value ="batal"></a>
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
?>