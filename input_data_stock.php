<?php 
include "koneksi.php";
include "header.php";

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE id_pengadaan='$id'");
    $data = mysqli_fetch_array($query);
}

// Fungsi untuk menghasilkan kode buku acak
function generateRandomCode() {
    return mt_rand(1000000, 9999999); // Angka acak antara 1.000.000 dan 9.999.999
}

// Jika mode tambah, buat kode buku baru
if (!$edit_mode) {
    $id_pengadaan = generateRandomCode();
} else {
    $id_pengadaan = $data['id_pengadaan'];
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    <?php echo $edit_mode ? 'Edit Data Stock' : 'Tambah Data Stock'; ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_stock.php" method="POST" enctype="multipart/form-data">
                                <!-- Kode buku sebagai input tersembunyi -->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="tgl_pengadaan">Tanggal Pengadaan</label>
                                        <input type="date" class="form-control" name="tgl_pengadaan" id="tgl_pengadaan" value="<?php echo $edit_mode ? $data['tgl_pengadaan'] : ''; ?>" required>
                                    </div>
                                    <label for="judul">Judul</label>
                                    <select class="form-control" name="judul" id="judul" required onchange="fetchBookDetails()">
                                        <option value="">Pilih Judul</option>
                                        <?php
                                        $query = "SELECT judul FROM buku";
                                        $result = mysqli_query($koneksi, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = $edit_mode && $data['judul'] == $row['judul'] ? 'selected' : '';
                                            echo "<option value=\"{$row['judul']}\" $selected>{$row['judul']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kode_buku">Kode Buku</label>
                                    <input type="text" class="form-control" name="kode_buku" id="kode_buku" value="<?php echo $edit_mode ? $data['kode_buku'] : ''; ?>" readonly required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?php echo $edit_mode ? $data['jumlah'] : ''; ?>" readonly required>
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
                                <?php if ($edit_mode) { ?>
                                    <input type="hidden" name="id_pengadaan" value="<?php echo $data['id_pengadaan']; ?>">
                                <?php } ?>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                                <a href="data_stock.php" class="btn btn-danger">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function fetchBookDetails() {
    var judul = document.getElementById('judul').value;
    if (judul) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_book_details.php?judul=' + judul, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('kode_buku').value = response.kode_buku;
                document.getElementById('jumlah').value = response.jumlah;
                updatePengadaan(response.kode_buku);
            }
        };
        xhr.send();
    } else {
        document.getElementById('kode_buku').value = '';
        document.getElementById('jumlah').value = '';
    }
}

function updatePengadaan(kode_buku) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'update_pengadaan.php?kode_buku=' + kode_buku, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            document.getElementById('jumlah').value = response.jumlah_pengadaan;
        }
    };
    xhr.send();
}
</script>

<?php
include "footer.html";
?>
