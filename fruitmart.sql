-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 11, 2020 at 05:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruitmart`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `beli`
-- (See below for the actual view)
--
CREATE TABLE `beli` (
`Qty` int(11)
,`Kd_Buah` char(11)
,`Nama` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `buah`
--

CREATE TABLE `buah` (
  `Kd_Buah` char(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `SupplierID` char(11) CHARACTER SET utf8mb4 NOT NULL,
  `KategoriID` char(11) NOT NULL,
  `Satuan` varchar(20) NOT NULL,
  `Stok` int(11) NOT NULL,
  `Harga_Modal` int(11) NOT NULL,
  `Harga_Jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buah`
--

INSERT INTO `buah` (`Kd_Buah`, `Nama`, `SupplierID`, `KategoriID`, `Satuan`, `Stok`, `Harga_Modal`, `Harga_Jual`) VALUES
('B0001', 'Apple', 'S0001', 'K0001', 'Buah', 119, 5000, 5500);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `Pembelian_ID` int(11) NOT NULL,
  `No_Invoice` varchar(255) NOT NULL,
  `Tanggal_Invoice` date NOT NULL,
  `Kd_Buah` char(11) NOT NULL,
  `Qty` int(11) NOT NULL,
  `TotalHargaPerProduk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`Pembelian_ID`, `No_Invoice`, `Tanggal_Invoice`, `Kd_Buah`, `Qty`, `TotalHargaPerProduk`) VALUES
(1, 'IV0001', '2020-07-19', 'B0001', 5, 27500),
(2, 'IV0002', '2020-07-10', 'B0001', 2, 11000),
(5, 'IV0002', '2020-07-10', 'B0002', 5, 27500),
(11, 'IV0002', '2020-07-10', 'B0002', 12, 66000),
(13, 'IV0003', '2020-07-10', 'B0001', 3, 16500),
(15, 'IV0003', '2020-07-10', 'B0003', 4, 7000),
(16, 'IV0003', '2020-07-10', 'B0003', 5, 8750),
(17, 'IV0004', '2020-07-11', 'B0001', 1, 5500);

--
-- Triggers `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `edit_stok` BEFORE UPDATE ON `detail_pembelian` FOR EACH ROW BEGIN IF(NEW.Qty >= OLD.Qty OR NEW.Qty <= OLD.Qty) THEN UPDATE buah SET buah.Stok = (buah.Stok + OLD.Qty) - NEW.Qty WHERE buah.Kd_Buah = OLD.Kd_Buah;
ELSE
UPDATE buah SET buah.Stok = buah.Stok WHERE buah.Kd_Buah = buah.Kd_Buah;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jumlah_stok` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN UPDATE buah SET buah.Stok = buah.Stok - NEW.Qty WHERE buah.Kd_Buah = NEW.Kd_Buah;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER DELETE ON `detail_pembelian` FOR EACH ROW BEGIN UPDATE buah SET buah.Stok = buah.Stok + OLD.Qty WHERE buah.Kd_Buah = OLD.Kd_Buah;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `join_buah`
-- (See below for the actual view)
--
CREATE TABLE `join_buah` (
`Tanggal_Invoice` date
,`NamaBuah` varchar(30)
,`HargaModal` int(11)
,`HargaJual` int(11)
,`Qty` int(11)
,`TotalPerProduk` int(11)
,`NoInvoice` varchar(255)
,`SubHarga` int(11)
,`Diskon` int(11)
,`TotalHarga` int(11)
,`admin` varchar(255)
,`Pelanggan` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buah`
--

CREATE TABLE `kategori_buah` (
  `KategoriID` char(11) NOT NULL,
  `Nama_Kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_buah`
--

INSERT INTO `kategori_buah` (`KategoriID`, `Nama_Kategori`) VALUES
('K0001', 'Lokal'),
('K0002', 'Import');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `No_Invoice` varchar(255) NOT NULL,
  `SubHarga` int(11) NOT NULL,
  `Diskon` int(11) NOT NULL,
  `TotalHarga` int(11) NOT NULL,
  `admin` varchar(255) NOT NULL,
  `pelanggan` varchar(255) NOT NULL,
  `Tanggal_Invoice` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`No_Invoice`, `SubHarga`, `Diskon`, `TotalHarga`, `admin`, `pelanggan`, `Tanggal_Invoice`) VALUES
('IV0001', 27500, 0, 27500, 'Ahmad', 'Budi', '2020-07-10'),
('IV0002', 104500, 12, 91960, 'Ahmad', 'Rahman', '2020-07-10'),
('IV0003', 16500, 13, 14355, 'Ahmad', '', '2020-07-11'),
('IV0004', 5500, 0, 5500, 'Ahmad', '', '2020-07-11');

--
-- Triggers `pembelian`
--
DELIMITER $$
CREATE TRIGGER `delete_invoice` AFTER DELETE ON `pembelian` FOR EACH ROW BEGIN DELETE FROM detail_pembelian WHERE detail_pembelian.No_Invoice = OLD.No_Invoice;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` char(11) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `NoTelp` char(14) NOT NULL,
  `Alamat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `Nama`, `NoTelp`, `Alamat`) VALUES
('S0001', 'Budi Anduk', '09231', 'Pekan Baru');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Nama` varchar(50) NOT NULL,
  `Alamat` varchar(100) NOT NULL,
  `Jenis_Kelamin` varchar(20) NOT NULL,
  `Tempat` varchar(50) NOT NULL,
  `Tanggal` date NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Foto` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Nama`, `Alamat`, `Jenis_Kelamin`, `Tempat`, `Tanggal`, `Username`, `Foto`, `Password`, `ID`) VALUES
('Ahmad', 'Piayu', 'Laki - Laki', 'Batam Center', '0000-00-00', 'Admin', 'Screenshot from 2020-07-07 23-00-39.png', 'admin', 1),
('nn', 'batam', 'Laki - Laki', 'batam, kepri', '2020-07-14', 'admin200', 'Screenshot from 2020-07-07 16-24-02.png', 'admin', 9);

-- --------------------------------------------------------

--
-- Structure for view `beli`
--
DROP TABLE IF EXISTS `beli`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `beli`  AS  select `detail`.`Qty` AS `Qty`,`detail`.`Kd_Buah` AS `Kd_Buah`,`b`.`Nama` AS `Nama` from (`detail_pembelian` `detail` join `buah` `b`) where `b`.`Kd_Buah` = `detail`.`Kd_Buah` ;

-- --------------------------------------------------------

--
-- Structure for view `join_buah`
--
DROP TABLE IF EXISTS `join_buah`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `join_buah`  AS  select `detail`.`Tanggal_Invoice` AS `Tanggal_Invoice`,`buah`.`Nama` AS `NamaBuah`,`buah`.`Harga_Modal` AS `HargaModal`,`buah`.`Harga_Jual` AS `HargaJual`,`detail`.`Qty` AS `Qty`,`detail`.`TotalHargaPerProduk` AS `TotalPerProduk`,`beli`.`No_Invoice` AS `NoInvoice`,`beli`.`SubHarga` AS `SubHarga`,`beli`.`Diskon` AS `Diskon`,`beli`.`TotalHarga` AS `TotalHarga`,`beli`.`admin` AS `admin`,`beli`.`pelanggan` AS `Pelanggan` from ((`buah` join `detail_pembelian` `detail` on(`buah`.`Kd_Buah` = `detail`.`Kd_Buah`)) join `pembelian` `beli` on(`detail`.`No_Invoice` = `beli`.`No_Invoice`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buah`
--
ALTER TABLE `buah`
  ADD PRIMARY KEY (`Kd_Buah`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`Pembelian_ID`),
  ADD KEY `NoInvoice` (`No_Invoice`),
  ADD KEY `ProdukID` (`Kd_Buah`);

--
-- Indexes for table `kategori_buah`
--
ALTER TABLE `kategori_buah`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`No_Invoice`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `Pembelian_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
