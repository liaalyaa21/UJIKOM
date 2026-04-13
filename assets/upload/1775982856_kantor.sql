-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2026 pada 05.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kantor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(10) NOT NULL,
  `id_karyawan` int(10) NOT NULL,
  `id_lembur` int(10) NOT NULL,
  `periode` date NOT NULL,
  `lama_lembur` int(10) DEFAULT NULL,
  `total_lembur` int(10) DEFAULT NULL,
  `total_bonus` int(10) NOT NULL,
  `total_tunjangan` int(10) NOT NULL,
  `total_pendapatan` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_karyawan`, `id_lembur`, `periode`, `lama_lembur`, `total_lembur`, `total_bonus`, `total_tunjangan`, `total_pendapatan`, `created_at`) VALUES
(1, 1, 1, '0000-00-00', 10, 250000, 1500000, 3000000, 14750000, '2025-03-19 16:01:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(10) NOT NULL,
  `jabatan` varchar(60) NOT NULL,
  `gaji_pokok` int(10) NOT NULL,
  `tunjangan` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `jabatan`, `gaji_pokok`, `tunjangan`, `created_at`) VALUES
(1, 'Manajer', 10000000, 3000000, '2025-03-19 13:51:01'),
(2, 'Supervisor', 7000000, 2000000, '2025-03-19 13:51:01'),
(3, 'Staf', 5000000, 1000000, '2025-03-19 13:51:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) NOT NULL,
  `id_jabatan` int(10) NOT NULL,
  `id_rating` int(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `divisi` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `umur` varchar(2) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `id_jabatan`, `id_rating`, `nama`, `divisi`, `alamat`, `umur`, `jenis_kelamin`, `status`, `created_at`) VALUES
(1, 1, 4, 'Sela', 'Marketing', 'Bandung', '21', 'Perempuan', 'Aktif', '2025-03-19 14:27:28'),
(2, 2, 5, 'Khayra', 'keuangan', 'Jakarta', '22', 'Perempuan', 'Aktif', '2025-03-19 14:27:28'),
(3, 3, 3, 'Ahmad', 'Produksi', 'Bogor', '25', 'Laki-Laki', 'Aktif', '2025-03-19 14:27:28'),
(4, 1, 4, 'Akhdan', 'Marketing', 'Majalengka', '21', 'Laki-Laki', 'Aktif', '2025-03-19 14:27:28'),
(5, 2, 3, 'Budi', 'Produksi', 'Bandung', '23', 'Laki-laki', 'Aktif', '2025-03-19 14:27:28'),
(6, 2, 4, 'Siti', 'Admin', 'Surabaya', '24', 'Perempuan', 'Aktif', '2025-03-19 14:27:28'),
(7, 3, 5, 'Aldo', 'IT', 'Bogor', '28', 'Laki-Laki', 'aktif', '2025-03-19 14:27:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

CREATE TABLE `lembur` (
  `id_lembur` int(10) NOT NULL,
  `tarif` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lembur`
--

INSERT INTO `lembur` (`id_lembur`, `tarif`) VALUES
(1, 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(10) NOT NULL,
  `rating` int(10) NOT NULL,
  `presentase_bonus` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`id_rating`, `rating`, `presentase_bonus`) VALUES
(1, 1, 0),
(2, 2, 0.05),
(3, 3, 0.1),
(4, 4, 0.15),
(5, 5, 0.2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_lembur` (`id_lembur`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_rating` (`id_rating`);

--
-- Indeks untuk tabel `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id_lembur` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `gaji_ibfk_2` FOREIGN KEY (`id_lembur`) REFERENCES `lembur` (`id_lembur`);

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `karyawan_ibfk_2` FOREIGN KEY (`id_rating`) REFERENCES `rating` (`id_rating`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
