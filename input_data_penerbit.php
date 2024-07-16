<?php
include "koneksi.php";
include "header.php";

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit='$id'");
    $data = mysqli_fetch_array($query);
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    <?php echo $edit_mode ? 'Edit Data Penerbit' : 'Tambah Data Penerbit'; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
								<form action="simpan_penerbit.php" method="POST">
									<div class="form-group">
									<label for="">Nama Penerbit</label>
									<input type="text" class="form-control" name="nama_penerbit">
									</div>
									<div class="form-group">
									<label for="">Kota</label>
									<input type="text" class="form-control" name="kota">
									</div>
									<?php if ($edit_mode) { 
									?>
                                    <input type="hidden" name="id_penerbit" value="<?php echo $data['id_penerbit']; ?>">
                                	<?php } 
									?>
									<br>
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