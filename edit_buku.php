<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID buku telah diberikan
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
                    Edit Buku
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_buku.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="judul">Judul Buku</label>
                                    <input type="text" class="form-control" name="judul" value="<?php echo $data['judul']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_penulis">Penulis:</label>
                                    <select class="form-control" name="id_penulis" required>
                                        <?php
                                        // Query untuk mengambil daftar penulis dari basis data
                                        $query = "SELECT id_penulis, nama_penulis FROM penulis";
                                        $result = mysqli_query($koneksi, $query);

                                        // Tampilkan pilihan penulis sebagai opsi dropdown
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['id_penulis'] == $data['id_penulis']) ? "selected" : "";
                                            echo "<option value=\"{$row['id_penulis']}\" $selected>{$row['nama_penulis']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_penerbit">Penerbit:</label>
                                    <select class="form-control" name="id_penerbit" required>
                                        <?php
                                        // Query untuk mengambil daftar penerbit dari basis data
                                        $query = "SELECT id_penerbit, nama_penerbit FROM penerbit";
                                        $result = mysqli_query($koneksi, $query);

                                        // Tampilkan pilihan penerbit sebagai opsi dropdown
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['id_penerbit'] == $data['id_penerbit']) ? "selected" : "";
                                            echo "<option value=\"{$row['id_penerbit']}\" $selected>{$row['nama_penerbit']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_kategori">Kategori:</label>
                                    <select class="form-control" name="id_kategori" required>
                                        <?php
                                        // Query untuk mengambil daftar kategori dari basis data
                                        $query = "SELECT id_kategori, nama_kategori FROM kategori";
                                        $result = mysqli_query($koneksi, $query);

                                        // Tampilkan pilihan kategori sebagai opsi dropdown
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['id_kategori'] == $data['id_kategori']) ? "selected" : "";
                                            echo "<option value=\"{$row['id_kategori']}\" $selected>{$row['nama_kategori']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" name="tahun" value="<?php echo $data['tahun']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="sinopsis">Sinopsis</label>
                                    <textarea class="form-control" name="sinopsis" required><?php echo $data['sinopsis']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="<?php echo $data['jumlah']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <?php if (!empty($data['foto'])): ?>
                                        <img src="uploads/cover/<?php echo $data['foto']; ?>" width="100">
                                    <?php endif; ?>
                                    <input type="file" class="form-control" name="foto">
                                    <input type="hidden" name="foto_lama" value="<?php echo $data['foto']; ?>">
                                </div>
                                
                                <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                <label for="kode_buku">Kode Buku</label>
                                <input type="text" class="form-control" id="kode_buku" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_buku']; ?>">
                                <input type="hidden" name="kode_buku" class="form-control" id="kode_buku" placeholder="Masukkan Nama Produk"  value="<?= $data['kode_buku']; ?>">
                                </div>
                                </div>
                                </div>

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
} else {
    echo "ID buku tidak ditemukan";
}
?>
