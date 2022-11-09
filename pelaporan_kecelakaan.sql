-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2022 at 09:55 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelaporan_kecelakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `nama_lengkap` text NOT NULL,
  `email` text,
  `no_hp` varchar(15) DEFAULT NULL,
  `foto` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `foto`, `status`, `last_login`, `create_datetime`, `update_datetime`) VALUES
(1, 'admin', '$2y$10$ZiL92FZIm4DZMeS0FVOswep2J/sJyoEVVVgProUECl17GiHrJ/2rq', 'Administrator Aplikasi', 'laporlakalantasapp@gmail.com', '089650509010', '1645027956_25fb569b0597133bdbcd.png', '1', '2022-06-21 16:17:29', '2022-01-29 19:20:21', '2022-06-21 16:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto_laporan`
--

CREATE TABLE `tb_foto_laporan` (
  `id_foto` bigint(10) NOT NULL,
  `id_laporan` bigint(10) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi` text,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `upload_by` enum('pelapor','personil') NOT NULL,
  `id_user_upload` int(11) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_foto_laporan`
--

INSERT INTO `tb_foto_laporan` (`id_foto`, `id_laporan`, `foto`, `deskripsi`, `latitude`, `longitude`, `upload_by`, `id_user_upload`, `create_datetime`, `update_datetime`) VALUES
(1, 102, '1655015853_f9b9c556ae9d4a2ece0e.jpeg', 'abcgaudasj\r\n', '-0.0582463', '109.3432463', 'pelapor', 1, '2022-06-12 13:37:34', '2022-06-12 13:57:57'),
(2, 103, '1655310193_1c24b3489a561777838f.jpg', NULL, '-0.0567128', '109.3531405', 'personil', 3, '2022-06-15 23:23:14', '2022-06-15 23:23:27'),
(3, 114, '1657500013_d0842f342268e15755d5.png', 'Test test 1213\r\n', '-5.1511296', '119.4491904', 'pelapor', 3, '2022-07-11 07:40:13', '2022-07-11 07:54:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_foto_tindakan_personil`
--

CREATE TABLE `tb_foto_tindakan_personil` (
  `id_foto` bigint(10) NOT NULL,
  `id_tindakan` bigint(10) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` text,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_foto_tindakan_personil`
--

INSERT INTO `tb_foto_tindakan_personil` (`id_foto`, `id_tindakan`, `foto`, `deskripsi`, `latitude`, `longitude`, `create_datetime`, `update_datetime`) VALUES
(1, 8, '1655656489_87994001e565cae753d6.png', 'ss', '-0.05479917730219954', '109.34932090044707', '2022-06-19 23:34:50', '2022-06-20 07:11:19'),
(3, 9, '1655657050_53378a7106bef93cf2ac.png', 'source code detail faskes', '-0.05479917730219954', '109.34932090044707', '2022-06-19 23:44:11', '2022-06-20 07:15:35'),
(5, 8, '1655657313_189a42cbce3910eec4d7.jpeg', 'ronal', '-0.05479917730219954', '109.34932090044707', '2022-06-19 23:48:33', '2022-06-20 07:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_tindakan_personil`
--

CREATE TABLE `tb_jenis_tindakan_personil` (
  `id_jenis_tindakan` int(11) NOT NULL,
  `jenis_tindakan` text NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_tindakan_personil`
--

INSERT INTO `tb_jenis_tindakan_personil` (`id_jenis_tindakan`, `jenis_tindakan`, `create_datetime`, `update_datetime`, `aktif`) VALUES
(1, 'Mendatangi TKP', '2022-02-21 14:03:56', '2022-06-01 19:15:46', 'Y'),
(2, 'Melakukan pertolongan pada korban', '2022-02-21 14:03:56', '2022-06-01 19:15:50', 'Y'),
(3, 'Melakukan tindakan pertama di TKP', '2022-03-21 02:25:30', '2022-06-01 19:15:55', 'Y'),
(4, 'Melakukan olah TKP', '2022-02-21 14:03:56', '2022-06-01 19:15:58', 'Y'),
(5, 'Mengatur kelancaran arus lalu lintas', '2022-02-21 14:03:56', '2022-06-01 19:16:00', 'Y'),
(6, 'Mengamankan Barang Bukti', '2022-02-21 14:03:56', '2022-06-01 19:16:03', 'Y'),
(7, 'Melakukan Penyidikan Perkara', '2022-02-21 14:03:56', '2022-06-01 19:16:05', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_kecelakaan`
--

CREATE TABLE `tb_kategori_kecelakaan` (
  `id_kategori_kecelakaan` int(11) NOT NULL,
  `kategori_kecelakaan` text NOT NULL,
  `deskripsi` text,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_kecelakaan`
--

INSERT INTO `tb_kategori_kecelakaan` (`id_kategori_kecelakaan`, `kategori_kecelakaan`, `deskripsi`, `create_datetime`, `update_datetime`, `aktif`) VALUES
(1, 'Kecelakaan Tunggal', 'test 1111', '2021-10-22 11:42:24', '2022-02-21 13:52:46', 'Y'),
(2, 'Kecelakaan Beruntun', 'jasajs qajs h q', '2022-02-21 13:52:56', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_korban`
--

CREATE TABLE `tb_kategori_korban` (
  `id_kategori_korban` int(11) NOT NULL,
  `kategori_korban` text NOT NULL,
  `deskripsi` text,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_korban`
--

INSERT INTO `tb_kategori_korban` (`id_kategori_korban`, `kategori_korban`, `deskripsi`, `create_datetime`, `update_datetime`, `aktif`) VALUES
(1, 'Meninggal Dunia', 'Korban meninggal dunia', '2022-02-19 15:11:09', '2022-03-21 02:40:29', 'Y'),
(2, 'Luka Berat', 'Jatuh sakit dan tidak ada harapan sembuh sama sekali atau menimbulkan bahaya maut / tidak mampu terus-menerus untuk menjalankan tugas jabatan atau pekerjaan;\nkehilangan salah satu pancaindra / menderita cacat berat atau lumpuh / terganggu daya pikir selama 4 (empat) minggu lebih\n\ngugur atau matinya kandungan seorang perempuan; atau\nluka yang membutuhkan perawatan di rumah sakit lebih dari 30 (tiga puluh) hari', '2022-02-19 15:13:39', '2022-03-21 02:39:00', 'Y'),
(3, 'Luka Ringan', 'Korban menderita sakit yang tidak memerlukan perawatan inap di rumah sakit atau selain yang diklasifikasikan dalam luka berat', '2022-02-19 15:13:58', '2022-03-21 02:40:22', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_laporan`
--

CREATE TABLE `tb_kategori_laporan` (
  `id_kategori_laporan` int(11) NOT NULL,
  `kategori_laporan` text NOT NULL,
  `deskripsi` text,
  `create_datetime` datetime DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_laporan`
--

INSERT INTO `tb_kategori_laporan` (`id_kategori_laporan`, `kategori_laporan`, `deskripsi`, `create_datetime`, `update_datetime`) VALUES
(1, 'Ringan', 'Kecelakaan yang mengakibatkan kerusakan Kendaraan dan/atau barang \r\n', '2022-02-21 13:58:21', '2022-02-21 13:58:24'),
(2, 'Sedang', 'Kecelakaan yang mengakibatkan luka ringan dan kerusakan Kendaraan dan/atau barang. \r\n', '2022-02-21 13:58:25', '2022-02-21 13:58:27'),
(3, 'Berat', 'Kecelakaan yang mengakibatkan korban meninggal dunia atau luka berat', '2022-02-21 13:58:33', '2022-02-21 14:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int(10) NOT NULL,
  `token` text NOT NULL,
  `waktu` datetime NOT NULL,
  `id_pelapor` int(10) NOT NULL,
  `id_kategori_laporan` int(10) NOT NULL,
  `id_kategori_kecelakaan` int(10) DEFAULT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `deskripsi` text,
  `status` enum('0','1','2') NOT NULL COMMENT '0 = Menunggu Respon, 1 = Telah ditindaklanjut, 2 = Tidak ditindaklanjut',
  `verifikasi` enum('0','1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `token`, `waktu`, `id_pelapor`, `id_kategori_laporan`, `id_kategori_kecelakaan`, `latitude`, `longitude`, `deskripsi`, `status`, `verifikasi`) VALUES
(1, '1Mf1RYIuZYrorPOIT5Eli1M2CctOhk9dyhYpK', '2022-01-29 10:18:34', 3, 1, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(2, 'R9jzAhQqZXtM3p6IyOCOkcD8WxJSfUKRdaIjA', '2022-01-29 10:18:38', 3, 3, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(3, '4ZctIHVOPyCgZwAEb8uKlPi70aUaLFAeDK48v', '2022-01-29 10:18:42', 3, 2, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(4, '7agefulvAQIHDkkplKy7pjnY5eCTwW3Ke3ZSu', '2022-01-29 10:27:20', 3, 1, NULL, '-0.037397', '109.3315568', NULL, '1', '0'),
(5, 'eOv2OznQtYYhRukrsIWGtcupI7s47fH3RqNYz', '2022-01-29 10:27:22', 3, 2, NULL, '-0.037397', '109.3315568', NULL, '1', '0'),
(7, 'nVvzhrOHTCIv5rsQ9R1KiG0FiVfrB8t8iPC3T', '2022-01-31 04:11:01', 3, 1, NULL, '-0.0558016', '109.3485426', NULL, '1', '0'),
(8, 'X2w74evPSL1Vk3hmvhHbLPnhT4TFr0HT8BWy9', '2022-02-14 15:49:51', 3, 2, NULL, '-0.0558158', '109.3484977', NULL, '1', '0'),
(9, 'Hckx9Y6Oja5InQgCLCgwx8ZkcIajpBGo9KoTz', '2022-02-15 09:59:46', 3, 2, NULL, '-7.2574719', '112.7520883', NULL, '1', '0'),
(10, '9Nz0e9qk6cTcDA3GkjzG3aYnYtOmtVxiby0e4', '2022-02-15 10:00:19', 3, 3, NULL, '-0.041132393501668134', '109.33660893798904', NULL, '1', '0'),
(11, '79QoM9Ni9PVuVSFDrhk4joZYHRNXYkGAK2o1O', '2022-02-15 10:01:41', 3, 1, NULL, '-7.2574719', '112.7520883', NULL, '1', '0'),
(12, 'PnJOfKtrU4nUYqeAopcav1EjI4WRHkSfjvQCn', '2022-02-15 10:02:32', 3, 3, NULL, '-0.0483555', '109.3580942', NULL, '1', '0'),
(13, 'MrVkYoA6gKfJPIy5wL11lsjxKTFlvfsDsvCll', '2022-02-15 10:02:42', 3, 2, NULL, '-0.0483555', '109.3580942', NULL, '1', '0'),
(14, 'D65yN6HCc0imbM2QlovsTZpvpe8hUYHyHl9RA', '2022-02-15 10:02:42', 3, 1, NULL, '-0.0483555', '109.3580942', NULL, '1', '0'),
(15, '6isF5lVaH1y9K8eWpjNfQDRgUdRNkvf2CMl7x', '2022-02-18 17:48:49', 3, 1, NULL, '-0.0616549', '109.3426422', NULL, '1', '0'),
(16, '703Kg2jBTYyfUd05Z9RCgObr7wWqfV4KXGVBu', '2022-02-22 06:01:52', 3, 2, NULL, '-0.0393216', '109.3337088', NULL, '1', '0'),
(17, 'RcQxjEUQktHJDxomNuDzOQqv5ACvqBGQRsfmG', '2022-02-22 06:01:56', 3, 3, NULL, '-0.04224520708528606', '109.32500369064218', NULL, '1', '0'),
(18, 'u13HQmWaEx80pNH2GTghUABczQMjHLwaShx3I', '2022-02-23 10:16:31', 3, 1, NULL, '-0.04062057216862603', '109.33351598382681', NULL, '1', '0'),
(33, 'FRuSrreCbEH6YCyRJ11sQ98zZwoVhR8YTE2sH', '2022-03-09 22:26:35', 5, 3, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(34, 'ziIAy0Od9qjsJvlOSS1bGSlE98uYvf3uDSnSc', '2022-03-09 22:26:36', 5, 2, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(36, 'R8LlcsK3G0ovLGidZE8kcbMx0HQ8GDNtNh8fy', '2022-03-09 22:26:54', 5, 2, NULL, '-0.0373276', '109.3315721', NULL, '1', '0'),
(39, 'DgyLfg9I2SINfKKB8T0cctCMLPaisF9IVvS0z', '2022-03-09 22:27:08', 5, 1, NULL, '-0.0373276', '109.3315721', NULL, '1', '0'),
(40, 'BPeUXdBNh77DoKhMshVCCFcP3cFHlcQ6Ui0i1', '2022-03-16 00:41:53', 5, 3, NULL, '-0.042546965936468', '109.34730175534212', NULL, '1', '0'),
(42, 'FMjrQHP13B0E9M7NVaVHE0k8r4wYjBWG5YTGU', '2022-03-16 01:22:52', 5, 3, NULL, '-0.0483491', '109.3580817', NULL, '1', '0'),
(43, 'lnFF5sePlPcsHiqh27sVUdEZjjfaczfBckGpa', '2022-03-16 14:10:28', 5, 3, NULL, '-0.0373785', '109.3315976', NULL, '1', '0'),
(44, 'enV8iyIkqAeA3KJv2uTmCl9QpRmLjoBjXmArj', '2022-03-16 14:10:37', 5, 1, NULL, '-0.0373785', '109.3315976', NULL, '1', '0'),
(45, 'C5Bl810ZNqU5DW5xfVsHMVhEL5JSQbrdyp9jN', '2022-03-16 14:10:42', 5, 2, NULL, '-0.0373785', '109.3315976', NULL, '1', '0'),
(46, 'YAqjdaKG6EUC2hOc92hkypkoY3aa419DMPiWd', '2022-03-16 14:48:23', 5, 2, NULL, '-0.0373757', '109.331601', NULL, '1', '0'),
(47, 'nf2FICcHZINbfLiRIBT5Fi277qQMJL4p1tuuW', '2022-03-16 14:54:38', 5, 1, NULL, '-0.0373764', '109.3315807', NULL, '1', '0'),
(48, 'AXA3jL9QH5iqeWk7b5CBaCR9pfMx7eZI6CIfc', '2022-03-19 19:58:34', 5, 1, NULL, '-0.0557309', '109.3484548', NULL, '1', '0'),
(49, 'hUsqP5ZOUxmn2Z9U8T2ySATVNiRNsHhT7LaDa', '2022-03-19 19:58:37', 5, 2, NULL, '-0.0557309', '109.3484548', NULL, '1', '0'),
(50, '9ndNT4p50S2MFfOShndpZgKPn1zMenRueg2Cb', '2022-03-19 19:58:39', 5, 3, NULL, '-0.0557309', '109.3484548', NULL, '1', '0'),
(51, 'wUFsTRwMlhUeo2p7i7gglenzEBwkf5t0eTG7z', '2022-03-19 20:01:50', 5, 1, NULL, '-0.0557674', '109.3484679', NULL, '1', '0'),
(52, 'Hit4QaqUEjZ7gOIBFy9CDkJiBwnFk7Dg2lh3c', '2022-03-21 03:07:22', 5, 3, NULL, '-0.048357', '109.3580901', NULL, '1', '0'),
(53, 'xrZElVVGYVShhqC4NfKloXjdKByaqOdVPRnDL', '2022-03-21 03:07:32', 5, 2, NULL, '-0.048357', '109.3580901', NULL, '1', '0'),
(54, 'GBcv5YBiMMOHbRoBSDdUAh3j9VmhwFHG12dRF', '2022-03-23 14:26:57', 5, 3, NULL, '-0.0373455', '109.3315936', NULL, '1', '0'),
(55, 'qDJBVtLsrQ5JgVZ6OyORDZ6qc1oMfIxvwAtN3', '2022-03-23 14:27:14', 5, 2, NULL, '-0.0373455', '109.3315936', NULL, '1', '0'),
(56, 'Et6OnskzJDZvfRJXkvHNbnSNdOY4iXne36FTz', '2022-03-23 15:13:46', 5, 1, NULL, '-0.0373502', '109.3315962', NULL, '1', '0'),
(57, 'EFSDhrYpb2m8vP5epeaigYOSwxHPy24XwBh60', '2022-03-23 15:13:56', 5, 2, NULL, '-0.0373502', '109.3315962', NULL, '1', '0'),
(58, 'eQ14oU0rxJ91ozeucjrqZsZ9tnGpzTLDZnR92', '2022-03-28 22:27:00', 5, 3, NULL, '-0.01774570286550009', '109.33033093547364', NULL, '1', '0'),
(59, 'Oqz6ZthymwTxja2Zlsma7ozO9j2XoO5m4ZIMD', '2022-03-29 22:27:47', 5, 1, NULL, '-0.0196608', '109.3271552', NULL, '1', '0'),
(60, 'sAree3RQC9MeYwfmKA3xcnJRuboiJtO3PXP6S', '2022-03-29 22:51:01', 5, 3, NULL, '-0.020529835667375818', '109.326253977771', NULL, '1', '0'),
(61, '5B4vly16qDHgriZQ4zV9YHjOyXYuIe3TisS0L', '2022-03-30 00:06:22', 5, 3, NULL, '-0.01856277074564769', '109.32912461196919', NULL, '1', '0'),
(62, 'N1th0EFCR2FPZhARKcpnAypAgX2yeFIcEPkyX', '2022-03-30 00:06:38', 5, 1, NULL, '-0.0196608', '109.3271552', NULL, '1', '0'),
(63, 'wHENGs5CNTy3zZtAeS7m8z1uEC7Ww87tjs7Ye', '2022-03-30 00:06:40', 5, 2, NULL, '-0.02017578409974483', '109.32409479951401', NULL, '1', '0'),
(64, 'FXrMFRrKaVRcNxWaHRpS765jRTLIgyg583mUE', '2022-04-05 22:47:02', 5, 3, NULL, '-0.0380631', '109.3325119', NULL, '1', '0'),
(65, 'Zn75uIW6ZLdpo06UghYkUXkB9WfNFLQNZG74p', '2022-04-05 22:48:12', 5, 2, NULL, '-0.0380631', '109.3325119', NULL, '1', '0'),
(66, 'bA9GxsF5fFCbIZeX13ecMp8roK8l61Z6Yw7zL', '2022-04-08 22:58:48', 5, 1, NULL, '-0.0425984', '109.3337088', NULL, '1', '0'),
(67, 'ddXanAD8drkieyNJU4hi0jAN0c2aQAWFKcNY4', '2022-04-08 22:59:49', 5, 3, NULL, '-0.04302218890604321', '109.33104268423921', NULL, '1', '0'),
(68, '9GPtzkeNAZgeXRxVYk31qzKqnkvY5z788fkT8', '2022-04-13 22:49:11', 5, 3, NULL, '-0.03073850996821937', '109.32208021945608', NULL, '1', '0'),
(69, 'ENWDVTNxuEnzqUl0RmAJG6mM8uu8N5WZKh2KZ', '2022-04-13 22:50:12', 5, 1, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(70, 'nGaSsl1UBEjNtcqHlICfoRrQAtGmcjUUvSzLf', '2022-04-13 22:52:37', 5, 2, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(71, 'KvMoojlPm0tQG1eguaKCPXrj3fUmwZCqFiyN4', '2022-04-14 00:25:10', 5, 3, NULL, '-0.016515238440100465', '109.33255527735365', NULL, '1', '0'),
(72, 'w8dWvwdvxw48gAHpj3nwMahpCPXkT3CRcPJA8', '2022-04-14 15:18:14', 5, 2, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(73, 'RM4hjfHOzkwYHpBXsr6LbGvXCcUp9qEqhzinW', '2022-04-14 15:22:01', 5, 1, NULL, '-0.0263303', '109.3425039', NULL, '1', '0'),
(74, '1TG839QdlFKxSTpS8ft5d6hFbtdmW3DWeg9me', '2022-04-14 23:56:24', 5, 3, NULL, '-0.0373462', '109.3316013', NULL, '1', '0'),
(75, '8BDZeJ2xfZbrwMxrFU0MWz8WuhHzaQtJC2tCA', '2022-04-15 00:05:21', 3, 3, NULL, '-0.037332', '109.3316049', NULL, '1', '0'),
(76, 'aLann3S2WwItZ8DcZr9PsNXMAL6V0fPtxll5l', '2022-04-15 00:06:21', 3, 2, NULL, '-0.037332', '109.3316049', NULL, '1', '0'),
(77, 'KHnoSQaGwLcD4P5hNuL6qB6qBxXJSjkxGOvtM', '2022-04-20 21:01:39', 5, 3, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(78, 'zfPrFPkwiIzPv9lz5oGlU0L0SSJ6wFjkGQadd', '2022-04-29 15:17:01', 1, 3, NULL, '-0.05170546199294172', '109.34661129269865', NULL, '1', '0'),
(79, 'UuzDWMaVlJhjWEHf6Qbvw5dLstHx3TfxLFrW8', '2022-04-29 15:18:02', 1, 1, NULL, '-0.049152', '109.3500928', NULL, '1', '0'),
(80, 'YPagqY9SU73vkhzV7xsOfuGMh0Zx1TJmrMuTE', '2022-04-30 11:20:41', 1, 2, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(81, 'xYEfdQeIEfuOAL4ewfqWCT4H0Wf7naeGP41hP', '2022-04-30 11:21:43', 1, 3, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(82, 'aifUblZsCVISQPfBs4p7Yr1x2tj16a0gLPxub', '2022-05-17 18:51:09', 1, 3, NULL, '-0.03747894954540174', '109.33153505053188', NULL, '1', '0'),
(83, 'LfaTtCEVifpDddazfm6uUeEHEBgvN2sxRZaeR', '2022-05-18 22:36:33', 5, 3, NULL, '-5.1544064', '119.4459136', NULL, '1', '0'),
(84, 'Vp6va3n4iG9MXfSjEmBqc7HK1pVmdGAOv9JJe', '2022-05-18 22:37:36', 5, 2, NULL, '-5.1544064', '119.4459136', NULL, '1', '0'),
(85, '9TnnoD7RIWPYZ9XuLTV8COR2OSbwK5hc7bxez', '2022-05-18 22:39:56', 5, 3, NULL, '-5.1544064', '119.4491904', NULL, '1', '0'),
(86, 'ZsxwsYyOPad7MUbkO16sXMctIL3F0p7RHF3rW', '2022-05-18 22:40:58', 5, 2, NULL, '-5.1544064', '119.4491904', NULL, '1', '0'),
(87, '5H03EpJr3urufeAFKW1LTmshsZSlQAreCMAGc', '2022-06-03 18:09:03', 5, 3, NULL, '-0.0372249', '109.3317448', NULL, '1', '0'),
(88, 'yF78hC3S9ccnSBfKLQbhWLt6tcpGrPfkSJwqv', '2022-06-03 18:12:03', 5, 2, NULL, '-0.0372249', '109.3317448', NULL, '1', '0'),
(89, 'eP3XWnAnuHuEXeMvKaDowCygTViEnIdCY0HbG', '2022-06-03 18:24:12', 5, 2, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(90, 'zbRLvXCm1zpf85HkQXrOOYS9O6UN4XS9Gnenn', '2022-06-03 18:27:54', 5, 3, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(91, '0xqiy6HrK8wTu3tUwQbY5esQnZysWXEgYRKIz', '2022-06-03 18:53:39', 5, 1, NULL, '-0.044031', '109.3426422', NULL, '1', '0'),
(92, 'khL8VPO9IUhmeZv3161oC7o7g13A1OFRpOaep', '2022-06-05 10:50:07', 3, 3, NULL, '-7.2574719', '112.7520883', NULL, '1', '0'),
(93, 'OGKHMJkZEKmzBjQ71r4ELfeJriWQthuPWI0B6', '2022-06-07 09:10:18', 3, 3, NULL, '-7.2574719', '112.7520883', NULL, '1', '0'),
(94, 'Yv6d7aCEY5tr7GENNxUpRHbtf6BEnauDTVChJ', '2022-06-07 13:05:53', 3, 2, NULL, '-0.0616549', '109.3426422', NULL, '1', '0'),
(95, 'XZuAfazuMOOy2oAyKWQ0MyIqmp7C5AZzj7Ugb', '2022-06-11 07:00:25', 3, 3, NULL, '-0.05645599999999999', '109.353111', NULL, '1', '0'),
(99, 'PAVPpqCACbLisnLbRdt4N3dxaV20qmVJhMNgZ', '2022-06-11 19:11:08', 1, 3, NULL, '-0.0453215', '109.3426422', NULL, '1', '0'),
(100, '2UCG1IBo53sOaMpDYcOgmJ2RvTvprPmeuV9rx', '2022-06-11 19:15:32', 1, 3, NULL, '-0.05663115403032745', '109.35301872513121', NULL, '1', '0'),
(102, '8K0f9ECHgMERe0E7HTBz0Y3BQWs9p9Mk5d7HJ', '2022-06-12 12:42:20', 1, 3, NULL, '-0.056729', '109.3531679', NULL, '1', '0'),
(103, 'JEuegmjh2kgeHu072ZIjZsCaUkjQFsqiSaHIq', '2022-06-15 21:38:58', 3, 2, NULL, '-0.056458904009302965', '109.3531083630301', NULL, '1', '0'),
(104, '2Acogq630C2VwzpDFSrQSklcE5IcFp915CyyW', '2022-06-16 19:39:58', 3, 2, NULL, '-0.0353905583388126', '109.3252193322098', NULL, '1', '0'),
(106, '37JEiF9m9OMnYKTT4o4VgRGcKXiirHbRbP0y1', '2022-06-18 09:23:12', 5, 2, NULL, '-5.1476651', '119.4327314', NULL, '1', '0'),
(107, '1FRwh42Sl0mr2vVq30YpXO4cLCf3C2lsKbrOk', '2022-06-18 12:41:50', 5, 3, NULL, '-0.0567132', '109.3531502', NULL, '1', '0'),
(108, 'wTiklYxRo6VwceCnjAkXVH72HrzU9YwXlODWQ', '2022-06-19 09:21:47', 5, 3, NULL, '-5.093294633770022', '119.51135231064454', NULL, '1', '0'),
(109, 'B7mP2k8PH7m5sBhg6JThTN8p1RLW8ONbEqTs9', '2022-06-19 22:03:17', 5, 2, NULL, '-0.05479917730219954', '109.34932090044707', NULL, '1', '0'),
(110, 'OhuhRIYN3dHQQxL374HKs8WWpgIsqzJ1uid94', '2022-06-20 08:19:07', 5, 3, NULL, '-0.0483762', '109.3582263', NULL, '1', '0'),
(111, 'yFkPxtpy96fORFG1zcBAtyqvKrth65Wpx9P57', '2022-06-20 09:59:09', 3, 3, NULL, '-0.048590086338625674', '109.3572556899364', NULL, '1', '0'),
(112, 'KbHRCKTEflULiShN3TG7JGiz4khphvjQtjS1k', '2022-06-21 13:50:45', 5, 3, NULL, '-0.032768', '109.3402624', NULL, '1', '0'),
(113, 'iTLG1gt28mUaUfQy8K1h7Po3YpY0PuMmROOhe', '2022-06-21 14:38:20', 5, 2, NULL, '-0.0372251', '109.3317579', NULL, '1', '0'),
(114, 'VlJeQzg6X1PtDcxyFYhZG9yOTgSMTOs1QvWXL', '2022-07-11 07:24:42', 3, 3, NULL, '-5.1478528', '119.4524672', NULL, '0', '0'),
(115, 'erF3pZ1PjkxDcbovnaCjhl5TD9CIvkBop4YPG', '2022-07-12 00:54:25', 3, 3, NULL, '-0.0287628', '109.3298604', NULL, '0', '0'),
(116, 'T2mlqVwPWehNFdxWHTiDhekExpGuFT46F1WzX', '2022-10-25 19:56:00', 1, 3, NULL, '-0.044031', '109.3426422', NULL, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_korban`
--

CREATE TABLE `tb_laporan_korban` (
  `id_laporan_korban` bigint(10) NOT NULL,
  `id_laporan` bigint(10) NOT NULL,
  `id_kategori_korban` int(10) NOT NULL,
  `jumlah_korban` int(5) NOT NULL,
  `deskripsi` text,
  `input_by` enum('personil','pelapor') NOT NULL,
  `id_user_input` int(10) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_laporan_korban`
--

INSERT INTO `tb_laporan_korban` (`id_laporan_korban`, `id_laporan`, `id_kategori_korban`, `jumlah_korban`, `deskripsi`, `input_by`, `id_user_input`, `create_datetime`, `update_datetime`) VALUES
(2, 114, 2, 1, 'test', 'pelapor', 3, '2022-07-11 09:15:30', NULL),
(4, 114, 2, 12, 'Butuh pertolongan segera', 'pelapor', 3, '2022-07-11 09:49:28', NULL),
(5, 114, 1, 2, 'Butuh ambulance segera', 'pelapor', 3, '2022-07-11 10:06:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pangkat_personil`
--

CREATE TABLE `tb_pangkat_personil` (
  `id_pangkat` int(11) NOT NULL,
  `pangkat` text NOT NULL,
  `singkatan` text NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pangkat_personil`
--

INSERT INTO `tb_pangkat_personil` (`id_pangkat`, `pangkat`, `singkatan`, `create_datetime`, `update_datetime`, `aktif`) VALUES
(1, 'Jenderal Polisi', 'JENDERAL POLISI', '2022-02-21 16:17:29', '2022-02-22 13:16:12', 'Y'),
(2, 'Komisaris Jenderal Polisi', 'KOMJEN', '2022-02-21 16:17:29', '2022-03-09 13:17:09', 'Y'),
(3, 'Inspektur Jenderal PolisI', 'IRJEN', '2022-02-21 16:17:29', NULL, 'Y'),
(4, 'Brigadir Jenderal Polisi', 'BRIGJEN', '2022-02-21 16:17:29', NULL, 'Y'),
(5, 'Komisaris Besar Polisi', 'KOMBESPOL', '2022-02-21 16:17:29', NULL, 'Y'),
(6, 'Ajun Komisaris Besar Polisi', 'AKBP', '2022-02-21 16:17:29', NULL, 'Y'),
(7, 'Komisaris Polisi', 'KOMPOL', '2022-02-21 16:17:29', NULL, 'Y'),
(8, 'Ajun Komisaris Polisi', 'AKP', '2022-02-21 16:17:29', NULL, 'Y'),
(9, 'Inspektur Polisi Satu', 'IPTU', '2022-02-21 16:17:29', NULL, 'Y'),
(10, 'Inspektur Polisi Dua', 'IPDA', '2022-02-21 16:17:29', NULL, 'Y'),
(11, 'Ajun Inspektur Satu', 'AIPTU', '2022-02-21 16:17:29', NULL, 'Y'),
(12, 'Ajun Inspektur Dua', 'AIPDA', '2022-02-21 16:17:29', NULL, 'Y'),
(13, 'Brigadir Polisi Kepala', 'BRIPKA', '2022-02-21 16:17:29', NULL, 'Y'),
(14, 'Brigadir Polisi', 'BRIGPOL', '2022-02-21 16:17:29', NULL, 'Y'),
(15, 'Brigadir Polisi Satu', 'BRIPTU', '2022-02-21 16:17:29', NULL, 'Y'),
(16, 'Brigadir Polisi Dua', 'BRIPDA', '2022-02-21 16:17:29', NULL, 'Y'),
(17, 'Ajun Brigadir Polisi', 'ABRIPOL', '2022-02-21 16:17:29', NULL, 'Y'),
(18, 'Ajun Brigadir Satu', 'ABRIPTU', '2022-02-21 16:17:29', NULL, 'Y'),
(19, 'Ajun Brigadir Dua', 'ABRIPDA', '2022-02-21 16:17:29', NULL, 'Y'),
(20, 'Bhayangkara Kepala', 'BHARAKA', '2022-02-21 16:17:29', NULL, 'Y'),
(21, 'Bhayangkara Satu', 'BHARATU', '2022-02-21 16:17:29', NULL, 'Y'),
(22, 'Bhayangkara Dua', 'BHARADA', '2022-02-21 16:17:29', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelapor`
--

CREATE TABLE `tb_pelapor` (
  `id_pelapor` int(10) NOT NULL,
  `google_id` text NOT NULL,
  `nama_lengkap` text NOT NULL,
  `nik` varchar(16) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `foto` text,
  `status` enum('0','1') NOT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pelapor`
--

INSERT INTO `tb_pelapor` (`id_pelapor`, `google_id`, `nama_lengkap`, `nik`, `tanggal_lahir`, `alamat`, `no_hp`, `email`, `foto`, `status`, `latitude`, `longitude`, `last_login`, `create_datetime`, `update_datetime`) VALUES
(1, '109122807979405606847', 'Ronaldo Pei Piro', '0283023023020320', '2021-11-01', 'Jl. Imam Bonjol, Pontianak Tenggara, Kota Pontianak', '089978776655', 'ronaldopeipiro@student.untan.ac.id', '1654996664_9ae609303235681b77d8.png', '1', '-0.044031', '109.3426422', '2021-11-10 08:42:44', '2021-11-10 08:42:44', '2022-06-12 08:17:44'),
(2, '112683968497211221968', 'Ronaldo Pei Piro', '0283023023020321', '2021-11-11', 'Jl. Adisucipto, Bansir Laut, Pontianak, Kalimantan Barat', '085750597580', 'ffdf487@gmail.com', '1636778822_4f4ce0680e97a8f7ff1a.jpg', '1', '-0.048354', '109.3580166', '2021-11-10 10:32:30', '2021-11-10 10:32:30', '2021-11-13 04:47:02'),
(3, '100188469418052439975', 'Ronaldo Pei Piro', '6202032000300001', '2022-01-21', 'Jl. Imam Bonjol, No.99, Pontianak Tenggara, Kota Pontianak, Kalimantan Barat', '085161671197', 'ronaldopeipiro11@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14Ggda1SH6Njbmk8uwudnrpRHI-fQYeWEyZiHMa0v1A=s96-c', '1', '-0.016384', '109.3664768', '2021-11-15 04:39:30', '2021-11-15 04:39:30', '2022-02-14 15:49:03'),
(4, '117252084143886119019', 'Wiwin galuh prayetno', NULL, NULL, NULL, NULL, 'wiwingaluhprayetno@student.untan.ac.id', '1639125371_e65a870c5de6a4208d2d.png', '1', '-0.0558466', '109.3485219', '2021-12-10 08:35:05', '2021-12-10 08:35:05', '2021-12-10 08:36:11'),
(5, '114506006396026335310', 'Ronaldo Pei Piro', '1010102019201920', '2022-02-24', 'Jl. Jaya Baru, Singkawang, Kalimantan Barat', '085980801919', 'ronaldopeipiro@gmail.com', '1645694872_4552aee168583b6f1315.jpg', '1', '-0.032768', '109.3402624', '2022-02-24 07:39:24', '2022-02-24 07:39:24', '2022-02-24 09:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `tb_personil`
--

CREATE TABLE `tb_personil` (
  `id_personil` int(10) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `nrp` varchar(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_satker` int(10) DEFAULT NULL,
  `id_pangkat` int(10) DEFAULT NULL,
  `jabatan` text,
  `no_hp` varchar(15) DEFAULT NULL,
  `email` text NOT NULL,
  `foto` text,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `status_akun` enum('0','1','2') NOT NULL,
  `aktif` enum('0','1') NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `token_reset_password` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_personil`
--

INSERT INTO `tb_personil` (`id_personil`, `nama_lengkap`, `nrp`, `password`, `id_satker`, `id_pangkat`, `jabatan`, `no_hp`, `email`, `foto`, `latitude`, `longitude`, `status_akun`, `aktif`, `last_login`, `create_datetime`, `update_datetime`, `token_reset_password`) VALUES
(2, 'Ronaldo Pei Piro', '12345678', '$2y$10$dQV2vNVGhJilLd9hzQawL.M25MuqsIjsG8Sr2BXnG8l/ILgKI/1jO', 2, 15, NULL, '085161671197', 'ronaldopeipiro@gmail.com', '1655770052_855af50f022f4413c5a9.png', '-5.1478528', '119.4491904', '1', '1', '2022-06-25 08:01:53', '2021-10-26 18:25:58', NULL, ''),
(3, 'Gregorius Dicky C.', '12341234', '$2y$10$w8UNkayC2lP5KbkZMjuOI.8a/aOPdZ8yJz8fAG45c/9XLNwOR9wL.', 1, 16, NULL, '085750597580', 'edwargre@gmail.com', '1645631916_b5b287b19c9b5f93f6be.png', '-5.1511296', '119.4524672', '1', '1', '2022-07-12 06:34:37', '2021-10-26 18:27:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_push_notif`
--

CREATE TABLE `tb_push_notif` (
  `id_push_notif` bigint(10) NOT NULL,
  `id_user` bigint(10) NOT NULL,
  `tipe_user` enum('pelapor','personil') NOT NULL,
  `endpoint` text NOT NULL,
  `p256dh` text NOT NULL,
  `auth` text NOT NULL,
  `create_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_satker_personil`
--

CREATE TABLE `tb_satker_personil` (
  `id_satker` int(11) NOT NULL,
  `nama_satker` text NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_datetime` datetime DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_satker_personil`
--

INSERT INTO `tb_satker_personil` (`id_satker`, `nama_satker`, `create_datetime`, `update_datetime`, `aktif`) VALUES
(1, 'DITLANTAS POLDA KALBAR', '2022-02-21 16:07:30', '2022-02-21 16:08:43', 'Y'),
(2, 'SATLANTAS POLRESTA PONTIANAK KOTA', '2022-02-21 16:09:20', NULL, 'Y'),
(3, 'SATLANTAS POLRES KUBU RAYA', '2022-02-21 16:09:47', NULL, 'Y'),
(4, 'SATLANTAS POLRES SINGKAWANG', '2022-03-21 02:27:29', NULL, 'Y'),
(5, 'SATLANTAS POLRES SAMBAS', '2022-03-21 02:27:35', NULL, 'Y'),
(6, 'SATLANTAS POLRES BENGKAYANG', '2022-03-21 02:27:41', NULL, 'Y'),
(7, 'SATLANTAS POLRES MEMPAWAH', '2022-03-21 02:27:48', NULL, 'Y'),
(8, 'SATLANTAS POLRES LANDAK', '2022-03-21 02:27:54', NULL, 'Y'),
(9, 'SATLANTAS POLRES SINTANG', '2022-03-21 02:28:01', NULL, 'Y'),
(10, 'SATLANTAS POLRES SANGGAU', '2022-03-21 02:28:08', NULL, 'Y'),
(11, 'SATLANTAS POLRES MELAWI', '2022-03-21 02:28:15', NULL, 'Y'),
(12, 'SATLANTAS POLRES KAPUAS HULU', '2022-03-21 02:28:21', NULL, 'Y'),
(13, 'SATLANTAS POLRES KAYONG UTARA', '2022-03-21 02:28:26', NULL, 'Y'),
(14, 'SATLANTAS POLRES KETAPANG', '2022-03-21 02:28:32', NULL, 'Y'),
(15, 'SATLANTAS POLRES SEKADAU', '2022-03-21 02:29:59', NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tindakan_personil`
--

CREATE TABLE `tb_tindakan_personil` (
  `id_tindakan` bigint(10) NOT NULL,
  `id_jenis_tindakan` int(10) NOT NULL,
  `id_laporan` int(10) NOT NULL,
  `id_personil` int(10) NOT NULL,
  `latitude` text,
  `longitude` text,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_tindakan_personil`
--

INSERT INTO `tb_tindakan_personil` (`id_tindakan`, `id_jenis_tindakan`, `id_laporan`, `id_personil`, `latitude`, `longitude`, `waktu`) VALUES
(1, 1, 107, 3, '-0.0567132', '109.3531502', '2022-06-19 09:09:19'),
(2, 1, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 10:06:52'),
(3, 3, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 10:16:51'),
(4, 2, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 11:02:12'),
(5, 7, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 11:02:21'),
(6, 4, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 15:41:26'),
(7, 6, 108, 3, '-5.093294633770022', '119.51135231064454', '2022-06-19 15:42:16'),
(8, 1, 109, 3, '-0.05479917730219954', '109.34932090044707', '2022-06-19 22:21:34'),
(9, 2, 109, 3, '-0.05479917730219954', '109.34932090044707', '2022-06-19 22:43:36'),
(10, 5, 109, 3, '-0.05479917730219954', '109.34932090044707', '2022-06-20 07:00:44'),
(11, 7, 109, 3, '-0.05479917730219954', '109.34932090044707', '2022-06-20 07:40:22'),
(12, 1, 110, 3, '-0.0483762', '109.3582263', '2022-06-20 09:13:39'),
(13, 1, 110, 3, '-0.0483762', '109.3582263', '2022-06-20 09:14:41'),
(17, 1, 111, 2, '-0.048590086338625674', '109.3572556899364', '2022-06-21 05:43:03'),
(18, 1, 104, 2, '-0.0353905583388126', '109.3252193322098', '2022-06-21 07:02:00'),
(19, 2, 104, 2, '-0.0353905583388126', '109.3252193322098', '2022-06-21 07:10:37'),
(20, 1, 112, 2, '-0.032768', '109.3402624', '2022-06-21 13:57:22'),
(21, 2, 111, 2, '-0.048590086338625674', '109.3572556899364', '2022-06-25 08:19:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_foto_laporan`
--
ALTER TABLE `tb_foto_laporan`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `tb_foto_tindakan_personil`
--
ALTER TABLE `tb_foto_tindakan_personil`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `tb_jenis_tindakan_personil`
--
ALTER TABLE `tb_jenis_tindakan_personil`
  ADD PRIMARY KEY (`id_jenis_tindakan`);

--
-- Indexes for table `tb_kategori_kecelakaan`
--
ALTER TABLE `tb_kategori_kecelakaan`
  ADD PRIMARY KEY (`id_kategori_kecelakaan`);

--
-- Indexes for table `tb_kategori_korban`
--
ALTER TABLE `tb_kategori_korban`
  ADD PRIMARY KEY (`id_kategori_korban`);

--
-- Indexes for table `tb_kategori_laporan`
--
ALTER TABLE `tb_kategori_laporan`
  ADD PRIMARY KEY (`id_kategori_laporan`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_laporan_korban`
--
ALTER TABLE `tb_laporan_korban`
  ADD PRIMARY KEY (`id_laporan_korban`);

--
-- Indexes for table `tb_pangkat_personil`
--
ALTER TABLE `tb_pangkat_personil`
  ADD PRIMARY KEY (`id_pangkat`);

--
-- Indexes for table `tb_pelapor`
--
ALTER TABLE `tb_pelapor`
  ADD PRIMARY KEY (`id_pelapor`);

--
-- Indexes for table `tb_personil`
--
ALTER TABLE `tb_personil`
  ADD PRIMARY KEY (`id_personil`);

--
-- Indexes for table `tb_push_notif`
--
ALTER TABLE `tb_push_notif`
  ADD PRIMARY KEY (`id_push_notif`);

--
-- Indexes for table `tb_satker_personil`
--
ALTER TABLE `tb_satker_personil`
  ADD PRIMARY KEY (`id_satker`);

--
-- Indexes for table `tb_tindakan_personil`
--
ALTER TABLE `tb_tindakan_personil`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_foto_laporan`
--
ALTER TABLE `tb_foto_laporan`
  MODIFY `id_foto` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_foto_tindakan_personil`
--
ALTER TABLE `tb_foto_tindakan_personil`
  MODIFY `id_foto` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jenis_tindakan_personil`
--
ALTER TABLE `tb_jenis_tindakan_personil`
  MODIFY `id_jenis_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_kategori_kecelakaan`
--
ALTER TABLE `tb_kategori_kecelakaan`
  MODIFY `id_kategori_kecelakaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori_korban`
--
ALTER TABLE `tb_kategori_korban`
  MODIFY `id_kategori_korban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_kategori_laporan`
--
ALTER TABLE `tb_kategori_laporan`
  MODIFY `id_kategori_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tb_laporan_korban`
--
ALTER TABLE `tb_laporan_korban`
  MODIFY `id_laporan_korban` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_pangkat_personil`
--
ALTER TABLE `tb_pangkat_personil`
  MODIFY `id_pangkat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_pelapor`
--
ALTER TABLE `tb_pelapor`
  MODIFY `id_pelapor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_personil`
--
ALTER TABLE `tb_personil`
  MODIFY `id_personil` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_push_notif`
--
ALTER TABLE `tb_push_notif`
  MODIFY `id_push_notif` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_satker_personil`
--
ALTER TABLE `tb_satker_personil`
  MODIFY `id_satker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_tindakan_personil`
--
ALTER TABLE `tb_tindakan_personil`
  MODIFY `id_tindakan` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
