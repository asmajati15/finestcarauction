-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 05:37 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
  `bid_price` bigint(20) DEFAULT NULL,
  `lot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `payment_status` int(4) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `jumlah_pembayaran` varchar(255) DEFAULT NULL,
  `payment_status_message` varchar(255) DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `bid_price`, `lot_id`, `user_id`, `snap_token`, `payment_status`, `transaction_id`, `jumlah_pembayaran`, `payment_status_message`, `transaction_time`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 200000000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 08:15:59', '2023-02-20 08:15:59'),
(2, 500000000, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 08:17:32', '2023-02-20 08:17:32'),
(3, 502000000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 17:17:31', '2023-02-20 17:17:31'),
(4, 503000000, 4, 1, 'ddba3cce-09d3-45a1-8d37-4847000d5586', NULL, '1677457765', NULL, NULL, NULL, NULL, '2023-02-20 17:34:42', '2023-02-27 00:29:26'),
(5, 505000000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 17:34:50', '2023-02-20 17:34:50'),
(6, 506000000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 18:09:10', '2023-02-20 18:09:10'),
(7, 1501000000, 5, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 20:49:52', '2023-02-20 20:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Car Part', '2023-02-27 02:38:40', '2023-02-27 02:38:40'),
(2, 'Team Merchandise', '2023-02-27 02:38:50', '2023-02-27 02:38:50'),
(3, 'Race Wear', '2023-02-27 02:39:12', '2023-02-27 02:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `lots`
--

CREATE TABLE `lots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `final_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `bid_increment` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `status` int(1) UNSIGNED DEFAULT NULL COMMENT '0=Close\r\n1=Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `name`, `description`, `image`, `start_price`, `final_price`, `bid_increment`, `user_id`, `category_id`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Official Alfa Romeo F1® Team Stake 2023 C43 Launch Car - Signed Chassis No. 1', 'This car represents a world first - the first time an official F1 launch car has become available to the public. Now you have a chance to own the Alfa\'s 2023 car - the first chassis.   Traditionally built exclusively for F1 teams and partners, this limited production is the first for 2023.  In 2022, the C42 Show Cars sold through F1 Authentics were the first of their kind from a current season to be made available for public.  Now the C43 follows its path, offering collectors the chance to own a current car.    This exquisite car dons the striking 2023 Alfa Romeo F1® Team Stake and features the sponsorship branding and liveries that the race cars driven by Bottas and Zhou will showcase for the 2023 season.   The 2023 Launch Car has been specifically designed for show car purposes and not for competition and has been constructed to withstand the load\'s exerted for show car purposes.  The Chassis and Body work is constructed from high performance, lightweight pre preg Carbon Fibre and are designed to represent', '20230220150214.jpg', 100000000, 506000000, 1000000, 1, 1, '2023-02-20 17:00:00', 0, '2023-02-20 08:02:14', '2023-02-20 18:09:10'),
(5, '2022 Oracle Red Bull Racing RB18 Show Car Simulator – Champions Edition', 'This Show Car Simulator has been expertly made by Memento Exclusives (F1 Authentics) in collaboration with the 2022 Constructors’ World Championship-winning team, Oracle Red Bull Racing. Created using the same processes as the real race cars, these Show Car Simulators offer an unparalleled F1 experience. These simulators are also very similar to the ones used by the drivers themselves as they prepare to storm the F1 tracks, allowing you to feel even closer to the sport and the drivers you love.  Each Simulator has been made from official Oracle Red Bull Racing CAD data and has been developed using composite tooling to create patterns, which are then used to make carbon fibre moulds via an autoclave. Each mould is then used to recreate each specific part of the car’s bodywork. The Champions Edition simulator comes with a show car nose and front wing assembly, completing the simulator for a more authentic experience and look.   The hardware is finalised in partnership with the race team, providing only the best market-leading options. This simulator also gives you the choice to have either Max Verstappen\'s Championship-winning livery or Sergio Pérez’s livery from the season, meaning you can tailor the simulator to your chosen F1 driver preference. Use the drop down above to select your driver livery preference.', '20230220162710.jpg', 1500000000, 1501000000, 1000000, 2, 1, '2023-02-22 03:26:00', 0, '2023-02-20 09:27:10', '2023-02-20 20:49:52'),
(43, 'Mercedes-AMG Petronas Formula One Team 2021 Rear Wheel Rim Table', 'Painted with 2021 Mercedes-AMG liveries, these wheel rims are all unique and were race-used during the team’s 2017 season. Celebrating the Silver Arrow team and drivers Lewis Hamilton and Valtteri Bottas, these tables allow you to bring the action of the tracks into your home.  Topped with glass for a sleek finish, these Mercedes wheel rim tables are ready to hold your drinks whilst you watch the Grands Prix.', '20230222061040.jpg', 80000000, 80000000, 1000000, NULL, 2, '2023-02-28 02:45:00', 1, '2023-02-21 23:10:40', '2023-02-27 02:45:44'),
(44, 'Scuderia Ferrari F2-75 2022 1:1 Scale Model Steering Wheel', 'Celebrate Scuderia Ferrari and the 2022 FIA Formula One World Championship™ with this 1:1 scale model of the Scuderia Ferrari F1-75 steering wheel.  This full-size replica of the Ferrari F1-75 steering wheel, recreates the one used by Charles Leclerc and Carlos Sainz in 2022, and will be handcrafted and finished with assistance of Scuderia Ferrari regarding original CAD data, finishes and paint codes.', '20230227094647.jpg', 80000000, 80000000, 2500000, NULL, 1, '2023-03-09 17:00:00', 1, '2023-02-27 02:46:47', '2023-02-27 02:47:00'),
(45, 'Sportpesa Racing Point F1 Team 2019 Race Used Front Wing', 'Own a piece of F1 racing history with this official race used front wing taken from a SportPesa Racing Point race car used in the 2019 season.    Features:    Official F1 memorabilia   Front Wing   SportPesa Racing Point race team  2019 F1 season  ‘SPORT’ sponsorship branding of ‘SportPesa’  Dimensions: 720mmD X 2300H X 1970mmW approximately  This official 2019 race used front wing was used by the SportPesa Racing Point F1 team during the 2019 season, with Sergio Pérez and Lance Stroll behind the wheel.    The front wings are a crucial element of any F1 race car, as they are the first part of the car to hit the airflow and therefore dictates the car’s shape and aerodynamics. It is angled to encourage air up and over the bodywork.   Become the proud owner of this unmissable piece of F1 history.', '20230227094746.jpg', 130000000, 130000000, 5000000, NULL, 1, '2023-03-05 17:00:00', NULL, '2023-02-27 02:47:46', '2023-02-27 02:47:46'),
(46, 'Sebastian Vettel 2022 Official Replica Race Suit', 'Vettel joined the iconic Aston Martin F1 team at the start of 2021 and claimed the team’s first ever podium with a second place in Azerbaijan (2021). Now after his second season with the team and final season in F1, the driver has had a respectable last season.   This official replica race suit features the striking dark green Aston Martin liveries and detailing and will come professionally framed ready for you to display.   Celebrate Vettel\'s epic F1 career, with a piece of his last chapter in F1.', '20230227094926.jpg', 60000000, 60000000, 2500000, NULL, 3, '2023-03-12 17:00:00', NULL, '2023-02-27 02:49:26', '2023-02-27 02:49:26'),
(47, 'Valtterri Bottas 2022 Signed Official Race Suit', 'Celebrate Valtteri Bottas’ first season with his new team, Alfa Romeo F1 Team ORLEN, with this official replica race suit, recreating the ones worn by the Finn during the 2022 FIA Formula One World Championship™. This special race suit will also be signed by Bottas! Valtteri joined Alfa Romeo F1 Team ORLEN at the start of the 2022 season, embarking on a new chapter of his F1 career. Already a ten-time race winner and 67-time podium finisher, Valtteri brings with him to the team years of experience. In 2022, donning the new team name, he will be on the hunt for more strong finishes to add to his growing collection.   This official replica race suit features the striking Alfa Romeo F1 Team ORLEN liveries and detailing and will be autographed by Valtteri. It will come professionally framed so you can display it amongst your F1 memorabilia with pride.', '20230227095028.jpg', 50000000, 50000000, 2500000, NULL, 3, '2023-03-12 17:00:00', NULL, '2023-02-27 02:50:28', '2023-02-27 02:50:28'),
(48, 'Zhou Guanyu 2022 Signed Official Replica Helmet', 'Zhou joined Alfa Romeo F1 Team ORLEN at the start of the 2022 season, marking his rookie season in the sport. Having impressed on track, Zhou remains one to watch.   This official half scale replica helmet has been made using similar materials to the original, making it the perfect addition to any F1 collection.', '20230227095227.jpg', 100000000, 100000000, 10000000, NULL, 3, '2023-03-09 17:00:00', NULL, '2023-02-27 02:52:27', '2023-02-27 02:52:27'),
(49, 'Lewis Hamilton 2020 Mercedes-AMG Petronas Formula One Team Official Replica Halo', 'Recreating the iconic car part, which was introduced in 2018 for extra driver safety. The halo is made using carbon fibre, staying authentic to the race used car parts.    Painted by the Mercedes-AMG Petronas team themselves, this halo has been decorated with 2020 team livery- their last double Championship Winning year (Drivers’ and Constructors’), marking a memorable year for the team.    This halo is the perfect way to celebrate an incredible F1 season for the team.    This halo has been produced by F1 Authentics and is now ready for fans of the sport to own and display.', '20230227095436.jpg', 20000000, 20000000, 500000, NULL, 1, '2023-04-08 17:00:00', NULL, '2023-02-27 02:54:36', '2023-02-27 02:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
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
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Asmajati', 'asmajati.cooler15@gmail.com', NULL, '$2y$10$LgeRgX3GFaaxeK6e0ReMbulzFpdm7VQ4m0c531oR/lXi7XzIwl1q6', 0, NULL, '2023-01-31 19:41:04', '2023-01-31 19:41:04'),
(2, 'Waluyo', 'waluyo@gmail.com', NULL, '$2y$10$SuQYI/iZKap2IDF3GR26jOkYOkR/z2D7oFbye7oaCAolerGl2rJbm', 1, NULL, '2023-02-20 08:17:06', '2023-02-20 08:17:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bids`
--
ALTER TABLE `bids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lot_id` (`lot_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bids`
--
ALTER TABLE `bids`
  ADD CONSTRAINT `bids_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lots`
--
ALTER TABLE `lots`
  ADD CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
