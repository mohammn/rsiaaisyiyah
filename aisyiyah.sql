-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2025 pada 19.14
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
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `noRm` varchar(7) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `tanggalLahir` date NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id`, `noRm`, `nik`, `nama`, `alamat`, `tanggalLahir`, `status`) VALUES
(3, '123456', '3526028273990001', 'Salimin bin mafua', 'Jaddih utara', '2025-09-15', 'ranap'),
(4, '213212', '3529384380000002', 'Siti Maryani', 'Geger bangkalan', '2025-09-15', 'rajal'),
(5, '372724', '3526019388800002', 'Evi sutanti', 'Bangkalan gebang', '2025-09-15', 'rajal'),
(6, '002233', '3524771000010002', 'FINDRIYANI DWI KUSASIB', 'BILAPORAH UTARA', '1997-07-19', 'rajal');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `pasienskorpoedji`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `pasienskorpoedji` (
`id` int(11)
,`noRm` varchar(15)
,`i` varchar(64)
,`ii` varchar(64)
,`iii` varchar(64)
,`iiii` varchar(64)
,`no_rkm_medis` varchar(15)
,`no_ktp` varchar(20)
,`nm_pasien` varchar(40)
,`alamat` varchar(200)
,`tgl_lahir` date
,`jk` enum('L','P')
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skorpoedji`
--

CREATE TABLE `skorpoedji` (
  `id` int(11) NOT NULL,
  `noRm` varchar(15) NOT NULL,
  `i` varchar(64) NOT NULL,
  `ii` varchar(64) NOT NULL,
  `iii` varchar(64) NOT NULL,
  `iiii` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skorpoedji`
--

INSERT INTO `skorpoedji` (`id`, `noRm`, `i`, `ii`, `iii`, `iiii`) VALUES
(1, '001348', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a3a0a7a0a2', '1a2a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a3a0', '2a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a8', '1a0a0a0a0a0a0a0a0a0a0a0a0a6a0a0a0a0a0a0a0a0a0a0a0a6a0a2a0'),
(4, '000003', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a5a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a4a0a6a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a3a0a0a0a7a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a2a0a0a0a0a0a8'),
(6, '000005', '1a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a2a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a3a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a4a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'),
(7, '000006', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a2a0a0a0a3a0a0a0a0a0a0a0a5a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a2a0a0a0a2a0a0a0a0a0a0a0a6a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'),
(12, '000971', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'),
(13, ' 001828', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a1', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0'),
(14, '001220', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0', '0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0a0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `rule` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `rule`) VALUES
(1, 'Andi', '$2y$10$yuPmzFjZKTHojkqnWote0Ob.jR4M9PbRwgN7FrkXs8Z.CLw0ygA86', '1'),
(8, 'FINDRIYANI DWI KUSASI,S.Tr.Kes', '$2y$10$UCjzWC.JNjGYfnWWq7xGueM9Z7uCQYjVdPSkLAH6r4HXgXNRZ82o6', '0');

-- --------------------------------------------------------

--
-- Struktur untuk view `pasienskorpoedji`
--
DROP TABLE IF EXISTS `pasienskorpoedji`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pasienskorpoedji`  AS SELECT `skorpoedji`.`id` AS `id`, `skorpoedji`.`noRm` AS `noRm`, `skorpoedji`.`i` AS `i`, `skorpoedji`.`ii` AS `ii`, `skorpoedji`.`iii` AS `iii`, `skorpoedji`.`iiii` AS `iiii`, `sik`.`pasien`.`no_rkm_medis` AS `no_rkm_medis`, `sik`.`pasien`.`no_ktp` AS `no_ktp`, `sik`.`pasien`.`nm_pasien` AS `nm_pasien`, `sik`.`pasien`.`alamat` AS `alamat`, `sik`.`pasien`.`tgl_lahir` AS `tgl_lahir`, `sik`.`pasien`.`jk` AS `jk` FROM (`skorpoedji` join `sik`.`pasien` on(`skorpoedji`.`noRm` = `sik`.`pasien`.`no_rkm_medis`)) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skorpoedji`
--
ALTER TABLE `skorpoedji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `skorpoedji`
--
ALTER TABLE `skorpoedji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
