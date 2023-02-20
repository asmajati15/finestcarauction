-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 05:34 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

CREATE TABLE `bids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid_price` int(11) NOT NULL,
  `lot_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `bid_price`, `lot_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 200000000, 4, 1, '2023-02-20 08:15:59', '2023-02-20 08:15:59'),
(2, 500000000, 4, 2, '2023-02-20 08:17:32', '2023-02-20 08:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `final_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `bid_increment` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `name`, `description`, `image`, `start_price`, `final_price`, `bid_increment`, `user_id`, `category_id`, `end_time`, `created_at`, `updated_at`) VALUES
(4, 'Official Alfa Romeo F1® Team Stake 2023 C43 Launch Car - Signed Chassis No. 1', 'This car represents a world first - the first time an official F1 launch car has become available to the public. Now you have a chance to own the Alfa\'s 2023 car - the first chassis.   Traditionally built exclusively for F1 teams and partners, this limited production is the first for 2023.  In 2022, the C42 Show Cars sold through F1 Authentics were the first of their kind from a current season to be made available for public.  Now the C43 follows its path, offering collectors the chance to own a current car.    This exquisite car dons the striking 2023 Alfa Romeo F1® Team Stake and features the sponsorship branding and liveries that the race cars driven by Bottas and Zhou will showcase for the 2023 season.   The 2023 Launch Car has been specifically designed for show car purposes and not for competition and has been constructed to withstand the load\'s exerted for show car purposes.  The Chassis and Body work is constructed from high performance, lightweight pre preg Carbon Fibre and are designed to represent', '20230220150214.jpg', 100000000, 500000000, 1000000, 2, 1, '2023-02-27 17:00:00', '2023-02-20 08:02:14', '2023-02-20 08:50:17'),
(5, '2022 Oracle Red Bull Racing RB18 Show Car Simulator – Champions Edition', 'This Show Car Simulator has been expertly made by Memento Exclusives (F1 Authentics) in collaboration with the 2022 Constructors’ World Championship-winning team, Oracle Red Bull Racing. Created using the same processes as the real race cars, these Show Car Simulators offer an unparalleled F1 experience. These simulators are also very similar to the ones used by the drivers themselves as they prepare to storm the F1 tracks, allowing you to feel even closer to the sport and the drivers you love.  Each Simulator has been made from official Oracle Red Bull Racing CAD data and has been developed using composite tooling to create patterns, which are then used to make carbon fibre moulds via an autoclave. Each mould is then used to recreate each specific part of the car’s bodywork. The Champions Edition simulator comes with a show car nose and front wing assembly, completing the simulator for a more authentic experience and look.   The hardware is finalised in partnership with the race team, providing only the best market-leading options. This simulator also gives you the choice to have either Max Verstappen\'s Championship-winning livery or Sergio Pérez’s livery from the season, meaning you can tailor the simulator to your chosen F1 driver preference. Use the drop down above to select your driver livery preference.', '20230220162710.jpg', 1500000000, 1500000000, 1000000, 0, 1, '2023-03-05 17:00:00', '2023-02-20 09:27:10', '2023-02-20 09:27:10'),
(6, 'Scuderia Ferrari F1-75 2022 1:1 Scale Model Steering Wheel', 'This full-size replica of the Ferrari F1-75 steering wheel, recreates the one used by Charles Leclerc and Carlos Sainz in 2022, and will be handcrafted and finished with assistance of Scuderia Ferrari regarding original CAD data, finishes and paint codes.   Featuring the 2022 detailing, this exquisite 1:1 scale model is perfect for growing collections.', '20230220162942.jpg', 80000000, 80000000, 1000000, 0, 1, '2023-02-27 17:00:00', '2023-02-20 09:29:44', '2023-02-20 09:29:44'),
(7, 'Mercedes-AMG Petronas Formula One Team 2021 Rear Wheel Rim Table', 'Painted with 2021 Mercedes-AMG liveries, these wheel rims are all unique and were race-used during the team’s 2017 season. Celebrating the Silver Arrow team and drivers Lewis Hamilton and Valtteri Bottas, these tables allow you to bring the action of the tracks into your home.  Topped with glass for a sleek finish, these Mercedes wheel rim tables are ready to hold your drinks whilst you watch the Grands Prix.', '20230220163223.jpg', 30000000, 30000000, 1000000, 0, 2, '2023-02-24 17:00:00', '2023-02-20 09:32:23', '2023-02-20 09:32:23');

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `purchases`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` bigint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Asmajati', 'asmajati.cooler15@gmail.com', NULL, '$2y$10$LgeRgX3GFaaxeK6e0ReMbulzFpdm7VQ4m0c531oR/lXi7XzIwl1q6', 0, NULL, '2023-01-31 19:41:04', '2023-01-31 19:41:04'),
(2, 'Waluyo', 'waluyo@gmail.com', NULL, '$2y$10$SuQYI/iZKap2IDF3GR26jOkYOkR/z2D7oFbye7oaCAolerGl2rJbm', 1, NULL, '2023-02-20 08:17:06', '2023-02-20 08:17:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lots`
--
ALTER TABLE `lots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bids`
--
ALTER TABLE `bids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
