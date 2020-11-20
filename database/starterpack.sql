-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2020 at 03:21 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_user`
--

CREATE TABLE `access_user` (
  `id_access_menu` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `access_user`
--

INSERT INTO `access_user` (`id_access_menu`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(7, 2, 3),
(8, 2, 2),
(9, 3, 2),
(10, 4, 2),
(18, 1, 8),
(24, 12, 2),
(28, 1, 15),
(29, 1, 16),
(30, 1, 17),
(31, 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `id_cabang` varchar(32) NOT NULL,
  `nama_cabang` varchar(64) NOT NULL,
  `alamat` varchar(128) NOT NULL,
  `status_cabang` varchar(128) NOT NULL,
  `pemilik_cabang` varchar(64) NOT NULL,
  `latitude` varchar(128) NOT NULL,
  `longitude` varchar(128) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`id_cabang`, `nama_cabang`, `alamat`, `status_cabang`, `pemilik_cabang`, `latitude`, `longitude`, `keterangan`) VALUES
('CB001', 'Cabang Kediri', 'Kabupaten Kediri', 'Aktif', 'Bapak Gunawawan', '-7.821207944438944', '111.99885635809143', 'menjual berbagaimacam kulit kopi'),
('CB002', 'Cabang Surakarta', 'Surakarta Pusat', 'Aktif', 'Bapak Gunadi', '-7.634775927004439', '110.83111640841167', 'menjual berbagaimacam kulit kopi dan Kebutuhan Kopi'),
('CB003', 'Cabang Singapore', 'Singapore', 'Aktif', 'Mr. Brobot', '1.1864386394452024', '103.93126413504211', 'Menjual seni dengan kopi');

-- --------------------------------------------------------

--
-- Table structure for table `dt_brg`
--

CREATE TABLE `dt_brg` (
  `id_brg` varchar(32) NOT NULL,
  `nama_brg` varchar(128) NOT NULL,
  `id_ktg` varchar(15) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `harga_brg` int(15) NOT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dt_brg`
--

INSERT INTO `dt_brg` (`id_brg`, `nama_brg`, `id_ktg`, `gambar`, `harga_brg`, `stok`) VALUES
('BR001', 'Testing 2', '1', '4hVHDzO1.jpg', 12300, 12);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Barang Jadi'),
(2, 'Bahan Jadi');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_user`
--

CREATE TABLE `submenu_user` (
  `id_submenu` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submenu_user`
--

INSERT INTO `submenu_user` (`id_submenu`, `menu_id`, `title`, `url`, `is_active`) VALUES
(2, 1, 'Dashboard', 'admin', 1),
(3, 2, 'My Profile', 'user', 1),
(4, 2, 'Edit Profile', 'user/edit', 1),
(5, 3, 'Management Menu', 'menu', 1),
(6, 3, 'Sub Menu Management', 'menu/submenu', 1),
(7, 1, 'Role', 'admin/role', 1),
(8, 2, 'Edit Password', 'user/edit_password', 1),
(24, 15, 'Management Barang', 'barang', 1),
(25, 15, 'Kategori Barang', 'barang/kategori', 1),
(26, 16, 'Home GIS', 'C_gis/home', 1),
(27, 16, 'Mapping', 'C_gis/mapping', 1),
(28, 17, 'Management User', 'C_user', 1),
(29, 18, 'Management Barang', 'barang', 1);

-- --------------------------------------------------------

--
-- Table structure for table `token_user`
--

CREATE TABLE `token_user` (
  `id_token` int(15) NOT NULL,
  `email` varchar(64) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token_user`
--

INSERT INTO `token_user` (`id_token`, `email`, `token`, `date_created`) VALUES
(19, 'khafid@polije.ac.id', '1K/3t4mzIrX5qc36SjVVwAMq6UyBryLEd+LPO4q2j4s=', 1604324755),
(20, 'bagoesihsant12@gmail.coma', 'ZP4Stdry7F/nDd0B164DpPu/mj/d4cPeJzzNxWn6oUg=', 1604324900),
(21, 'bagoesihsant@gmail.comas', 'E7ha+NWbkxhPsGp+/GHbpLFDcMysFvbM1lEj33vzLNc=', 1604325083);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(40) NOT NULL,
  `nama` varchar(48) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `email` varchar(48) NOT NULL,
  `username` varchar(20) NOT NULL,
  `notelp` varchar(13) NOT NULL,
  `profile_image` varchar(48) NOT NULL,
  `password` varchar(64) NOT NULL,
  `about` varchar(64) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(15) NOT NULL,
  `update_at` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `tanggal_lahir`, `email`, `username`, `notelp`, `profile_image`, `password`, `about`, `role_id`, `is_active`, `date_created`, `update_at`) VALUES
('ID-U11302', 'Alfian Rochmatul Irman', 'Kediri, Kec.Ngadiluwih', '1999-01-07', 'admin@admin.com', 'alfiannsx98', '081252223123', 'IMG-20190926-WA00371.jpg', '$2y$10$rA4uod33NMm97udn9WHda.ycsAZeqDE3sOCoLpPRP/ZJdoGSXjyYG', 'Wani Tok! yotoasddsa', 1, 1, 1583394165, 1586009053),
('USR2140120511118', 'Taufik Ikhsan', 'Kec. Sidoarjo, Kab. Sidoarjo', '1998-10-12', 'bagoesihsant@gmail.com', 'taufiq99', '0812523123122', 'default.jpg', '$2y$10$5EkPTWEFYT.CEm4YGhJeAOtwkuIf7vNy9jHMIoQbxAOrTm4oiXpim', 'engko ae', 2, 0, 1604238678, 0),
('USR3150120151124', 'cobabanget', 'jalan_$_/_sI', '2020-05-01', 'alfianrochmatul77@gmail.com', 'testing101', '+628231230921', 'default.jpg', '', '&lt;h1&gt;BANZAI&lt;/h1&gt;', 1, 1, 1604240124, 0),
('USR4140220481120', 'test112', 'asddddddsadsad', '2020-11-02', 'bagoesihsant12@gmail.coma', 'suryaadhy235aa', '123123213', 'default.jpg', '', 'sdaasd', 1, 0, 1604324900, 0),
('USR5140220511123', 'asdsda', 'asdasddai8yoiuj', '2020-11-17', 'bagoesihsant@gmail.comas', 'suryaadhy235aa9', '1221312321', 'default.jpg', '', 'adsojjoijio', 1, 0, 1604325083, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(32) NOT NULL,
  `icon` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id_menu`, `menu`, `icon`) VALUES
(1, 'admin', 'fas fa-tachometer-alt'),
(2, 'user', 'fas fa-users'),
(3, 'menu', 'fas fa-bars'),
(16, 'C_gis', 'fas fa-map-marked-alt'),
(17, 'C_user', 'fas fa-table');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'operator'),
(3, 'kurir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_user`
--
ALTER TABLE `access_user`
  ADD PRIMARY KEY (`id_access_menu`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `dt_brg`
--
ALTER TABLE `dt_brg`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `submenu_user`
--
ALTER TABLE `submenu_user`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `token_user`
--
ALTER TABLE `token_user`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_user`
--
ALTER TABLE `access_user`
  MODIFY `id_access_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `submenu_user`
--
ALTER TABLE `submenu_user`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `token_user`
--
ALTER TABLE `token_user`
  MODIFY `id_token` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
