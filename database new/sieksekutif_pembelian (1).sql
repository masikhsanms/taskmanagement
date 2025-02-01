-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 03:12 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sieksekutif_pembelian`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangkeluar`
--

CREATE TABLE `barangkeluar` (
  `idbarangkeluar` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tglkeluar` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangkeluar`
--

INSERT INTO `barangkeluar` (`idbarangkeluar`, `idsupplier`, `idbarang`, `tglkeluar`, `jumlah`, `satuan`, `datecreated`) VALUES
(3, 2, 3, '2024-06-06', 10, 'oke', '2024-06-05 04:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `barangmasuk`
--

CREATE TABLE `barangmasuk` (
  `idbarangmasuk` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tglmasuk` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barangmasuk`
--

INSERT INTO `barangmasuk` (`idbarangmasuk`, `idsupplier`, `idbarang`, `tglmasuk`, `jumlah`, `satuan`, `datecreated`) VALUES
(4, 2, 3, '2024-06-05', 30, 'buah', '2024-06-05 03:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `databarang`
--

CREATE TABLE `databarang` (
  `idbarang` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `namabarang` varchar(250) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `databarang`
--

INSERT INTO `databarang` (`idbarang`, `kode`, `namabarang`, `tanggal`) VALUES
(3, 'K1234', 'Komputer', '2024-05-15 22:30:02');

-- --------------------------------------------------------

--
-- Table structure for table `databuyer`
--

CREATE TABLE `databuyer` (
  `idbuyer` int(11) NOT NULL,
  `namabuyer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `databuyer`
--

INSERT INTO `databuyer` (`idbuyer`, `namabuyer`, `alamat`, `telepon`, `datecreated`) VALUES
(2, 'RIJAL GANTENG', 'CILACAP', '0899999', '2024-05-10 22:56:36'),
(3, 'Mansur Ganteng', 'Kebumen', '087777777', '2024-05-19 17:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `dataproduk`
--

CREATE TABLE `dataproduk` (
  `idproduk` int(11) NOT NULL,
  `kodeproduk` varchar(50) NOT NULL,
  `namaproduk` varchar(200) NOT NULL,
  `harga` float NOT NULL,
  `satuan` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `idbuyer` int(11) NOT NULL,
  `proses_produksi` int(11) NOT NULL COMMENT '1:Bordir,2:TPR,3:Printing,4:Emboss'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dataproduk`
--

INSERT INTO `dataproduk` (`idproduk`, `kodeproduk`, `namaproduk`, `harga`, `satuan`, `datecreated`, `idbuyer`, `proses_produksi`) VALUES
(4, '88iuw', 'testoke', 3000, 23, '2024-06-05 04:54:46', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `datasuplier`
--

CREATE TABLE `datasuplier` (
  `idsuplier` int(11) NOT NULL,
  `namasuplier` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datasuplier`
--

INSERT INTO `datasuplier` (`idsuplier`, `namasuplier`, `telepon`, `alamat`, `datecreated`) VALUES
(2, 'Coba lagi', '0983748', 'TEST LAGI', '2024-05-09 16:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `idpembelian` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tglpembelian` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`idpembelian`, `idsupplier`, `idbarang`, `tglpembelian`, `jumlah`, `satuan`, `hargasatuan`, `total`, `datecreated`) VALUES
(1, 2, 3, '2024-05-01', 20, 'pcs', 6000, 120000, '2024-05-19 15:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` int(11) NOT NULL COMMENT 'admin:1,gudang:2,akuntan:3,eksekutif:4',
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `level`, `nama`) VALUES
(4, 'ikhsan', 'coba', 1, 'Ikhsan'),
(6, 'admin', '123456', 1, 'admin'),
(7, 'gudang', '123456', 2, 'Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `idpenjualan` int(11) NOT NULL,
  `idbuyer` int(11) NOT NULL,
  `idproduk` int(11) NOT NULL,
  `tglpenjualan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`idpenjualan`, `idbuyer`, `idproduk`, `tglpenjualan`, `jumlah`, `satuan`, `hargasatuan`, `total`, `datecreated`) VALUES
(1, 3, 1, '2024-05-09', 10, 'pcs', 1000, 10000, '2024-05-19 17:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `stokbarang`
--

CREATE TABLE `stokbarang` (
  `idstokbarang` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `idsupplier` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stokbarang`
--

INSERT INTO `stokbarang` (`idstokbarang`, `idbarang`, `idsupplier`, `jumlah`, `satuan`, `datecreated`) VALUES
(2, 3, 2, 30, 'PCS', '2024-05-16 06:14:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  ADD PRIMARY KEY (`idbarangkeluar`);

--
-- Indexes for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  ADD PRIMARY KEY (`idbarangmasuk`);

--
-- Indexes for table `databarang`
--
ALTER TABLE `databarang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `databuyer`
--
ALTER TABLE `databuyer`
  ADD PRIMARY KEY (`idbuyer`);

--
-- Indexes for table `dataproduk`
--
ALTER TABLE `dataproduk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `datasuplier`
--
ALTER TABLE `datasuplier`
  ADD PRIMARY KEY (`idsuplier`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`idpembelian`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`idpenjualan`);

--
-- Indexes for table `stokbarang`
--
ALTER TABLE `stokbarang`
  ADD PRIMARY KEY (`idstokbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barangkeluar`
--
ALTER TABLE `barangkeluar`
  MODIFY `idbarangkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `barangmasuk`
--
ALTER TABLE `barangmasuk`
  MODIFY `idbarangmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `databarang`
--
ALTER TABLE `databarang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `databuyer`
--
ALTER TABLE `databuyer`
  MODIFY `idbuyer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dataproduk`
--
ALTER TABLE `dataproduk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `datasuplier`
--
ALTER TABLE `datasuplier`
  MODIFY `idsuplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `idpembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `idpenjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stokbarang`
--
ALTER TABLE `stokbarang`
  MODIFY `idstokbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
