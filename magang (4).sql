-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2022 at 10:59 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `databarang`
--

CREATE TABLE `databarang` (
  `barcode` varchar(18) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '-',
  `kdKategori` int(11) NOT NULL DEFAULT 1,
  `kdSatuan` int(11) NOT NULL DEFAULT 1,
  `hrgBeli` int(11) NOT NULL,
  `hrgJual` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `stok_gudang` int(11) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `cloud_img` text DEFAULT NULL,
  `img_urls` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`barcode`, `namaBarang`, `slug`, `kdKategori`, `kdSatuan`, `hrgBeli`, `hrgJual`, `stok`, `stok_gudang`, `deskripsi`, `cloud_img`, `img_urls`, `created_at`, `updated_at`) VALUES
('123', '123', '123-', 1, 1, 1000, 1000, 10, 0, '-', NULL, NULL, '2022-10-04 05:02:38', '2022-10-04 05:02:38'),
('VSC2207073140', 'Scanner', 'scanner', 1, 1, 140000, 148500, 7, 0, '-', NULL, NULL, '2022-10-03 01:01:28', '2022-10-03 01:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `datapelanggan`
--

CREATE TABLE `datapelanggan` (
  `kdPelanggan` varchar(25) NOT NULL,
  `namaPelanggan` text NOT NULL,
  `Point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datapelanggan`
--

INSERT INTO `datapelanggan` (`kdPelanggan`, `namaPelanggan`, `Point`) VALUES
('01', 'Ardianto', 0);

-- --------------------------------------------------------

--
-- Table structure for table `datasupplier`
--

CREATE TABLE `datasupplier` (
  `kdSupplier` varchar(6) NOT NULL,
  `namaSupplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datasupplier`
--

INSERT INTO `datasupplier` (`kdSupplier`, `namaSupplier`) VALUES
('1', 'CV. Mekar Cutting Digital');

-- --------------------------------------------------------

--
-- Table structure for table `datauser`
--

CREATE TABLE `datauser` (
  `kdUser` int(10) UNSIGNED NOT NULL,
  `namaUser` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `no_hp` varchar(11) NOT NULL DEFAULT '0',
  `kabupaten` text NOT NULL,
  `kecamatan` text NOT NULL,
  `desa` text NOT NULL,
  `alamat_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datauser`
--

INSERT INTO `datauser` (`kdUser`, `namaUser`, `email`, `password`, `level`, `no_hp`, `kabupaten`, `kecamatan`, `desa`, `alamat_lengkap`) VALUES
(1, 'Admin', 'smegamart@smega.sch.id', '$2y$10$WW5sw2NFXRFMzbNQ5050v.2QT4iAhN7m6sWeUxLnJ6IbuWJesuIX2', 'Admin', '0', '', '', '', ''),
(2, 'Kasir', 'ksm@smega.sch.id', '$2y$10$zcr4wGVPfswYBwfSQRHQJ.3GAa/aZSUQqd0dFMGccjgr0KF8fNJMC', 'Kasir', '08888908970', 'Purbalingga', 'Kalimanah', 'selabaya', 'Jl. Mawar indah 1'),
(3, 'Ardianto', 'ardianto@gmail.com', '$2y$10$zcr4wGVPfswYBwfSQRHQJ.3GAa/aZSUQqd0dFMGccjgr0KF8fNJMC', 'Customer', '0888888888', 'Purbalingga', 'Kalimanah', 'Selabaya', 'Jl. Mawar Indah 1');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `kdGaleri` int(11) NOT NULL,
  `cloud_img` text NOT NULL,
  `img_urls` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gambar`
--

CREATE TABLE `gambar` (
  `kdGambar` int(11) NOT NULL,
  `cloud_img` text DEFAULT NULL,
  `img_urls` text DEFAULT NULL,
  `barcode` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `kdUser` int(11) NOT NULL,
  `barcode` varchar(18) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `hrgJual` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `kdUser`, `barcode`, `namaBarang`, `qty`, `hrgJual`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, '123', '123', 1, 1000, 0, '2022-10-08 07:11:31', '2022-10-08 07:11:31'),
(2, 1, '123', '123', 1, 1000, 1000, '2022-10-08 07:14:02', '2022-10-08 07:14:02'),
(5, 1, '0', 'Scanner', 1, 148500, 148500, '2022-10-08 07:24:12', '2022-10-08 07:24:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `noFaktur` varchar(255) NOT NULL,
  `barcode` varchar(18) NOT NULL,
  `namaBarang` varchar(255) NOT NULL,
  `hrgJual` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `kdUser` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `kelipatan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`kelipatan`) VALUES
(25000);

-- --------------------------------------------------------

--
-- Table structure for table `rinci_order`
--

CREATE TABLE `rinci_order` (
  `noFaktur` varchar(18) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL DEFAULT 0,
  `kdUser` int(11) NOT NULL,
  `status_bayar` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rinci_order`
--

INSERT INTO `rinci_order` (`noFaktur`, `qty`, `subtotal`, `kdUser`, `status_bayar`, `status`, `created_at`, `updated_at`) VALUES
('SM-2022-10-084392', 1, 297000, 1, 0, 0, '2022-10-08 06:52:33', '2022-10-08 06:52:33'),
('SM-2022-10-084392', 1, 298000, 1, 0, 0, '2022-10-08 06:53:11', '2022-10-08 06:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `tabelkategori`
--

CREATE TABLE `tabelkategori` (
  `kdKategori` int(11) NOT NULL,
  `namaKategori` text NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabelkategori`
--

INSERT INTO `tabelkategori` (`kdKategori`, `namaKategori`, `slug`) VALUES
(1, 'Scanner', 'scanner');

-- --------------------------------------------------------

--
-- Table structure for table `tabelpembelian`
--

CREATE TABLE `tabelpembelian` (
  `No` int(11) NOT NULL,
  `noFakturBeli` varchar(25) NOT NULL,
  `tglBeli` date NOT NULL,
  `kdSupplier` varchar(25) NOT NULL,
  `kdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tabelrealpembelian`
--

CREATE TABLE `tabelrealpembelian` (
  `id` int(11) NOT NULL,
  `noFakturBeli` varchar(25) NOT NULL,
  `barcode` varchar(25) NOT NULL,
  `jmlBeli` int(11) NOT NULL,
  `jmlStokGudang` int(11) NOT NULL DEFAULT 0,
  `hrgBeli` int(11) NOT NULL,
  `hrgJual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabelrealpembelian`
--

INSERT INTO `tabelrealpembelian` (`id`, `noFakturBeli`, `barcode`, `jmlBeli`, `jmlStokGudang`, `hrgBeli`, `hrgJual`) VALUES
(1, 'FB04-10-20221', '123', 1, 0, 1000, 1000),
(2, 'FB04-10-20221', '123', 1, 0, 1000, 1000),
(3, 'FB04-10-20221', '123', 1, 0, 1000, 1000),
(4, 'FB04-10-20221', '123', 1, 0, 1000, 1000),
(5, 'FB04-10-20221', '123', 10, 20, 1000, 1000),
(6, 'FB04-10-20221', '123', 10, 10, 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tabelrealpenjualan`
--

CREATE TABLE `tabelrealpenjualan` (
  `no` int(11) NOT NULL,
  `noFakturJualan` varchar(15) NOT NULL,
  `barcode` varchar(15) NOT NULL,
  `namaBarang` varchar(35) NOT NULL,
  `jmlhJual` int(11) NOT NULL,
  `hrgJual` double NOT NULL,
  `hrgBeli` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabelrealpenjualan`
--

INSERT INTO `tabelrealpenjualan` (`no`, `noFakturJualan`, `barcode`, `namaBarang`, `jmlhJual`, `hrgJual`, `hrgBeli`) VALUES
(1, 'FJ04-10-20221', '123', '123', 1, 1000, 1000),
(2, 'FJ04-10-20221', 'VSC2207073140', 'Scanner', 1, 148500, 140000),
(3, 'FJ04-10-20221', 'VSC2207073140', 'Scanner', 1, 148500, 140000),
(4, 'FJ04-10-20221', '123', '123', 1, 1000, 1000),
(5, 'FJ04-10-20222', '123', '123', 1, 1000, 1000),
(6, 'FJ04-10-20222', 'VSC2207073140', 'Scanner', 1, 148500, 140000),
(7, 'FJ04-10-20223', '123', '123', 1, 1000, 1000),
(8, 'FJ05-10-20224', '123', '123', 1, 1000, 1000),
(9, 'FJ05-10-20225', '123', '123', 1, 1000, 1000);

--
-- Triggers `tabelrealpenjualan`
--
DELIMITER $$
CREATE TRIGGER `kurangiStok` AFTER INSERT ON `tabelrealpenjualan` FOR EACH ROW UPDATE databarang set stok = stok - new.jmlhJual where barcode = new.barcode
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tabelsatuan`
--

CREATE TABLE `tabelsatuan` (
  `kdSatuan` int(10) UNSIGNED NOT NULL,
  `namaSatuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabelsatuan`
--

INSERT INTO `tabelsatuan` (`kdSatuan`, `namaSatuan`) VALUES
(1, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penjualan`
--

CREATE TABLE `tabel_penjualan` (
  `No` int(11) NOT NULL,
  `No_Faktur_Jual` varchar(30) NOT NULL,
  `Tgl_Jual` date NOT NULL,
  `Kd_Pelanggan` varchar(20) NOT NULL,
  `Total` double NOT NULL,
  `Bayar` double NOT NULL,
  `Kd_User` varchar(4) NOT NULL,
  `poin` int(11) NOT NULL,
  `metode_bayar` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_penjualan`
--

INSERT INTO `tabel_penjualan` (`No`, `No_Faktur_Jual`, `Tgl_Jual`, `Kd_Pelanggan`, `Total`, `Bayar`, `Kd_User`, `poin`, `metode_bayar`, `status`) VALUES
(1, 'FJ04-10-20221', '2022-10-04', '1', 299000, 300000, '2', 12, 0, 1),
(2, 'FJ04-10-20222', '2022-10-04', '', 149500, 200000, '2', 6, 0, 1),
(3, 'FJ04-10-20223', '2022-10-04', '1', 1000, 2000, '1', 0, 0, 1),
(4, 'FJ05-10-20224', '2022-10-05', '1', 1000, 2000, '2', 0, 0, 1);

--
-- Triggers `tabel_penjualan`
--
DELIMITER $$
CREATE TRIGGER `tambahPoin` AFTER INSERT ON `tabel_penjualan` FOR EACH ROW UPDATE datapelanggan set point = point + new.poin where kdPelanggan = new.kd_Pelanggan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `Nama` varchar(35) NOT NULL,
  `Alamat` text NOT NULL,
  `NO_Telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `datapelanggan`
--
ALTER TABLE `datapelanggan`
  ADD PRIMARY KEY (`kdPelanggan`);

--
-- Indexes for table `datasupplier`
--
ALTER TABLE `datasupplier`
  ADD PRIMARY KEY (`kdSupplier`);

--
-- Indexes for table `datauser`
--
ALTER TABLE `datauser`
  ADD PRIMARY KEY (`kdUser`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`kdGaleri`);

--
-- Indexes for table `gambar`
--
ALTER TABLE `gambar`
  ADD PRIMARY KEY (`kdGambar`),
  ADD KEY `kdBarang` (`barcode`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcode` (`barcode`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tabelkategori`
--
ALTER TABLE `tabelkategori`
  ADD PRIMARY KEY (`kdKategori`);

--
-- Indexes for table `tabelpembelian`
--
ALTER TABLE `tabelpembelian`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `tabelrealpembelian`
--
ALTER TABLE `tabelrealpembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabelrealpenjualan`
--
ALTER TABLE `tabelrealpenjualan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tabelsatuan`
--
ALTER TABLE `tabelsatuan`
  ADD PRIMARY KEY (`kdSatuan`);

--
-- Indexes for table `tabel_penjualan`
--
ALTER TABLE `tabel_penjualan`
  ADD PRIMARY KEY (`No`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datauser`
--
ALTER TABLE `datauser`
  MODIFY `kdUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `kdGaleri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gambar`
--
ALTER TABLE `gambar`
  MODIFY `kdGambar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabelkategori`
--
ALTER TABLE `tabelkategori`
  MODIFY `kdKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabelpembelian`
--
ALTER TABLE `tabelpembelian`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tabelrealpembelian`
--
ALTER TABLE `tabelrealpembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tabelrealpenjualan`
--
ALTER TABLE `tabelrealpenjualan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tabelsatuan`
--
ALTER TABLE `tabelsatuan`
  MODIFY `kdSatuan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tabel_penjualan`
--
ALTER TABLE `tabel_penjualan`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
