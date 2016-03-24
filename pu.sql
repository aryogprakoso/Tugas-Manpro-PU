-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Mar 2016 pada 16.10
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `namaAdmin` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE IF NOT EXISTS `artikel` (
  `idArtikel` int(3) NOT NULL,
  `judulArtikel` varchar(30) NOT NULL,
  `isiArtikel` varchar(300) NOT NULL,
  `waktu` date NOT NULL,
  `pathGambar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `idBerita` int(3) NOT NULL,
  `judulBerita` varchar(20) NOT NULL,
  `isiBerita` varchar(300) NOT NULL,
  `waktu` date NOT NULL,
  `pathGambar` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE IF NOT EXISTS `galeri` (
  `idGaleri` int(3) NOT NULL,
  `pathGambar` blob NOT NULL,
  `keteranganGambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `idPeminjaman` int(3) NOT NULL,
  `idPenanggungJawab` int(3) NOT NULL,
  `ruang` enum('Kapel Atas','Kapel Bawah','','') NOT NULL,
  `alatMusik` tinyint(1) NOT NULL,
  `alatPeribadatan` tinyint(1) NOT NULL,
  `alatElektronik` tinyint(1) NOT NULL,
  `waktuPeminjaman` date NOT NULL,
  `keteranganPeminjaman` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggungjawab`
--

CREATE TABLE IF NOT EXISTS `penanggungjawab` (
  `idPenanggungJawab` int(3) NOT NULL,
  `namaPenanggungJawab` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `idStaff` int(3) NOT NULL,
  `namaStaff` varchar(30) NOT NULL,
  `jabatanStaff` enum('Ketua','Pegawai','','') NOT NULL,
  `emailStaff` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`namaAdmin`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
 ADD PRIMARY KEY (`idArtikel`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
 ADD PRIMARY KEY (`idBerita`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
 ADD PRIMARY KEY (`idGaleri`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
 ADD PRIMARY KEY (`idPeminjaman`), ADD KEY `idPenanggungJawab` (`idPenanggungJawab`);

--
-- Indexes for table `penanggungjawab`
--
ALTER TABLE `penanggungjawab`
 ADD PRIMARY KEY (`idPenanggungJawab`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`idStaff`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`idPenanggungJawab`) REFERENCES `penanggungjawab` (`idPenanggungJawab`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
