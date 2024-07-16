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
    $kode_buku = generateRandomCode();
} else {
    $kode_buku = $data['kode_buku'];
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    <?php echo $edit_mode ? 'Edit Data Buku' : 'Tambah Data Buku'; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_buku.php" method="POST" enctype="multipart/form-data">
                                <!-- Kode buku sebagai input tersembunyi -->
                           
                                <div class="form-group">
                                    <label for="judul">Judul Buku</label>
                                    <input type="text" class="form-control" name="judul" value="<?php echo $edit_mode ? $data['judul'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_penulis">Penulis:</label>
                                    <select class="form-control" name="id_penulis" required>
                                        <?php
                                        $query = "SELECT id_penulis, nama_penulis FROM penulis";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['id_penulis'] == $row['id_penulis'] ? 'selected' : '';
                                            echo "<option value=\"{$row['id_penulis']}\" $selected>{$row['nama_penulis']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_penerbit">Penerbit:</label>
                                    <select class="form-control" name="id_penerbit" required>
                                        <?php
                                        $query = "SELECT id_penerbit, nama_penerbit FROM penerbit";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['id_penerbit'] == $row['id_penerbit'] ? 'selected' : '';
                                            echo "<option value=\"{$row['id_penerbit']}\" $selected>{$row['nama_penerbit']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">Kategori:</label>
                                    <select class="form-control" name="id_kategori" required>
                                        <?php
                                        $query = "SELECT id_kategori, nama_kategori FROM kategori";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['id_kategori'] == $row['id_kategori'] ? 'selected' : '';
                                            echo "<option value=\"{$row['id_kategori']}\" $selected>{$row['nama_kategori']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" value="<?php echo $edit_mode ? $data['tahun'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="sinopsis">Sinopsis</label>
                                    <textarea class="form-control" name="sinopsis" required><?php echo $edit_mode ? $data['sinopsis'] : ''; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="<?php echo $edit_mode ? $data['jumlah'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <?php if ($edit_mode && $data['foto']) { ?>
                                        <img src="uploads/cover/<?php echo $data['foto']; ?>" width="100"><br>
                                        <input type="hidden" name="foto_lama" value="<?php echo $data['foto']; ?>">
                                    <?php } ?>
                                    <input type="file" class="form-control" name="foto">
                                </div>
                                <?php if ($edit_mode) { ?>
                                    <input type="hidden" name="kode_buku" value="<?php echo $data['kode_buku']; ?>">
                                <?php } ?>
                                <br>
                                <a href="data_buku.php" class="btn btn-danger">Batal</a>
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
