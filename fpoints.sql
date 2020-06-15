-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 15, 2020 at 08:27 PM
-- Server version: 10.1.44-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.26-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fpoints`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_siswa` bigint(20) NOT NULL,
  `id_status_absensi` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id_agama` int(11) NOT NULL,
  `agama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `agama`) VALUES
(1, 'ISLAM1'),
(2, 'KRISTEN'),
(3, 'HINDU'),
(4, 'BUDDHA'),
(5, 'KONG HU CHU'),
(6, 'Kong guang');

-- --------------------------------------------------------

--
-- Table structure for table `akumulasi_point`
--

CREATE TABLE `akumulasi_point` (
  `id_siswa` bigint(20) NOT NULL,
  `id_sanksi` int(11) NOT NULL,
  `total_point` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_tindakan` int(11) DEFAULT NULL,
  `pasal` varchar(10) DEFAULT NULL,
  `uraian_aturan` text,
  `point_aturan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `id_kategori`, `id_tindakan`, `pasal`, `uraian_aturan`, `point_aturan`) VALUES
(4, 1, 1, 'A1', 'Datang terlambat < 15 menit', 5),
(5, 1, 1, 'A2', 'Datang terlambat > 15 menit', 15),
(6, 1, 1, 'A3', 'Tidak masuk tanpa keterangan', 20);

-- --------------------------------------------------------

--
-- Table structure for table `hari_efektif`
--

CREATE TABLE `hari_efektif` (
  `id_hari_efektif` int(11) NOT NULL,
  `nama_hari_efektif` varchar(10) NOT NULL,
  `status_hari_efektif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hari_efektif`
--

INSERT INTO `hari_efektif` (`id_hari_efektif`, `nama_hari_efektif`, `status_hari_efektif`) VALUES
(1, 'Senin', 1),
(2, 'Selasa', 1),
(3, 'Rabu', 1),
(4, 'Kamis', 1),
(5, 'Jum\'at', 1),
(6, 'Sabtu', 0),
(7, 'Minggu', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hari_tidak_efektif`
--

CREATE TABLE `hari_tidak_efektif` (
  `id_hari_tidak_efektif` int(11) NOT NULL,
  `tanggal_tidak_efektif` date DEFAULT NULL,
  `keterangan_tidak_efektif` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hari_tidak_efektif`
--

INSERT INTO `hari_tidak_efektif` (`id_hari_tidak_efektif`, `tanggal_tidak_efektif`, `keterangan_tidak_efektif`) VALUES
(3, '2020-06-01', 'an only install one of: mpdf/mpdf[v8.0.6, v7.1.8].\r\n    - Installation request for mpdf/mpdf (locked at v7.1.8) -> satisfiable by mpdf/mpdf[v7.1.8].'),
(4, '2020-06-02', 'an only install one of: mpdf/mpdf[v8.0.6, v7.1.8].\r\n    - Installation request for mpdf/mpdf (locked at v7.1.8) -> satisfiable by mpdf/mpdf[v7.1.8].');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`) VALUES
(2, 'Guru'),
(1, 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `kepala_jurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `jurusan`, `kepala_jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak', 'Defri Indra Mahardika1');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_aturan`
--

CREATE TABLE `kategori_aturan` (
  `id_kategori` int(11) NOT NULL,
  `kategori_aturan` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_aturan`
--

INSERT INTO `kategori_aturan` (`id_kategori`, `kategori_aturan`) VALUES
(1, 'Kehadiran');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_penghargaan`
--

CREATE TABLE `kategori_penghargaan` (
  `id_kategori_penghargaan` int(11) NOT NULL,
  `kategori_penghargaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_penghargaan`
--

INSERT INTO `kategori_penghargaan` (`id_kategori_penghargaan`, `kategori_penghargaan`) VALUES
(1, 'Membawa nama baik sekolah dan megikuti kegiatan sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_wali_kelas` int(11) DEFAULT NULL,
  `kelas` varchar(3) DEFAULT NULL,
  `grade` varchar(3) DEFAULT NULL,
  `id_tahun_ajaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_jurusan`, `id_wali_kelas`, `kelas`, `grade`, `id_tahun_ajaran`) VALUES
(19, 1, 8, 'B', 'XII', 1),
(20, 1, 9, 'A', 'XII', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', NULL),
('m130524_201442_init', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nama_kelas`
--

CREATE TABLE `nama_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nama_kelas`
--

INSERT INTO `nama_kelas` (`id_kelas`, `nama_kelas`) VALUES
(19, 'XII Rekayasa Perangkat Lunak B'),
(20, 'XII Rekayasa Perangkat Lunak A');

-- --------------------------------------------------------

--
-- Table structure for table `on_kelas_siswa`
--

CREATE TABLE `on_kelas_siswa` (
  `id_kelas` int(11) NOT NULL,
  `id_siswa` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `on_kelas_siswa`
--

INSERT INTO `on_kelas_siswa` (`id_kelas`, `id_siswa`) VALUES
(19, 2),
(19, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `alamat_pegawai` text NOT NULL,
  `jenis_kelamin_pegawai` enum('L','P') NOT NULL,
  `no_hp_pegawai` varchar(15) NOT NULL,
  `status_kepegawaian` varchar(50) NOT NULL,
  `jabatan_pegawai` int(11) NOT NULL,
  `foto_pegawai` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_agama`, `nama_pegawai`, `alamat_pegawai`, `jenis_kelamin_pegawai`, `no_hp_pegawai`, `status_kepegawaian`, `jabatan_pegawai`, `foto_pegawai`) VALUES
(1, 1, 'admin', 'admin', 'L', '+6281234567890', 'Pegawai Tetap', 1, ''),
(2, 1, 'Defri Indra Mahardika', 'Ds. Pulung Kec. Pulung', 'L', '+6285604845437', 'Tetap', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama_pekerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`) VALUES
(2, 'Wiraswasta'),
(3, 'Pegawai Negeri Sipil');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int(11) NOT NULL,
  `id_siswa` bigint(20) NOT NULL,
  `id_aturan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `id_siswa`, `id_aturan`, `tanggal`) VALUES
(1, 2, 4, '2020-06-01'),
(2, 2, 4, '2020-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `penghargaan`
--

CREATE TABLE `penghargaan` (
  `id_penghargaan` int(11) NOT NULL,
  `id_kategori_penghargaan` int(11) NOT NULL,
  `uraian_penghargaan` text,
  `point_penghargaan` int(11) DEFAULT NULL,
  `pasal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penghargaan`
--

INSERT INTO `penghargaan` (`id_penghargaan`, `id_kategori_penghargaan`, `uraian_penghargaan`, `point_penghargaan`, `pasal`) VALUES
(1, 1, 'Membawa nama sekolah ke tingkat Provinsi', 10, 'A1'),
(2, 1, 'Membawa nama baik sekolah ketingkat Nasional', 15, 'A2');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id_prestasi` int(11) NOT NULL,
  `id_siswa` bigint(20) NOT NULL,
  `id_penghargaan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id_prestasi`, `id_siswa`, `id_penghargaan`, `tanggal`) VALUES
(1, 2, 1, '2020-06-01'),
(2, 2, 2, '2020-06-01'),
(3, 2, 2, '2020-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `id_sanksi` int(11) NOT NULL,
  `uraian` text,
  `minimum_point` int(11) DEFAULT NULL,
  `maximum_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`id_sanksi`, `uraian`, `minimum_point`, `maximum_point`) VALUES
(1, 'Skorsing 3 hari', 25, 60),
(2, 'Skorsing selama 6 hari\r\nMembuat surat pernyataan', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(11) NOT NULL,
  `semester` enum('1','2') NOT NULL,
  `awal_bulan_semester` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `akhir_bulan_semester` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `semester`, `awal_bulan_semester`, `akhir_bulan_semester`) VALUES
(1, '1', '6', '12'),
(2, '2', '1', '6');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` bigint(20) NOT NULL,
  `id_wali_murid` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `tempat_lahir_siswa` varchar(40) NOT NULL,
  `tanggal_lahir_siswa` date NOT NULL,
  `jenis_kelamin_siswa` enum('P','L') NOT NULL,
  `alamat_rumah_siswa` text NOT NULL,
  `alamat_domisili_siswa` text NOT NULL,
  `no_hp_siswa` varchar(15) NOT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `id_wali_murid`, `id_agama`, `nis`, `nama_siswa`, `tempat_lahir_siswa`, `tanggal_lahir_siswa`, `jenis_kelamin_siswa`, `alamat_rumah_siswa`, `alamat_domisili_siswa`, `no_hp_siswa`, `foto_siswa`) VALUES
(2, 1, 1, '1123463434534', 'Vlania Putri Deviantara', 'Ponorogo', '2002-05-19', 'P', '$trans->commit();', '$trans->commit();', '+6285604845437', ''),
(6, 1, 1, '1123463434534', 'Vlania Putri Deviantara II', 'Ponorogo', '2002-05-19', 'L', '-', '-', '+6285604845437', '-');

-- --------------------------------------------------------

--
-- Table structure for table `sp`
--

CREATE TABLE `sp` (
  `id_sp` int(11) NOT NULL,
  `id_siswa` bigint(20) NOT NULL,
  `sp_ke` varchar(3) NOT NULL,
  `tanggal_sp` date NOT NULL,
  `jml_point_pelanggaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_absensi`
--

CREATE TABLE `status_absensi` (
  `id_status_absensi` int(11) NOT NULL,
  `keterangan_status_absensi` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_absensi`
--

INSERT INTO `status_absensi` (`id_status_absensi`, `keterangan_status_absensi`) VALUES
(1, 'Alpha'),
(2, 'Mbolos'),
(3, 'Hadir'),
(4, 'Sakit'),
(5, 'Izin');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE `tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`) VALUES
(1, '2017/2018'),
(3, '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `tindakan`
--

CREATE TABLE `tindakan` (
  `id_tindakan` int(11) NOT NULL,
  `tindakan` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tindakan`
--

INSERT INTO `tindakan` (`id_tindakan`, `tindakan`) VALUES
(1, 'Membersihkan lingkungan sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_pegawai`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '68r2xcRUUj-MNODNLTd3C-FyqU91ENQF', '$2y$13$CX9I6C0VQa6blxgbbPo.cOsMZrsip6xO94/dnYRVnRSjRfJjgrxPG', NULL, 'admin@admin.com', 10, '2020-06-11 02:05:49', '2020-06-11 02:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wali_kelas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali_kelas`
--

INSERT INTO `wali_kelas` (`id_wali_kelas`, `id_pegawai`) VALUES
(9, 1),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `wali_murid`
--

CREATE TABLE `wali_murid` (
  `id_wali_murid` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `nama_wali_murid` varchar(50) NOT NULL,
  `tempat_lahir_wali_murid` varchar(50) NOT NULL,
  `tanggal_lahir_wali_murid` date NOT NULL,
  `jenis_kelamin_wali_murid` enum('L','P') NOT NULL,
  `alamat_rumah_wali_murid` text NOT NULL,
  `no_hp_wali_murid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali_murid`
--

INSERT INTO `wali_murid` (`id_wali_murid`, `id_pekerjaan`, `id_agama`, `nama_wali_murid`, `tempat_lahir_wali_murid`, `tanggal_lahir_wali_murid`, `jenis_kelamin_wali_murid`, `alamat_rumah_wali_murid`, `no_hp_wali_murid`) VALUES
(1, 2, 1, 'Defri Indra Mahardika', 'Ponorogo', '2002-05-19', 'L', 'Ds. Pulung Kec. Pulung', '085604845437');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_siswa`,`id_status_absensi`),
  ADD KEY `FK_ABSENSI2` (`id_status_absensi`);

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `akumulasi_point`
--
ALTER TABLE `akumulasi_point`
  ADD PRIMARY KEY (`id_siswa`,`id_sanksi`),
  ADD KEY `FK_AKUMULASI_POINT2` (`id_sanksi`),
  ADD KEY `FK_AKUMULASI_POINT_3` (`id_tahun_ajaran`),
  ADD KEY `FK_SEMESTER_1` (`id_semester`);

--
-- Indexes for table `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `FK_ON_KATEGORI_ATURAN` (`id_kategori`),
  ADD KEY `FK_ON_TINDAKAN_ATURAN` (`id_tindakan`);

--
-- Indexes for table `hari_efektif`
--
ALTER TABLE `hari_efektif`
  ADD PRIMARY KEY (`id_hari_efektif`),
  ADD UNIQUE KEY `nama_hari_efektif` (`nama_hari_efektif`);

--
-- Indexes for table `hari_tidak_efektif`
--
ALTER TABLE `hari_tidak_efektif`
  ADD PRIMARY KEY (`id_hari_tidak_efektif`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD UNIQUE KEY `jabatan` (`jabatan`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kategori_aturan`
--
ALTER TABLE `kategori_aturan`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_penghargaan`
--
ALTER TABLE `kategori_penghargaan`
  ADD PRIMARY KEY (`id_kategori_penghargaan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD UNIQUE KEY `id_wali_kelas` (`id_wali_kelas`),
  ADD KEY `FK_ON_JURUSAN_KELAS` (`id_jurusan`),
  ADD KEY `FK_ON_WALIKELAS` (`id_wali_kelas`),
  ADD KEY `FK_TAHUN_AJARAN` (`id_tahun_ajaran`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `nama_kelas`
--
ALTER TABLE `nama_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `on_kelas_siswa`
--
ALTER TABLE `on_kelas_siswa`
  ADD PRIMARY KEY (`id_kelas`,`id_siswa`),
  ADD UNIQUE KEY `id_siswa` (`id_siswa`),
  ADD KEY `FK_ON_KELAS_SISWA2` (`id_siswa`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `FK_ON_AGAMA_PEGAWAI` (`id_agama`),
  ADD KEY `fk_on_jabatan_pegawai` (`jabatan_pegawai`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `FK_PELANGGARAN2` (`id_aturan`),
  ADD KEY `FK_PELANGGARAN` (`id_siswa`);

--
-- Indexes for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD PRIMARY KEY (`id_penghargaan`),
  ADD KEY `FK_KATEGORI_PENGHARGAAN` (`id_kategori_penghargaan`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `FK_PRESTASI2` (`id_penghargaan`),
  ADD KEY `FK_PRESTASI` (`id_siswa`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`id_sanksi`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD KEY `FK_ON_AGAMA_SISWA` (`id_agama`),
  ADD KEY `FK_ON_WALI_MURid_siswa` (`id_wali_murid`);

--
-- Indexes for table `sp`
--
ALTER TABLE `sp`
  ADD PRIMARY KEY (`id_sp`),
  ADD KEY `FK_ON_SISWA_SP` (`id_siswa`);

--
-- Indexes for table `status_absensi`
--
ALTER TABLE `status_absensi`
  ADD PRIMARY KEY (`id_status_absensi`);

--
-- Indexes for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`),
  ADD UNIQUE KEY `tahun_ajaran` (`tahun_ajaran`);

--
-- Indexes for table `tindakan`
--
ALTER TABLE `tindakan`
  ADD PRIMARY KEY (`id_tindakan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ON_PEGAWAI_USER` (`id_pegawai`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wali_kelas`),
  ADD UNIQUE KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `FK_ON_PEGAWAI_WALIKELAS` (`id_pegawai`);

--
-- Indexes for table `wali_murid`
--
ALTER TABLE `wali_murid`
  ADD PRIMARY KEY (`id_wali_murid`),
  ADD KEY `FK_ON_AGAMA_WALI_MURID` (`id_agama`),
  ADD KEY `FK_ON_PEKERJAAN_WALI_MURID` (`id_pekerjaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hari_efektif`
--
ALTER TABLE `hari_efektif`
  MODIFY `id_hari_efektif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hari_tidak_efektif`
--
ALTER TABLE `hari_tidak_efektif`
  MODIFY `id_hari_tidak_efektif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_aturan`
--
ALTER TABLE `kategori_aturan`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori_penghargaan`
--
ALTER TABLE `kategori_penghargaan`
  MODIFY `id_kategori_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penghargaan`
--
ALTER TABLE `penghargaan`
  MODIFY `id_penghargaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sanksi`
--
ALTER TABLE `sanksi`
  MODIFY `id_sanksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sp`
--
ALTER TABLE `sp`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_absensi`
--
ALTER TABLE `status_absensi`
  MODIFY `id_status_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tahun_ajaran`
--
ALTER TABLE `tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tindakan`
--
ALTER TABLE `tindakan`
  MODIFY `id_tindakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wali_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wali_murid`
--
ALTER TABLE `wali_murid`
  MODIFY `id_wali_murid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `FK_ABSENSI` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `FK_ABSENSI2` FOREIGN KEY (`id_status_absensi`) REFERENCES `status_absensi` (`id_status_absensi`);

--
-- Constraints for table `akumulasi_point`
--
ALTER TABLE `akumulasi_point`
  ADD CONSTRAINT `FK_AKUMULASI_POINT` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `FK_AKUMULASI_POINT2` FOREIGN KEY (`id_sanksi`) REFERENCES `sanksi` (`id_sanksi`),
  ADD CONSTRAINT `FK_AKUMULASI_POINT_3` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`),
  ADD CONSTRAINT `FK_SEMESTER_1` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id_semester`);

--
-- Constraints for table `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `FK_ON_KATEGORI_ATURAN` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_aturan` (`id_kategori`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ON_TINDAKAN_ATURAN` FOREIGN KEY (`id_tindakan`) REFERENCES `tindakan` (`id_tindakan`) ON UPDATE CASCADE;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `FK_ON_JURUSAN_KELAS` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`),
  ADD CONSTRAINT `FK_ON_WALIKELAS` FOREIGN KEY (`id_wali_kelas`) REFERENCES `wali_kelas` (`id_wali_kelas`),
  ADD CONSTRAINT `FK_TAHUN_AJARAN` FOREIGN KEY (`id_tahun_ajaran`) REFERENCES `tahun_ajaran` (`id_tahun_ajaran`);

--
-- Constraints for table `nama_kelas`
--
ALTER TABLE `nama_kelas`
  ADD CONSTRAINT `FK_ON_NAMA_KELAS` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `on_kelas_siswa`
--
ALTER TABLE `on_kelas_siswa`
  ADD CONSTRAINT `FK_ON_KELAS_SISWA` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `FK_ON_KELAS_SISWA2` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_ON_AGAMA_PEGAWAI` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`),
  ADD CONSTRAINT `fk_on_jabatan_pegawai` FOREIGN KEY (`jabatan_pegawai`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `FK_PELANGGARAN` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `FK_PELANGGARAN2` FOREIGN KEY (`id_aturan`) REFERENCES `aturan` (`id_aturan`);

--
-- Constraints for table `penghargaan`
--
ALTER TABLE `penghargaan`
  ADD CONSTRAINT `FK_KATEGORI_PENGHARGAAN` FOREIGN KEY (`id_kategori_penghargaan`) REFERENCES `kategori_penghargaan` (`id_kategori_penghargaan`);

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `FK_PRESTASI` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`),
  ADD CONSTRAINT `FK_PRESTASI2` FOREIGN KEY (`id_penghargaan`) REFERENCES `penghargaan` (`id_penghargaan`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `FK_ON_AGAMA_SISWA` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`),
  ADD CONSTRAINT `FK_ON_WALI_MURid_siswa` FOREIGN KEY (`id_wali_murid`) REFERENCES `wali_murid` (`id_wali_murid`);

--
-- Constraints for table `sp`
--
ALTER TABLE `sp`
  ADD CONSTRAINT `FK_ON_SISWA_SP` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id_siswa`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_ON_PEGAWAI_USER` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD CONSTRAINT `FK_ON_PEGAWAI_WALIKELAS` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `wali_murid`
--
ALTER TABLE `wali_murid`
  ADD CONSTRAINT `FK_ON_AGAMA_WALI_MURID` FOREIGN KEY (`id_agama`) REFERENCES `agama` (`id_agama`),
  ADD CONSTRAINT `FK_ON_PEKERJAAN_WALI_MURID` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id_pekerjaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
