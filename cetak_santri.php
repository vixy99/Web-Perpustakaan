<?php
session_start();


if (!isset($_SESSION['loggedin'])) {    header("Location: login.html");
    exit();
}

include "koneksi.php";


if (isset($_GET['id'])) {
    $id_santri = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM santri WHERE id_santri='$id_santri'");
    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Kartu Anggota</title>
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
                <h2 class="text-center">Detail Santri</h2>
                <table class="table table-bordered printarea">
                    <tr>
                        <th>ID Santri</th>
                        <td><?php echo $data['id_santri']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Santri</th>
                        <td><?php echo $data['nama_santri']; ?></td>
                    </tr>
                    <tr>
                        <th>Kelamin</th>
                        <td><?php echo $data['kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td><?php echo $data['tempat_lahir']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td><?php echo $data['tgl_lahir']; ?></td>
                    </tr>
                    <tr>
                        <th>Nomer HP</th>
                        <td><?php echo $data['no_hp']; ?></td>
                    </tr>
                    <tr>
                        <th>Foto Santri</th>
                        <td><img src="img/<?php echo $data['foto_santri']; ?>" alt="Foto Santri" width="135" height="150"></td>
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
                        window.location.href = 'data_santri.php';
                    }, 1000);
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Data Santri Tidak Ditemukan.";
    }
} else {
    echo "ID Santri Tidak Diberikan.";
}
?>
