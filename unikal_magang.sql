-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 03 Bulan Mei 2023 pada 03.51
-- Versi server: 5.7.33
-- Versi PHP: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unikal_magang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbing_sekolah`
--

CREATE TABLE `pembimbing_sekolah` (
  `id_pembimbing_sekolah` int(11) NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembimbing_sekolah`
--

INSERT INTO `pembimbing_sekolah` (`id_pembimbing_sekolah`, `id_sekolah`, `nama_pembimbing`, `alamat`, `no_telp`, `email`, `created_at`, `updated_at`) VALUES
(7, 60, 'Arif Setiawan', 'Jl Tulis, Desa Ging Gong, Batang', '024751549478', 'hrefstwn775@gmail.com', '2023-02-17 01:20:29', '2023-02-17 01:28:06'),
(9, 64, 'Saifudin Aji Negara', 'affafafasfdasdfasfas', '088812341234', 'saifudin_aji@gmail.com', '2023-02-27 21:33:30', '2023-02-27 14:33:30'),
(10, 65, 'Cikgu Jasmine', 'jehrwiunfo', '097654333', 'regergwe@ekjf.fd', '2023-03-16 13:21:17', '2023-05-02 14:47:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbing_unikal`
--

CREATE TABLE `pembimbing_unikal` (
  `id_pembimbing_unikal` int(11) NOT NULL,
  `nama_pembimbing` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembimbing_unikal`
--

INSERT INTO `pembimbing_unikal` (`id_pembimbing_unikal`, `nama_pembimbing`, `alamat`, `no_telp`, `email`, `created_at`, `updated_at`) VALUES
(6, 'Vahad Khusni', 'Jl. klflajsfljasfjasdfjkj', '08943284924', 'vahad@gmail.com', '2023-02-04 14:20:15', '2023-02-27 14:27:00'),
(7, 'Nuruz Zaman', 'Jl. jksdfajsdklf', '08324829222', 'zaman@gmail.com', '2023-02-04 14:21:07', '2023-02-27 14:26:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id_sekolah`, `nama_sekolah`, `kota`, `alamat`, `created_at`, `updated_at`) VALUES
(39, 'SMK Muhammadiyah Ulujami', 'Kab. Pemalang', 'Jl. Raya Rowosari, Dusun Empat, Rowosari, Kec. Ulujami, Kabupaten Pemalang, Jawa Tengah 52371', '0000-00-00 00:00:00', '2023-03-15 16:44:53'),
(60, 'MI Manba\'ul Ulum', 'Kota Pekalongan', 'Jl Sumatra, Gang 5A, Kergon, Pekalongan', '2023-02-17 01:13:00', '2023-05-03 02:16:24'),
(64, 'SMK Negeri 1 Punggelan', 'Kab Banjarnegara', 'Jl. Ps. Manis, Kepering, Punggelan, Kec. Punggelan, Kab. Banjarnegara, Jawa Tengah 53462', '2023-02-27 21:26:03', '2023-03-15 16:43:50'),
(65, 'Tadika Mesra', 'Kuala Lumpur', 'Jl, xx alfkjalkfjaf asfj asfkjk', '2023-03-15 23:42:41', '2023-03-15 16:42:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` tinytext NOT NULL,
  `foto` tinytext NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `id_sekolah` int(11) NOT NULL,
  `id_pembimbing_sekolah` int(11) NOT NULL,
  `id_pembimbing_unikal` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `nisn`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telp`, `email`, `foto`, `tgl_masuk`, `tgl_keluar`, `id_sekolah`, `id_pembimbing_sekolah`, `id_pembimbing_unikal`, `created_at`, `updated_at`) VALUES
(9, 'M. Iyan Tsabit Saputra', '77339901', 'Bendan', '2005-06-04', 'Jl xx xx, Gang xx, Xx, Pekalongan,  Jawa Tengah', '081234459543', 'mimu@gmail.com', 'ab768560898219a4833160284ba3cbc5.jpg', '2023-02-01', '2023-06-20', 60, 7, 6, '0000-00-00 00:00:00', '2023-03-15 14:04:17'),
(11, 'Tsakilatu Syifa\'', '77339902', 'Pekalongan', '2005-06-19', 'Jl. Sulawesi, Gang 5A, Kergon, Pekalongan', '081438923543', 'mimu@gmail.com', '19c42dd8ded86dfae0cc19188d8f2c1d.jpg', '2023-03-14', '2023-05-03', 60, 7, 6, '0000-00-00 00:00:00', '2023-05-02 14:57:17'),
(21, 'Krelis Agustina', '73913384', 'Pekalongan', '2006-08-07', 'Jl. Sulawesi, Gang xx, Bendan, Pekalongan', '088778523543', 'krelis@gmail.com', '2827fd1cf146501049b7c58098962748.jpg', '2023-11-15', '2024-03-28', 60, 7, 6, '0000-00-00 00:00:00', '2023-03-13 13:18:34'),
(24, 'Sawa Hajita N', '00477239006', 'Banjarnegara', '2004-02-07', 'Kecepit RT 04 RW 02, Punggelan, Banjarnegara', '085602425506', 'sawahajitanailah@gmail.com', '828314e9554f31a8b6aa90e5fec97d14.jpg', '2022-07-05', '2023-02-28', 64, 9, 7, '0000-00-00 00:00:00', '2023-02-27 14:38:17'),
(25, 'Riska Fitriyani Wulandari', '0037826139', 'Banjarnegara', '2003-11-17', 'Purbalingga, Pengadegan, Temanggal RT 03/ RW 02', '0882008953222', 'wulanriska851@gmail.com', '86eaa1a46d59ca6039f04cbc5a70441a.jpg', '2022-07-05', '2023-02-28', 64, 9, 7, '0000-00-00 00:00:00', '2023-02-27 14:40:45'),
(26, 'Retno Sumilir', '0044706092', 'Kebumen', '2004-08-14', 'Jateng, Banjarnegara, Punggelan, Danakerta RT02/RW01', '085723905863', 'retnoo1408@gmail.com', '8d4ee611569f5fc14d8e6c8bb147efac.jpg', '2022-07-05', '2023-02-28', 64, 9, 7, '0000-00-00 00:00:00', '2023-02-27 14:44:07'),
(27, 'Anggih Titis Barokah', '0046883209', 'Banjarnegara', '2004-07-17', 'Purwasana Rt 02 Rw 03, Punggelan, Banjarnegara', '085865735322', 'anggititis489@gmail.com', '82a706d57ee06891d802aa67bbb34615.jpg', '2022-07-05', '2023-02-28', 64, 9, 7, '0000-00-00 00:00:00', '2023-02-27 14:46:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `nama_user`, `password`, `created_at`, `updated_at`) VALUES
(10, 'Admin Utama', 'admin', '$2y$10$rgXkWJn92yHIB9IGpyB9N.DCMdfwzzyU0DegcMafPvZ6vEMDKt02y', '0000-00-00 00:00:00', '2023-03-26 17:04:17'),
(11, 'Lab. Puskom', 'puskom', '$2y$10$DtSE8VaTZnWqhce7o6vvF.DwNHDgCOrBd6u5fcyYXsCgPjUV71ZdO', '0000-00-00 00:00:00', '2023-03-28 01:23:26'),
(12, 'BAAK', 'baak', '$2y$10$8qFfBixdxJmGnImQQDvwVegxgBkG0SFKgby9FSMr26rVroJXaJOze', '0000-00-00 00:00:00', '2023-03-28 01:23:49'),
(13, 'Alpha Alhaitam', 'alpha', '$2y$10$n.MOw2vuOw40ADMX7xPbROFhF1DWeEuC4u7zbcuHkiKHH.icwl3RS', '0000-00-00 00:00:00', '2023-03-28 02:42:01'),
(14, 'Beta Basudara', 'beta', '$2y$10$Fi3852JMoHEWfKDNTckdluwyTIhcypRj8WFg2PjkDq4FRdPJZoDKa', '0000-00-00 00:00:00', '2023-03-28 07:50:51'),
(15, 'Cupcake Capybara', 'cupcake', '$2y$10$IKL3tnhDUTLUdg9xKcKosuguVs1ZDyFJSrIvSQuGtw4y..vox./1.', '0000-00-00 00:00:00', '2023-03-28 07:20:04'),
(16, 'Bismillah hirrahman nirrahimm', 'bismillah', '$2y$10$ZhjKExEXQpE0ZN9fP4W5numQO7FJTRKCg7AhNbBEWzU2/dxe4/Npq', '0000-00-00 00:00:00', '2023-03-29 02:45:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pembimbing_sekolah`
--
ALTER TABLE `pembimbing_sekolah`
  ADD PRIMARY KEY (`id_pembimbing_sekolah`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indeks untuk tabel `pembimbing_unikal`
--
ALTER TABLE `pembimbing_unikal`
  ADD PRIMARY KEY (`id_pembimbing_unikal`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `id_pembimbing_sekolah` (`id_pembimbing_sekolah`),
  ADD KEY `id_pembimbing_unikal` (`id_pembimbing_unikal`),
  ADD KEY `id_sekolah` (`id_sekolah`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pembimbing_sekolah`
--
ALTER TABLE `pembimbing_sekolah`
  MODIFY `id_pembimbing_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembimbing_unikal`
--
ALTER TABLE `pembimbing_unikal`
  MODIFY `id_pembimbing_unikal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembimbing_sekolah`
--
ALTER TABLE `pembimbing_sekolah`
  ADD CONSTRAINT `pembimbing_sekolah_ibfk_1` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_pembimbing_sekolah`) REFERENCES `pembimbing_sekolah` (`id_pembimbing_sekolah`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_pembimbing_unikal`) REFERENCES `pembimbing_unikal` (`id_pembimbing_unikal`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_sekolah`) REFERENCES `sekolah` (`id_sekolah`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
