-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 08:36 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bk_test2`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gurubk`
--

CREATE TABLE `gurubk` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gurubk`
--

INSERT INTO `gurubk` (`id`, `id_user`, `nama`, `email`) VALUES
(1, 2, 'Muhammad Mulya Rahman', 'guru_bk@gmail.com'),
(5, 66, 'pak guru bk2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id` int(11) NOT NULL,
  `id_konseling` int(11) NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `jumlah_siswa` int(11) NOT NULL,
  `id_wali_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `jumlah_siswa`, `id_wali_kelas`) VALUES
(1, 'X MIA 1', 15, 1),
(2, 'X MIA 2', 15, 2),
(3, 'X IIS', 9, 3),
(4, 'XI MIA 1', 33, 4),
(5, 'XI MIA 2', 33, 5),
(6, 'XI IIS', 20, 6),
(7, 'XII MIA 1', 19, 7),
(8, 'XII MIA 2', 19, 8),
(9, 'XII IIS 1', 19, 9),
(10, 'XII IIS 2', 19, 10);

-- --------------------------------------------------------

--
-- Table structure for table `konseling`
--

CREATE TABLE `konseling` (
  `id` int(11) NOT NULL,
  `jadwal_konseling` date NOT NULL,
  `status` enum('Datang','Sedang Dipanggil','Tidak Datang') DEFAULT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_000000_create_users_table', 1),
(14, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(15, '2019_08_19_000000_create_failed_jobs_table', 1),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`id`, `id_user`, `nama`, `email`) VALUES
(1, 1, 'Pak Operator', 'operator@gmail.com'),
(2, 4, 'Pak Operator2', 'operator2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `tgl_pelanggaran` date NOT NULL,
  `tingkat_pelanggaran` enum('Ringan','Sedang','Berat') DEFAULT NULL,
  `detail_pelanggaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id`, `id_siswa`, `tgl_pelanggaran`, `tingkat_pelanggaran`, `detail_pelanggaran`) VALUES
(44, 1, '2023-07-20', 'Ringan', 'Telat datang'),
(45, 1, '2023-07-31', 'Sedang', 'berkelahi'),
(46, 1, '2023-07-09', 'Berat', 'Mengancam Guru'),
(47, 1, '2023-08-31', 'Ringan', 'Tidak Menjalankan Sholat Dhuha'),
(48, 1, '2023-07-14', 'Ringan', 'sasasasa');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int(11) NOT NULL,
  `id_konseling` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nis` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `tmp_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('laki-laki','perempuan') NOT NULL,
  `nohp` char(20) NOT NULL,
  `nohp_ortu` char(20) NOT NULL,
  `alamat` text NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_user`, `nis`, `nama`, `tmp_lahir`, `tgl_lahir`, `jk`, `nohp`, `nohp_ortu`, `alamat`, `id_kelas`) VALUES
(1, 60, 123001, 'Arsya Ramadhani', 'Palembang', '2008-06-11', 'laki-laki', '082246720990', '082246720992', 'Bukit Lama', 1),
(2, 61, 123002, 'Ayatullah Khomeini', 'Baturaja', '2007-01-16', 'laki-laki', '082268140260', '082268140673', 'Plaju', 1),
(3, 62, 123004, 'Bunga Safitri', 'Kertapati', '2008-01-31', 'perempuan', '08226812122', '082268140221', 'Kertapati', 1),
(4, 63, 1234003, 'Carissa Suci Amelia', 'Jakarta', '2007-06-11', 'perempuan', '082121313142', '089733441212', 'JL. Panjaitan', 1),
(5, 64, 123005, 'Diki Firmansyah', 'Palembang', '2023-06-05', 'laki-laki', '081256626966', '081256626962', 'Kemuning', 2),
(6, 59, 123008, 'Afifu Rahman', 'Prabumulih', '2008-06-28', 'laki-laki', '082291213142', '082291213322', 'Gang Sejahtera, Plaju', 3),
(22, 77, 49000850, 'Amel Ria', 'Palembang', '2023-07-09', 'perempuan', '087768099021', '08776809902', 'Bukit Lama', 10),
(23, 78, 57232711, 'Sundari', 'Palembang', '2023-07-10', 'perempuan', '087768099055', '087768099067', 'JL. Basuki Rahmat', 10),
(24, 84, 305313677, 'M. Akbar', 'Banyu Asin', '2007-01-05', 'laki-laki', '0857232711212', '0857232714422', 'Jaka Baring', 10),
(25, 103, 123, '123', '123', '2023-07-10', 'laki-laki', '123', '12131', '123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('operator','guru_bk','wali_kelas','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'operator',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pak Operator', 'operator@gmail.com', NULL, '$2y$10$TyzUFyW83LcwAFzyCHu7tu1rFzUERadaR8jXGSmuxg081qTTi2Nni', 'operator', NULL, '2023-07-07 01:58:40', '2023-07-07 01:58:40'),
(2, 'Muhammad Mulya Rahman', 'guru_bk@gmail.com', NULL, '$2y$10$EYh982VXRIPcjYtzi1S2kOE3xQqw8jtD7.Kd5e5lw64Xf5YE.5uhy', 'guru_bk', NULL, '2023-07-07 01:56:20', '2023-07-07 01:56:20'),
(3, 'Wali Kelas', 'wali_kelas@gmail.com', NULL, '$2y$10$bOJGz1FjxSQr.mF5VuL0yeyv9dvKoyX.ssPiJiWQdM1iiunH3wcsy', 'wali_kelas', NULL, '2023-07-02 05:38:02', '2023-07-02 05:38:02'),
(4, 'Pak Operator2', 'operator2@gmail.com', NULL, '$2y$10$y.owyFOYuiEKZlvMlCturu5QWYKSrmRP7Ha5IjrQpAlKeuE1B0gny', 'operator', NULL, '2023-07-07 01:58:06', '2023-07-07 01:58:06'),
(59, 'Afifu', 'afifu@gmail.com', NULL, '$2y$10$wBYHeEq/b6TLknn5UQ243.hQCcWxd/7aMHKY4zULEG1KHZBdvtk/y', 'siswa', NULL, '2023-07-07 02:40:58', '2023-07-07 02:40:58'),
(60, 'Arsya', 'arsya@gmail.com', NULL, '$2y$10$eKZYunWAbHVNoEI2kW2hwer01QPD3UheZzNoZIhPArdVD6y.InHum', 'siswa', NULL, '2023-07-07 04:27:33', '2023-07-07 04:27:33'),
(61, 'Ayatullah Khomeini', 'Ayatullah@gmail.com', NULL, '$2y$10$Mq1SvYFS7oyjocOQUPS2eugzvCWF8wQJbXg9qMmdy6TB9H0JCPwKK', 'siswa', NULL, '2023-07-07 04:28:19', '2023-07-07 04:28:19'),
(62, 'Bunga Safitri', 'bungasafitri@gmail.com', NULL, '$2y$10$BCyWfzCn/iUONIR8WKbgTug7KPothD/YSKx/IQJ9mHyRQGlrD8Qi6', 'siswa', NULL, '2023-07-07 04:28:47', '2023-07-07 04:28:47'),
(63, 'Carissa Suci Amelia', 'carissa@gmail.com', NULL, '$2y$10$PPfGb2ylWTSrIvJkALvkAOj0efaNGrDSKVp7.2Pa623DzIJgDFSS.', 'siswa', NULL, '2023-07-07 04:29:15', '2023-07-07 04:29:15'),
(64, 'Diki Firmansyah', 'dikifirmansyah@gmail.com', NULL, '$2y$10$yh0YHH.mfvGpHZEWEvKnOu8L6cxgoEG0UtG7udFTGuXhAQi493hWG', 'siswa', NULL, '2023-07-07 04:29:42', '2023-07-07 04:29:42'),
(66, 'pak guru bk2', 'guru_bk2@gmail.com', NULL, '$2y$10$577hmiTNL8j5KZHhoVqcy.2BbZFABzmXcrr6Sn24LS.B161ms92Fi', 'guru_bk', NULL, '2023-07-09 05:26:56', '2023-07-09 05:26:56'),
(67, 'Sundus Amirah', 'amirah@gmail.com', NULL, '$2y$10$wwU/LO3wHQyukHHhInHuAO2vqcXLtmph7hlSiAwKXruxI.Cgwf.Ki', 'wali_kelas', NULL, '2023-07-09 05:27:27', '2023-07-09 05:27:27'),
(68, 'Riska Kartika Sari, S.Pd', 'riska@gmail.com', NULL, '$2y$10$pb8r8bSPTxYJlbFcrMVzIegbtB1tXmimkQGoGOmPYGMWZIBRCHS46', 'wali_kelas', NULL, '2023-07-09 05:27:58', '2023-07-09 05:27:58'),
(69, 'Rima Fitria Sari, S.pd', 'rima@gmail.com', NULL, '$2y$10$wIKKxv15TLE6BDS/F9vtaeLIVj0d0vXyOgPzgOvTLcBbmYaN7NxGS', 'wali_kelas', NULL, '2023-07-09 05:29:49', '2023-07-09 05:29:49'),
(70, 'Nurbaiti, S.Pd', 'nurbaiti@gmail.com', NULL, '$2y$10$ku51X8FSFlHZ2U561JAjb.jz5e7omlJsyA7DLFYpPTeVT6Jifv58W', 'wali_kelas', NULL, '2023-07-09 05:30:18', '2023-07-09 05:30:18'),
(71, 'Winda', 'winda@gmail.com', NULL, '$2y$10$KIj6qApJ.0nRNRF.BIraiOu.EOJMgPRAfclMOlHGy17bijf6AVAnW', 'wali_kelas', NULL, '2023-07-09 05:37:51', '2023-07-09 05:37:51'),
(72, 'Nirwana Indah', 'nirwana@gmail.com', NULL, '$2y$10$J4p9P7xcM1QekP/PG2Yc8uhARa6//yxqnSnviYPT3.gc1Vzt5tRUG', 'wali_kelas', NULL, '2023-07-09 05:38:05', '2023-07-09 05:38:05'),
(73, 'Rostiana Sartika', 'rostiana@gmail.com', NULL, '$2y$10$UrfG7A5DPAk/OcrvO1u4kOwO81K4gQkiNT9yTigamruzzPnBMoGCO', 'wali_kelas', NULL, '2023-07-09 05:38:23', '2023-07-09 05:38:23'),
(74, 'Wartilah', 'wartilah@gmail.com', NULL, '$2y$10$lSMyS77GXQvSeUqQdABgY.mhvb4GCWewdmC8VhSxc3e0ZImWSGc62', 'wali_kelas', NULL, '2023-07-09 05:38:38', '2023-07-09 05:38:38'),
(75, 'Muhammad Ladis Mi\'raj', 'ladis@gmail.com', NULL, '$2y$10$fwXcOrIRi4NvRULbiRoXPulh8oCD.V18vwsb0yUfae/5MmMCIciDy', 'wali_kelas', NULL, '2023-07-09 05:38:52', '2023-07-09 05:38:52'),
(76, 'Sauda Rahmah', 'rahmah@gmail.com', NULL, '$2y$10$m84cRGjRExsYkvQ6xeApd.0dAF1gLjiRwCNABPNTwCic8K3U4omF.', 'wali_kelas', NULL, '2023-07-09 05:39:09', '2023-07-09 05:39:09'),
(77, 'Amel Ria', 'amel@gmail.com', NULL, '$2y$10$D26.aU8L9ANArBt72g.8Ce85M7DWgM9.n2kk9YkBMbBhmfzSiQPlW', 'siswa', NULL, '2023-07-09 05:42:24', '2023-07-09 05:42:24'),
(78, 'Sundari', 'sundari@gmail.com', NULL, '$2y$10$vlTSsgTGvmbkOXHWHCwgOubM2DJJVz6MjT2uoNp1Rnxvhocb2DsJe', 'siswa', NULL, '2023-07-09 05:44:42', '2023-07-09 05:44:42'),
(84, 'M. Akbar', 'akbar@gmail.com', NULL, '$2y$10$agx.mLSh8xY7uq3QBtDIGOLA.k/uXbc/Der5eqIvn4KMgm54J/Arm', 'siswa', NULL, '2023-07-09 05:49:13', '2023-07-09 05:49:13'),
(86, 'Bunga Safitri', 'bungasafitri@gmail', NULL, '$2y$10$MzLPsLmiffB1svlScZ.x.uQwdB3X18/5/dZDxiHQE/v12MC8GA9Cu', 'siswa', NULL, '2023-07-09 06:41:02', '2023-07-09 06:41:02'),
(102, 'Pak wali 10', 'wali10@gmail.com', NULL, '$2y$10$s2L7T.6KP/t1MK6RqCnYcePRRqNcsDjHNauL1rM0UKW07vjzbq.ZO', 'wali_kelas', NULL, '2023-07-10 02:33:13', '2023-07-10 02:33:13'),
(103, '123', '123@gmail.com', NULL, '$2y$10$0z9Te8a0QSXEvZ2AIzBkTuK73sR3/mRp/JHAdqvDqFTXe4rdnudHm', 'siswa', NULL, '2023-07-10 02:40:36', '2023-07-10 02:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id`, `id_user`, `nama`) VALUES
(1, 68, 'Riska Kartika Sari, S.Pd'),
(2, 69, 'Rima Fitria Sari, S.pd'),
(3, 70, 'Nurbaiti, S.Pd'),
(4, 71, 'Winda'),
(5, 72, 'Nirwana Indah'),
(6, 73, 'Rostiana Sartika'),
(7, 74, 'Wartilah'),
(8, 75, 'Muhammad Ladis Mi\'raj'),
(9, 76, 'Sauda Rahmah'),
(10, 67, 'Sundus Amirah'),
(47, 102, 'Pak wali 11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurubk`
--
ALTER TABLE `gurubk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konseling`
--
ALTER TABLE `konseling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurubk`
--
ALTER TABLE `gurubk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `konseling`
--
ALTER TABLE `konseling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
