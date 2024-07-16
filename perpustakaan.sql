-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 29, 2024 at 04:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Yayan', 'yayan', 'yayan123');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `judul` varchar(255) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `sinopsis` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `kode_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`judul`, `id_penulis`, `id_penerbit`, `id_kategori`, `tahun`, `sinopsis`, `jumlah`, `foto`, `kode_buku`) VALUES
('RANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 6, 7, '2024', '	RANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 2, 'cover1.jpg', 4666872),
('ARANCANG BANGUN SISTEM PREDIKSI PADA KOPINAN  MENGGUNAKAN METODE PROTOYPING', 10, 1, 7, '2024', 'ertyfghikhjhvcgfds', 4, 'Hadits At Tirmidzi.jpg', 4666873),
('RRANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2024', 'fghjklkjhgfghjk', 4, 'cover2.jpg', 4666874),
('ttANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2024', 'fgcgcghcgcgc', 4, 'Hadits Bukhari.jpg', 4666875),
('11001ffs', 10, 1, 7, '2024', 'jjjj', 4, 'cover2.jpg', 4666876),
('990', 10, 1, 7, '2021', 'rdcrfcr', 4, 'cover1.jpg', 4666877),
('76767', 10, 1, 7, '2021', 'ertgyhjk', 4, 'TafsirAlbriz.jpg', 4666878),
('45678', 10, 1, 7, '2021', 'bbhhhh', 4, 'Hadits At Tirmidzi.jpg', 286638),
('4567', 10, 1, 7, '2021', 'bbhhhh', 4, 'cover2.jpg', 4172120),
('45678', 10, 1, 7, '2021', 'bbhhhh', 4, 'Hadits Bukhari.jpg', 8451867),
('000000', 10, 1, 7, '2021', 'xfdgchjlkgh', 4, 'cover1.jpg', 7433569),
('000000', 10, 1, 7, '2021', 'xfdgchjlkgh', 4, 'Tafsir Ibnu Katsir.jpg', 4985725),
('000000', 10, 1, 7, '2021', 'xfdgchjlkgh', 4, 'tafsir at thabrani.jpg', 3650258),
('ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2021', 'gfhjkljhgfgfvbnm,mnbv', 4, 'Hadits Bukhari.jpg', 9799517),
('ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2021', 'gfhjkljhgfgfvbnm,mnbv', 4, 'Tafsir Jalalain.jpeg', 5955935),
('ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 4, 7, '2021', 'gfhjkljhgfgfvbnm,mnbv', 4, 'tafsir at thabrani.jpg', 2459113),
('dfgbvcxvb', 10, 1, 7, '2021', 'drtfgyhugftdr', 4, 'Tafsir Ibnu Katsir.jpg', 9799518),
('8878', 10, 1, 7, '2021', 'ghhjbjbjb', 4, 'cover1.jpg', 6652117),
('88789', 10, 1, 7, '2021', 'ghhjbjbjb', 4, 'tafsir at thabrani.jpg', 6652118),
('0011', 18, 1, 7, '2021', 'jjjj', 4, 'tafsir at thabrani.jpg', 9799519),
('11001ff6', 10, 1, 7, '2021', 'dfcgvhbjnkm,', 4, 'Hadits Bukhari.jpg', 9799520),
('t11001fft', 10, 1, 7, '2021', 'ghjk', 4, 'tafsir at thabrani.jpg', 9799521),
('098789', 10, 1, 7, '2021', 'dfghjkhgfd', 4, 'tafsir at thabrani.jpg', 9799523),
('zzzz11001ff', 10, 1, 7, '2021', 'dfghjk', 4, 'Hadits At Tirmidzi.jpg', 9799524),
('RRANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2021', 'dfghjnkmnvbc', 4, 'cover2.jpg', 9799525),
('ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2021', 'cvbnm,.', 4, 'tafsir at thabrani.jpg', 9799526),
('1yttyty1001ff', 10, 1, 7, '2021', 'fghjkl', 4, 'Tafsir Ibnu Katsir.jpg', 9799528),
('11111sdfghjklsANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 10, 1, 7, '2021', 'sdfghjkl;', 4, 'TafsirAlbriz.jpg', 1744542),
('yuy11001ff', 10, 1, 7, '2021', 'cvbnm,./', 4, 'TafsirAlbriz.jpg', 2760214);

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `id_denda` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `kode_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_santri` int(11) NOT NULL,
  `nama_santri` varchar(255) NOT NULL,
  `tgl_harus_kembali` date NOT NULL,
  `tgl_kmb` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`id_denda`, `id_peminjaman`, `kode_buku`, `judul`, `jumlah`, `id_santri`, `nama_santri`, `tgl_harus_kembali`, `tgl_kmb`) VALUES
(7689860, 551152, 5955935, 'ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 1, 4183477, 'zzaNur Hidayah', '2024-05-21', '2024-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_peminjaman` varchar(6) NOT NULL,
  `id_buku` varchar(5) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `id_ebook` int(11) NOT NULL,
  `judul_ebook` varchar(50) NOT NULL,
  `source` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`id_ebook`, `judul_ebook`, `source`, `deskripsi`, `foto`) VALUES
(1, 'Sahih Muslim', 'uploads/pdf/pdf1.pdf', 'Tafsir Al-Qur\'an dengan menggunakan Arab Pegon yang dibaca dengan bahasa Jawa', 'cover1.jpg'),
(2, 'Tafsir Al-Ibriz', 'uploads/pdf/pdf2.pdf', 'Tafsir Al-Ibriz Ebook Free Bosku', 'uploads/cover/cover2.jpg'),
(3, 'Tafsir Ibnu Katsir', 'uploads/pdf/pdf3.pdf', 'Tafsir Al-Qur\'an dengan menggunakan Arab Pegon yang dibaca dengan bahasa Jawa', 'uploads/cover/cover3.jpg'),
(4, 'Sahih Muslims', 'pdf2.pdf', 'sdfdssfd', 'cover3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(7, 'Dongen1'),
(8, 'Cerita Islam'),
(9, 'Dongens'),
(10, '1Cerita Islami'),
(12, '1');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(6) NOT NULL,
  `id_santri` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_harus_kembali` date NOT NULL,
  `id_admin` int(11) NOT NULL,
  `kode_buku` int(255) NOT NULL,
  `status_pinjam` varchar(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_santri`, `tgl_pinjam`, `tgl_harus_kembali`, `id_admin`, `kode_buku`, `status_pinjam`, `jumlah`) VALUES
('551152', 4183477, '2024-05-16', '2024-05-21', 1, 5955935, 'Pinjam', 1),
('651009', 6199526, '2024-05-17', '2024-05-22', 1, 4666878, 'Kembali', 1),
('667079', 419366, '2024-05-10', '2024-05-15', 1, 4172120, 'Pinjam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL,
  `kota` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `kota`) VALUES
(1, 'Imam Al_Ghazalii', 'Thus, Khurasan, Iran'),
(4, 'Heruanasp', 'kota seemarang'),
(5, 'Imam Al_Ghazalisq', 'Pati'),
(6, '445', 'Pati'),
(8, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` varchar(6) NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `kode_buku` int(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `id_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `tgl_pengadaan`, `kode_buku`, `jumlah`, `judul`, `id_admin`) VALUES
('537377', '2024-05-10', 9799517, 4, 'ANALISIS PERAMALAN PENJUALAN PADA UMKM UNTUK OPTIMALISASI PENJUALAN DAN EFISIENSI BAHAN BAKU', 1),
('764457', '2024-05-03', 286638, 3, '45678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` varchar(6) NOT NULL,
  `id_peminjaman` varchar(6) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_admin` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id_penulis` int(11) NOT NULL,
  `nama_penulis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id_penulis`, `nama_penulis`) VALUES
(10, 'anjanizs'),
(17, 'ranjani'),
(18, 'aaaaaas'),
(9010044, 'tiyono'),
(9010045, 'anjani'),
(9010046, 'anjanisqqq'),
(9010050, 'anjanisq'),
(9010051, 'yyytt'),
(9010052, 'yyyttttyyyyy'),
(9010053, 'anjanisq'),
(9010055, 'aaqqqqtiyono'),
(9010056, '44anjanis'),
(9010058, '1');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

CREATE TABLE `santri` (
  `id_santri` int(11) NOT NULL,
  `nama_santri` varchar(100) NOT NULL,
  `kelamin` varchar(1) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `foto_santri` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id_santri`, `nama_santri`, `kelamin`, `tempat_lahir`, `tgl_lahir`, `no_hp`, `foto_santri`) VALUES
(419366, '1', 'L', 'Pati', '2024-05-28', '0859160068890', 'cover1.jpg'),
(4183477, 'zzaNur Hidayah', 'L', 'Pati', '2024-05-23', '0859160068890', 'cover1.jpg'),
(6199526, 'Ad Hidayah', 'L', 'Pati', '2024-05-14', '0859160068890', 'Tafsir Jalalain.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `temp_peminjaman`
--

CREATE TABLE `temp_peminjaman` (
  `id_temp` int(11) NOT NULL,
  `id_buku` varchar(5) NOT NULL,
  `jumlah_pinjam` int(11) NOT NULL,
  `kode_buku` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD KEY `kode_buku` (`kode_buku`),
  ADD KEY `fk_penulis` (`id_penulis`),
  ADD KEY `fk_kategori` (`id_kategori`),
  ADD KEY `fk_penerbit` (`id_penerbit`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id_ebook`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id_penulis`);

--
-- Indexes for table `santri`
--
ALTER TABLE `santri`
  ADD PRIMARY KEY (`id_santri`);

--
-- Indexes for table `temp_peminjaman`
--
ALTER TABLE `temp_peminjaman`
  ADD PRIMARY KEY (`id_temp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `kode_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9799529;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8708040;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id_ebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id_penulis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9010059;

--
-- AUTO_INCREMENT for table `santri`
--
ALTER TABLE `santri`
  MODIFY `id_santri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8829412;

--
-- AUTO_INCREMENT for table `temp_peminjaman`
--
ALTER TABLE `temp_peminjaman`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `fk_penerbit` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_penulis` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
