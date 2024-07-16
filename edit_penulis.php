<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID penulis telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data penulis berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM penulis WHERE id_penulis='$id'");
    $data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Edit Penulis
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_penulis.php" method="POST">
                                <div class="form-group">
                                    <label for="nama_penulis">Nama Penulis</label>
                                    <input type="text" class="form-control" name="nama_penulis" value="<?php echo $data['nama_penulis']; ?>" required>
                                </div>
                                <div class="row">
                                	<div class="col-md-6">
                                	<div class="form-group">
                                	<label for="id_penulis">ID Penulis</label>
                                	<input type="text" class="form-control" id="id_penulis" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_penulis']; ?>">
                                	<input type="hidden" name="id_penulis" class="form-control" id="id_penulis" placeholder="Masukkan Nama Produk"  value="<?= $data['id_penulis']; ?>">
                                	</div>
                                	</div>
                                	</div>
                                	
                                <br>
                                <a href="data_penulis.php" class="btn btn-danger">Batal</a>
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
    echo "ID penulis tidak ditemukan";
}
?>
