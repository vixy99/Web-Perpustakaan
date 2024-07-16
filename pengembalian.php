<?php 
include "koneksi.php";
include "header.php";

// Cek apakah ID buku telah diberikan
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ambil data buku berdasarkan ID yang diberikan
    $ambil_data = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
    $data = mysqli_fetch_array($ambil_data);
    
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Perpanjangan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_peminjaman.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                </div>
                                <div class="form-group">
                                <label for="id_santri">ID Santri</label>
                                <input type="text" class="form-control" id="id_santri" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_santri']; ?>">
                                <input type="hidden" name="id_santri" class="form-control" id="id_santri" placeholder="Masukkan Nama Produk"  value="<?= $data['id_santri']; ?>">
                                </div>
                                 
                                <div class="form-group">
                                <label for="kode_buku">Kode Buku</label>
                                <input type="text" class="form-control" id="kode_buku" placeholder="Masukkan Nama Produk" disabled value="<?= $data['kode_buku']; ?>">
                                <input type="hidden" name="kode_buku" class="form-control" id="kode_buku" placeholder="Masukkan Nama Produk"  value="<?= $data['kode_buku']; ?>">
                                </div>

								<div class="form-group">
                                <label for="tgl_pinjam">Tanggal Pinjam</label>
                                <input type="date" class="form-control" id="tgl_pinjam" disabled value="<?= isset($data['tgl_pinjam']) ? $data['tgl_pinjam'] : ''; ?>">
                                <input type="hidden" name="tgl_pinjam" class="form-control" id="tgl_pinjam" value="<?= isset($data['tgl_pinjam']) ? $data['tgl_pinjam'] : ''; ?>">
                                </div>

								<div class="form-group">
                                <label for="tgl_harus_kembali">Tanggal Harus Kembali</label>
                                <input type="date" class="form-control" id="tgl_harus_kembali" disabled value="<?= isset($data['tgl_harus_kembali']) ? $data['tgl_harus_kembali'] : ''; ?>">
                                <input type="hidden" name="tgl_harus_kembali" class="form-control" id="tgl_harus_kembali" value="<?= isset($data['tgl_harus_kembali']) ? $data['tgl_harus_kembali'] : ''; ?>">
                                </div>

                                <div class="form-group">
                                <label for="id_admin">ID Admin</label>
                                <input type="text" class="form-control" id="id_admin" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_admin']; ?>">
                                <input type="hidden" name="id_admin" class="form-control" id="id_admin" placeholder="Masukkan Nama Produk"  value="<?= $data['id_admin']; ?>">
                                </div>

                                <div class="form-group">
                                <label for="status_pinjam">Status Pinjam</label>
                                <select class="form-control" name="status_pinjam" required>
                                <option value="Pinjam" <?php echo ($data['status_pinjam'] == 'Pinjam') ? 'selected' : ''; ?>>Pinjam</option>
                                <option value="Kembali" <?php echo ($data['status_pinjam'] == 'Kembali') ? 'selected' : ''; ?>>Kembali</option>
                                </select>
                                </div>
                                
                                <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" class="form-control" id="jumlah" placeholder="Masukkan Nama Produk" disabled value="<?= $data['jumlah']; ?>">
                                <input type="hidden" name="jumlah" class="form-control" id="jumlah" placeholder="Masukkan Nama Produk"  value="<?= $data['jumlah']; ?>">
                                </div>
                                
                                <div class="form-group">
                                <label for="id_peminjaman">ID Peminjaman</label>
                                <input type="text" class="form-control" id="id_peminjaman" placeholder="Masukkan Nama Produk" disabled value="<?= $data['id_peminjaman']; ?>">
                                <input type="hidden" name="id_peminjaman" class="form-control" id="id_peminjaman" placeholder="Masukkan Nama Produk"  value="<?= $data['id_peminjaman']; ?>">
                                </div>
                                
                                <br>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="data_peminjaman.php" class="btn btn-danger">Batal</a>
                                
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
