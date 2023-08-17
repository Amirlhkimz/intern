-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2017 at 07:27 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecirculation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcuti`
--

CREATE TABLE `tblcuti` (
  `id_cuti` int(12) NOT NULL,
  `idAhliC` varchar(150) NOT NULL,
  `tkh_mulaC` date NOT NULL,
  `tkh_akhirC` date NOT NULL,
  `idpenggunaC` varchar(11) NOT NULL,
  `trkemaskiniC` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblgred`
--

CREATE TABLE `tblgred` (
  `ID` int(11) NOT NULL,
  `Keterangan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgred`
--

INSERT INTO `tblgred` (`ID`, `Keterangan`) VALUES
(1, 54),
(2, 52),
(3, 48),
(4, 44),
(5, 41);

-- --------------------------------------------------------

--
-- Table structure for table `tblgroup`
--

CREATE TABLE `tblgroup` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblgroup`
--

INSERT INTO `tblgroup` (`id`, `keterangan`) VALUES
(1, 'MMKSN'),
(2, 'MMKPPA'),
(3, 'MMTKPPA(P)'),
(4, 'Lembaga KPPA');

-- --------------------------------------------------------

--
-- Table structure for table `tbljenisurusan`
--

CREATE TABLE `tbljenisurusan` (
  `id_jenisurusan` int(11) NOT NULL,
  `desc_jenisurusan` varchar(500) NOT NULL,
  `acr_jenisurusan` varchar(10) NOT NULL,
  `ruj_jenisurusan` text NOT NULL,
  `kat_jenisurusan` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljenisurusan`
--

INSERT INTO `tbljenisurusan` (`id_jenisurusan`, `desc_jenisurusan`, `acr_jenisurusan`, `ruj_jenisurusan`, `kat_jenisurusan`) VALUES
(2, 'Pemangkuan', 'PMKN', 'Pemangkuan', ''),
(1, 'Pertukaran', 'PTKN', 'Pertukaran', ''),
(3, 'Penempatan Khas', 'PNKS', 'Penempatan Khas', ''),
(4, 'Tamat CBBP', 'TCBB', 'Tamat CBBP', ''),
(5, 'Tamat CTG/CSG', 'TCTG', 'Tamat CTG/CSG', ''),
(6, 'Tamat Peminjaman', 'TPJN', 'Tamat Peminjaman', ''),
(7, 'Jawatan Kumpulan', 'JNKN', 'Jawatan Kumpulan', ''),
(8, 'Pemakluman', 'PMMN', 'Pemakluman', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblkategori`
--

CREATE TABLE `tblkategori` (
  `id_kategori` int(11) NOT NULL,
  `desc_kategori` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbllog`
--

CREATE TABLE `tbllog` (
  `id` int(11) NOT NULL,
  `idPengguna` varchar(50) NOT NULL,
  `Aktiviti` varchar(250) NOT NULL,
  `Masa` datetime NOT NULL,
  `IP` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllog`
--

INSERT INTO `tbllog` (`id`, `idPengguna`, `Aktiviti`, `Masa`, `IP`) VALUES
(23573, '1', 'Login', '2017-09-18 05:15:43', '::1'),
(23574, '1', 'Login', '2017-09-18 05:42:39', '::1'),
(23575, '1', 'Login', '2017-09-18 05:45:22', '10.21.205.40'),
(23576, '1', 'Logout', '2017-09-18 05:45:59', '10.21.205.40'),
(23577, '1', 'Login', '2017-09-18 05:56:14', '10.21.205.40'),
(23578, '1', 'Logout', '2017-09-18 05:58:29', '10.21.205.40'),
(23579, '1', 'Login', '2017-09-18 06:55:30', '10.21.205.40'),
(23580, '1', 'Login', '2017-09-18 08:03:18', '10.21.205.40'),
(23581, '1', 'Login', '2017-09-18 08:14:41', '10.21.205.40'),
(23582, '1', 'Login', '2017-09-18 08:17:31', '10.21.205.40'),
(23583, '1', 'Login', '2017-09-18 08:18:40', '10.21.205.40'),
(23584, '1', 'Login', '2017-09-18 08:19:06', '10.21.205.40'),
(23585, '1', 'Login', '2017-09-18 08:21:40', '10.21.205.40'),
(23586, '1', 'Login', '2017-09-18 08:24:33', '10.21.205.40'),
(23587, '1', 'Login', '2017-09-18 08:38:25', '10.21.205.40'),
(23588, '1', 'Login', '2017-09-18 08:49:59', '10.21.205.40'),
(23589, '1', 'Login', '2017-09-18 09:59:31', '10.21.205.40'),
(23590, '1', 'Login', '2017-09-18 10:43:52', '10.21.205.40'),
(23591, '1', 'Login', '2017-09-25 05:05:00', '10.21.199.48'),
(23592, '1', 'Login', '2017-09-25 05:06:55', '10.21.199.48'),
(23593, '1', 'Login', '2017-12-14 03:31:37', '::1'),
(23594, '1', 'Tambah mesyuarat: ', '2017-12-14 04:05:03', '::1'),
(23595, '1', 'Tambah mesyuarat: ', '2017-12-14 04:12:59', '::1'),
(23596, '1', 'Tambah mesyuarat: ', '2017-12-14 04:13:12', '::1'),
(23597, '1', 'Tambah mesyuarat: ', '2017-12-14 04:13:25', '::1'),
(23598, '1', 'Tambah mesyuarat: ', '2017-12-14 04:14:43', '::1'),
(23599, '1', 'Tambah mesyuarat: ', '2017-12-14 04:29:19', '::1'),
(23600, '', 'Hapus pengumuman: 3', '2017-12-14 05:29:00', '::1'),
(23601, '1', 'Logout', '2017-12-14 07:38:27', '::1'),
(23602, '1', 'Login', '2017-12-14 07:38:40', '::1'),
(23603, '', 'Tambah Pengguna: Fauzi', '2017-12-14 07:49:42', '::1'),
(23604, '', 'Tambah Pengguna: karim', '2017-12-14 07:52:36', '::1'),
(23605, '', 'Tambah Pengguna: Amat', '2017-12-14 08:11:56', '::1'),
(23606, '', 'Kemas kini pengguna: 65(Amat)', '2017-12-15 04:16:30', '::1'),
(23607, '', 'Kemas kini pengguna: 65(Amat)', '2017-12-15 04:16:53', '::1'),
(23608, '', 'Kemas kini pengguna: 65(Amat)', '2017-12-15 04:17:21', '::1'),
(23609, '1', 'Logout', '2017-12-15 04:17:23', '::1'),
(23610, '2', 'Login', '2017-12-15 04:18:16', '::1'),
(23611, '2', 'Logout', '2017-12-15 04:19:40', '::1'),
(23612, '63', 'Login', '2017-12-15 04:19:57', '::1'),
(23613, '63', 'Logout', '2017-12-15 04:20:45', '::1'),
(23614, '2', 'Login', '2017-12-15 04:20:49', '::1'),
(23615, '2', 'Logout', '2017-12-15 04:26:28', '::1'),
(23616, '1', 'Login', '2017-12-15 04:26:31', '::1'),
(23617, '', 'Kemas kini pengguna: 63(Fauzi)', '2017-12-15 04:46:25', '::1'),
(23618, '', 'Kemas kini pengguna: 64(karim)', '2017-12-15 04:49:14', '::1'),
(23619, '', 'Kemas kini pengguna: 2(Ahmad)', '2017-12-15 04:50:09', '::1'),
(23620, '', 'Kemas kini pengguna: 63(Fauzi)', '2017-12-15 04:50:22', '::1'),
(23621, '1', 'Logout', '2017-12-15 04:51:58', '::1'),
(23622, '2', 'Login', '2017-12-15 04:52:01', '::1'),
(23623, '1', 'Login', '2017-12-18 00:52:37', '::1'),
(23624, '1', 'Logout', '2017-12-18 02:02:39', '::1'),
(23625, '1', 'Login', '2017-12-18 02:02:40', '::1'),
(23626, '', 'Tambah Pengguna: Ain', '2017-12-18 02:45:57', '::1'),
(23627, '1', 'Logout', '2017-12-18 02:51:32', '::1'),
(23628, '2', 'Login', '2017-12-18 02:51:41', '::1'),
(23629, '2', 'Logout', '2017-12-18 02:52:07', '::1'),
(23630, '1', 'Login', '2017-12-18 02:52:12', '::1'),
(23631, '1', 'Logout', '2017-12-18 04:05:14', '::1'),
(23632, '2', 'Login', '2017-12-18 04:05:19', '::1'),
(23633, '2', 'Logout', '2017-12-18 04:19:30', '::1'),
(23634, '66', 'Login', '2017-12-18 04:20:00', '::1'),
(23635, '66', 'Logout', '2017-12-18 04:24:45', '::1'),
(23636, '1', 'Login', '2017-12-18 04:24:48', '::1'),
(23637, '1', 'Logout', '2017-12-18 04:29:12', '::1'),
(23638, '64', 'Login', '2017-12-18 04:30:23', '::1'),
(23639, '64', 'Logout', '2017-12-18 04:31:04', '::1'),
(23640, '64', 'Login', '2017-12-18 04:32:27', '::1'),
(23641, '64', 'Logout', '2017-12-18 04:32:31', '::1'),
(23642, '1', 'Login', '2017-12-18 04:32:53', '::1'),
(23643, '1', 'Logout', '2017-12-18 04:34:13', '::1'),
(23644, '2', 'Login', '2017-12-18 04:34:18', '::1'),
(23645, '2', 'Logout', '2017-12-18 04:40:47', '::1'),
(23646, '65', 'Login', '2017-12-18 04:40:56', '::1'),
(23647, '65', 'Logout', '2017-12-18 04:41:21', '::1'),
(23648, '65', 'Login', '2017-12-18 04:41:27', '::1'),
(23649, '65', 'Tambah mesyuarat: ', '2017-12-18 04:50:25', '::1'),
(23650, '65', 'Tambah mesyuarat: ', '2017-12-18 04:54:09', '::1'),
(23651, '65', 'Tambah mesyuarat: ', '2017-12-18 04:54:56', '::1'),
(23652, '65', 'Tambah mesyuarat: ', '2017-12-18 04:55:15', '::1'),
(23653, '65', 'Logout', '2017-12-18 04:56:58', '::1'),
(23654, '65', 'Login', '2017-12-18 04:57:00', '::1'),
(23655, '', 'Hapus pengumuman: 9', '2017-12-18 04:57:26', '::1'),
(23656, '', 'Hapus pengumuman: 8', '2017-12-18 04:57:34', '::1'),
(23657, '', 'Hapus pengumuman: 7', '2017-12-18 04:57:40', '::1'),
(23658, '65', 'Logout', '2017-12-18 05:01:18', '::1'),
(23659, '2', 'Login', '2017-12-18 05:01:23', '::1'),
(23660, '2', 'Logout', '2017-12-18 05:27:03', '::1'),
(23661, '1', 'Login', '2017-12-18 05:27:07', '::1'),
(23662, '1', 'Logout', '2017-12-18 08:29:49', '::1'),
(23663, '1', 'Login', '2017-12-18 08:29:54', '::1'),
(23664, '1', 'Logout', '2017-12-18 08:29:59', '::1'),
(23665, '1', 'Login', '2017-12-18 08:32:59', '::1'),
(23666, '1', 'Logout', '2017-12-18 08:35:29', '::1'),
(23667, '2', 'Login', '2017-12-18 08:35:35', '::1'),
(23668, '2', 'Logout', '2017-12-18 08:35:44', '::1'),
(23669, '1', 'Login', '2017-12-18 08:35:50', '::1'),
(23670, '1', 'Logout', '2017-12-18 08:36:47', '::1'),
(23671, '2', 'Login', '2017-12-18 08:36:52', '::1'),
(23672, '2', 'Logout', '2017-12-18 08:43:31', '::1'),
(23673, '1', 'Login', '2017-12-18 08:43:37', '::1'),
(23674, '', 'Kemas kini pengguna: 2(Ahmad)', '2017-12-18 08:44:27', '::1'),
(23675, '', 'Kemas kini pengguna: 65(Amat Sedi)', '2017-12-18 08:56:13', '::1'),
(23676, '', 'Kemas kini pengguna: 66(Ain Husna)', '2017-12-18 08:56:37', '::1'),
(23677, '', 'Kemas kini pengguna: 66(Ain Husna)', '2017-12-18 09:05:06', '::1'),
(23678, '', 'Kemas kini pengguna: 65(Amat Sedi)', '2017-12-18 09:05:22', '::1'),
(23679, '', 'Kemas kini pengguna: 64(karim)', '2017-12-18 09:05:32', '::1'),
(23680, '', 'Kemas kini pengguna: 63(Fauzi)', '2017-12-18 09:05:42', '::1'),
(23681, '', 'Tambah Pengguna: Murad', '2017-12-18 09:24:19', '::1'),
(23682, '', 'Kemas kini pengguna: 67(Murad Isa)', '2017-12-18 09:54:51', '::1'),
(23683, '', 'Kemas kini pengguna: 66(Ain Husna)', '2017-12-18 09:55:15', '::1'),
(23684, '', 'Kemas kini pengguna: 63(Fauzi)', '2017-12-18 09:55:38', '::1'),
(23685, '', 'Kemas kini pengguna: 64(karim)', '2017-12-18 09:56:03', '::1'),
(23686, '', 'Kemas kini pengguna: 65(Amat Sedi)', '2017-12-18 09:56:46', '::1'),
(23687, '1', 'Logout', '2017-12-19 03:43:27', '::1'),
(23688, '66', 'Login', '2017-12-19 03:43:35', '::1'),
(23689, '66', 'Logout', '2017-12-19 03:43:47', '::1'),
(23690, '1', 'Login', '2017-12-19 03:43:51', '::1'),
(23691, '1', 'Logout', '2017-12-19 03:43:54', '::1'),
(23692, '2', 'Login', '2017-12-19 03:43:58', '::1'),
(23693, '2', 'Logout', '2017-12-19 03:44:07', '::1'),
(23694, '64', 'Login', '2017-12-19 03:44:13', '::1'),
(23695, '64', 'Logout', '2017-12-19 03:44:21', '::1'),
(23696, '1', 'Login', '2017-12-19 03:44:26', '::1'),
(23697, '', 'Tambah pengumuman: Jom Solat', '2017-12-19 03:47:49', '::1'),
(23698, '', 'tutup: 3', '2017-12-19 03:48:00', '::1'),
(23699, '', 'papar: 3', '2017-12-19 03:48:14', '::1'),
(23700, '1', 'Logout', '2017-12-19 03:49:28', '::1'),
(23701, '2', 'Login', '2017-12-19 03:49:33', '::1'),
(23702, '2', 'Logout', '2017-12-19 03:52:29', '::1'),
(23703, '1', 'Login', '2017-12-19 03:52:34', '::1'),
(23704, '1', 'Logout', '2017-12-19 04:06:24', '::1'),
(23705, '2', 'Login', '2017-12-19 04:06:29', '::1'),
(23706, '2', 'Logout', '2017-12-19 04:13:02', '::1'),
(23707, '2', 'Login', '2017-12-19 04:13:05', '::1'),
(23708, '2', 'Logout', '2017-12-19 04:13:09', '::1'),
(23709, '66', 'Login', '2017-12-19 04:13:16', '::1'),
(23710, '', 'Kemas kini pengguna: 67(Murad Isa)', '2017-12-19 04:15:07', '::1'),
(23711, '66', 'Logout', '2017-12-19 04:15:10', '::1'),
(23712, '67', 'Login', '2017-12-19 04:15:20', '::1'),
(23713, '67', 'Logout', '2017-12-19 04:16:38', '::1'),
(23714, '1', 'Login', '2017-12-19 04:16:44', '::1'),
(23715, '1', 'Logout', '2017-12-19 04:17:04', '::1'),
(23716, '66', 'Login', '2017-12-19 04:17:08', '::1'),
(23717, '66', 'Logout', '2017-12-19 04:40:27', '::1'),
(23718, '66', 'Login', '2017-12-19 04:40:29', '::1'),
(23719, '66', 'Logout', '2017-12-19 04:53:09', '::1'),
(23720, '2', 'Login', '2017-12-19 04:53:15', '::1'),
(23721, '', 'Kemaskini status akhir urusan kepada Selesai', '2017-12-19 05:14:14', '::1'),
(23722, '', 'Kemaskini status akhir urusan kepada Selesai', '2017-12-19 05:14:45', '::1'),
(23723, '', 'Kemaskini status akhir urusan kepada Selesai', '2017-12-19 05:15:49', '::1'),
(23724, '', 'Kemaskini status akhir urusan kepada Selesai', '2017-12-19 05:16:01', '::1'),
(23725, '', 'Kemaskini status akhir urusan kepada Selesai', '2017-12-19 05:16:46', '::1'),
(23726, '2', 'Logout', '2017-12-19 05:22:10', '::1'),
(23727, '1', 'Login', '2017-12-19 05:22:22', '::1'),
(23728, '1', 'Logout', '2017-12-19 05:22:48', '::1'),
(23729, '64', 'Login', '2017-12-19 05:22:56', '::1'),
(23730, '64', 'Logout', '2017-12-19 05:23:20', '::1'),
(23731, '65', 'Login', '2017-12-19 05:23:30', '::1'),
(23732, '65', 'Logout', '2017-12-19 05:24:16', '::1'),
(23733, '66', 'Login', '2017-12-19 05:24:24', '::1'),
(23734, '66', 'Logout', '2017-12-19 05:24:49', '::1'),
(23735, '63', 'Login', '2017-12-19 05:25:04', '::1'),
(23736, '63', 'Logout', '2017-12-19 05:26:58', '::1'),
(23737, '2', 'Login', '2017-12-19 05:27:05', '::1'),
(23738, '2', 'Logout', '2017-12-19 05:28:21', '::1'),
(23739, '66', 'Login', '2017-12-19 05:28:27', '::1'),
(23740, '66', 'Logout', '2017-12-19 05:31:17', '::1'),
(23741, '2', 'Login', '2017-12-19 05:31:24', '::1'),
(23742, '2', 'Logout', '2017-12-19 05:32:23', '::1'),
(23743, '63', 'Login', '2017-12-19 05:32:33', '::1'),
(23744, '63', 'Logout', '2017-12-19 05:33:43', '::1'),
(23745, '1', 'Login', '2017-12-19 05:33:48', '::1'),
(23746, '', 'Kemas kini pengguna: 63(Fauzi)', '2017-12-19 05:34:55', '::1'),
(23747, '1', 'Logout', '2017-12-19 05:34:59', '::1'),
(23748, '63', 'Login', '2017-12-19 05:35:03', '::1'),
(23749, '63', 'Logout', '2017-12-19 05:35:34', '::1'),
(23750, '2', 'Login', '2017-12-19 05:35:53', '::1'),
(23751, '2', 'Logout', '2017-12-19 05:36:20', '::1'),
(23752, '1', 'Login', '2017-12-19 05:36:23', '::1'),
(23753, '1', 'Tambah mesyuarat: ', '2017-12-19 05:37:41', '::1'),
(23754, '1', 'Logout', '2017-12-19 05:39:27', '::1'),
(23755, '2', 'Login', '2017-12-19 05:39:34', '::1'),
(23756, '2', 'Logout', '2017-12-19 05:40:09', '::1'),
(23757, '63', 'Login', '2017-12-19 05:40:18', '::1'),
(23758, '63', 'Logout', '2017-12-19 05:40:25', '::1'),
(23759, '1', 'Login', '2017-12-19 05:40:29', '::1'),
(23760, '1', 'Logout', '2017-12-19 05:46:31', '::1'),
(23761, '2', 'Login', '2017-12-19 05:46:40', '::1'),
(23762, '2', 'Logout', '2017-12-19 05:48:51', '::1'),
(23763, '1', 'Login', '2017-12-19 05:48:55', '::1'),
(23764, '1', 'Logout', '2017-12-19 05:51:13', '::1'),
(23765, '67', 'Login', '2017-12-19 05:51:25', '::1'),
(23766, '67', 'Logout', '2017-12-19 05:51:25', '::1'),
(23767, '65', 'Login', '2017-12-19 05:51:31', '::1'),
(23768, '65', 'Logout', '2017-12-19 05:51:47', '::1'),
(23769, '63', 'Login', '2017-12-19 05:51:55', '::1'),
(23770, '63', 'Logout', '2017-12-19 05:54:22', '::1'),
(23771, '67', 'Login', '2017-12-19 05:54:32', '::1'),
(23772, '67', 'Logout', '2017-12-19 05:54:32', '::1'),
(23773, '63', 'Login', '2017-12-19 05:54:41', '::1'),
(23774, '63', 'Logout', '2017-12-19 05:54:47', '::1'),
(23775, '1', 'Login', '2017-12-19 05:54:52', '::1'),
(23776, '', 'Kemas kini pengguna: 2(KSN)', '2017-12-19 05:55:38', '::1'),
(23777, '', 'Kemas kini pengguna: 67(Ahli)', '2017-12-19 05:56:28', '::1'),
(23778, '1', 'Logout', '2017-12-19 05:56:39', '::1'),
(23779, '67', 'Login', '2017-12-19 05:56:50', '::1'),
(23780, '67', 'Logout', '2017-12-19 05:56:51', '::1'),
(23781, '1', 'Login', '2017-12-19 05:56:54', '::1'),
(23782, '', 'Kemas kini pengguna: 67(Ahli)', '2017-12-19 05:57:27', '::1'),
(23783, '1', 'Logout', '2017-12-19 05:57:47', '::1'),
(23784, '67', 'Login', '2017-12-19 05:57:59', '::1'),
(23785, '67', 'Logout', '2017-12-19 05:57:59', '::1'),
(23786, '67', 'Login', '2017-12-19 05:58:34', '::1'),
(23787, '67', 'Logout', '2017-12-19 05:58:35', '::1'),
(23788, '1', 'Login', '2017-12-19 05:58:41', '::1'),
(23789, '1', 'Tambah Pengguna: ahlul', '2017-12-19 06:00:14', '::1'),
(23790, '1', 'Logout', '2017-12-19 06:00:21', '::1'),
(23791, '68', 'Login', '2017-12-19 06:00:43', '::1'),
(23792, '68', 'Logout', '2017-12-19 06:00:44', '::1'),
(23793, '68', 'Login', '2017-12-19 06:01:01', '::1'),
(23794, '68', 'Logout', '2017-12-19 06:01:01', '::1'),
(23795, '68', 'Login', '2017-12-19 06:01:39', '::1'),
(23796, '68', 'Logout', '2017-12-19 06:01:39', '::1'),
(23797, '66', 'Login', '2017-12-19 06:01:53', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tblmesyuarat`
--

CREATE TABLE `tblmesyuarat` (
  `id` int(11) NOT NULL,
  `siri` int(11) NOT NULL,
  `sirithn` int(11) NOT NULL,
  `mesyuarat` varchar(100) NOT NULL,
  `tarikhMesyuarat` date NOT NULL,
  `masa` varchar(20) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tempat2` varchar(100) NOT NULL,
  `tempat3` varchar(100) NOT NULL,
  `idCipta` varchar(20) NOT NULL,
  `trCipta` datetime NOT NULL,
  `status` varchar(5) NOT NULL,
  `idKemaskini` varchar(20) NOT NULL,
  `TrKemaskini` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmesyuarat`
--

INSERT INTO `tblmesyuarat` (`id`, `siri`, `sirithn`, `mesyuarat`, `tarikhMesyuarat`, `masa`, `tempat`, `tempat2`, `tempat3`, `idCipta`, `trCipta`, `status`, `idKemaskini`, `TrKemaskini`) VALUES
(4, 3, 3, 'Mesyuarat Mingguan KPPA', '2017-12-21', '', '', '', '', '1', '2017-12-14 04:13:25', 'Ya', '', '0000-00-00 00:00:00'),
(5, 4, 4, 'Mesyuarat Mingguan KPPA', '2017-12-28', '', '', '', '', '1', '2017-12-14 04:14:43', 'Ya', '', '0000-00-00 00:00:00'),
(6, 5, 5, 'Lembaga KPPA', '2017-12-21', '', '', '', '', '1', '2017-12-14 04:29:19', 'Ya', '', '0000-00-00 00:00:00'),
(10, 9, 9, 'Mesyuarat Mingguan TKPPA(P)', '2017-12-18', '', '', '', '', '65', '2017-12-18 04:55:15', 'Ya', '', '0000-00-00 00:00:00'),
(11, 10, 10, 'Mesyuarat Mingguan KSN', '2017-12-19', '', '', '', '', '1', '2017-12-19 05:37:41', 'Ya', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblpengguna`
--

CREATE TABLE `tblpengguna` (
  `id` int(11) NOT NULL,
  `Gelaran` varchar(50) NOT NULL,
  `NoKp` varchar(20) NOT NULL,
  `NamaPenuh` varchar(50) NOT NULL,
  `Jawatan` varchar(250) NOT NULL,
  `Gred` varchar(10) NOT NULL,
  `NoHp` varchar(15) NOT NULL,
  `Bahagian` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Email_dummy` varchar(150) NOT NULL,
  `Login` varchar(50) NOT NULL,
  `Klaluan` varchar(750) NOT NULL,
  `Klaluan_emergency` varchar(750) NOT NULL,
  `Kumpulan` varchar(25) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Susunan` int(11) NOT NULL,
  `Group_Id` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpengguna`
--

INSERT INTO `tblpengguna` (`id`, `Gelaran`, `NoKp`, `NamaPenuh`, `Jawatan`, `Gred`, `NoHp`, `Bahagian`, `Email`, `Email_dummy`, `Login`, `Klaluan`, `Klaluan_emergency`, `Kumpulan`, `Status`, `Susunan`, `Group_Id`) VALUES
(1, '', '001', 'Admin', '', '', '', '', 'admin@spa.gov.my', '', 'admin', '0192023a7bbd73250516f069df18b500', '', 'urusetia', 'Aktif', 0, '0'),
(2, 'Tan Sri', '6047', 'KSN', 'KSN', 'KSN', '', '', 'ksn@jpa.gov.my', '', 'ksn', 'e62005cb2e20dd26f702f22c6f170853', '', 'Pengerusi', 'Aktif', 0, 'MMKSN'),
(63, 'Dato', '5164', 'KPPA', 'kppa', 'utama 1', '5555', 'Bahagian Perkhidmatan', 'kppa@jpa.gov.my', '', 'kppa', 'fc245950aca0b59ed5eea54e93fe6a20', '', 'Pengerusi', 'Aktif', 0, 'MMKSN'),
(64, 'Dato', '6006', 'karim', 'tkppa', 'Jusa A', '8888', 'Bahagian Perkhidmatan', 'tkppa', '', 'tkppa', 'bab415511cb7778511ec1354173a0030', '', 'Pengerusi', 'Aktif', 0, 'MMTKPPA(P)'),
(65, 'Encik', '8989', 'Amat Sedi', 'tkppa(o)', 'Jusa A', '9999', 'Bahagian Perkhidmatan', 'amat@jpa', '', 'tkppao', '3dcabfe284f87493afd44d05f207e384', '', 'urusetia', 'Aktif', 0, 'Lembaga KPPA'),
(66, 'Puan', '568923', 'Urusetia', 'KPP', '54', '88888', 'Bahagian Perkhidmatan', 'ain@jpa', '', 'ain', 'edf559915c178c96ff6cb994708c634a', '', 'urusetia', 'Aktif', 0, 'MMTKPPA(P)'),
(67, 'Dato\'', '789456123', 'Ahli', 'PP(K)PG1C', '54', '019888888', 'Bahagian Perkhidmatan', 'murad@yahoo', '', 'ahli', 'f067dda7c7362a47359169a41a2da804', '', 'Ahli', 'Aktif', 6, 'MMKSN'),
(68, 'Puan', '7777777777', 'ahlul', 'hdhdhdh', 'Jusa A', '', 'Bahagian Perkhidmatan', 'ahlul@gmail', '', 'ahlul', '80391880b7bff697b2c5e56ae4d4b3e6', '', 'Ahli', 'Aktif', 0, 'MMKSN');

-- --------------------------------------------------------

--
-- Table structure for table `tblpengumuman`
--

CREATE TABLE `tblpengumuman` (
  `id` int(11) NOT NULL,
  `Tajuk` varchar(250) NOT NULL,
  `Kandungan` text NOT NULL,
  `idCipta` varchar(100) NOT NULL,
  `trCipta` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpengumuman`
--

INSERT INTO `tblpengumuman` (`id`, `Tajuk`, `Kandungan`, `idCipta`, `trCipta`, `status`) VALUES
(3, 'Jom Solat', 'Jom Solat di surau', '', '2017-12-19 03:47:49', 'papar');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatusurusan`
--

CREATE TABLE `tblstatusurusan` (
  `id` int(11) NOT NULL,
  `idPengguna` int(11) NOT NULL,
  `idUrusan` int(11) NOT NULL,
  `Kategori` varchar(250) NOT NULL,
  `Keputusan` varchar(100) NOT NULL,
  `Ulasan` text NOT NULL,
  `Maklumbalas` varchar(200) NOT NULL,
  `TrTerima` datetime NOT NULL,
  `TrBuka` datetime NOT NULL,
  `TrSelesai` datetime NOT NULL,
  `Tempoh` varchar(250) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `susunan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstatusurusan`
--

INSERT INTO `tblstatusurusan` (`id`, `idPengguna`, `idUrusan`, `Kategori`, `Keputusan`, `Ulasan`, `Maklumbalas`, `TrTerima`, `TrBuka`, `TrSelesai`, `Tempoh`, `Status`, `susunan`) VALUES
(9054, 2, 821, '', '', '', '', '2017-12-14 08:59:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Baru', 2),
(9055, 2, 822, '', '', '', '', '2017-12-14 09:01:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Baru', 2),
(9056, 2, 823, '', 'Berkecuali', 'Tidak berkaitan', '', '2017-12-14 09:02:11', '0000-00-00 00:00:00', '2017-12-19 05:16:46', '', 'Selesai', 2),
(9057, 2, 824, '', 'Tidak Setuju', 'Masih baru', '', '2017-12-14 09:07:32', '0000-00-00 00:00:00', '2017-12-19 05:16:01', '', 'Selesai', 2),
(9058, 2, 825, '', 'Setuju', 'Amat bersetuju', '', '2017-12-18 04:44:42', '0000-00-00 00:00:00', '2017-12-19 05:14:45', '', 'Selesai', 0),
(9059, 2, 826, '', '', '', '', '2017-12-19 05:39:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'Baru', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblurusan`
--

CREATE TABLE `tblurusan` (
  `id` int(11) NOT NULL,
  `Kategori` varchar(100) NOT NULL,
  `Jenis` varchar(500) NOT NULL,
  `GredUrusan` int(11) DEFAULT NULL,
  `Ringkasan` text NOT NULL,
  `Kertas` varchar(500) NOT NULL,
  `NoKertas` varchar(500) NOT NULL,
  `rujBhg` varchar(100) NOT NULL,
  `bilMesyuarat` varchar(100) NOT NULL,
  `Link` varchar(100) NOT NULL,
  `idCipta` varchar(50) NOT NULL,
  `TrCipta` datetime NOT NULL,
  `idkemaskini` varchar(50) NOT NULL,
  `TrKemaskini` datetime NOT NULL,
  `TrSelesaiU` datetime NOT NULL,
  `Status` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblurusan`
--

INSERT INTO `tblurusan` (`id`, `Kategori`, `Jenis`, `GredUrusan`, `Ringkasan`, `Kertas`, `NoKertas`, `rujBhg`, `bilMesyuarat`, `Link`, `idCipta`, `TrCipta`, `idkemaskini`, `TrKemaskini`, `TrSelesaiU`, `Status`) VALUES
(823, '', 'Pertukaran', NULL, 'Karam Pun', 'cimb02102017 - Copy (4).pdf', '784512784512', '004', 'Lembaga KPPA', 'upload/cimb02102017 - Copy (4).pdf', '1', '2017-12-14 09:02:11', '', '2017-12-19 05:16:46', '0000-00-00 00:00:00', 'Selesai'),
(822, '', 'Penempatan Khas', NULL, 'Abu Sayaf', 'cimb02102017 - Copy (3).pdf', '791128', '005', 'Mesyuarat Mingguan KPPA', 'upload/cimb02102017 - Copy (3).pdf', '1', '2017-12-14 09:01:06', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Baru'),
(821, '', 'Pemangkuan', NULL, 'Ahmad Fauzi', 'cimb02102017 - Copy (2).pdf', '750721086047', '007', 'Mesyuarat Mingguan KPPA', 'upload/cimb02102017 - Copy (2).pdf', '1', '2017-12-14 08:59:50', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Baru'),
(824, '', 'Pemangkuan', NULL, 'Halim Othman', 'cimb02102017 - Copy (5).pdf', '333333333', '002', 'Mesyuarat Mingguan KPPA', 'upload/cimb02102017 - Copy (5).pdf', '1', '2017-12-14 09:07:32', '', '2017-12-19 05:16:01', '0000-00-00 00:00:00', 'Selesai'),
(825, '', 'Pertukaran', NULL, 'Pertukaran PPTM F32 drp JPA ke MOF', 'Minit SPP Error.pdf', '122', 'JPA/123/2017', 'Mesyuarat Mingguan KPPA', 'upload/Minit SPP Error.pdf', '65', '2017-12-18 04:44:42', '', '2017-12-19 05:14:45', '0000-00-00 00:00:00', 'Selesai'),
(826, '', 'Tamat CBBP', NULL, 'Abu Hasan', 'langkawi.pdf', '124578', 'BPPSM', 'Mesyuarat Mingguan KSN', 'upload/langkawi.pdf', '1', '2017-12-19 05:39:04', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Baru');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcuti`
--
ALTER TABLE `tblcuti`
  ADD PRIMARY KEY (`id_cuti`);

--
-- Indexes for table `tblgred`
--
ALTER TABLE `tblgred`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbljenisurusan`
--
ALTER TABLE `tbljenisurusan`
  ADD PRIMARY KEY (`id_jenisurusan`);

--
-- Indexes for table `tblkategori`
--
ALTER TABLE `tblkategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbllog`
--
ALTER TABLE `tbllog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmesyuarat`
--
ALTER TABLE `tblmesyuarat`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tblpengguna`
--
ALTER TABLE `tblpengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tblpengumuman`
--
ALTER TABLE `tblpengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstatusurusan`
--
ALTER TABLE `tblstatusurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblurusan`
--
ALTER TABLE `tblurusan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcuti`
--
ALTER TABLE `tblcuti`
  MODIFY `id_cuti` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblgred`
--
ALTER TABLE `tblgred`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbljenisurusan`
--
ALTER TABLE `tbljenisurusan`
  MODIFY `id_jenisurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `tblkategori`
--
ALTER TABLE `tblkategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbllog`
--
ALTER TABLE `tbllog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23798;
--
-- AUTO_INCREMENT for table `tblmesyuarat`
--
ALTER TABLE `tblmesyuarat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblpengguna`
--
ALTER TABLE `tblpengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `tblpengumuman`
--
ALTER TABLE `tblpengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblstatusurusan`
--
ALTER TABLE `tblstatusurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9060;
--
-- AUTO_INCREMENT for table `tblurusan`
--
ALTER TABLE `tblurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=827;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
