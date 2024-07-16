<?php
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan kode penulis otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

$kode_penulis = generateBarcode(); // Menggunakan fungsi generateBarcode untuk mendapatkan kode penulis otomatis
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Penulis
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_penulis.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_penulis.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari nama penulis" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Id Penulis</th>
                                    <th>Nama Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                if ($keyword != '') {
                                    $query = mysqli_query($koneksi, "SELECT * FROM penulis WHERE nama_penulis LIKE '%$keyword%'");
                                } else {
                                    $query = mysqli_query($koneksi, "SELECT * FROM penulis");
                                }
                                $no = 1;
                                while ($ambil_data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $ambil_data['id_penulis']; ?></td>
                                        <td><?php echo $ambil_data['nama_penulis']; ?></td>
                                        <td>
                                        <a href="edit_penulis.php?id=<?php echo $ambil_data['id_penulis']?>" class="btn btn-warning me-4">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="hapus_data_penulis.php?id=<?php echo $ambil_data['id_penulis']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Input Data Penulis</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="simpan_penulis.php" method="POST">
                                <div class="form-group">
                                    <label for="nama_penulis">Nama Penulis</label>
                                    <input type="text" class="form-control" name="nama_penulis" required>
                                </div>
                                <input type="hidden" id="kode_penulis" name="kode_penulis" value="">
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        document.getElementById('kode_penulis').value = '<?php echo $kode_penulis; ?>';
                                    });
                                </script>
                                <br>
                                <input type="submit" class="btn btn-primary" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Script jQuery untuk Menampilkan ID Penulis yang Dipilih -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Menangani perubahan pemilihan pada dropdown id_penulis
    $("select[name='id_penulis']").change(function() {
        var selectedId = $(this).val();
        // Menampilkan ID Penulis yang dipilih di tempat yang diinginkan
        $("#selected_penulis_id").text("ID Penulis yang dipilih: " + selectedId);
    });
});
</script>
