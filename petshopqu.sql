-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2022 at 11:22 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petshopqu`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_pelanggan` int(6) NOT NULL,
  `username` varchar(65) NOT NULL,
  `password` varchar(8) NOT NULL,
  `role` varchar(9) NOT NULL,
  `nama_pelanggan` varchar(32) NOT NULL,
  `alamat_pelanggan` varchar(32) NOT NULL,
  `no_hp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_pelanggan`, `username`, `password`, `role`, `nama_pelanggan`, `alamat_pelanggan`, `no_hp`) VALUES
(1, 'wirdanry', 'gundar11', 'admin', 'Wirda Nurmayanti', 'Bogor, Jawa Barat', '088976000529'),
(2, 'squilla', 'balalala', 'pelanggan', 'shimizu squilla', 'Bandung, Jawa Barat', '088872437733'),
(3, 'polynomial', '1234', 'pelanggan', 'daffa', 'trikora', '081234939439'),
(6, 'wirda', '12345678', 'pelanggan', 'Wirda Nurmayanti', 'Bogor, Jawa Barat', '088946566643');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `ID_pembelian` int(6) NOT NULL,
  `ID_produk` int(5) NOT NULL,
  `ID_pelanggan` int(5) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `jumlah` int(9) NOT NULL,
  `harga` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`ID_pembelian`, `ID_produk`, `ID_pelanggan`, `tgl_pembelian`, `jumlah`, `harga`) VALUES
(9, 5, 2, '2022-07-03', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `ID_produk` int(6) NOT NULL,
  `nama_produk` varchar(42) NOT NULL,
  `deskripsi_produk` varchar(64) NOT NULL,
  `harga_produk` int(9) NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`ID_produk`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `gambar`) VALUES
(5, 'Whiskas Majikan', 'Makanan majikan brand Whiskas diatas 1 tahun dengan berat 400g', 40000, 'image/whiskas1.jpg'),
(7, 'Orijen Puppy', 'Makanan kering untuk anjing brand Orijen Puppy', 50000, 'image/orijen1.webp'),
(8, 'Royal Canin Majikan', 'Makanan majikan brand Royal Canin Instinctive Cat Food in Gravy ', 50000, 'image/royalcanin1.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_pelanggan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`ID_pembelian`),
  ADD KEY `pembelian_ibfk_1` (`ID_produk`),
  ADD KEY `ID_pelanggan` (`ID_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`ID_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_pelanggan` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `ID_pembelian` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `ID_produk` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
