-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Bulan Mei 2024 pada 17.37
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PeminjamanIT`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `idUser` int(11) NOT NULL,
  `sEmpID` varchar(50) NOT NULL,
  `sFullname` varchar(150) DEFAULT NULL,
  `sPassword` text NOT NULL,
  `sRole` varchar(30) NOT NULL DEFAULT 'user',
  `dtCreate` datetime DEFAULT current_timestamp(),
  `iCreateBy` int(11) DEFAULT 0,
  `dtModify` datetime DEFAULT NULL,
  `iModifyBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`idUser`, `sEmpID`, `sFullname`, `sPassword`, `sRole`, `dtCreate`, `iCreateBy`, `dtModify`, `iModifyBy`) VALUES
(1, '752846', 'Arif Febriana', '6a9d383e1e2a64942429e2af2ce5330a082138603e6e1a12e922fc6db157886cc3ce83724ecf2cb97fb57b32c181dc3a1f50136760630618dee8553cb9337e18Fy0WL9+esD6+ROyrg7JrlHxMKtHkAUYvoKQ1zGpHQEU=', 'admin', '2024-05-04 01:04:47', 0, NULL, NULL),
(2, '123987', 'Rama Wijaya', '6a9d383e1e2a64942429e2af2ce5330a082138603e6e1a12e922fc6db157886cc3ce83724ecf2cb97fb57b32c181dc3a1f50136760630618dee8553cb9337e18Fy0WL9+esD6+ROyrg7JrlHxMKtHkAUYvoKQ1zGpHQEU=', 'admin', '2024-05-04 21:35:44', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
