<?php
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

$kode_buku = generateBarcode(); // Menggunakan fungsi generateBarcode untuk mendapatkan kode buku otomatis
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Keterlambatan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_denda.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_denda.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari nama santri" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>ID Denda</th>
                                    <th>Kode Buku</th>
                                    <th>Judul Buku</th>
                                    <th>ID Santri</th>
                                    <th>Nama Santri</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Tanggal Dikembalikan</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                if ($keyword != '') {
                                    $query = mysqli_query($koneksi, "SELECT d.*, b.judul, s.nama_santri FROM denda d JOIN buku b ON d.kode_buku = b.kode_buku JOIN santri s ON d.id_santri = s.id_santri WHERE s.nama_santri LIKE '%$keyword%'");
                                } else {
                                    $query = mysqli_query($koneksi, "SELECT d.*, b.judul, s.nama_santri FROM denda d JOIN buku b ON d.kode_buku = b.kode_buku JOIN santri s ON d.id_santri = s.id_santri");
                                }
                                $no = 1;
                                while ($ambil_data = mysqli_fetch_array($query)) {
                                ?>
                                    <tr>
                                    <td>
                                        <?php echo $no++ ?></td>
                                        <td><?php echo $ambil_data['id_denda']; ?></td>
                                        <td style="word-break: break-word;"><?php echo $ambil_data['kode_buku']; ?></td>
                                        <td><?php echo $ambil_data['judul']; ?></td>
                                        <td style="word-break: break-word;"><?php echo $ambil_data['id_santri']; ?></td>
                                        <td><?php echo $ambil_data['nama_santri']; ?></td>
                                        <td style="word-break: break-word;"><?php echo $ambil_data['tgl_harus_kembali']; ?></td>
                                        <td><?php echo $ambil_data['tgl_kmb']; ?></td>
                                        <td>
                                            <a href="cetak_denda.php?id=<?php echo $ambil_data['id_denda']?>" class="btn btn-warning mb-4">
                                                <i class="fas fa-print"></i> Print
                                            </a>
                                            
                                            <a href="hapus_denda.php?id=<?php echo $ambil_data['id_denda']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
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
