-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Feb 2023 pada 03.21
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_lelang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid_price` int(11) NOT NULL,
  `lot_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
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
-- Struktur dari tabel `lots`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `min_price` bigint(20) UNSIGNED DEFAULT 0,
  `max_price` bigint(20) UNSIGNED DEFAULT 0,
  `buyout_price` bigint(20) UNSIGNED DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `lots`
--

INSERT INTO `lots` (`id`, `name`, `description`, `image`, `min_price`, `max_price`, `buyout_price`, `user_id`, `category_id`, `end_time`, `created_at`, `updated_at`) VALUES
(4, 'LEWIS HAMILTON 2020 MERCEDES-AMG PETRONAS FORMULA ONE TEAM OFFICIAL REPLICA HALO', 'You can now get your hands on this striking replica car part, recreating the Mercedes-AMG Petronas Formula One Team Halo, painted by the team themselves, decorated with 2020 livery – a double Championship winning year.  Features:    Official Replica Halo  Lewis Hamilton edition Made using carbon fibre  2020 Livery– Championship Winning year   Paint applied at the Mercedes-AMG Petronas Formula One Team paint shop in Brackley F1 Authentics exclusive  Dimensions: 640mmW X 730mmH approximately  Recreating the iconic car part, which was introduced in 2018 for extra driver safety. The halo is made using carbon fibre, staying authentic to the race used car parts.    Painted by the Mercedes-AMG Petronas team themselves, this halo has been decorated with 2020 team livery- their last double Championship Winning year (Drivers’ and Constructors’), marking a memorable year for the team.    This halo is the perfect way to celebrate an incredible F1 season for the team.    This halo has been produced by F1 Authentics and is now ready for fans of the sport to own and display.', '20230201063859.jpg', 30000000, 50000000, 55000000, NULL, 1, '2023-02-04 17:00:00', '2023-01-31 23:38:59', '2023-01-31 23:38:59'),
(5, 'SPORTPESA RACING POINT F1 TEAM 2019 RACE USED FRONT WING', 'Own a piece of F1 racing history with this official race used front wing taken from a SportPesa Racing Point race car used in the 2019 season.    Features:    Official F1 memorabilia   Front Wing   SportPesa Racing Point race team  2019 F1 season  ‘SPORT’ sponsorship branding of ‘SportPesa’  Dimensions: 720mmD X 2300H X 1970mmW approximately  This official 2019 race used front wing was used by the SportPesa Racing Point F1 team during the 2019 season, with Sergio Pérez and Lance Stroll behind the wheel.    The front wings are a crucial element of any F1 race car, as they are the first part of the car to hit the airflow and therefore dictates the car’s shape and aerodynamics. It is angled to encourage air up and over the bodywork.   Become the proud owner of this unmissable piece of F1 history.', '20230201064419.jpg', 1231232131, 123123, 123, NULL, 2, '2023-02-01 17:00:00', '2023-01-31 23:44:19', '2023-01-31 23:44:19'),
(6, 'ZHOU GUANYU 2022 SIGNED OFFICIAL REPLICA HELMET', 'Own this official replica helmet recreating the one worn by Chinese F1 driver, Zhou Guanyu, during his rookie F1 season - the 2022 FIA Formula One World Championship. It has also been signed by Zhou himself!   Features:   Signed by Zhou Guanyu  1:1 official replica helmet  2022 design  Comes with display case  Display case measures 40cmL x 30cmW x 28cmH  Zhou joined Alfa Romeo F1 Team ORLEN at the start of the 2022 season, marking his rookie season in the sport. Having impressed on track, Zhou remains one to watch.   This official replica helmet has been made using similar materials to the original and has been autographed by Zhou himself.', '20230201070008.jpg', 135000000, 150000000, 160000000, NULL, 3, '2023-02-07 17:00:00', '2023-02-01 00:00:08', '2023-02-01 00:00:08'),
(7, 'SEBASTIAN VETTEL 2022 OFFICIAL REPLICA RACE SUIT', 'Fans of four-time World Champion, Sebastian Vettel, can own this official replica race suit, recreating the ones worn by the German driver during the 2022 FIA Formula One World Championship™.    Features:   Official licensed replica  2022 Aston Martin Aramco Cognizant F1 Team liveries  Professionally framed  Dimensions: 1045mmH X 745mmL X 80mmW  Vettel joined the iconic Aston Martin F1 team at the start of 2021 and claimed the team’s first ever podium with a second place in Azerbaijan (2021). Now after his second season with the team and final season in F1, the driver has had a respectable last season.   This official replica race suit features the striking dark green Aston Martin liveries and detailing and will come professionally framed ready for you to display.   Celebrate Vettel\'s epic F1 career, with a piece of his last chapter in F1.', '20230201070123.jpg', 60000000, 90000000, 100000000, NULL, 3, '2023-02-01 17:00:00', '2023-02-01 00:01:23', '2023-02-01 00:01:23');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_01_005721_create_lots_table', 1),
(6, '2023_02_01_005745_create_categories_table', 1),
(7, '2023_02_01_005802_create_bids_table', 1),
(8, '2023_02_01_005817_create_purchases_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lot_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `balance` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Asmajati', 'asmajati.cooler15@gmail.com', NULL, '$2y$10$LgeRgX3GFaaxeK6e0ReMbulzFpdm7VQ4m0c531oR/lXi7XzIwl1q6', 0, NULL, '2023-01-31 19:41:04', '2023-01-31 19:41:04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
