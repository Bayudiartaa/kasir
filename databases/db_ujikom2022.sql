-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2022 at 07:02 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ujikom2022`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_pengguna` ()  SELECT * FROM x_tbl_pengguna$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_det_jual`
--

CREATE TABLE `tbl_det_jual` (
  `id_det_jual` int(11) NOT NULL,
  `nofak_jual` varchar(30) NOT NULL,
  `kode_menu` varchar(20) DEFAULT NULL,
  `jumlah_item` int(15) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_det_jual`
--

INSERT INTO `tbl_det_jual` (`id_det_jual`, `nofak_jual`, `kode_menu`, `jumlah_item`, `harga_jual`) VALUES
(233, '202203160000218', 'PA002', 1, 15000),
(234, '202203160000218', 'PA002', 2, 15000),
(235, '202203160000219', 'MI002', 1, 1000),
(236, '202203160000219', 'MA001', 1, 7500),
(237, '202203160000220', 'MI002', 1, 1000),
(238, '202203160000221', 'MA001', 1, 7500),
(242, '202203160000223', 'MA002', 1, 2500);

--
-- Triggers `tbl_det_jual`
--
DELIMITER $$
CREATE TRIGGER `tTransaksiDetailHapus` BEFORE DELETE ON `tbl_det_jual` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.nofak_jual, 'Belum Ada Pengguna', CONCAT('Transaksi detail- menghapus no faktur : ', old.nofak_jual))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tTransaksiDetailTambah` BEFORE INSERT ON `tbl_det_jual` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (new.nofak_jual, 'Belum Ada Pengguna', CONCAT('Transaksi detail - menambahkan na faktur : ', new.nofak_jual,', Kode menu: ', new.kode_menu, ', Jumlah item: ', new.jumlah_item, ' dan harga jual: ', new.harga_jual))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `id_jenis` int(11) NOT NULL,
  `jenis_menu` varchar(50) NOT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id_jenis`, `jenis_menu`, `pengguna_id`) VALUES
(7836, 'Makanan', 39),
(7837, 'Minuman', 39),
(7838, 'Paket 1', 39),
(7839, 'Paket 3', 39),
(7879, 'Paket 2', 39);

--
-- Triggers `tbl_jenis`
--
DELIMITER $$
CREATE TRIGGER `tJenisHapus` BEFORE DELETE ON `tbl_jenis` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, 'Belum Ada Pengguna', CONCAT('Jenis Menu - menghapus jenis menu : ', old.jenis_menu))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tJenisTambah` AFTER INSERT ON `tbl_jenis` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (new.pengguna_id, 'Belum Ada Pengguna', CONCAT('Jenis Menu - menambahkan jenis menu : ', new.jenis_menu))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tJenisUbah` BEFORE UPDATE ON `tbl_jenis` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, 'Belum Ada Pengguna', CONCAT('Jenis menu - mengubah nama jenis menu : ', old.jenis_menu, ' menjadi : ', new.jenis_menu))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `pengunjung_id` int(11) NOT NULL,
  `pengguna_id` varchar(100) NOT NULL,
  `pengguna_nama` varchar(100) NOT NULL,
  `pengunjung_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `aksi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_jual`
--

CREATE TABLE `tbl_master_jual` (
  `id_master_jual` int(11) NOT NULL,
  `nofak_jual` varchar(30) NOT NULL,
  `tgl_jual` date DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `no_meja` char(20) DEFAULT NULL,
  `total_bayar` int(11) NOT NULL,
  `pengguna_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_master_jual`
--

INSERT INTO `tbl_master_jual` (`id_master_jual`, `nofak_jual`, `tgl_jual`, `total_harga`, `no_meja`, `total_bayar`, `pengguna_id`) VALUES
(219, '202203160000218', '2022-03-16', 45000, '1', 50000, 48),
(220, '202203160000219', '2022-03-16', 8500, '2', 10000, 48),
(221, '202203160000220', '2022-03-16', 1000, '1', 10000, 48),
(222, '202203160000221', '2022-03-16', 7500, '1', 4444, 48),
(224, '202203160000223', '2022-03-15', 2500, '1', 10000, 49);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `kode_menu` varchar(5) NOT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `nama_menu` varchar(150) DEFAULT NULL,
  `satuan` varchar(30) DEFAULT NULL,
  `hrg_jual` double DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `pengguna_id` int(11) DEFAULT NULL,
  `photo_makanan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`kode_menu`, `id_jenis`, `nama_menu`, `satuan`, `hrg_jual`, `deskripsi`, `pengguna_id`, `photo_makanan`) VALUES
('MA001', 7836, 'Nasi Putih', 'pcs', 7500, '', 39, 'food.jpg'),
('MA002', 7836, 'Telor Dadar', 'pcs', 2500, '', 39, 'food.jpg'),
('MA003', 7836, 'Kerupuk', 'pcs', 1500, '', 39, 'food.jpg'),
('MI001', 7837, 'Es Jeruk', 'pcs', 12500, '', 39, 'food.jpg'),
('MI002', 7837, 'Air Cup', 'pcs', 1000, '', 39, 'food.jpg'),
('PA001', 7838, 'Tahu + Tempe', 'paket', 3000, '', 39, 'food.jpg'),
('PA002', 7839, 'Nasi Putih + Telor Dadar + Sayur', 'paket', 15000, '', 39, 'food.jpg');

--
-- Triggers `tbl_menu`
--
DELIMITER $$
CREATE TRIGGER `tMenuHapus` BEFORE DELETE ON `tbl_menu` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, 'Belum Ada Pengguna', CONCAT('Nama Menu - menghapus nama menu : ', old.nama_menu))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tMenuTambah` BEFORE INSERT ON `tbl_menu` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (new.pengguna_id, 'Belum Ada Pengguna', CONCAT('Nama Menu - menambahkan nama menu : ', new.nama_menu))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tMenuUbah` BEFORE UPDATE ON `tbl_menu` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, 'Belum Ada Pengguna', CONCAT('Nama menu - mengubah nama menu : ', old.nama_menu, ' menjadi : ', new.nama_menu, ', Harga Jual : ', old.hrg_jual, ' menjadi : ',  new.hrg_jual))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `x_tbl_pengguna`
--

CREATE TABLE `x_tbl_pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `pengguna_nama` varchar(50) DEFAULT NULL,
  `pengguna_username` varchar(30) DEFAULT NULL,
  `pengguna_password` varchar(35) DEFAULT NULL,
  `pengguna_email` varchar(50) DEFAULT NULL,
  `pengguna_nohp` varchar(20) DEFAULT NULL,
  `pengguna_hak_akses` varchar(3) DEFAULT NULL,
  `pengguna_register` timestamp NULL DEFAULT current_timestamp(),
  `pengguna_photo` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `x_tbl_pengguna`
--

INSERT INTO `x_tbl_pengguna` (`pengguna_id`, `pengguna_nama`, `pengguna_username`, `pengguna_password`, `pengguna_email`, `pengguna_nohp`, `pengguna_hak_akses`, `pengguna_register`, `pengguna_photo`) VALUES
(37, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '081-', '1', '2022-02-16 16:11:55', 'favicon.png'),
(39, 'Manajer Keren', 'manajer', '69b731ea8f289cf16a192ce78a37b4f0', 'manajer@gmail.com', '0812345', '2', '2022-02-16 16:16:15', 'f02b6816539ee0f39b596e2189c49fb4.png'),
(48, 'Kasir Lama', 'lama', '25873e159d36d8c7218c74bbfd3d7e02', 'lama@gmail.com', '081-', '3', '2022-02-21 18:05:20', 'favicon.png'),
(49, 'Kasir skr', '123', '202cb962ac59075b964b07152d234b70', '123@gmail.com', '123', '3', '2022-02-21 18:05:57', 'favicon.png');

--
-- Triggers `x_tbl_pengguna`
--
DELIMITER $$
CREATE TRIGGER `tPenggunaHapus` BEFORE DELETE ON `x_tbl_pengguna` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, old.pengguna_nama, CONCAT('Pengguna - menghapus nama pengguna : ', old.pengguna_nama))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tPenggunaTambah` AFTER INSERT ON `x_tbl_pengguna` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (new.pengguna_id, new.pengguna_nama, CONCAT('Pengguna - menambahkan nama pengguna : ', new.pengguna_username, ', pengguna email : ', new.pengguna_email))
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tPenggunaUbah` BEFORE UPDATE ON `x_tbl_pengguna` FOR EACH ROW INSERT tbl_log(pengguna_id, pengguna_nama, aksi) VALUES (old.pengguna_id, old.pengguna_nama, CONCAT('Pengguna - mengubah nama pengguna : ', old.pengguna_nama, ' menjadi : ', new.pengguna_nama, ', mengubah username : ', old.pengguna_username, ' menjadi : ', new.pengguna_username, ', mengubah email : ', old.pengguna_email, ' menjadi : ', new.pengguna_email, ', mengubah no HP : ', old.pengguna_nohp, ' menjadi : ', new.pengguna_nohp, ' dan  mengubah hak akses : ', old.pengguna_hak_akses, ' menjadi : ', new.pengguna_hak_akses))
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_det_jual`
--
ALTER TABLE `tbl_det_jual`
  ADD PRIMARY KEY (`id_det_jual`);

--
-- Indexes for table `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`id_jenis`),
  ADD UNIQUE KEY `jenis_menu` (`jenis_menu`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`pengunjung_id`);

--
-- Indexes for table `tbl_master_jual`
--
ALTER TABLE `tbl_master_jual`
  ADD PRIMARY KEY (`id_master_jual`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`kode_menu`),
  ADD UNIQUE KEY `nama_menu` (`nama_menu`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `x_tbl_pengguna`
--
ALTER TABLE `x_tbl_pengguna`
  ADD PRIMARY KEY (`pengguna_id`),
  ADD UNIQUE KEY `pengguna_username` (`pengguna_username`,`pengguna_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_det_jual`
--
ALTER TABLE `tbl_det_jual`
  MODIFY `id_det_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=249;

--
-- AUTO_INCREMENT for table `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7881;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1707;

--
-- AUTO_INCREMENT for table `tbl_master_jual`
--
ALTER TABLE `tbl_master_jual`
  MODIFY `id_master_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `x_tbl_pengguna`
--
ALTER TABLE `x_tbl_pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD CONSTRAINT `tbl_menu_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tbl_jenis` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
