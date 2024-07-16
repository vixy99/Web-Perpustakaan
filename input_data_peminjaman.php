<?php 
include "koneksi.php";
include "header.php";

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
    $data = mysqli_fetch_array($query);

    $ambil_data = mysqli_query($koneksi, "SELECT * FROM santri WHERE id_santri='$id'");
    $data = mysqli_fetch_array($query);

    $ambil_data = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id'");
    $data = mysqli_fetch_array($query);

    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE kode_buku='$id'");
    $data = mysqli_fetch_array($query);
}

// Fungsi untuk menghasilkan kode buku acak
function generateRandomCode() {
    return mt_rand(1000000, 9999999); // Angka acak antara 1.000.000 dan 9.999.999
}

// Jika mode tambah, buat kode buku baru
if (!$edit_mode) {
    $id_peminjaman = generateRandomCode();
} else {
    $id_peminjaman = $data['id_peminjaman'];
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
                            <form action="simpan_peminjaman.php" method="POST" enctype="multipart/form-data">
                                <!-- Kode buku sebagai input tersembunyi -->
                                <div class="form-group">
                                    <label for="id_santri">ID Santri</label>
                                    <select class="form-control" name="id_santri" required>
                                        <?php
                                        $query = "SELECT id_santri FROM santri";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['id_santri'] == $row['id_santri'] ? 'selected' : '';
                                            echo "<option value=\"{$row['id_santri']}\" $selected>{$row['id_santri']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kode_buku">Kode Buku</label>
                                    <select class="form-control" name="kode_buku" required>
                                        <?php
                                        $query = "SELECT kode_buku FROM buku";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['kode_buku'] == $row['kode_buku'] ? 'selected' : '';
                                            echo "<option value=\"{$row['kode_buku']}\" $selected>{$row['kode_buku']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                                    <input type="date" class="form-control" name="tgl_pinjam" id="tgl_pinjam" value="<?php echo $edit_mode ? $data['tgl_pinjam'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_harus_kembali">Tanggal Harus Kembali</label>
                                    <input type="hidden" class="form-control" name="tgl_harus_kembali" id="tgl_harus_kembali_hidden" required>
                                    <input type="text" class="form-control" id="tgl_harus_kembali_display" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="id_admin">ID Admin:</label>
                                    <select class="form-control" name="id_admin" required>
                                        <?php
                                        $query = "SELECT id_admin FROM admin";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['id_admin'] == $row['id_admin'] ? 'selected' : '';
                                            echo "<option value=\"{$row['id_admin']}\" $selected>{$row['id_admin']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_pinjam">Status Pinjam</label>
                                    <select class="form-control" name="status_pinjam" required>
                                        <option value="Pinjam" <?php echo ($edit_mode && $data['status_pinjam'] == 'Pinjam') ? 'selected' : ''; ?>>Pinjam</option>
                                        <option value="Kembali" <?php echo ($edit_mode && $data['status_pinjam'] == 'Kembali') ? 'selected' : ''; ?>>Kembali</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" value="<?php echo $edit_mode ? $data['jumlah'] : ''; ?>" required>
                                </div>
                                <?php if ($edit_mode) { ?>
                                    <input type="hidden" name="id_peminjaman" value="<?php echo $data['id_peminjaman']; ?>">
                                <?php } ?>
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

<script>
    
    var tglPinjam = document.getElementById("tgl_pinjam");
    var tglHarusKembali = document.getElementById("tgl_harus_kembali_hidden");

    
    tglPinjam.addEventListener("change", function() {
        
        var tanggalPinjam = new Date(tglPinjam.value);
        tanggalPinjam.setDate(tanggalPinjam.getDate() + 5);
        var tahun = tanggalPinjam.getFullYear();
        var bulan = ("0" + (tanggalPinjam.getMonth() + 1)).slice(-2);
        var tanggal = ("0" + tanggalPinjam.getDate()).slice(-2);
        var tanggalFormat = tahun + "-" + bulan + "-" + tanggal;
        tglHarusKembali.value = tanggalFormat;
        document.getElementById("tgl_harus_kembali_display").value = tanggalFormat;
    });
</script>

<?php
include "footer.html";
?>

