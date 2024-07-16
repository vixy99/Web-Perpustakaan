<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Cetak</title>
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
        .noprint {
            display: none;
        }
    </style>
</head>
<body>
    <h2>Menu Cetak</h2>
    <table>
        <tr>
            <th>Menu</th>
            <th>Deskripsi</th>
        </tr>
        <tr>
            <td><a href="cetak_santri.php?id=<?php echo $data['id_santri']; ?>" class="btn btn-primary">Cetak Detail Santri</a></td>
            <td>Cetak detail informasi tentang santri tertentu.</td>
        </tr>
        <tr>
            <td><a href="cetak.php?id=<?php echo $data['id_peminjaman']; ?>" class="btn btn-primary">Cetak Detail Buku</a></td>
            <td>Cetak detail informasi tentang buku tertentu.</td>
        </tr>
        <!-- Tambahkan baris tabel untuk setiap menu cetak yang Anda inginkan -->
    </table>

    <!-- Tombol cetak tidak akan dicetak -->
    <button onclick="window.print()" class="btn btn-primary noprint">Cetak</button>

    <script>
        // Fungsi untuk mengarahkan kembali setelah mencetak
        function printAndRedirect() {
            window.print();
            setTimeout(function() {
                window.location.href = 'menu_cetak.php';
            }, 1000);
        }
    </script>
</body>
</html>
