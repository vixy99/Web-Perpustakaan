<?php
include "koneksi.php";
include "header.php";
// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE kode_buku='$id'");
    $data = mysqli_fetch_array($query);
}

// Fungsi untuk menghasilkan kode buku acak
function generateRandomCode() {
    return mt_rand(1000000, 9999999); // Angka acak antara 1.000.000 dan 9.999.999
}

// Jika mode tambah, buat kode buku baru
if (!$edit_mode) {
    $id_santri = generateRandomCode();
} else {
    $id_santri = $data['id_santri'];
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    <?php echo $edit_mode ? 'Edit Data Santri' : 'Tambah Data Santri'; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_santri.php" method="POST" enctype="multipart/form-data">
                                <!-- Kode buku sebagai input tersembunyi -->
                           
                                <div class="form-group">
                                    <label for="nama_santri">Nama</label>
                                    <input type="text" class="form-control" name="nama_santri" value="<?php echo $edit_mode ? $data['nama_santri'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="kelamin" required>
                                        <option value="Laki-Laki" <?php echo ($edit_mode && $data['kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?php echo ($edit_mode && $data['kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $edit_mode ? $data['tempat_lahir'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $edit_mode ? $data['tgl_lahir'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Nomer HP</label>
                                    <input type="text" class="form-control" name="no_hp" value="<?php echo $edit_mode ? $data['no_hp'] : ''; ?>" required>
                                </div>
                               
                                <div class="form-group">
                                    <label for="foto_santri">Foto</label>
                                    <?php if ($edit_mode && $data['foto_santri']) { ?>
                                        <img src="imgr/<?php echo $data['foto_santri']; ?>" width="100"><br>
                                        <input type="hidden" name="foto_santri_lama" value="<?php echo $data['foto_santri']; ?>">
                                    <?php } ?>
                                    <input type="file" class="form-control" name="foto_santri">
                                </div>
                                <?php if ($edit_mode) { ?>
                                    <input type="hidden" name="id_santri" value="<?php echo $data['id_santri']; ?>">
                                <?php } ?>
                                <br>
                                <a href="data_santri.php" class="btn btn-danger">Batal</a>
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
