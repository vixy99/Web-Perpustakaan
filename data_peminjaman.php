<?php
include "koneksi.php";
include "header.php";

// Fungsi untuk menghasilkan kode buku otomatis dengan minimal 7 digit angka
function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

$id_peminjaman = generateBarcode(); // Menggunakan fungsi generateBarcode untuk mendapatkan kode buku otomatis
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Peminjaman
                </div>
                <div class="card-body">
                    <div class="row">
                            
                        <div class="col">
                            <a href="input_data_peminjaman.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_peminjaman.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari id santri" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Peminjaman</th>
                                        <th>ID Santri</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tangal Harus Kembali</th>
                                        <th>Id Admin</th>
                                        <th>Status Pinjam</th>
                                        <th>Kode Buku</th>
                                        <th>Jumlah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                    if ($keyword != '') {
                                        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_santri LIKE '%$keyword%'");
                                    } else {
                                        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                                    }
                                    $no = 1;
                                    while ($ambil_data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $ambil_data['id_peminjaman'];?></td>
                                        <td><?php echo $ambil_data['id_santri'];?></td>
                                        <td><?php echo $ambil_data['tgl_pinjam'];?></td>
                                        <td><?php echo $ambil_data['tgl_harus_kembali'];?></td>
                                        <td><?php echo $ambil_data['id_admin'];?></td>
                                        <td><?php echo $ambil_data['status_pinjam'];?></td>
                                        <td><?php echo $ambil_data['kode_buku'];?></td>
                                        <td><?php echo $ambil_data['jumlah'];?></td>
                                        <td>
                                            <?php if ($ambil_data['status_pinjam'] != 'Kembali') : ?>
                                                <a href="perpanjangan.php?id=<?php echo $ambil_data['id_peminjaman']?>" class="btn btn-warning">Perpanjang</a>
                                                <a href="pengembalian.php?id=<?php echo $ambil_data['id_peminjaman']?>" class="btn btn-danger">Pengembalian</a>
                                            <?php endif; ?>
                                            <a href="cetak.php?id=<?php echo $ambil_data['id_peminjaman']?>" class="btn btn-default me-3"><i class="fas fa-print"></i> Cetak</a>
                                            <a href="hapus_peminjaman.php?id=<?php echo $ambil_data['id_peminjaman']?>" class="btn btn-default" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
                                            <i class="fas fa-trash"></i> Hapus
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<script>
    function printAndRedirect(id_peminjaman) {
        $.ajax({
            url: 'cetak.php',
            type: 'GET',
            data: { id: id_peminjaman },
            success: function(response) {
                var newWindow = window.open('', '_blank');
                newWindow.document.open();
                newWindow.document.write(response);
                newWindow.document.close();
                newWindow.print();
            }
        });
    }
</script>

<?php
include "footer.html";
?>
