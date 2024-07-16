<?php
include "koneksi.php";
include "header.php";

function generateBarcode() {
    $barcode = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT); // Menghasilkan angka acak 7 digit dengan padding nol di depan
    return $barcode;
}

// Tentukan apakah ini adalah mode tambah atau edit
$edit_mode = false;
$id_denda = '';
if (isset($_GET['id'])) {
    $edit_mode = true;
    $id = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM denda WHERE id_denda='$id'");
    $data = mysqli_fetch_array($query);
    $id_denda = $data['id_denda'];
}

$query = "SELECT p.id_peminjaman, p.kode_buku, p.id_santri, p.tgl_harus_kembali, p.jumlah, b.kode_buku as kode_buku_pinjaman, b.judul, s.nama_santri
          FROM peminjaman p
          INNER JOIN buku b ON p.kode_buku = b.kode_buku
          INNER JOIN santri s ON p.id_santri = s.id_santri
          WHERE p.status_pinjam = 'pinjam'";

$result = mysqli_query($koneksi, $query);

// Menginisialisasi array JavaScript dengan data peminjaman untuk id_santri, kode_buku, tgl_harus_kembali, jumlah, judul, dan nama_santri
$peminjamanData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $peminjamanData[$row['id_peminjaman']] = [
        'id_santri' => $row['id_santri'],
        'kode_buku' => $row['kode_buku_pinjaman'],
        'tgl_harus_kembali' => $row['tgl_harus_kembali'],
        'jumlah' => $row['jumlah'],
        'judul' => $row['judul'],
        'nama_santri' => $row['nama_santri']
    ];
}
$peminjamanJson = json_encode($peminjamanData);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <div class="card">
                <div class="card-header">
                    Input Data Denda
                </div>
                <div class="card-body">
                    <form action="simpan_denda.php" method="POST" id="formDenda">
                        <div class="form-group">
                            <label for="id_peminjaman">ID Pinjaman:</label>
                            <select class="form-control" id="id_peminjaman" name="id_peminjaman">
                                <?php mysqli_data_seek($result, 0); // Reset pointer mysqli_fetch_assoc ?>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                    <option value="<?php echo $row['id_peminjaman']; ?>"><?php echo $row['id_peminjaman']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kode_buku">Kode Buku:</label>
                            <input type="text" class="form-control" id="kode_buku" name="kode_buku" readonly>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul Buku:</label>
                            <input type="text" class="form-control" id="judul" name="judul" readonly>
                        </div>
                        <div class="form-group">
                            <label for="id_santri">ID Santri:</label>
                            <input type="text" class="form-control" id="id_santri" name="id_santri" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_santri">Nama Santri:</label>
                            <input type="text" class="form-control" id="nama_santri" name="nama_santri" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_harus_kembali">Tanggal Harus Kembali:</label>
                            <input type="date" class="form-control" id="tgl_harus_kembali" name="tgl_harus_kembali" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_kmb">Tanggal Pengembalian:</label>
                            <input type="date" class="form-control" id="tgl_kmb" name="tgl_kmb" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required readonly>
                        </div>
                        <?php if ($edit_mode) { ?>
                            <input type="hidden" name="id_denda" value="<?php echo $id_denda; ?>">
                        <?php } ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data peminjaman dari PHP dan konversi ke JSON
    var peminjamanData = <?php echo $peminjamanJson; ?>;

    // Fungsi untuk mengisi otomatis id_santri, kode_buku, tgl_harus_kembali, jumlah, judul, dan nama_santri saat memilih id_peminjaman
    function updateFormFields() {
        var idPeminjaman = document.getElementById('id_peminjaman').value;
        var dataPeminjaman = peminjamanData[idPeminjaman];
        document.getElementById('id_santri').value = dataPeminjaman.id_santri;
        document.getElementById('kode_buku').value = dataPeminjaman.kode_buku;
        document.getElementById('tgl_harus_kembali').value = dataPeminjaman.tgl_harus_kembali;
        document.getElementById('jumlah').value = dataPeminjaman.jumlah;
        document.getElementById('judul').value = dataPeminjaman.judul;
        document.getElementById('nama_santri').value = dataPeminjaman.nama_santri;
    }

    document.getElementById('id_peminjaman').addEventListener('change', updateFormFields);

    // Panggil updateFormFields saat halaman dimuat untuk memastikan field-field terisi otomatis jika hanya ada satu opsi
    if (document.getElementById('id_peminjaman').options.length === 1) {
        updateFormFields();
    } else {
        // Memicu acara 'change' secara manual untuk opsi pertama
        document.getElementById('id_peminjaman').dispatchEvent(new Event('change'));
    }

    // Tambahkan event listener untuk validasi tanggal pengembalian
    document.getElementById('formDenda').addEventListener('submit', function(event) {
        var tglHarusKembali = new Date(document.getElementById('tgl_harus_kembali').value);
        var tglKembali = new Date(document.getElementById('tgl_kmb').value);

        if (tglKembali <= tglHarusKembali) {
            alert('Tanggal Pengembalian harus lebih dari Tanggal Harus Kembali.');
            event.preventDefault(); // Mencegah pengiriman formulir jika validasi gagal
        }
    });
});
</script>

<?php
include "footer.html";
?>