-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2025 pada 04.29
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
-- Struktur dari tabel `persetujuanrajal`
--

CREATE TABLE `persetujuanrajal` (
  `id` int(11) NOT NULL,
  `noRm` varchar(15) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `noHp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `sebagai` varchar(16) NOT NULL,
  `petugas` varchar(64) NOT NULL,
  `saksi` varchar(64) NOT NULL,
  `keluarga` text NOT NULL,
  `pembayaran` varchar(32) NOT NULL,
  `selesai` varchar(1) NOT NULL DEFAULT '0',
  `tglinput` date NOT NULL DEFAULT current_timestamp(),
  `ttdWali` longtext NOT NULL,
  `ttdSaksi` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `persetujuanrajal`
--

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `persetujuanrajal`
--
ALTER TABLE `persetujuanrajal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `persetujuanrajal`
--
ALTER TABLE `persetujuanrajal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
