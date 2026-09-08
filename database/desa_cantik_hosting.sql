-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2026 pada 15.44
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
-- Database: `desa_cantik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users`
--

CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admin_users`
--

INSERT INTO `admin_users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin Desa', 'admin@desacantik.id', '$2y$12$5EjDaCGCyIhGZAKN4.vDWOzIGJ1FCZaeecHlz6qfnZ.ObuSK03H8i', '2026-08-15 17:26:28', '2026-08-15 17:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_galleries`
--

CREATE TABLE `desa_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `is_background` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_head_history`
--

CREATE TABLE `desa_head_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_profiles`
--

CREATE TABLE `desa_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Desa Cantik',
  `code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `regency` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `background_image` varchar(255) DEFAULT NULL,
  `office_photo` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `history` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `mission` text DEFAULT NULL,
  `boundaries` text DEFAULT NULL,
  `area` decimal(12,2) DEFAULT NULL,
  `head_name` varchar(255) DEFAULT NULL,
  `head_photo` varchar(255) DEFAULT NULL,
  `structure_image` varchar(255) DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa_profiles`
--

INSERT INTO `desa_profiles` (`id`, `name`, `code`, `address`, `district`, `regency`, `province`, `phone`, `email`, `website`, `logo`, `favicon`, `hero_image`, `background_image`, `office_photo`, `description`, `history`, `vision`, `mission`, `boundaries`, `area`, `head_name`, `head_photo`, `structure_image`, `theme`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Desa Cantik', 'DESA-CANTIK', 'Alamat Kantor Desa Cantik', 'Kecamatan', 'Kabupaten', 'Maluku', '', '', '', NULL, NULL, '/uploads/1786843916_OxmHP2_screenshot-1.png', NULL, NULL, 'Website resmi Pemerintah Desa Cantik.', NULL, 'Terwujudnya Desa Cantik yang maju, mandiri, transparan, dan melayani.', 'Meningkatkan pelayanan publik, keterbukaan informasi, dan pembangunan desa.', NULL, NULL, 'Kepala Desa', '/uploads/1786843993_RW328r_images.jpg', '/uploads/1786844080_c63vvI_diagram.png', 'default', 1, '2026-08-15 17:26:27', '2026-08-15 17:34:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_profile_sections`
--

CREATE TABLE `desa_profile_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_profile_id` bigint(20) UNSIGNED NOT NULL,
  `section_type` enum('tentang_desa','sejarah_desa','profil_kepala_desa','profil_wilayah','visi_misi','struktur_organisasi','peta_desa','perangkat_desa') NOT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa_profile_sections`
--

INSERT INTO `desa_profile_sections` (`id`, `desa_profile_id`, `section_type`, `content`, `image`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 'tentang_desa', 'Informasi umum tentang desa, sejarah singkat, dan deskripsi desa.', NULL, 1, 0, '2026-08-15 21:13:41', '2026-08-15 21:13:41'),
(2, 1, 'profil_kepala_desa', 'Profil kepala desa, latar belakang, dan informasi pemerintahan.', '/uploads/1786871618_hMnf0H_oip.jfif', 1, 1, '2026-08-15 21:13:41', '2026-08-16 01:13:38'),
(3, 1, 'profil_wilayah', 'Informasi wilayah, luas desa, batas administratif, dan karakteristik geografis.', NULL, 1, 2, '2026-08-15 21:13:41', '2026-08-15 21:13:41'),
(4, 1, 'visi_misi', 'Visi: Terwujudnya Desa Cantik yang maju, mandiri, transparan, dan melayani.\r\n\r\nMisi:\r\nMeningkatkan pelayanan publik, keterbukaan informasi, dan pembangunan desa. bb', NULL, 1, 3, '2026-08-15 21:13:41', '2026-08-16 01:09:10'),
(5, 1, 'struktur_organisasi', 'Struktur organisasi pemerintah desa dan susunan perangkat desa.', '/uploads/1786871650_WHimmt_sotk.jpg', 1, 4, '2026-08-15 21:13:41', '2026-08-16 01:14:10'),
(6, 1, 'peta_desa', 'Peta wilayah desa atau embed peta interaktif.', NULL, 1, 5, '2026-08-15 21:13:41', '2026-08-15 21:13:41'),
(7, 1, 'perangkat_desa', 'Daftar lengkap perangkat desa dan jabatan mereka.', NULL, 1, 6, '2026-08-15 21:13:41', '2026-08-15 21:13:41'),
(8, 1, 'sejarah_desa', 'Sejarah desa', NULL, 1, 7, '2026-08-16 01:08:52', '2026-08-16 01:15:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_statistics`
--

CREATE TABLE `desa_statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `total_penduduk` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `laki_laki` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `perempuan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `kepala_keluarga` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `keluarga_miskin` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `balita` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `anak` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `remaja` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `dewasa` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `lansia` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `disabilitas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `belum_sekolah` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sd` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `smp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sma` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `diploma` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sarjana` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `petani` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `nelayan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pedagang` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `wiraswasta` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pns` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `karyawan` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pelajar` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `belum_bekerja` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `islam` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `kristen` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `katolik` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `hindu` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `buddha` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `konghucu` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `kepercayaan_lainnya` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sekolah` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `posyandu` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `puskesmas` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `tempat_ibadah` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `luas_wilayah` decimal(12,2) NOT NULL DEFAULT 0.00,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `desa_statistics`
--

INSERT INTO `desa_statistics` (`id`, `desa_id`, `total_penduduk`, `laki_laki`, `perempuan`, `kepala_keluarga`, `keluarga_miskin`, `balita`, `anak`, `remaja`, `dewasa`, `lansia`, `disabilitas`, `belum_sekolah`, `sd`, `smp`, `sma`, `diploma`, `sarjana`, `petani`, `nelayan`, `pedagang`, `wiraswasta`, `pns`, `karyawan`, `pelajar`, `belum_bekerja`, `islam`, `kristen`, `katolik`, `hindu`, `buddha`, `konghucu`, `kepercayaan_lainnya`, `sekolah`, `posyandu`, `puskesmas`, `tempat_ibadah`, `luas_wilayah`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0.00, NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_statistic_histories`
--

CREATE TABLE `desa_statistic_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `tahun` smallint(5) UNSIGNED NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_structures`
--

CREATE TABLE `desa_structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa_villages`
--

CREATE TABLE `desa_villages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `nama_dusun` varchar(255) NOT NULL,
  `jumlah_rt` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `jumlah_penduduk` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `letter_requests`
--

CREATE TABLE `letter_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `no_hp` varchar(30) NOT NULL,
  `tracking_code` varchar(30) DEFAULT NULL,
  `keperluan` text NOT NULL,
  `form_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_data`)),
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu',
  `catatan_admin` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_11_000001_create_site_contents_table', 1),
(5, '2026_08_11_000002_create_admin_users_table', 1),
(6, '2026_08_11_000003_create_site_sections_table', 1),
(7, '2026_08_11_063525_create_desa_profiles_table', 1),
(8, '2026_08_12_015227_create_desa_statistics_table', 1),
(9, '2026_08_12_015230_create_desa_villages_table', 1),
(10, '2026_08_12_015231_create_desa_head_history_table', 1),
(11, '2026_08_12_015232_create_desa_structures_table', 1),
(12, '2026_08_12_015233_create_desa_galleries_table', 1),
(13, '2026_08_13_000002_create_letter_requests_table', 1),
(14, '2026_08_13_000003_seed_letter_services', 1),
(15, '2026_08_13_054344_create_publications_table', 1),
(16, '2026_08_14_000002_create_desa_statistic_histories_table', 1),
(17, '2026_08_15_000000_finalize_single_desa_architecture', 1),
(18, '2026_08_16_000001_sync_desa_columns', 2),
(19, '2026_08_16_000002_create_village_pages_table', 2),
(20, '2026_08_16_000001_create_desa_profile_sections_table', 3),
(21, '2026_08_16_000003_add_sejarah_and_seed_profile_sections', 4),
(22, '2026_08_16_132748_add_agama_fields_to_desa_statistics_table', 4),
(23, '2026_08_18_000001_ensure_publications_schema', 5),
(24, '2026_08_18_000002_add_requirements_to_services', 5),
(25, '2026_08_18_000003_add_contact_url_and_tracking_code', 5),
(26, '2026_08_18_000004_backfill_service_data', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `publications`
--

CREATE TABLE `publications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `status` enum('published','draft') NOT NULL DEFAULT 'draft',
  `image` varchar(255) DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `publications`
--

INSERT INTO `publications` (`id`, `desa_id`, `title`, `slug`, `category`, `status`, `image`, `excerpt`, `content`, `file`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'musyawaarh', 'musyawaarh-ter57', 'akjhhgg', 'published', '/uploads/1786857600_Du7qCi_whatsapp-image-2025-05-15-at-211029-5f384068.jpg', 'kjfhg', 'jkhjjghfhgdgff', '/uploads/1786857600_zn1EFu_python.pdf', '2026-08-15 21:20:00', '2026-08-15 21:20:00', '2026-08-15 21:20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lOVd62RCQbyYzdaIdPN2swO6PUWU4Qo2rWMlWFCs', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUGtxNHFDYWVmc20xZjk0d2Fnaks0aDNXSVhFbjVzNlBZM1ZqeFo5WSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXRhLWRlc2EiO3M6NToicm91dGUiO3M6OToiZGF0YS1kZXNhIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo4OiJhZG1pbl9pZCI7aToxO3M6MTA6ImFkbWluX25hbWUiO3M6MTA6IkFkbWluIERlc2EiO30=', 1786887699),
('RdosY2z8B2gFiVubZTMJ039yz34Ff3TLWwyva3LW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUjh1NWxES0dETU93RUFKWEowRVFmM3pPU3BLcG5JMjVCWm5rR3lvUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXRhLWRlc2EiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhdGEtZGVzYSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6ODoiYWRtaW5faWQiO2k6MTtzOjEwOiJhZG1pbl9uYW1lIjtzOjEwOiJBZG1pbiBEZXNhIjtzOjc6ImRlc2FfaWQiO2k6MTt9', 1786872277),
('VoAXrRqUFhot3799jcOKjHSZ69SiYZqmJ4K0NKdq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSGRkMjAwUDl3clJ4bFUyVjhhdElHUk93ZUVLS2Q5RXlOb2QyUHpQYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1786880886);

-- --------------------------------------------------------

--
-- Struktur dari tabel `site_contents`
--

CREATE TABLE `site_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `site_contents`
--

INSERT INTO `site_contents` (`id`, `desa_id`, `key`, `value`, `hero_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'nama_desa', 'Desa Cantik', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(2, 1, 'hero_badge', 'WEBSITE RESMI DESA', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(3, 1, 'hero_title', 'Selamat Datang di Desa Cantik', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(4, 1, 'hero_description', 'Portal informasi resmi Pemerintah Desa Cantik. Temukan informasi desa, layanan, data statistik, publikasi, dan pengajuan surat secara mudah.', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(5, 1, 'about_title', 'Tentang Desa Cantik', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(6, 1, 'about_description', 'Website ini menjadi pusat informasi dan pelayanan digital Pemerintah Desa Cantik untuk masyarakat.', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(7, 1, 'stat_population', '0', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(8, 1, 'stat_households', '0', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(9, 1, 'stat_dusun', '0', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(10, 1, 'stat_potentials', '0', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(11, 1, 'publication_badge', 'PUBLIKASI DESA', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(12, 1, 'publication_title', 'Informasi Terbaru Desa', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(13, 1, 'publication_description', 'Informasi dan pengumuman resmi Pemerintah Desa.', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(14, 1, 'publication_button', 'Lihat Selengkapnya', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28'),
(15, 1, 'publication_link', '/publikasi', NULL, '2026-08-15 17:26:28', '2026-08-15 17:26:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `site_sections`
--

CREATE TABLE `site_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_letter` tinyint(1) NOT NULL DEFAULT 0,
  `form_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_fields`)),
  `requirements` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`requirements`)),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `site_sections`
--

INSERT INTO `site_sections` (`id`, `desa_id`, `type`, `title`, `description`, `icon`, `is_letter`, `form_fields`, `active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'service', 'Surat Keterangan Domisili', 'Surat keterangan tempat tinggal bagi warga desa.', '🏠', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(2, 1, 'service', 'Surat Keterangan Tidak Mampu', 'Surat keterangan tidak mampu untuk kebutuhan administrasi.', '🤝', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(3, 1, 'service', 'Surat Keterangan Usaha', 'Surat keterangan yang menerangkan kegiatan usaha warga.', '💼', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(4, 1, 'service', 'Surat Pengantar SKCK', 'Surat pengantar desa untuk pembuatan SKCK.', '🛡️', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(5, 1, 'service', 'Surat Keterangan Kelahiran', 'Surat keterangan untuk administrasi kelahiran.', '👶', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(6, 1, 'service', 'Surat Keterangan Kematian', 'Surat keterangan untuk administrasi kematian.', '🕊️', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(7, 1, 'service', 'Surat Keterangan Belum Menikah', 'Surat keterangan bahwa warga belum menikah.', '💍', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(8, 1, 'service', 'Surat Keterangan Penghasilan', 'Surat keterangan penghasilan warga.', '💰', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(9, 1, 'service', 'Surat Keterangan Pindah', 'Surat keterangan untuk keperluan pindah domisili.', '🚚', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(10, 1, 'service', 'Surat Keterangan Ahli Waris', 'Surat keterangan untuk keperluan ahli waris.', '📜', 1, '[]', 1, 0, '2026-08-15 17:26:27', '2026-08-15 17:26:29'),
(11, 1, 'contact', 'Kantor Desa', 'Silakan isi alamat dan kontak kantor desa melalui menu Profil Desa.', '📍', 0, NULL, 1, 0, '2026-08-15 17:26:29', '2026-08-15 17:26:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `village_pages`
--

CREATE TABLE `village_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `desa_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_email_unique` (`email`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `desa_galleries`
--
ALTER TABLE `desa_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_galleries_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `desa_head_history`
--
ALTER TABLE `desa_head_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_head_history_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `desa_profiles`
--
ALTER TABLE `desa_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `desa_profile_sections`
--
ALTER TABLE `desa_profile_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desa_profile_sections_desa_profile_id_section_type_unique` (`desa_profile_id`,`section_type`);

--
-- Indeks untuk tabel `desa_statistics`
--
ALTER TABLE `desa_statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_statistics_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `desa_statistic_histories`
--
ALTER TABLE `desa_statistic_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `desa_statistic_histories_desa_id_tahun_unique` (`desa_id`,`tahun`),
  ADD KEY `desa_statistic_histories_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `desa_structures`
--
ALTER TABLE `desa_structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_structures_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `desa_villages`
--
ALTER TABLE `desa_villages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_villages_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `letter_requests`
--
ALTER TABLE `letter_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `letter_requests_service_id_foreign` (`service_id`),
  ADD KEY `letter_requests_desa_id_service_id_status_index` (`desa_id`,`service_id`,`status`),
  ADD KEY `letter_requests_desa_id_index` (`desa_id`),
  ADD UNIQUE KEY `letter_requests_tracking_code_unique` (`tracking_code`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `publications_slug_unique` (`slug`),
  ADD KEY `publications_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_contents_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `site_sections`
--
ALTER TABLE `site_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `site_sections_desa_id_index` (`desa_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `village_pages`
--
ALTER TABLE `village_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `village_pages_desa_id_slug_unique` (`desa_id`,`slug`),
  ADD KEY `village_pages_desa_id_index` (`desa_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `desa_galleries`
--
ALTER TABLE `desa_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `desa_head_history`
--
ALTER TABLE `desa_head_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `desa_profiles`
--
ALTER TABLE `desa_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `desa_profile_sections`
--
ALTER TABLE `desa_profile_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `desa_statistics`
--
ALTER TABLE `desa_statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `desa_statistic_histories`
--
ALTER TABLE `desa_statistic_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `desa_structures`
--
ALTER TABLE `desa_structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `desa_villages`
--
ALTER TABLE `desa_villages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `letter_requests`
--
ALTER TABLE `letter_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `site_sections`
--
ALTER TABLE `site_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `village_pages`
--
ALTER TABLE `village_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `desa_profile_sections`
--
ALTER TABLE `desa_profile_sections`
  ADD CONSTRAINT `desa_profile_sections_desa_profile_id_foreign` FOREIGN KEY (`desa_profile_id`) REFERENCES `desa_profiles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `letter_requests`
--
ALTER TABLE `letter_requests`
  ADD CONSTRAINT `letter_requests_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `site_sections` (`id`) ON DELETE CASCADE;

-- ============================================================================
-- Desa Cantik: persyaratan dokumen layanan
-- ============================================================================
UPDATE `site_sections` SET `requirements`='["Kartu Keluarga (KK)","KTP pemohon","Surat pengantar RT/RW jika diberlakukan di desa"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%tidak mampu%';
UPDATE `site_sections` SET `requirements`='["KTP","Kartu Keluarga (KK)","Pas foto sesuai ketentuan kepolisian","Surat pengantar RT/RW jika diberlakukan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%skck%';
UPDATE `site_sections` SET `requirements`='["KTP calon pengantin","Kartu Keluarga (KK)","Akta kelahiran/ijazah sesuai kebutuhan","Pas foto sesuai ketentuan KUA"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%nikah%';
UPDATE `site_sections` SET `requirements`='["Kartu Keluarga (KK)","KTP orang tua","Surat keterangan lahir dari bidan/rumah sakit"]' WHERE `type`='service' AND (LOWER(`title`) LIKE '%lahir%' OR LOWER(`title`) LIKE '%kelahiran%');
UPDATE `site_sections` SET `requirements`='["Kartu Keluarga (KK)","KTP almarhum/almarhumah jika tersedia","Surat keterangan kematian","KTP pelapor/anggota keluarga"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%kematian%';
UPDATE `site_sections` SET `requirements`='["KTP anggota keluarga","KK lama jika perubahan data","Dokumen pendukung perubahan data sesuai keperluan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%kartu keluarga%';
UPDATE `site_sections` SET `requirements`='["KTP pemohon","Kartu Keluarga (KK)","Surat pengantar RT/RW jika diberlakukan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%domisili%';
UPDATE `site_sections` SET `requirements`='["KTP pemohon","Kartu Keluarga (KK)","Surat pengantar RT/RW jika diberlakukan","Dokumen pendukung usaha jika tersedia"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%usaha%';
UPDATE `site_sections` SET `requirements`='["KTP pemohon","Kartu Keluarga (KK)","Surat pengantar RT/RW jika diberlakukan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%belum menikah%';
UPDATE `site_sections` SET `requirements`='["KTP pemohon","Kartu Keluarga (KK)","Dokumen pendukung sumber penghasilan jika diperlukan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%penghasilan%';
UPDATE `site_sections` SET `requirements`='["KTP dan KK","Dokumen tujuan pindah","Surat pengantar RT/RW jika diberlakukan"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%pindah%';
UPDATE `site_sections` SET `requirements`='["KTP seluruh ahli waris","Kartu Keluarga (KK)","Akta/surat kematian pewaris","Dokumen pendukung hubungan keluarga"]' WHERE `type`='service' AND LOWER(`title`) LIKE '%ahli waris%';

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
