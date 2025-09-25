-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2025 pada 04.30
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aisyiyah`
--

-- --------------------------------------------------------

--
-- Struktur untuk view `pasienpersrajal`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pasienpersrajal`  AS SELECT `persetujuanrajal`.`id` AS `id`, `persetujuanrajal`.`noRm` AS `noRm`, `persetujuanrajal`.`nama` AS `nama`, `persetujuanrajal`.`noHp` AS `noHp`, `persetujuanrajal`.`alamat` AS `alamatWali`, `persetujuanrajal`.`petugas` AS `petugas`, `persetujuanrajal`.`saksi` AS `saksi`, `persetujuanrajal`.`sebagai` AS `sebagai`, `persetujuanrajal`.`keluarga` AS `keluarga`, `persetujuanrajal`.`selesai` AS `selesai`, `persetujuanrajal`.`pembayaran` AS `pembayaran`, `persetujuanrajal`.`tglinput` AS `tglinput`, `sik`.`pasien`.`no_rkm_medis` AS `no_rkm_medis`, `sik`.`pasien`.`no_ktp` AS `no_ktp`, `sik`.`pasien`.`nm_pasien` AS `nm_pasien`, `sik`.`pasien`.`alamat` AS `alamat`, `sik`.`pasien`.`tgl_lahir` AS `tgl_lahir`, `sik`.`pasien`.`jk` AS `jk`, `sik`.`pasien`.`no_tlp` AS `no_telp` FROM (`persetujuanrajal` join `sik`.`pasien` on(`persetujuanrajal`.`noRm` = `sik`.`pasien`.`no_rkm_medis`)) ;

--
-- VIEW `pasienpersrajal`
-- Data: Tidak ada
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
