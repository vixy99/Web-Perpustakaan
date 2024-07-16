<?php 
include "header.php";

// Cek apakah parameter ID diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data buku berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM buku WHERE kode_buku='$id'");
    $data = mysqli_fetch_array($ambil_data);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Buku
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_ebook.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="form-group">
                                    <label for="">Judul_ebook</label>
                                    <input type="text" class="form-control" name="judul_ebook" value="<?php echo $data['judul_ebook']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Source</label>
                                    <input type="file" class="form-control" name="source" value="<?php echo $data['source']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" value="<?php echo $data['deskripsi']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <input type="file" class="form-control" name="foto" value="<?php echo $data['foto']; ?>">
                                </div>
                                <br>
                                <a href="data_ebook.php"><input class="btn btn-danger" value="batal"></a>
                                <input type="submit" class="btn btn-primary" value="simpan">
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
