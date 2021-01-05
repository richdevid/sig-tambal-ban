-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 05 Jan 2021 pada 11.03
-- Versi server: 5.7.24
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Tambal Ban'),
(2, 'Bengkel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `location`
--

CREATE TABLE `location` (
  `ID` int(11) NOT NULL,
  `name` varchar(75) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `price2` bigint(20) NOT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `address` text,
  `photo` varchar(250) DEFAULT NULL,
  `serve` text,
  `open` text,
  `close` text NOT NULL,
  `holiday` text NOT NULL,
  `status` enum('ACCEPTED','DECLINED','PENDING','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `location`
--

INSERT INTO `location` (`ID`, `name`, `price`, `price2`, `latitude`, `longitude`, `address`, `photo`, `serve`, `open`, `close`, `holiday`, `status`) VALUES
(1, 'Tambal Ban Pinggir Jalan', 10000, 50000, '-7.397797', '112.7047293', 'Dusun Ganting, Ganting, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254', 'Screenshot_7192.png', 'Tambal Ban Motor, Tambah Angin', '07.00', '21.00', 'Minggu', 'ACCEPTED'),
(2, 'Tambal Ban Tubless Mas Hadi', 5000, 20000, '-7.4026073', '112.6994664', 'Jl. Raya Jenggolo, Demeling, Gedangan, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254', 'Screenshot_7201.png', 'Tambal Ban Motor, Tambah Angin', '07.00', '21.00', 'Senin', 'ACCEPTED'),
(3, 'Tambal Ban Sepeda Pak Pujiadi', 5000, 20000, '-7.407670331156321', '112.7002316305208', 'Jl. Keling, Keling, Jumputrejo, Kec. Sukodono, Kabupaten Sidoarjo, Jawa Timur 61258', 'Screenshot_721.png', 'Tambal Ban Motor, Tambah Angin', '08.00', '16.30', 'Minggu', 'ACCEPTED'),
(5, 'Tambal Ban Tubeles', 1000, 50000, '-7.401182855960929', '112.67419117905722', 'Jl. Raya Sukodono, Sawo, Sukodono, Kec. Sukodono, Kabupaten Sidoarjo, Jawa Timur 61258', 'Screenshot_7221.png', 'Tambal Ban Motor, Service Motor, Tambah Angin', '07.00', '17.00', 'Minggu', 'ACCEPTED'),
(6, 'Bengkel Tambal Ban', 5000, 100000, '-7.381655360159337', '112.72887199230345', 'Jl. Raya Waru, Lemahasin, Gedangan, Kec. Gedangan, Kabupaten Sidoarjo, Jawa Timur 61254', 'Screenshot_725.png', 'Tambal Ban Motor, Service Motor, Tambah Angin', '07.00', '17.00', 'Minggu', 'ACCEPTED');

-- --------------------------------------------------------

--
-- Struktur dari tabel `locationcategories`
--

CREATE TABLE `locationcategories` (
  `locationcategories_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `locationcategories`
--

INSERT INTO `locationcategories` (`locationcategories_id`, `location_id`, `category_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 1),
(4, 3, 1),
(6, 5, 1),
(7, 6, 1),
(8, 6, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID`, `fullname`, `username`, `email`, `password`) VALUES
(1, 'Muhammad Arief', 'admin', 'arief0039@gmail.com', '$2y$10$BmvaEG/RynACOdOfwZsz0..nmpqeQrArVQ3TGl1ATDOBriWnq2.xW');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `locationcategories`
--
ALTER TABLE `locationcategories`
  ADD PRIMARY KEY (`locationcategories_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `location`
--
ALTER TABLE `location`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `locationcategories`
--
ALTER TABLE `locationcategories`
  MODIFY `locationcategories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
