-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2025 at 04:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `full_name`, `username`, `password_hash`, `created_at`, `updated_at`) VALUES
(1, 'Abdo 2', 'Admin1', '$2y$10$e0u6ZT4JcOr29eP2TbPN3eEwNVcGgcWMzfevEEo6NqLMGl7tLFzde', '2025-09-25 03:42:53', '2025-09-25 04:39:14'),
(2, 'Michall Makrson ', 'Admin2', '$2y$10$5eOHr3GWdQ28rVWTYCfw..fsFFev5LubY2TlIpnMIyNFTmnoRfDpS', '2025-09-25 04:24:07', '2025-09-25 04:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `transaction_group_id` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` varchar(50) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `transaction_group_id`, `user_id`, `campaign_id`, `payment_method_id`, `amount`, `notes`, `created_at`) VALUES
(5, 'txn_68d4e47d60614', 1, 'building-fund-2025', 4, 30.00, NULL, '2025-09-25 06:43:09'),
(6, 'txn_68d4e4cbdc7a5', 1, 'building-fund-2025', 6, 20.00, NULL, '2025-09-25 06:44:27'),
(7, 'txn_68db8d07c309e', 3, 'building-fund-2025', 5, 20.00, NULL, '2025-09-30 07:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `donation_campaigns`
--

CREATE TABLE `donation_campaigns` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `goal_amount` decimal(12,2) DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('Upcoming','Active','Completed','Cancelled') NOT NULL DEFAULT 'Upcoming'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_campaigns`
--

INSERT INTO `donation_campaigns` (`id`, `name`, `description`, `goal_amount`, `start_date`, `end_date`, `status`) VALUES
('building-fund-2025', 'New Building Fund 2025', 'Help us raise funds for the construction of our new community center, providing more space for activities.', 75000.00, '2025-01-01', '2025-12-31', 'Active'),
('youth-outreach-2026', 'Youth Outreach Program 2026', 'Funding for our annual youth outreach and community support program scheduled for next year.', 15000.00, '2026-01-01', '2026-03-31', 'Upcoming');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` datetime NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT 'images/events/default.jpg',
  `status` enum('Upcoming','Completed','Cancelled') NOT NULL DEFAULT 'Upcoming',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `location`, `image_path`, `status`, `created_at`) VALUES
(3, 'Annual Community Picnic', 'Join us for a day of fun, food, and fellowship at the park. All are welcome! Please RSVP by October 5th.', '2025-10-12 11:00:00', 'Central Park, Petaling Jaya', 'images/Events/Annual Community Picnic.jpg', 'Upcoming', '2025-09-25 04:49:05'),
(4, 'Charity Bake Sale', 'Support our local charities by purchasing delicious homemade goods. All proceeds will be donated.', '2025-11-08 09:00:00', 'Community Hall Entrance', 'images/Events/Charity Bake Sale.jpg', 'Upcoming', '2025-09-25 04:49:05'),
(6, 'Seasonal Festival', 'Host a Fall Festival, a Christmas Market, or an Easter Egg Hunt. These are great for attracting families from the local community.', '2025-12-01 15:00:00', 'sunway church', 'images/events/default.jpg', 'Upcoming', '2025-10-01 07:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

CREATE TABLE `event_attendees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `role` enum('Participant','Volunteer') NOT NULL DEFAULT 'Participant',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_attendees`
--

INSERT INTO `event_attendees` (`id`, `user_id`, `event_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Participant', '2025-09-25 06:53:43', '2025-09-25 06:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `form_slug` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `event_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_slug`, `title`, `description`, `status`, `event_id`) VALUES
(1, 'dummy-test', 'testing', NULL, 'Active', NULL),
(2, 'annual-community-picnic-Event', 'Annual Community Picnic Event', NULL, 'Active', 3),
(3, 'MCOM-Student-Connect-Form', 'MCOM Student Connect Form', NULL, 'Active', NULL),
(4, 'Connect-Card-Form', 'Connect Card Form', NULL, 'Active', NULL),
(5, 'Prayer-Request-Form', 'Prayer Request Form', NULL, 'Active', NULL),
(6, 'MCOM-Kids-Serve-Team-Form', 'MCOM Kids Serve Team Form', NULL, 'Active', NULL),
(7, 'MCOM-Kids-Baptism-Interest-Form', 'MCOM Kids Baptism Interest Form', NULL, 'Active', NULL),
(8, 'Special-Needs-First-Time-Guest-Form', 'Special Needs First Time Guest Form', NULL, 'Active', NULL),
(9, 'Legacy-Team-Interest-Form', 'Legacy Team Interest Form', NULL, 'Active', NULL),
(10, 'MCOM-Kids-First-Time-Guest-Registration-Form', 'MCOM Kids First Time Guest Registration Form', NULL, 'Active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

CREATE TABLE `form_fields` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `field_label` varchar(255) NOT NULL,
  `field_type` enum('text','email','tel','textarea','select','checkbox','radio','date') NOT NULL,
  `field_options` text DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL DEFAULT 0,
  `display_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `form_id`, `field_label`, `field_type`, `field_options`, `is_required`, `display_order`) VALUES
(6, 1, 'food', 'checkbox', 'rice, bread', 1, 1),
(7, 1, 'drink', 'radio', 'cola, juice, tea, coffee', 0, 2),
(12, 3, 'Full Name', 'text', '', 1, 1),
(13, 3, 'Email', 'email', '', 1, 2),
(14, 3, 'Contact Number', 'tel', '', 0, 3),
(15, 3, 'Address', 'text', '', 0, 4),
(16, 3, 'Birthday', 'date', '', 1, 5),
(17, 3, 'Gender', 'checkbox', 'Male, Female', 1, 6),
(18, 3, 'Grade', 'radio', '6th, 7th, 8th, 9th, 10th, 11th, 12th', 1, 7),
(19, 3, 'School', 'text', '', 0, 8),
(20, 3, 'Paren Full Name', 'text', '', 1, 9),
(21, 3, 'Parent Contact Number', 'tel', '', 0, 10),
(22, 3, 'Did your parents attend church with you today?', 'radio', 'Yes, No', 1, 11),
(42, 6, 'Full Name', 'text', '', 1, 1),
(43, 6, 'Email', 'email', '', 1, 2),
(44, 6, 'Contact Number', 'tel', '', 0, 3),
(45, 6, 'I prefer to serve in the following area(s):', 'checkbox', 'Elementary, Preschool, special needs schools', 1, 4),
(46, 6, 'I can serve on the following date(s)', 'checkbox', 'September 5, October 1, November 2, December 3', 1, 5),
(47, 4, 'Full Name', 'text', '', 1, 1),
(48, 4, 'Email', 'email', '', 1, 2),
(49, 4, 'Contact Number', 'tel', '', 0, 3),
(50, 4, 'Birthday', 'date', '', 0, 4),
(51, 4, 'Gender', 'radio', 'Male, Female', 1, 5),
(52, 4, 'Marital Status', 'select', 'Single, Married, Divorced', 1, 6),
(53, 4, 'Which service did you attend?', 'radio', '8:00 am, 9:00 am, 11:00 am', 1, 7),
(54, 5, 'Full Name', 'text', '', 1, 1),
(55, 5, 'Email', 'email', '', 1, 2),
(56, 5, 'Contact Number', 'tel', '', 0, 3),
(57, 5, 'How can we pray for you?', 'textarea', '', 1, 4),
(62, 2, 'Full Name', 'text', '', 1, 1),
(63, 2, 'Email', 'email', '', 0, 2),
(64, 2, 'Contact Number', 'tel', '', 1, 3),
(65, 2, 'I would like to participate as ....', 'select', 'Participant, Volunteer', 1, 4),
(66, 7, 'Parent Full Name', 'text', '', 1, 1),
(67, 7, 'Parent Email', 'email', '', 1, 2),
(68, 7, 'Parent Contact Number', 'tel', '', 0, 3),
(69, 7, 'Child\'s Name and Age', 'text', '', 1, 4),
(72, 8, 'Full Name', 'text', '', 1, 1),
(73, 8, 'Email', 'email', '', 1, 2),
(74, 8, 'Contact Number', 'tel', '', 1, 3),
(75, 8, 'Spouse\'s Name', 'text', '', 1, 4),
(76, 8, 'Spouse\'s Email', 'email', '', 1, 5),
(77, 8, 'Spouse\'s Contact Number', 'tel', '', 1, 6),
(78, 8, 'Child\'s Name', 'text', '', 1, 7),
(79, 8, 'Child\'s Birthday', 'date', '', 1, 8),
(80, 8, 'Child\'s Gender', 'radio', 'Male, Female', 1, 9),
(81, 8, 'Any allergies we need to be aware of?', 'text', '', 1, 10),
(82, 8, 'Tell me a little about your child with special needs (medical challenges, diagnosis, etc.)', 'textarea', '', 1, 11),
(83, 8, 'When do you plan to visit?', 'date', '', 1, 12),
(84, 9, 'Full Name', 'text', '', 1, 1),
(85, 9, 'Email', 'email', '', 1, 2),
(86, 9, 'Contact Number', 'tel', '', 1, 3),
(87, 9, 'Are you ready to join out team?', 'radio', 'I am not ready to join the team but I want more information, I am interested in joining the team', 1, 4),
(89, 10, 'Full Name', 'text', '', 1, 1),
(90, 10, 'Email', 'email', '', 1, 2),
(91, 10, 'Contact Number', 'tel', '', 0, 3),
(92, 10, 'Spouse\'s Name', 'text', '', 1, 4),
(93, 10, 'Spouse\'s Email', 'email', '', 1, 5),
(94, 10, 'Spouse\'s Contact Number', 'tel', '', 1, 6),
(95, 10, 'How many children you have?', 'radio', '1, 2, 3, 4, 5, 6+', 1, 7),
(96, 10, 'Child/Children name(s)', 'textarea', '', 1, 8),
(97, 10, 'Child/Children name(s)', 'textarea', '', 1, 9),
(98, 10, 'Child/Children Age', 'textarea', '', 1, 10),
(99, 10, 'Any allergies we should know about for Child/Children?', 'textarea', '', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `form_submissions`
--

CREATE TABLE `form_submissions` (
  `id` int(11) NOT NULL,
  `form_slug` varchar(100) NOT NULL,
  `submission_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`submission_data`)),
  `status` enum('Unread','Read','Archived') NOT NULL DEFAULT 'Unread',
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_submissions`
--

INSERT INTO `form_submissions` (`id`, `form_slug`, `submission_data`, `status`, `submitted_at`) VALUES
(1, 'dummy-test', '{\n    \"drink\": \"cola\"\n}', 'Unread', '2025-10-01 03:52:18'),
(2, 'dummy-test', '{\n    \"food\": \"rice\",\n    \"drink\": \"tea\"\n}', 'Unread', '2025-10-01 04:05:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`) VALUES
(1, 1, 21.99, 'Pending', '2025-09-25 07:35:52'),
(2, 2, 15.99, 'Pending', '2025-09-25 07:38:15'),
(3, 2, 16.50, 'Pending', '2025-09-25 07:38:59'),
(4, 1, 22.99, 'Pending', '2025-09-25 07:40:22'),
(5, 1, 7.50, 'Pending', '2025-09-25 07:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_item` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_per_item`) VALUES
(1, 1, 'PROD_SOAP_002', 2, 7.50),
(2, 1, 'PROD_SOAP_001', 1, 6.99),
(3, 2, 'PROD_OIL_002', 1, 15.99),
(4, 3, 'PROD_PERF_002', 1, 16.50),
(5, 4, 'PROD_CANDLE_002', 1, 22.99),
(6, 5, 'PROD_SOAP_002', 1, 7.50);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`) VALUES
(5, 'Bank Transfer'),
(4, 'Credit Card'),
(6, 'E-Wallet');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `category_id` varchar(50) DEFAULT NULL,
  `sku` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sku`, `name`, `description`, `price`, `stock_quantity`, `created_at`, `updated_at`) VALUES
('PROD_CANDLE_001', 'CAT_CANDLE_001', 'CANDLE-BEE-001', 'Beeswax Prayer Candle', 'Pure beeswax votive candle with natural honey scent. Burn cleanly for prayer intentions and meditation.', 8.99, 100, '2025-09-25 07:26:22', '2025-09-25 07:26:22'),
('PROD_CANDLE_002', 'CAT_CANDLE_001', 'CANDLE-PILLAR-001', 'Frankincense Pillar Candle', 'Dripless pillar candle with Frankincense essential oil. Decorated with cross symbol. Burns for 40+ hours.', 22.99, 39, '2025-09-25 07:26:22', '2025-09-25 07:40:22'),
('PROD_OIL_001', 'CAT_OIL_001', 'OIL-FM-001', 'Frankincense & Myrrh Anointing Oil', 'A sacred blend of Frankincense and Myrrh essential oils in a base of pure olive oil. Blessed for personal prayer and meditation. Symbolizes prayer and sacrifice.', 12.99, 50, '2025-09-25 07:26:22', '2025-09-25 07:26:22'),
('PROD_OIL_002', 'CAT_OIL_001', 'OIL-SPIKE-001', 'Spikenard Devotional Oil', 'Pure Spikenard essential oil in jojoba base. reminiscent of Mary\'s anointing of Jesus. For deep prayer and dedication.', 15.99, 29, '2025-09-25 07:26:22', '2025-09-25 07:38:15'),
('PROD_PERF_001', 'CAT_PERFUME_001', 'PERF-ROSE-001', 'Rose of Sharon Solid Perfume', 'Beeswax-based solid perfume with Rose essential oil. Subtle, personal fragrance symbolizing Christ\'s love. From Song of Solomon.', 18.99, 25, '2025-09-25 07:26:22', '2025-09-25 07:26:22'),
('PROD_PERF_002', 'CAT_PERFUME_001', 'PERF-SANDAL-001', 'Sandalwood Devotion Roll-On', 'Natural perfume oil with Sandalwood and Cedarwood. Grounding scent for daily devotion and prayer.', 16.50, 34, '2025-09-25 07:26:22', '2025-09-25 07:38:59'),
('PROD_SOAP_001', 'CAT_SOAP_001', 'SOAP-MYRRH-001', 'Myrrh Prayer Soap', 'Handmade olive oil soap infused with Myrrh essential oil. For daily cleansing as a spiritual practice. Reminds of sacrifice and purification.', 6.99, 74, '2025-09-25 07:26:22', '2025-09-25 07:35:52'),
('PROD_SOAP_002', 'CAT_SOAP_001', 'SOAP-GOAT-001', 'Goat Milk & Frankincense Soap', 'Gentle goat milk soap with Frankincense essential oil. Moisturizing and spiritually uplifting for morning renewal.', 7.50, 57, '2025-09-25 07:26:22', '2025-09-25 07:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`) VALUES
('CAT_CANDLE_001', 'Candle', 'Prayer candles symbolizing the light of Christ. Includes votive candles, pillar candles, and beeswax candles for meditation and remembrance.'),
('CAT_OIL_001', 'Oil', 'Anointing oils and fragrant oils for personal devotion, prayer, and meditation. Includes biblical-inspired essential oils like Frankincense, Myrrh, and Spikenard.'),
('CAT_PERFUME_001', 'Perfume', 'Subtle, personal fragrances for devotion. Includes solid perfumes and roll-ons with biblical scents like Rose of Sharon and Sandalwood.'),
('CAT_SOAP_001', 'Soap', 'Natural, gently scented soaps for spiritual cleansing and renewal. Made with olive oil, goat milk, and biblical essences like Frankincense and Myrrh.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `persistent_token` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `total_item_purchased` int(11) NOT NULL DEFAULT 0,
  `last_purchased_item` varchar(255) DEFAULT NULL,
  `total_donation` decimal(12,2) NOT NULL DEFAULT 0.00,
  `last_donation` decimal(10,2) DEFAULT NULL,
  `total_attended_events` int(11) NOT NULL DEFAULT 0,
  `last_event_attended` varchar(255) DEFAULT NULL,
  `attend_upcoming_event` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `contact_number`, `persistent_token`, `status`, `total_item_purchased`, `last_purchased_item`, `total_donation`, `last_donation`, `total_attended_events`, `last_event_attended`, `attend_upcoming_event`, `created_at`, `updated_at`) VALUES
(1, 'Maria Smith', 'maria@mcom.com', '01477778888', '08f3fd3e315267e80bdcda0a25d3a191e1e69a0fcb7241d61bce6328e7c8d365', 'Active', 5, 'Goat Milk & Frankincense Soap', 50.00, 20.00, 1, NULL, 'Annual Community Picnic', '2025-09-25 06:43:09', '2025-09-26 04:13:51'),
(2, 'Anderson Marson', 'anderson@mcom.com', '0124578333', '5127a686d356d248d5113d66908cad6e3200ddb0fd1821764470d500e15e89c7', 'Active', 2, 'Sandalwood Devotion Roll-On', 0.00, NULL, 0, NULL, NULL, '2025-09-25 07:38:15', '2025-09-26 04:09:13'),
(3, 'Walter White', 'walter@mcom.com', '01233664455', 'ee00a65f84b5f4cc9e38f14ef2655de9c2bb3ba9e43d3c1f5bcc37685a681740', 'Active', 0, NULL, 20.00, 20.00, 0, NULL, NULL, '2025-09-30 07:55:51', '2025-09-30 07:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_notes`
--

CREATE TABLE `user_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visiting_now`
--

CREATE TABLE `visiting_now` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `members_joining` text DEFAULT NULL,
  `visit_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `payment_method_id` (`payment_method_id`);

--
-- Indexes for table `donation_campaigns`
--
ALTER TABLE `donation_campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_event_unique` (`user_id`,`event_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_slug` (`form_slug`),
  ADD KEY `fk_form_event` (`event_id`);

--
-- Indexes for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `form_submissions`
--
ALTER TABLE `form_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_slug` (`form_slug`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `persistent_token_unique` (`persistent_token`);

--
-- Indexes for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `visiting_now`
--
ALTER TABLE `visiting_now`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `form_fields`
--
ALTER TABLE `form_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `form_submissions`
--
ALTER TABLE `form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_notes`
--
ALTER TABLE `user_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visiting_now`
--
ALTER TABLE `visiting_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `fk_donation_campaign` FOREIGN KEY (`campaign_id`) REFERENCES `donation_campaigns` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donation_payment` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donation_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `fk_attendee_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_attendee_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `fk_form_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_item_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `product_categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_notes`
--
ALTER TABLE `user_notes`
  ADD CONSTRAINT `fk_note_admin` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_note_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visiting_now`
--
ALTER TABLE `visiting_now`
  ADD CONSTRAINT `fk_visiting_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
