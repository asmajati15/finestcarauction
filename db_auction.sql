-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2023 at 05:01 PM
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
  `bid_price` bigint(20) DEFAULT NULL,
  `lot_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` int(4) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_time` timestamp NULL DEFAULT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bids`
--

INSERT INTO `bids` (`id`, `bid_price`, `lot_id`, `user_id`, `snap_token`, `payment_status`, `transaction_id`, `jumlah_pembayaran`, `payment_status_message`, `transaction_time`, `payment_type`, `created_at`, `updated_at`) VALUES
(1, 200000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 08:15:59', '2023-02-20 08:15:59'),
(2, 500000, 4, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 08:17:32', '2023-02-20 08:17:32'),
(3, 502000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 17:17:31', '2023-02-20 17:17:31'),
(4, 503000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 17:34:42', '2023-02-24 03:28:16'),
(5, 505000, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 17:34:50', '2023-02-20 17:34:50'),
(6, 506000, 4, 1, '2127a85b-9ded-4ca1-abbc-a517d6b6b1c4', 200, '1678677574', '506000.00', 'Success, Credit Card transaction is successful', '2023-03-13 03:20:27', 'credit', '2023-02-20 18:09:10', '2023-03-13 03:19:35'),
(7, 150200, 5, 2, NULL, NULL, '1677796622', NULL, NULL, NULL, NULL, '2023-02-20 20:49:52', '2023-03-02 22:37:02'),
(8, 150100, 5, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-20 20:49:52', '2023-03-02 22:37:02'),
(31, 360000, 44, 1, '05fb30bd-3888-4770-a08b-15602b6c0875', 200, '1678678660', '360000.00', 'Success, Credit Card transaction is successful', '2023-03-13 03:38:10', 'credit', '2023-03-13 03:36:17', '2023-03-13 03:37:40'),
(42, 8500000, 45, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-13 14:05:24', '2023-03-13 14:06:59');

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

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Car Parts', '2023-02-26 08:44:56', '2023-02-26 08:44:56'),
(3, 'Racewear', '2023-02-26 08:45:57', '2023-02-26 08:45:57'),
(4, 'Team Merchandise', '2023-02-26 08:46:14', '2023-03-02 15:49:24');

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
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `final_price` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `bid_increment` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `status` int(1) UNSIGNED DEFAULT 1 COMMENT '0=Close\r\n1=Open\r\n2=Paused/Pending\r\n3=Hidden',
  `tracking_number` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lots`
--

INSERT INTO `lots` (`id`, `name`, `description`, `image`, `start_price`, `final_price`, `bid_increment`, `user_id`, `category_id`, `end_time`, `status`, `tracking_number`, `created_at`, `updated_at`) VALUES
(4, 'Official Alfa Romeo F1® Team Stake 2023 C43 Launch Car - Signed Chassis No. 1', 'This car represents a world first - the first time an official F1 launch car has become available to the public. Now you have a chance to own the Alfa\'s 2023 car - the first chassis.   Traditionally built exclusively for F1 teams and partners, this limited production is the first for 2023.  In 2022, the C42 Show Cars sold through F1 Authentics were the first of their kind from a current season to be made available for public.  Now the C43 follows its path, offering collectors the chance to own a current car.    This exquisite car dons the striking 2023 Alfa Romeo F1® Team Stake and features the sponsorship branding and liveries that the race cars driven by Bottas and Zhou will showcase for the 2023 season.   The 2023 Launch Car has been specifically designed for show car purposes and not for competition and has been constructed to withstand the load\'s exerted for show car purposes.  The Chassis and Body work is constructed from high performance, lightweight pre preg Carbon Fibre and are designed to represent', '20230220150214.jpg', 500000, 506000, 1000, 1, 2, '2023-03-13 10:18:11', 3, 1234567890, '2023-02-20 08:02:14', '2023-03-13 15:20:37'),
(5, '2022 Oracle Red Bull Racing RB18 Show Car Simulator – Champions Edition', 'This Show Car Simulator has been expertly made by Memento Exclusives (F1 Authentics) in collaboration with the 2022 Constructors’ World Championship-winning team, Oracle Red Bull Racing. Created using the same processes as the real race cars, these Show Car Simulators offer an unparalleled F1 experience. These simulators are also very similar to the ones used by the drivers themselves as they prepare to storm the F1 tracks, allowing you to feel even closer to the sport and the drivers you love.  Each Simulator has been made from official Oracle Red Bull Racing CAD data and has been developed using composite tooling to create patterns, which are then used to make carbon fibre moulds via an autoclave. Each mould is then used to recreate each specific part of the car’s bodywork. The Champions Edition simulator comes with a show car nose and front wing assembly, completing the simulator for a more authentic experience and look.   The hardware is finalised in partnership with the race team, providing only the best market-leading options. This simulator also gives you the choice to have either Max Verstappen\'s Championship-winning livery or Sergio Pérez’s livery from the season, meaning you can tailor the simulator to your chosen F1 driver preference. Use the drop down above to select your driver livery preference.', '20230220162710.jpg', 150000, 160000, 10000, 2, 1, '2023-02-22 03:26:00', 0, NULL, '2023-02-20 09:27:10', '2023-02-20 20:49:52'),
(44, 'Fernando Alonso 2022 Signed Team Cap', 'After re-joining the F1 grid at the start of the 2021 season, Alonso continued with the French team for the 2022 season, finishing in ninth place in the Drivers\' Championship. The 2022 season has been Alonso’s final year with the team before he moves to Aston Martin in 2023.   This team cap dons the liveries chosen by the team for the 2022 FIA Formula One World Championship™ and features an autograph from Fernando Alonso. An awesome collectible for fans of the Champion, this cap is not to be missed.', '20230226160011.jpg', 350000, 360000, 10000, 1, 0, '2023-03-13 03:37:32', 0, 1234567890, '2023-02-26 09:00:12', '2023-03-13 14:57:31'),
(45, 'Scuderia Ferrari F1-75 2022 1:1 Scale Model Steering Wheel', 'Celebrate Scuderia Ferrari and the 2022 FIA Formula One World Championship™ with this 1:1 scale model of the Scuderia Ferrari F1-75 steering wheel.  This full-size replica of the Ferrari F1-75 steering wheel, recreates the one used by Charles Leclerc and Carlos Sainz in 2022, and will be handcrafted and finished with assistance of Scuderia Ferrari regarding original CAD data, finishes and paint codes.', '20230302232715.jpg', 8000000, 8500000, 500000, 1, 2, '2023-04-16 17:00:05', 1, NULL, '2023-03-02 16:27:15', '2023-03-13 14:22:40'),
(46, 'Mercedes-AMG Petronas Formula One Team 2021 Rear Wheel Rim Table', 'Painted with 2021 Mercedes-AMG liveries, these wheel rims are all unique and were race-used during the team’s 2017 season. Celebrating the Silver Arrow team and drivers Lewis Hamilton and Valtteri Bottas, these tables allow you to bring the action of the tracks into your home.  Topped with glass for a sleek finish, these Mercedes wheel rim tables are ready to hold your drinks whilst you watch the Grands Prix.', '20230313111113.jpg', 5000000, 5000000, 100000, NULL, 3, '2023-03-27 17:00:57', 2, NULL, '2023-03-13 04:11:13', '2023-03-13 15:21:47'),
(48, 'Lewis Hamilton 2022 Official Replica Race Suit', 'Lewis Hamilton had a strong season and helped the team finish third in the Constructors\' World Championship, finishing sixth himself in the Drivers Standings. He claimed nine podiums throughout the season. Hamilton is the most successful F1 driver in history with the most race wins to his name as well as seven World Titles - six of which he has won with Mercedes.  This official replica race suit features the official team details seen on the one worn by Hamilton during the 2022 season. This race suit will come professionally framed, making the perfect piece of F1 memorabilia to add to your collection.', '20230313165125.jpg', 500000, 500000, 100000, NULL, 3, '2023-04-18 17:00:00', 1, NULL, '2023-03-13 09:51:25', '2023-03-13 09:51:25'),
(49, 'David Coulthard 2000 McLaren Replica Race Suit (Warsteiner, West And Siemens Branding)', 'Driving for McLaren in 2000, it marked his fifth season with the iconic team. It was a great year for the Scottish driver, who finished third in the Drivers’ World Championship. He claimed three race victories that season as well as eight further podium finishes.   This race suit dons the liveries that McLaren used in 2000 and features the sponsorship branding seen on the real suits too – including Warsteiner, West and Siemens. This official replica comes professionally framed so you can hang it on your home or office walls as soon as you receive it.', '20230313213127.jpg', 5000000, 5000000, 500000, NULL, 3, '2023-03-20 14:30:00', 1, NULL, '2023-03-13 14:31:27', '2023-03-13 14:31:27'),
(50, 'Mick Schumacher 2022 Signed Official Replica Helmet – Miami Edition', 'Mick joined the F1 grid at the start of the 2021 season, following in the footsteps of his seven-time World Champion father, Michael Schumacher. Mick is only at the start of his career but will be one to watch. Schumacher claimed 12 points across the 2022 season, with his highest race finish being 6th, which he achieved at the Austrian Grand Prix. Mick will join the Mercedes-AMG Petronas Formula One Team as a reserve driver for the 2023 season.', '20230313213351.jpg', 25000000, 25000000, 5000000, NULL, 3, '2023-03-26 17:00:00', 1, NULL, '2023-03-13 14:33:51', '2023-03-13 14:33:51'),
(51, 'Sebastian Vettel 2022 Bodywork in Acrylic', 'This piece of bodywork has been hand cut from a section of Vettel’s AMR22 car, meaning each piece is completely unique. Each acrylic also features a floating digital signature of Vettel’s. This Bodywork in Acrylic is perfect for growing collections within the home or office.   After joining Aston Martin Aramco Cognizant F1 Team in 2021, Vettel claimed the team’s first ever podium in Formula 1 at the 2021 Azerbaijan Grand Prix. Vettel remained with the team for the 2022 season and performed well on the track, securing points across 10 races, ultimately finishing 12th in the Drivers\' Championship.', '20230313213545.jpg', 200000, 200000, 50000, NULL, 4, '2023-04-02 17:00:00', 1, NULL, '2023-03-13 14:35:45', '2023-03-13 14:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'asmajati.cooler15@gmail.com', 'p test', '2023-03-13 13:05:20', '2023-03-13 13:05:20');

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
(8, '2023_02_01_005817_create_purchases_table', 1),
(11, '2023_03_13_195722_create_messages_table', 2);

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
  `type` int(4) NOT NULL DEFAULT 0,
  `status` int(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Asmajati', 'asmajati.cooler15@gmail.com', NULL, '$2y$10$LgeRgX3GFaaxeK6e0ReMbulzFpdm7VQ4m0c531oR/lXi7XzIwl1q6', 0, 0, 'lWXdythUgSr8ZagZ8Dvv3GGQnc84isJOJazyynmxsIoYFEMsmNnPpRrdGC1m', '2023-01-31 19:41:04', '2023-03-13 13:30:29'),
(2, 'Waluyo', 'waluyo@gmail.com', NULL, '$2y$10$SuQYI/iZKap2IDF3GR26jOkYOkR/z2D7oFbye7oaCAolerGl2rJbm', 0, 1, NULL, '2023-02-20 08:17:06', '2023-02-20 08:17:06'),
(3, 'Wildun', 'wildun@gmail.com', NULL, '$2y$10$8mun6nZ5OmLHy6s.znATh.tAIcK12OweFjyO4wIt2fP8SIl/2kuiO', 2, 0, NULL, '2023-03-02 14:28:14', '2023-03-13 15:52:48'),
(5, 'Asep Munawar', 'asepmnv14@gmail.com', NULL, '$2y$10$HNv3ZMVLlNOm4lFJFXHC1ulnSzvtoYGuzgf9/pI/N8nqXhkYyPSTC', 1, 0, NULL, '2023-03-13 13:41:11', '2023-03-13 15:53:16'),
(6, 'Tatang Sutarma', 'asep@gmail.com', NULL, '$2y$10$RpVGVfMeYAIgmhII6W38suXIEm3UF7H9lWqSN5KKXYDM2DErdpeci', 0, 0, NULL, '2023-03-13 14:08:31', '2023-03-13 14:08:31');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lots`
--
ALTER TABLE `lots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
