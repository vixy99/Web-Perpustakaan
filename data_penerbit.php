<?php 
include "header.php";
$query = mysqli_query($koneksi,"select * from penerbit");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 500px">
            <div class="card">
                <div class="card-header">
                    Data Penerbit
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="input_data_penerbit.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <form action="data_penerbit.php" method="GET" class="form-inline">
                            <input type="text" class="form-control" name="keyword" placeholder="Cari nama penerbit" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                            <input type="submit" class="btn btn-primary ml-2" value="Cari">
                        </form>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Id Penerbit</th>
                                    <th>Nama Penerbit</th>
                                    <th>Kota</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
                                if ($keyword != '') {
                                    $query = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE nama_penerbit LIKE '%$keyword%'");
                                } else {
                                    $query = mysqli_query($koneksi, "SELECT * FROM penerbit");
                                }
                                $no = 1;
                                while ($ambil_data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $ambil_data['id_penerbit'];?></td>
                                    <td><?php echo $ambil_data['nama_penerbit'];?></td>
                                    <td><?php echo $ambil_data['kota'];?></td>
                                    <td>
                                        <a href="edit_penerbit.php?id=<?php echo $ambil_data['id_penerbit']?>" class="btn btn-warning me-4">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="hapus_data_penerbit.php?id=<?php echo $ambil_data['id_penerbit']?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data ?')">
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
