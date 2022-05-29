-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2022 at 03:11 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuzzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_aturan`
--

CREATE TABLE `data_aturan` (
  `id_aturan` int(11) NOT NULL,
  `fcr` varchar(50) NOT NULL,
  `henday` varchar(50) NOT NULL,
  `status_produktivitas` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_aturan`
--

INSERT INTO `data_aturan` (`id_aturan`, `fcr`, `henday`, `status_produktivitas`, `keterangan`) VALUES
(1, 'Rendah', 'Rendah', 'Produktif', 'Tingkatkan'),
(2, 'Rendah', 'Normal', 'Produktif', 'Tingkatkan'),
(3, 'Rendah', 'Tinggi', 'Sangat Produktif', 'Pertahankan'),
(4, 'Normal', 'Rendah', 'Kurang Produktif', 'Tingkatkan'),
(5, 'Normal', 'Normal', 'Produktif', 'Tingkatkan'),
(6, 'Normal', 'Tinggi', 'Sangat Produktif', 'Pertahankan'),
(7, 'Tinggi', 'Rendah', 'Tidak Produktif', 'Segera Tangani'),
(8, 'Tinggi', 'Normal', 'Kurang Produktif', 'Tingkatkan'),
(9, 'Tinggi', 'Tinggi', 'Produktif', 'Tingkatkan');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_fuzzy`
--

CREATE TABLE `hasil_fuzzy` (
  `id_hasil` int(11) NOT NULL,
  `fcr` varchar(50) NOT NULL,
  `henday` varchar(50) NOT NULL,
  `nilai_fuzzy` varchar(50) NOT NULL,
  `status_produktivitas` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `rule1` varchar(40) NOT NULL,
  `rule2` varchar(50) NOT NULL,
  `rule3` varchar(50) NOT NULL,
  `rule4` varchar(50) NOT NULL,
  `rule5` varchar(50) NOT NULL,
  `rule6` varchar(50) NOT NULL,
  `rule7` varchar(50) NOT NULL,
  `rule8` varchar(50) NOT NULL,
  `rule9` varchar(50) NOT NULL,
  `min` varchar(50) NOT NULL,
  `max` varchar(50) NOT NULL,
  `a1` varchar(50) NOT NULL,
  `a2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_fuzzy`
--

INSERT INTO `hasil_fuzzy` (`id_hasil`, `fcr`, `henday`, `nilai_fuzzy`, `status_produktivitas`, `keterangan`, `rule1`, `rule2`, `rule3`, `rule4`, `rule5`, `rule6`, `rule7`, `rule8`, `rule9`, `min`, `max`, `a1`, `a2`) VALUES
(1, '2.37', '90.76', 'Segera Tangani', '33.333333333333', 'Tidak Produktif', '0', '0', '0', '', '', '0.65', '', '', '0.35', '0', '1', '0', '100'),
(2, '2.45', '47', 'Segera Tangani', '33.333333333333', 'Tidak Produktif', '0', '0', '0', '0.25', '', '', '0.75', '', '', '0', '1', '0', '100'),
(3, '2.4', '56', 'Segera Tingatkan', '61.111111111111', 'Kurang Produktif', '0', '0', '0', '0.5', '0.2', '', '0.5', '0.2', '', '0', '0.8', '0', '80'),
(4, '2.45', '47', 'Segera Tangani', '33.333333333333', 'Tidak Produktif', '0', '0', '0', '0.25', '', '', '0.75', '', '', '0', '1', '0', '100'),
(5, '2.45', '47', 'Segera Tingatkan', '66.666666666667', 'Kurang Produktif', '0', '0', '0', '0.25', '', '', '0.75', '', '', '0', '1', '50', '100'),
(6, '2.4', '56', 'Pertahankan', '97.222222222222', 'Sangat Produktif', '0', '0', '0', '0.5', '0.2', '', '0.5', '0.2', '', '0', '0.8', '50', '90'),
(7, '2.46', '75.57', 'Segera Tingatkan', '60.121717171717', 'Kurang Produktif', '0', '0', '0', '', '0.2', '0.2', '', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '0', '53.436666666667'),
(8, '2', '62', 'Segera Tingatkan', '66.666666666667', 'Kurang Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '50', '100'),
(9, '2', '62', 'Segera Tingatkan', '61.666666666667', 'Kurang Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '50', '85'),
(10, '2', '62', 'Segera Tangani', '28.333333333333', 'Tidak Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '0', '85'),
(11, '2', '62', 'Pertahankan', '90', 'Sangat Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '85', '100'),
(12, '2', '62', 'Tingkatkan', '80', 'Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '70', '100'),
(13, '2', '62', 'Segera Tingatkan', '66.666666666667', 'Kurang Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '50', '100'),
(14, '2', '62', 'Tingkatkan', '70', 'Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '55', '100'),
(15, '3', '62', 'Tingkatkan', '70', 'Produktif', '0', '0', '0', '', '', '', '', '1', '', '0', '1', '55', '100'),
(16, '3', '62', 'Tingkatkan', '70', 'Produktif', '0', '0', '0', '', '', '', '', '1', '', '0', '1', '55', '100'),
(17, '2', '62', 'Segera Tangani', '28.333333333333', 'Tidak Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '0', '85'),
(18, '2', '62', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '85', '0'),
(19, '2', '62', 'Segera Tangani', '28.333333333333', 'Tidak Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '0', '85'),
(20, '2', '62', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '', '1', '', '', '', '', '', '', '', '', '1', '85', '0'),
(21, '2', '62', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '1', '', '', '', '', '', '', '', '0', '1', '85', '0'),
(22, '2', '90', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '', '1', '', '', '', '', '', '', '0', '1', '85', '0'),
(23, '2', '90', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '', '1', '', '', '', '', '', '', '0', '1', '85', '0'),
(24, '2.46', '75.57', 'Tingkatkan', '70.911340679522', 'Produktif', '0', '0', '0', '0', '0.2', '0.2', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '85', '31.563333333333'),
(25, '2', '90', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '', '1', '', '', '', '', '', '', '0', '1', '85', '0'),
(26, '2', '78', 'Tingkatkan', '77.70202020202', 'Produktif', '0', '0.46666666666667', '0.53333333333333', '', '', '', '', '', '', '0', '0.53333333333333', '85', '39.666666666667'),
(27, '3', '50', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '0', '0', '', '', '', '1', '', '', '0', '1', '85', '0'),
(28, '3', '10', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '0', '0', '', '', '', '1', '', '', '0', '1', '85', '0'),
(29, '2.46', '75.57', 'Tingkatkan', '70.911340679522', 'Produktif', '0', '0', '0', '0', '0.2', '0.2', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '85', '31.563333333333'),
(30, '2', '62', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '1', '', '', '', '', '', '', '', '0', '1', '85', '0'),
(31, '3', '56', 'Segera Tingatkan', '61.388888888889', 'Kurang Produktif', '0', '0', '0', '', '', '', '0.8', '0.2', '', '0', '0.8', '85', '17'),
(32, '2.46', '75.57', 'Tingkatkan', '70.911340679522', 'Produktif', '0', '0', '0', '0', '0.2', '0.2', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '85', '31.563333333333'),
(33, '2', '62', 'Segera Tingatkan', '56.666666666667', 'Kurang Produktif', '0', '1', '', '', '', '', '', '', '', '0', '1', '85', '0'),
(34, '2.46', '75.57', 'Tingkatkan', '70.911340679522', 'Produktif', '0', '0', '0', '0', '0.4', '0.37133333333333', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '85', '31.563333333333'),
(35, '2.46', '75.57', 'Tingkatkan', '83.425106681791', 'Produktif', '0', '0', '0', '0', '0.4', '0.37133333333333', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '100', '37.133333333333'),
(36, '2.46', '75.57', 'Segera Tingatkan', '50.055064009075', 'Kurang Produktif', '0', '0', '0', '0', '0.4', '0.37133333333333', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '60', '22.28'),
(37, '2.46', '75.57', 'Segera Tingatkan', '58.397574677254', 'Kurang Produktif', '0', '0', '0', '0', '0.4', '0.37133333333333', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '70', '25.993333333333'),
(38, '2.46', '75.57', 'Segera Tingatkan', '66.740085345433', 'Kurang Produktif', '0', '0', '0', '0', '0.4', '0.37133333333333', '0', '0.62866666666667', '0.37133333333333', '0', '0.62866666666667', '80', '29.706666666667'),
(39, '2', '65', 'Segera Tingatkan', '53.333333333333', 'Kurang Produktif', '0', '1', '0', '', '', '', '0', '0', '0', '0', '1', '80', '0'),
(40, '2', '65', 'Segera Tingatkan', '53.333333333333', 'Kurang Produktif', '0', '1', '0', '', '', '', '0', '0', '0', '0', '1', '80', '0');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `ket` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `ket`) VALUES
(1, 'FCR', 'Rendah, Normal, Tinggi'),
(2, 'Henday', 'Rendah, Normal, Tinggi'),
(3, 'Status Produktivitas ', 'Tidak Produktif, Kurang Produktif, Produktif, Sangat Produktif');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'AIRLANGGA', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_aturan`
--
ALTER TABLE `data_aturan`
  ADD PRIMARY KEY (`id_aturan`);

--
-- Indexes for table `hasil_fuzzy`
--
ALTER TABLE `hasil_fuzzy`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
