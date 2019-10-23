-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Apr 2019 pada 11.22
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectpw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email_admin` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `email_admin`, `password`) VALUES
(1, 'andrian rizqi', 'admin', 'andrianrizqi22@gmail.com', 'admin'),
(7, 'Felix', 'felixskz', 'felix22@gmail.com', '123456'),
(8, 'Catur Rahmat', 'caturkece', 'caturtampan@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'demak', 20000),
(2, 'cirebon', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL,
  `alamat_pelanggan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`, `alamat_pelanggan`) VALUES
(0, 'caturtampan@gmail.com', '123456', 'Catur Rahmat', '082150332316', 'Kulon Progo Beriman'),
(1, 'andrianrizqi22@gmail.com', 'andrian271', 'andrian rizqi', '082150332316', 'Balikpapan'),
(2, 'catur22@gmail.com', 'catur27129', 'catur rahmat', '08215002317', 'Kulon Progo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(6, 11, 'Andrian Rizqi', 'mandiri', 55000, '2019-04-19', '20190419002349SONJAY.PNG'),
(7, 16, 'Andrian Rizqi', 'mandiri', 660000, '2019-04-19', '20190419033103app-logo.png'),
(8, 18, 'Andrian Rizqi', 'BNI', 300000, '2019-04-19', '20190419105749buku.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pelanggan`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(16, 1, 1, '2019-04-19', 660000, 'demak', 20000, 'bts korsel', 'barang dikirim', 'ABC123'),
(17, 1, 1, '2019-04-19', 420000, 'demak', 20000, 'BDS Manunggal Blok B-3\r\nJalan AMD Manunggal Komplek BDS Manunggal Blok B No 3', 'pending', ''),
(18, 0, 2, '2019-04-19', 300000, 'cirebon', 25000, 'Kulon Progo', 'barang dikirim', '431JAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(5, 8, 24, 1, '', 0, 0),
(6, 8, 22, 1, '', 0, 0),
(7, 9, 26, 1, 'Minyak Goreng ', 250000, 250000),
(8, 9, 21, 1, 'Sepatu Nike ORI', 150000, 150000),
(9, 10, 20, 1, 'Pengharum Ruangan', 22000, 22000),
(10, 10, 28, 1, 'Jam Tangan Swiss', 43000, 43000),
(11, 11, 25, 1, 'Lipstik Wardah', 35000, 35000),
(12, 12, 26, 1, 'Minyak Goreng ', 250000, 250000),
(13, 14, 18, 2, 'Xiaomi Pocophone', 5000000, 10000000),
(14, 14, 21, 1, 'Sepatu Nike ORI', 200000, 200000),
(15, 14, 22, 10, 'Kopi Nescafe', 20000, 200000),
(16, 15, 21, 2, 'Sepatu Nike ORI', 200000, 400000),
(17, 16, 21, 3, 'Sepatu Nike ORI', 200000, 600000),
(18, 16, 22, 2, 'Kopi Nescafe', 20000, 40000),
(19, 17, 21, 1, 'Sepatu Nike ORI', 200000, 200000),
(20, 17, 24, 1, 'Kue Pie', 200000, 200000),
(21, 18, 19, 1, 'Rinso Anti Noda', 20000, 20000),
(22, 18, 22, 1, 'Kopi Nescafe', 20000, 20000),
(23, 18, 24, 1, 'Kue Pie', 200000, 200000),
(24, 18, 25, 1, 'Lipstik Wardah', 35000, 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kategori_produk` varchar(100) NOT NULL,
  `sub_kategori_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `foto_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `stok_produk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori_produk`, `sub_kategori_produk`, `harga_produk`, `foto_produk`, `deskripsi_produk`, `stok_produk`) VALUES
(18, 'Xiaomi Pocophone', '', '', 5000000, 'xiaomipoco.jpg', 'Harga Pasti Pas', 5),
(19, 'Rinso Anti Noda', '', '', 20000, '4.jpeg', ' 			 			 			Anti Noda Membandel 		 		 		', 4),
(20, 'Pengharum Ruangan', '', '', 22000, '3.jpeg', ' 			Terjamin Harumnya 		', 5),
(21, 'Sepatu Nike ORI', '', '', 200000, 'nike.jpg', ' 			Nike ORI dari China 		', 4),
(22, 'Kopi Nescafe', '', '', 20000, 'nescafe.jpg', 'Kopi Dengan Rasa Terbaru', 4),
(24, 'Kue Pie', '', '', 200000, '4.png', 'Pie coklat lezat', 3),
(25, 'Lipstik Wardah', '', '', 35000, 'lipstik.jpg', 'Lipstick buat kamu cantik tanpa plastik', 4),
(26, 'Minyak Goreng ', '', '', 250000, 'minyak.jpg', ' 			Minyak goreng tanpa gula. buat diet  		', 5),
(27, 'Charm Relax', '', '', 10000, 'pembalut.jpg', 'Buat kamu nyaman melakukan aktivitas', 5),
(28, 'Jam Tangan Swiss', '', '', 43000, '1.jpg', 'Jam Tangan Awet Mahal', 5),
(29, 'Susu UHT Coklat', '', '', 15000, 'indomilk.jpg', ' 			Susu dengan kalsium di atas rata rata 		', 7),
(30, 'Jilbab By KeKe', '', '', 150000, 'muslimah.png', 'Baju bagus berasal dari katun', 8),
(31, 'Kue Tart ', '', '', 30000, 'kue.jpg', 'Kue tart kualitas terbaik dari jepang', 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
