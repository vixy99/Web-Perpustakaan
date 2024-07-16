<?php
include "koneksi.php";
include "header.php";

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM penulis WHERE id_penulis='$id'");
    $data = mysqli_fetch_array($query);
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    <?php echo $edit_mode ? 'Edit Data Kategori' : 'Tambah Kategori'; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_kategori.php" method="POST">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" value="<?php echo $edit_mode ? $data['nama_penulis'] : ''; ?>" required>
                                </div>
                                <?php if ($edit_mode) { ?>
                                    <input type="hidden" name="id_kategori" value="<?php echo $data['id_kategori']; ?>">
                                <?php } ?>
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
?>
