<?php 
	include "header.php";
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 mt-2" style="min-height: 500px">
			<div class="card">
				  <div class="card-header">
					Data E-book
				  </div>
				  <div class="card-body">
					<div class ="row">
						<div class="col">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
							  Tambah Data
							</button>
						</div>
						<div class="col">
							<form action="" class="form-inline">
								<input type="text" class="form-control">
								<input type="submit" class="btn btn-primary" value="cari">
							</form>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col">
							<table class="table table-bordered table-striped">
							<tr>
								<th>No</th>
								<th>Judul E-Book</th>
								<th>deskripsi</th>
								<th>foto</th>
							</tr>
							<?php
							if(isset($_GET['cari'])){
								$keyword=$_GET['keyword'];
								$query=mysqli_query($koneksi,"select* from ebook where judul_ebook like '%$keyword%'");
							}else {
									$query = mysqli_query($koneksi,"select *from ebook");
							}
							$no=1;
								while ($ambil_data=mysqli_fetch_array($query)){
							?>
							<tr>
								<td><?php echo $no++ ?></td>
								<td><?php echo $ambil_data['judul_ebook'];?></td>
								<td><?php echo $ambil_data['deskripsi'];?></td>
                                <td><img src="uploads/cover/<?php echo $ambil_data['foto']; ?>" width="100"></td>
								<td><a href="edit_ebook.php?id=<?php echo $ambil_data['id_ebook']?>" class="btn btn-warning">Edit<a>  ||  <a href="hapus_data_ebook.php?id=<?php echo $ambil_data['id_ebook']?>" class="btn btn-danger">Hapus<a>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Data Buku</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
					<div class="card-body">
						<div class="row">
							<div class="col">
								<form action="simpan_ebook.php" method="POST">
									<div class="form-group">
									<label for="">Judul_ebook</label>
									<input type="text" class="form-control"  name="judul_ebook" required>
									</div>
									<div class="form-group">
									<label for="">Source</label>
									<input type="file" class="form-control"  name="source" id="pdf">
									</div>
									<div class="form-group">
									<label for="">Deskripsi</label>
									<input type="text" class="form-control"  name="deskripsi">
									</div>
									<div class="form-group">
									<label for="">Foto</label>
									<input type="file" class="form-control"  name="foto" id="cover">
									</div>
									<br>
									<input type="submit" class="btn btn-primary" value="simpan">
								</form>
							</div>
						</div>
					</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
