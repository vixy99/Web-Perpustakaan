<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header("Location: login.html");
    exit();
}

include "koneksi.php";

if (isset($_GET['id'])) {
    $id_pengadaan = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM pengadaan WHERE id_pengadaan='$id_pengadaan'");

    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $kode_buku = $data['kode_buku'];
        $id_admin = $data['id_admin'];

        // Get book details
        $book_query = mysqli_query($koneksi, "SELECT b.*, p.id_penulis, p.nama_penulis, pb.id_penerbit, pb.nama_penerbit FROM buku b JOIN penulis p ON b.id_penulis = p.id_penulis JOIN penerbit pb ON b.id_penerbit = pb.id_penerbit WHERE kode_buku='$kode_buku'");
        $book_data = mysqli_fetch_assoc($book_query);

        // Get admin details
        $admin_query = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_admin'");
        $admin_data = mysqli_fetch_assoc($admin_query);

        // Get loan details
        $loan_query = mysqli_query($koneksi, "SELECT p.*, s.nama_santri FROM peminjaman p JOIN santri s ON p.id_santri = s.id_santri WHERE p.kode_buku='$kode_buku'");
        $loan_data = [];
        while ($row = mysqli_fetch_assoc($loan_query)) {
            $loan_data[] = $row;
        }

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Stock Buku</title>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
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
            <h2 class="text-center">Detail Buku</h2>
            <table class="table table-bordered printarea">
                <tr>
                    <th>ID Pengadaan</th>
                    <td><?php echo $data['id_pengadaan']; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Pengadaan</th>
                    <td><?php echo $data['tgl_pengadaan']; ?></td>
                </tr>
                <tr>
                    <th>Judul</th>
                    <td><?php echo $data['judul']; ?></td>
                </tr>
                <tr>
                    <th>Kode Buku</th>
                    <td><?php echo $data['kode_buku']; ?></td>
                </tr>
                <tr>
                    <th>ID Penulis</th>
                    <td><?php echo $book_data['id_penulis']; ?></td>
                </tr>
                <tr>
                    <th>Nama Penulis</th>
                    <td><?php echo $book_data['nama_penulis']; ?></td>
                </tr>
                <tr>
                    <th>ID Penerbit</th>
                    <td><?php echo $book_data['id_penerbit']; ?></td>
                </tr>
                <tr>
                    <th>Nama Penerbit</th>
                    <td><?php echo $book_data['nama_penerbit']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah Awal</th>
                    <td><?php echo $book_data['jumlah']; ?></td>
                </tr>
                <tr>
                    <th>Jumlah Akhir</th>
                    <td><?php echo $data['jumlah']; ?></td>
                </tr>
                <tr>
                    <th>ID Admin</th>
                    <td><?php echo $data['id_admin']; ?></td>
                </tr>
                <tr>
                    <th>Nama Admin</th>
                    <td><?php echo $admin_data['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <th>Daftar Pinjam</th>
                    <td>
                        <ul>
                            <?php
                            $total_pinjam = 0;
                            foreach ($loan_data as $loan) {
                                echo "<li>" . $loan['nama_santri'] . " - " . $loan['jumlah'] . " buku" . " (Status: " . $loan['status_pinjam'] . ")</li>";
                                if ($loan['status_pinjam'] == 'Pinjam') {
                                    $total_pinjam += $loan['jumlah'];
                                }
                            }
                            ?>
                        </ul>
                        <strong>Total Pinjam: <?php echo $total_pinjam; ?></strong>
                    </td>
                </tr>
                <tr>
                    <th>Gambar Buku</th>
                    <td><img src="uploads/cover/<?php echo $book_data['foto']; ?>" alt="foto" style="width:100px;"></td>
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
                    window.location.href = 'data_stock.php';
                }, 1000);
            }
        </script>
        </body>
        </html>
        <?php
    } else {
        echo "Data Pengadaan Tidak Ditemukan.";
    }
} else {
    echo "ID Pengadaan Tidak Diberikan.";
}
?>
