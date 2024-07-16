<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID buku telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data buku berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM santri WHERE id_santri='$id'");
    $data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Edit Santri
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_santri.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_santri">Nama Santri</label>
                                    <input type="text" class="form-control" name="nama_santri" value="<?php echo $data['nama_santri']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="kelamin" required>
                                        <option value="Laki-Laki" <?php echo ( $data['kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?php echo ( $data['kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $data['tempat_lahir'] ; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $data['tgl_lahir'] ; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Nomer HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?php echo $data['no_hp'] ; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto_santri">Foto</label>
                                    <?php if ($data['foto_santri']) { ?>
                                        <img src="img/<?php echo $data['foto_santri']; ?>" width="100"><br>
                                        <input type="hidden" name="foto_santri_lama" value="<?php echo $data['foto_santri']; ?>">
                                    <?php } ?>
                                    <input type="file" class="form-control" name="foto_santri">
                                </div>
                                </div>
                                <div class="row">
                                	<div class="col-md-6">
                                	<div class="form-group">
                                	<label for="id_santri">ID Santri</label>
                                	<input type="text" class="form-control" id="id_santri" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_santri']; ?>">
                                	<input type="hidden" name="id_santri" class="form-control" id="id_santri" placeholder="Masukkan Nama Produk"  value="<?= $data['id_santri']; ?>">
                                	</div>
                                	</div>
                                	</div>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="data_santri.php" class="btn btn-danger">Batal</a>
                                
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
    echo "ID buku tidak ditemukan";
}
?>
