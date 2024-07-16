<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

include "koneksi.php";

if(isset($_GET['id'])) {
    // Tangkap nilai id dari parameter GET
    $id_denda = $_GET['id'];

    // Query untuk mengambil detail data denda berdasarkan id
    $query = mysqli_query($koneksi, "SELECT * FROM denda WHERE id_denda = '$id_denda'");
    
    // Periksa apakah data ditemukan
    if(mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);

        // Hitung keterlambatan (telat) dalam hari
        $tgl_kmb = new DateTime($data['tgl_kmb']);
        $tgl_harus_kembali = new DateTime($data['tgl_harus_kembali']);
        $telat = $tgl_kmb->diff($tgl_harus_kembali)->days;

        // Hitung denda berdasarkan jumlah hari telat
        $tarif_denda_per_hari = 5000; // Tarif denda per hari (Rp 5000)
        $denda = $telat * $tarif_denda_per_hari; // Denda total

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detail Peminjaman</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 80%;
                }
                th, td {
                    text-align: left;
                    padding: 8px 12px 8px 12px; 
                    border: 1px solid #dddddd;
                }

                th {
                    background-color: #f2f2f2;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                
                @media print {
                    .noprint {
                        display: none;
                    }
                    table {
                        background-color: #ffffff;
                    }
                    th, td {
                        color: #000000;
                    }
                    img {
                        filter: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container parentprintarea">
                <h2 class="text-center">Keterlambatan</h2>
                <table class="table table-bordered printarea">
                    <tr>
                        <th>ID Peminjaman</th>
                        <td><?php echo $data['id_peminjaman']; ?></td>
                    </tr>
                    <tr>
                        <th>ID Santri</th>
                        <td><?php echo $data['id_santri']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Santri</th>
                        <td><?php echo $data['nama_santri']; ?></td>
                    </tr>
                    <tr>
                        <th>Kode Buku</th>
                        <td><?php echo $data['kode_buku']; ?></td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td><?php echo $data['judul']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Pinjam</th>
                        <td><?php echo $data['tgl_harus_kembali']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Harus Kembali</th>
                        <td><?php echo $data['tgl_kmb']; ?></td>
                    </tr>
                    <tr>
                        <th>Telat (hari)</th>
                        <td><?php echo $telat; ?></td>
                    </tr>
                    <tr>
                        <th>Denda </th>
                        <td>Rp. 5000 Per Hari</td>
                    </tr>
                    <tr>
                        <th>Denda Saatini</th>
                        <td>Rp. <?php echo $denda; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?php echo $data['jumlah']; ?></td>
                    </tr>
                </table>
                <br>
                <button onclick="printAndRedirect()" class="btn btn-primary noprint">Cetak</button>
            </div>
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script>
                function printAndRedirect() {
                    window.print();
                    setTimeout(function() {
                        window.location.href = 'data_denda.php';
                    }, 1000);
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Data peminjaman tidak ditemukan.";
    }
} else {
    echo "ID peminjaman tidak diberikan.";
}
?>
