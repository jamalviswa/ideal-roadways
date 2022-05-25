-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 04:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idealroadways_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `truck_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `load_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL,
  `status` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'view'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `truck_id`, `load_id`, `user_id`, `created_at`, `updated_at`, `remark`, `cancel_by`, `status`) VALUES
(1, '1', '1', '-1', '2021-07-10 08:23:56', '2021-07-29 13:48:58', 'djkdj', 1, 'cancel'),
(2, '2', '6', '-1', '2021-07-30 00:03:21', '2021-07-30 00:03:21', NULL, NULL, 'view');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(240) COLLATE utf8mb4_unicode_ci DEFAULT 'ideal12#',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `password`, `phone`, `location`, `state`, `district`, `created_at`, `updated_at`) VALUES
(1, 'ideal chennai', 'ideal12#', '9942634001', 'madhawaram', '32', '554', '2021-07-10 08:10:02', '2021-07-10 08:10:02'),
(2, 'ideal tuticorin', 'ideal12#', '9976434001', '2/392 c by pass road, sipcot , tuticorin 628008', '32', '579', '2021-07-10 08:37:03', '2021-07-10 08:37:03'),
(3, 'ideal coimbatore', 'ideal12#', '7406444001', 'l & t by pass road, ag pudur, irugur, coimbatore', '32', '555', '2021-07-10 08:38:48', '2021-07-10 08:38:48'),
(4, 'ideal trichy', 'ideal12#', '9025034001', 'annai complex , tanjavur road, kattur, trichy', '32', '580', '2021-07-10 08:41:57', '2021-07-10 08:41:57'),
(5, 'ideal pondy', 'ideal12#', '9942234001', 'pondy - viluppuram road, tiruvandar koil, pondicherry', '28', '491', '2021-07-10 08:43:50', '2021-07-10 08:43:50'),
(6, 'ideal ranipettai', 'ideal12#', '9176834001', 'sipcot, ranipet', '32', '573', '2021-07-10 08:45:07', '2021-07-10 08:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `district_tables`
--

CREATE TABLE `district_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `district_tables`
--

INSERT INTO `district_tables` (`id`, `district`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Nicobar', 1, NULL, NULL),
(2, 'North Middle Andaman', 1, NULL, NULL),
(3, 'South Andaman', 1, NULL, NULL),
(4, 'Anantapur', 2, NULL, NULL),
(5, 'Chittoor', 2, NULL, NULL),
(6, 'East Godavari', 2, NULL, NULL),
(7, 'Guntur', 2, NULL, NULL),
(8, 'Kadapa', 2, NULL, NULL),
(9, 'Krishna', 2, NULL, NULL),
(10, 'Kurnool', 2, NULL, NULL),
(11, 'Nellore', 2, NULL, NULL),
(12, 'Prakasam', 2, NULL, NULL),
(13, 'Srikakulam', 2, NULL, NULL),
(14, 'Visakhapatnam', 2, NULL, NULL),
(15, 'Vizianagaram', 2, NULL, NULL),
(16, 'West Godavari', 2, NULL, NULL),
(17, 'Anjaw', 3, NULL, NULL),
(18, 'Central Siang', 3, NULL, NULL),
(19, 'Changlang', 3, NULL, NULL),
(20, 'Dibang Valley', 3, NULL, NULL),
(21, 'East Kameng', 3, NULL, NULL),
(22, 'East Siang', 3, NULL, NULL),
(23, 'Kamle', 3, NULL, NULL),
(24, 'Kra Daadi', 3, NULL, NULL),
(25, 'Kurung Kumey', 3, NULL, NULL),
(26, 'Lepa Rada', 3, NULL, NULL),
(27, 'Lohit', 3, NULL, NULL),
(28, 'Longding', 3, NULL, NULL),
(29, 'Lower Dibang Valley', 3, NULL, NULL),
(30, 'Lower Siang', 3, NULL, NULL),
(31, 'Lower Subansiri', 3, NULL, NULL),
(32, 'Namsai', 3, NULL, NULL),
(33, 'Pakke Kessang', 3, NULL, NULL),
(34, 'Papum Pare', 3, NULL, NULL),
(35, 'Shi Yomi', 3, NULL, NULL),
(36, 'Tawang', 3, NULL, NULL),
(37, 'Tirap', 3, NULL, NULL),
(38, 'Upper Siang', 3, NULL, NULL),
(39, 'Upper Subansiri', 3, NULL, NULL),
(40, 'West Kameng', 3, NULL, NULL),
(41, 'West Siang', 3, NULL, NULL),
(42, 'Bajali', 4, NULL, NULL),
(43, 'Baksa', 4, NULL, NULL),
(44, 'Barpeta', 4, NULL, NULL),
(45, 'Biswanath', 4, NULL, NULL),
(46, 'Bongaigaon', 4, NULL, NULL),
(47, 'Cachar', 4, NULL, NULL),
(48, 'Charaideo', 4, NULL, NULL),
(49, 'Chirang', 4, NULL, NULL),
(50, 'Darrang', 4, NULL, NULL),
(51, 'Dhemaji', 4, NULL, NULL),
(52, 'Dhubri', 4, NULL, NULL),
(53, 'Dibrugarh', 4, NULL, NULL),
(54, 'Dima Hasao', 4, NULL, NULL),
(55, 'Goalpara', 4, NULL, NULL),
(56, 'Golaghat', 4, NULL, NULL),
(57, 'Hailakandi', 4, NULL, NULL),
(58, 'Hojai', 4, NULL, NULL),
(59, 'Jorhat', 4, NULL, NULL),
(60, 'Kamrup', 4, NULL, NULL),
(61, 'Kamrup Metropolitan', 4, NULL, NULL),
(62, 'Karbi Anglong', 4, NULL, NULL),
(63, 'Karimganj', 4, NULL, NULL),
(64, 'Kokrajhar', 4, NULL, NULL),
(65, 'Lakhimpur', 4, NULL, NULL),
(66, 'Majuli', 4, NULL, NULL),
(67, 'Morigaon', 4, NULL, NULL),
(68, 'Nagaon', 4, NULL, NULL),
(69, 'Nalbari', 4, NULL, NULL),
(70, 'Sivasagar', 4, NULL, NULL),
(71, 'Sonitpur', 4, NULL, NULL),
(72, 'South Salmara-Mankachar', 4, NULL, NULL),
(73, 'Tinsukia', 4, NULL, NULL),
(74, 'Udalguri', 4, NULL, NULL),
(75, 'West Karbi Anglong', 4, NULL, NULL),
(76, 'Araria', 5, NULL, NULL),
(77, 'Arwal', 5, NULL, NULL),
(78, 'Aurangabad', 5, NULL, NULL),
(79, 'Banka', 5, NULL, NULL),
(80, 'Begusarai', 5, NULL, NULL),
(81, 'Bhagalpur', 5, NULL, NULL),
(82, 'Bhojpur', 5, NULL, NULL),
(83, 'Buxar', 5, NULL, NULL),
(84, 'Darbhanga', 5, NULL, NULL),
(85, 'East Champaran', 5, NULL, NULL),
(86, 'Gaya', 5, NULL, NULL),
(87, 'Gopalganj', 5, NULL, NULL),
(88, 'Jamui', 5, NULL, NULL),
(89, 'Jehanabad', 5, NULL, NULL),
(90, 'Kaimur', 5, NULL, NULL),
(91, 'Katihar', 5, NULL, NULL),
(92, 'Khagaria', 5, NULL, NULL),
(93, 'Kishanganj', 5, NULL, NULL),
(94, 'Lakhisarai', 5, NULL, NULL),
(95, 'Madhepura', 5, NULL, NULL),
(96, 'Madhubani', 5, NULL, NULL),
(97, 'Munger', 5, NULL, NULL),
(98, 'Muzaffarpur', 5, NULL, NULL),
(99, 'Nalanda', 5, NULL, NULL),
(100, 'Nawada', 5, NULL, NULL),
(101, 'Patna', 5, NULL, NULL),
(102, 'Purnia', 5, NULL, NULL),
(103, 'Rohtas', 5, NULL, NULL),
(104, 'Saharsa', 5, NULL, NULL),
(105, 'Samastipur', 5, NULL, NULL),
(106, 'Saran', 5, NULL, NULL),
(107, 'Sheikhpura', 5, NULL, NULL),
(108, 'Sheohar', 5, NULL, NULL),
(109, 'Sitamarhi', 5, NULL, NULL),
(110, 'Siwan', 5, NULL, NULL),
(111, 'Supaul', 5, NULL, NULL),
(112, 'Vaishali', 5, NULL, NULL),
(113, 'West Champaran', 5, NULL, NULL),
(114, 'Chandigarh', 6, NULL, NULL),
(115, 'Balod', 7, NULL, NULL),
(116, 'Baloda Bazar', 7, NULL, NULL),
(117, 'Balrampur', 7, NULL, NULL),
(118, 'Bastar', 7, NULL, NULL),
(119, 'Bemetara', 7, NULL, NULL),
(120, 'Bijapur', 7, NULL, NULL),
(121, 'Bilaspur', 7, NULL, NULL),
(122, 'Dantewada', 7, NULL, NULL),
(123, 'Dhamtari', 7, NULL, NULL),
(124, 'Durg', 7, NULL, NULL),
(125, 'Gariaband', 7, NULL, NULL),
(126, 'Gaurela Pendra Marwahi', 7, NULL, NULL),
(127, 'Janjgir Champa', 7, NULL, NULL),
(128, 'Jashpur', 7, NULL, NULL),
(129, 'Kabirdham', 7, NULL, NULL),
(130, 'Kanker', 7, NULL, NULL),
(131, 'Kondagaon', 7, NULL, NULL),
(132, 'Korba', 7, NULL, NULL),
(133, 'Koriya', 7, NULL, NULL),
(134, 'Mahasamund', 7, NULL, NULL),
(135, 'Mungeli', 7, NULL, NULL),
(136, 'Narayanpur', 7, NULL, NULL),
(137, 'Raigarh', 7, NULL, NULL),
(138, 'Raipur', 7, NULL, NULL),
(139, 'Rajnandgaon', 7, NULL, NULL),
(140, 'Sukma', 7, NULL, NULL),
(141, 'Surajpur', 7, NULL, NULL),
(142, 'Surguja', 7, NULL, NULL),
(143, 'Dadra Nagar Haveli', 8, NULL, NULL),
(144, 'Daman', 9, NULL, NULL),
(145, 'Diu', 9, NULL, NULL),
(146, 'Central Delhi', 10, NULL, NULL),
(147, 'East Delhi', 10, NULL, NULL),
(148, 'New Delhi', 10, NULL, NULL),
(149, 'North Delhi', 10, NULL, NULL),
(150, 'North East Delhi', 10, NULL, NULL),
(151, 'North West Delhi', 10, NULL, NULL),
(152, 'Shahdara', 10, NULL, NULL),
(153, 'South Delhi', 10, NULL, NULL),
(154, 'South East Delhi', 10, NULL, NULL),
(155, 'South West Delhi', 10, NULL, NULL),
(156, 'West Delhi', 10, NULL, NULL),
(157, 'North Goa', 11, NULL, NULL),
(158, 'South Goa', 11, NULL, NULL),
(159, 'Ahmedabad', 12, NULL, NULL),
(160, 'Amreli', 12, NULL, NULL),
(161, 'Anand', 12, NULL, NULL),
(162, 'Aravalli', 12, NULL, NULL),
(163, 'Banaskantha', 12, NULL, NULL),
(164, 'Bharuch', 12, NULL, NULL),
(165, 'Bhavnagar', 12, NULL, NULL),
(166, 'Botad', 12, NULL, NULL),
(167, 'Chhota Udaipur', 12, NULL, NULL),
(168, 'Dahod', 12, NULL, NULL),
(169, 'Dang', 12, NULL, NULL),
(170, 'Devbhoomi Dwarka', 12, NULL, NULL),
(171, 'Gandhinagar', 12, NULL, NULL),
(172, 'Gir Somnath', 12, NULL, NULL),
(173, 'Jamnagar', 12, NULL, NULL),
(174, 'Junagadh', 12, NULL, NULL),
(175, 'Kheda', 12, NULL, NULL),
(176, 'Kutch', 12, NULL, NULL),
(177, 'Mahisagar', 12, NULL, NULL),
(178, 'Mehsana', 12, NULL, NULL),
(179, 'Morbi', 12, NULL, NULL),
(180, 'Narmada', 12, NULL, NULL),
(181, 'Navsari', 12, NULL, NULL),
(182, 'Panchmahal', 12, NULL, NULL),
(183, 'Patan', 12, NULL, NULL),
(184, 'Porbandar', 12, NULL, NULL),
(185, 'Rajkot', 12, NULL, NULL),
(186, 'Sabarkantha', 12, NULL, NULL),
(187, 'Surat', 12, NULL, NULL),
(188, 'Surendranagar', 12, NULL, NULL),
(189, 'Tapi', 12, NULL, NULL),
(190, 'Vadodara', 12, NULL, NULL),
(191, 'Valsad', 12, NULL, NULL),
(192, 'Ambala', 13, NULL, NULL),
(193, 'Bhiwani', 13, NULL, NULL),
(194, 'Charkhi Dadri', 13, NULL, NULL),
(195, 'Faridabad', 13, NULL, NULL),
(196, 'Fatehabad', 13, NULL, NULL),
(197, 'Gurugram', 13, NULL, NULL),
(198, 'Hisar', 13, NULL, NULL),
(199, 'Jhajjar', 13, NULL, NULL),
(200, 'Jind', 13, NULL, NULL),
(201, 'Kaithal', 13, NULL, NULL),
(202, 'Karnal', 13, NULL, NULL),
(203, 'Kurukshetra', 13, NULL, NULL),
(204, 'Mahendragarh', 13, NULL, NULL),
(205, 'Mewat', 13, NULL, NULL),
(206, 'Palwal', 13, NULL, NULL),
(207, 'Panchkula', 13, NULL, NULL),
(208, 'Panipat', 13, NULL, NULL),
(209, 'Rewari', 13, NULL, NULL),
(210, 'Rohtak', 13, NULL, NULL),
(211, 'Sirsa', 13, NULL, NULL),
(212, 'Sonipat', 13, NULL, NULL),
(213, 'Yamunanagar', 13, NULL, NULL),
(214, 'Bilaspur', 14, NULL, NULL),
(215, 'Chamba', 14, NULL, NULL),
(216, 'Hamirpur', 14, NULL, NULL),
(217, 'Kangra', 14, NULL, NULL),
(218, 'Kinnaur', 14, NULL, NULL),
(219, 'Kullu', 14, NULL, NULL),
(220, 'Lahaul Spiti', 14, NULL, NULL),
(221, 'Mandi', 14, NULL, NULL),
(222, 'Shimla', 14, NULL, NULL),
(223, 'Sirmaur', 14, NULL, NULL),
(224, 'Solan', 14, NULL, NULL),
(225, 'Una', 14, NULL, NULL),
(226, 'Anantnag', 15, NULL, NULL),
(227, 'Bandipora', 15, NULL, NULL),
(228, 'Baramulla', 15, NULL, NULL),
(229, 'Budgam', 15, NULL, NULL),
(230, 'Doda', 15, NULL, NULL),
(231, 'Ganderbal', 15, NULL, NULL),
(232, 'Jammu', 15, NULL, NULL),
(233, 'Kathua', 15, NULL, NULL),
(234, 'Kishtwar', 15, NULL, NULL),
(235, 'Kulgam', 15, NULL, NULL),
(236, 'Kupwara', 15, NULL, NULL),
(237, 'Poonch', 15, NULL, NULL),
(238, 'Pulwama', 15, NULL, NULL),
(239, 'Rajouri', 15, NULL, NULL),
(240, 'Ramban', 15, NULL, NULL),
(241, 'Reasi', 15, NULL, NULL),
(242, 'Samba', 15, NULL, NULL),
(243, 'Shopian', 15, NULL, NULL),
(244, 'Srinagar', 15, NULL, NULL),
(245, 'Udhampur', 15, NULL, NULL),
(246, 'Bokaro', 16, NULL, NULL),
(247, 'Chatra', 16, NULL, NULL),
(248, 'Deoghar', 16, NULL, NULL),
(249, 'Dhanbad', 16, NULL, NULL),
(250, 'Dumka', 16, NULL, NULL),
(251, 'East Singhbhum', 16, NULL, NULL),
(252, 'Garhwa', 16, NULL, NULL),
(253, 'Giridih', 16, NULL, NULL),
(254, 'Godda', 16, NULL, NULL),
(255, 'Gumla', 16, NULL, NULL),
(256, 'Hazaribagh', 16, NULL, NULL),
(257, 'Jamtara', 16, NULL, NULL),
(258, 'Khunti', 16, NULL, NULL),
(259, 'Koderma', 16, NULL, NULL),
(260, 'Latehar', 16, NULL, NULL),
(261, 'Lohardaga', 16, NULL, NULL),
(262, 'Pakur', 16, NULL, NULL),
(263, 'Palamu', 16, NULL, NULL),
(264, 'Ramgarh', 16, NULL, NULL),
(265, 'Ranchi', 16, NULL, NULL),
(266, 'Sahebganj', 16, NULL, NULL),
(267, 'Seraikela Kharsawan', 16, NULL, NULL),
(268, 'Simdega', 16, NULL, NULL),
(269, 'West Singhbhum', 16, NULL, NULL),
(270, 'Bagalkot', 17, NULL, NULL),
(271, 'Bangalore Rural', 17, NULL, NULL),
(272, 'Bangalore Urban', 17, NULL, NULL),
(273, 'Belgaum', 17, NULL, NULL),
(274, 'Bellary', 17, NULL, NULL),
(275, 'Bidar', 17, NULL, NULL),
(276, 'Chamarajanagar', 17, NULL, NULL),
(277, 'Chikkaballapur', 17, NULL, NULL),
(278, 'Chikkamagaluru', 17, NULL, NULL),
(279, 'Chitradurga', 17, NULL, NULL),
(280, 'Dakshina Kannada', 17, NULL, NULL),
(281, 'Davanagere', 17, NULL, NULL),
(282, 'Dharwad', 17, NULL, NULL),
(283, 'Gadag', 17, NULL, NULL),
(284, 'Gulbarga', 17, NULL, NULL),
(285, 'Hassan', 17, NULL, NULL),
(286, 'Haveri', 17, NULL, NULL),
(287, 'Kodagu', 17, NULL, NULL),
(288, 'Kolar', 17, NULL, NULL),
(289, 'Koppal', 17, NULL, NULL),
(290, 'Mandya', 17, NULL, NULL),
(291, 'Mysore', 17, NULL, NULL),
(292, 'Raichur', 17, NULL, NULL),
(293, 'Ramanagara', 17, NULL, NULL),
(294, 'Shimoga', 17, NULL, NULL),
(295, 'Tumkur', 17, NULL, NULL),
(296, 'Udupi', 17, NULL, NULL),
(297, 'Uttara Kannada', 17, NULL, NULL),
(298, 'Vijayanagara', 17, NULL, NULL),
(299, 'Vijayapura ', 17, NULL, NULL),
(300, 'Yadgir', 17, NULL, NULL),
(301, 'Alappuzha', 18, NULL, NULL),
(302, 'Ernakulam', 18, NULL, NULL),
(303, 'Idukki', 18, NULL, NULL),
(304, 'Kannur', 18, NULL, NULL),
(305, 'Kasaragod', 18, NULL, NULL),
(306, 'Kollam', 18, NULL, NULL),
(307, 'Kottayam', 18, NULL, NULL),
(308, 'Kozhikode', 18, NULL, NULL),
(309, 'Malappuram', 18, NULL, NULL),
(310, 'Palakkad', 18, NULL, NULL),
(311, 'Pathanamthitta', 18, NULL, NULL),
(312, 'Thiruvananthapuram', 18, NULL, NULL),
(313, 'Thrissur', 18, NULL, NULL),
(314, 'Wayanad', 18, NULL, NULL),
(315, 'Kargil', 19, NULL, NULL),
(316, 'Leh', 19, NULL, NULL),
(317, 'Lakshadweep', 20, NULL, NULL),
(318, 'Agar Malwa', 21, NULL, NULL),
(319, 'Alirajpur', 21, NULL, NULL),
(320, 'Anuppur', 21, NULL, NULL),
(321, 'Ashoknagar', 21, NULL, NULL),
(322, 'Balaghat', 21, NULL, NULL),
(323, 'Barwani', 21, NULL, NULL),
(324, 'Betul', 21, NULL, NULL),
(325, 'Bhind', 21, NULL, NULL),
(326, 'Bhopal', 21, NULL, NULL),
(327, 'Burhanpur', 21, NULL, NULL),
(328, 'Chachaura', 21, NULL, NULL),
(329, 'Chhatarpur', 21, NULL, NULL),
(330, 'Chhindwara', 21, NULL, NULL),
(331, 'Damoh', 21, NULL, NULL),
(332, 'Datia', 21, NULL, NULL),
(333, 'Dewas', 21, NULL, NULL),
(334, 'Dhar', 21, NULL, NULL),
(335, 'Dindori', 21, NULL, NULL),
(336, 'Guna', 21, NULL, NULL),
(337, 'Gwalior', 21, NULL, NULL),
(338, 'Harda', 21, NULL, NULL),
(339, 'Hoshangabad', 21, NULL, NULL),
(340, 'Indore', 21, NULL, NULL),
(341, 'Jabalpur', 21, NULL, NULL),
(342, 'Jhabua', 21, NULL, NULL),
(343, 'Katni', 21, NULL, NULL),
(344, 'Khandwa', 21, NULL, NULL),
(345, 'Khargone', 21, NULL, NULL),
(346, 'Maihar', 21, NULL, NULL),
(347, 'Mandla', 21, NULL, NULL),
(348, 'Mandsaur', 21, NULL, NULL),
(349, 'Morena', 21, NULL, NULL),
(350, 'Nagda', 21, NULL, NULL),
(351, 'Narsinghpur', 21, NULL, NULL),
(352, 'Neemuch', 21, NULL, NULL),
(353, 'Niwari', 21, NULL, NULL),
(354, 'Panna', 21, NULL, NULL),
(355, 'Raisen', 21, NULL, NULL),
(356, 'Rajgarh', 21, NULL, NULL),
(357, 'Ratlam', 21, NULL, NULL),
(358, 'Rewa', 21, NULL, NULL),
(359, 'Sagar', 21, NULL, NULL),
(360, 'Satna', 21, NULL, NULL),
(361, 'Sehore', 21, NULL, NULL),
(362, 'Seoni', 21, NULL, NULL),
(363, 'Shahdol', 21, NULL, NULL),
(364, 'Shajapur', 21, NULL, NULL),
(365, 'Sheopur', 21, NULL, NULL),
(366, 'Shivpuri', 21, NULL, NULL),
(367, 'Sidhi', 21, NULL, NULL),
(368, 'Singrauli', 21, NULL, NULL),
(369, 'Tikamgarh', 21, NULL, NULL),
(370, 'Ujjain', 21, NULL, NULL),
(371, 'Umaria', 21, NULL, NULL),
(372, 'Vidisha', 21, NULL, NULL),
(373, 'Ahmednagar', 22, NULL, NULL),
(374, 'Akola', 22, NULL, NULL),
(375, 'Amravati', 22, NULL, NULL),
(376, 'Aurangabad', 22, NULL, NULL),
(377, 'Beed', 22, NULL, NULL),
(378, 'Bhandara', 22, NULL, NULL),
(379, 'Buldhana', 22, NULL, NULL),
(380, 'Chandrapur', 22, NULL, NULL),
(381, 'Dhule', 22, NULL, NULL),
(382, 'Gadchiroli', 22, NULL, NULL),
(383, 'Gondia', 22, NULL, NULL),
(384, 'Hingoli', 22, NULL, NULL),
(385, 'Jalgaon', 22, NULL, NULL),
(386, 'Jalna', 22, NULL, NULL),
(387, 'Kolhapur', 22, NULL, NULL),
(388, 'Latur', 22, NULL, NULL),
(389, 'Mumbai City', 22, NULL, NULL),
(390, 'Mumbai Suburban', 22, NULL, NULL),
(391, 'Nagpur', 22, NULL, NULL),
(392, 'Nanded', 22, NULL, NULL),
(393, 'Nandurbar', 22, NULL, NULL),
(394, 'Nashik', 22, NULL, NULL),
(395, 'Osmanabad', 22, NULL, NULL),
(396, 'Palghar', 22, NULL, NULL),
(397, 'Parbhani', 22, NULL, NULL),
(398, 'Pune', 22, NULL, NULL),
(399, 'Raigad', 22, NULL, NULL),
(400, 'Ratnagiri', 22, NULL, NULL),
(401, 'Sangli', 22, NULL, NULL),
(402, 'Satara', 22, NULL, NULL),
(403, 'Sindhudurg', 22, NULL, NULL),
(404, 'Solapur', 22, NULL, NULL),
(405, 'Thane', 22, NULL, NULL),
(406, 'Wardha', 22, NULL, NULL),
(407, 'Washim', 22, NULL, NULL),
(408, 'Yavatmal', 22, NULL, NULL),
(409, 'Bishnupur', 23, NULL, NULL),
(410, 'Chandel', 23, NULL, NULL),
(411, 'Churachandpur', 23, NULL, NULL),
(412, 'Imphal East', 23, NULL, NULL),
(413, 'Imphal West', 23, NULL, NULL),
(414, 'Jiribam', 23, NULL, NULL),
(415, 'Kakching', 23, NULL, NULL),
(416, 'Kamjong', 23, NULL, NULL),
(417, 'Kangpokpi', 23, NULL, NULL),
(418, 'Noney', 23, NULL, NULL),
(419, 'Pherzawl', 23, NULL, NULL),
(420, 'Senapati', 23, NULL, NULL),
(421, 'Tamenglong', 23, NULL, NULL),
(422, 'Tengnoupal', 23, NULL, NULL),
(423, 'Thoubal', 23, NULL, NULL),
(424, 'Ukhrul', 23, NULL, NULL),
(425, 'East Garo Hills', 24, NULL, NULL),
(426, 'East Jaintia Hills', 24, NULL, NULL),
(427, 'East Khasi Hills', 24, NULL, NULL),
(428, 'North Garo Hills', 24, NULL, NULL),
(429, 'Ri Bhoi', 24, NULL, NULL),
(430, 'South Garo Hills', 24, NULL, NULL),
(431, 'South West Garo Hills', 24, NULL, NULL),
(432, 'South West Khasi Hills', 24, NULL, NULL),
(433, 'West Garo Hills', 24, NULL, NULL),
(434, 'West Jaintia Hills', 24, NULL, NULL),
(435, 'West Khasi Hills', 24, NULL, NULL),
(436, 'Aizawl', 25, NULL, NULL),
(437, 'Champhai', 25, NULL, NULL),
(438, 'Hnahthial', 25, NULL, NULL),
(439, 'Kolasib', 25, NULL, NULL),
(440, 'Khawzawl', 25, NULL, NULL),
(441, 'Lawngtlai', 25, NULL, NULL),
(442, 'Lunglei', 25, NULL, NULL),
(443, 'Mamit', 25, NULL, NULL),
(444, 'Saiha', 25, NULL, NULL),
(445, 'Serchhip', 25, NULL, NULL),
(446, 'Saitual', 25, NULL, NULL),
(447, 'Dimapur', 26, NULL, NULL),
(448, 'Kiphire', 26, NULL, NULL),
(449, 'Kohima', 26, NULL, NULL),
(450, 'Longleng', 26, NULL, NULL),
(451, 'Mokokchung', 26, NULL, NULL),
(452, 'Mon', 26, NULL, NULL),
(453, 'Noklak', 26, NULL, NULL),
(454, 'Peren', 26, NULL, NULL),
(455, 'Phek', 26, NULL, NULL),
(456, 'Tuensang', 26, NULL, NULL),
(457, 'Wokha', 26, NULL, NULL),
(458, 'Zunheboto', 26, NULL, NULL),
(459, 'Angul', 27, NULL, NULL),
(460, 'Balangir', 27, NULL, NULL),
(461, 'Balasore', 27, NULL, NULL),
(462, 'Bargarh', 27, NULL, NULL),
(463, 'Bhadrak', 27, NULL, NULL),
(464, 'Boudh', 27, NULL, NULL),
(465, 'Cuttack', 27, NULL, NULL),
(466, 'Debagarh', 27, NULL, NULL),
(467, 'Dhenkanal', 27, NULL, NULL),
(468, 'Gajapati', 27, NULL, NULL),
(469, 'Ganjam', 27, NULL, NULL),
(470, 'Jagatsinghpur', 27, NULL, NULL),
(471, 'Jajpur', 27, NULL, NULL),
(472, 'Jharsuguda', 27, NULL, NULL),
(473, 'Kalahandi', 27, NULL, NULL),
(474, 'Kandhamal', 27, NULL, NULL),
(475, 'Kendrapara', 27, NULL, NULL),
(476, 'Kendujhar', 27, NULL, NULL),
(477, 'Khordha', 27, NULL, NULL),
(478, 'Koraput', 27, NULL, NULL),
(479, 'Malkangiri', 27, NULL, NULL),
(480, 'Mayurbhanj', 27, NULL, NULL),
(481, 'Nabarangpur', 27, NULL, NULL),
(482, 'Nayagarh', 27, NULL, NULL),
(483, 'Nuapada', 27, NULL, NULL),
(484, 'Puri', 27, NULL, NULL),
(485, 'Rayagada', 27, NULL, NULL),
(486, 'Sambalpur', 27, NULL, NULL),
(487, 'Subarnapur', 27, NULL, NULL),
(488, 'Sundergarh', 27, NULL, NULL),
(489, 'Karaikal', 28, NULL, NULL),
(490, 'Mahe', 28, NULL, NULL),
(491, 'Puducherry', 28, NULL, NULL),
(492, 'Yanam', 28, NULL, NULL),
(493, 'Amritsar', 28, NULL, NULL),
(494, 'Barnala', 29, NULL, NULL),
(495, 'Bathinda', 29, NULL, NULL),
(496, 'Faridkot', 29, NULL, NULL),
(497, 'Fatehgarh Sahib', 29, NULL, NULL),
(498, 'Fazilka', 29, NULL, NULL),
(499, 'Firozpur', 29, NULL, NULL),
(500, 'Gurdaspur', 29, NULL, NULL),
(501, 'Hoshiarpur', 29, NULL, NULL),
(502, 'Jalandhar', 29, NULL, NULL),
(503, 'Kapurthala', 29, NULL, NULL),
(504, 'Ludhiana', 29, NULL, NULL),
(505, 'Mansa', 29, NULL, NULL),
(506, 'Moga', 29, NULL, NULL),
(507, 'Mohali', 29, NULL, NULL),
(508, 'Muktsar', 29, NULL, NULL),
(509, 'Pathankot', 29, NULL, NULL),
(510, 'Patiala', 29, NULL, NULL),
(511, 'Rupnagar', 29, NULL, NULL),
(512, 'Sangrur', 29, NULL, NULL),
(513, 'Shaheed Bhagat Singh Nagar', 29, NULL, NULL),
(514, 'Tarn Taran', 29, NULL, NULL),
(515, 'Ajmer', 30, NULL, NULL),
(516, 'Alwar', 30, NULL, NULL),
(517, 'Banswara', 30, NULL, NULL),
(518, 'Baran', 30, NULL, NULL),
(519, 'Barmer', 30, NULL, NULL),
(520, 'Bharatpur', 30, NULL, NULL),
(521, 'Bhilwara', 30, NULL, NULL),
(522, 'Bikaner', 30, NULL, NULL),
(523, 'Bundi', 30, NULL, NULL),
(524, 'Chittorgarh', 30, NULL, NULL),
(525, 'Churu', 30, NULL, NULL),
(526, 'Dausa', 30, NULL, NULL),
(527, 'Dholpur', 30, NULL, NULL),
(528, 'Dungarpur', 30, NULL, NULL),
(529, 'Hanumangarh', 30, NULL, NULL),
(530, 'Jaipur', 30, NULL, NULL),
(531, 'Jaisalmer', 30, NULL, NULL),
(532, 'Jalore', 30, NULL, NULL),
(533, 'Jhalawar', 30, NULL, NULL),
(534, 'Jhunjhunu', 30, NULL, NULL),
(535, 'Jodhpur', 30, NULL, NULL),
(536, 'Karauli', 30, NULL, NULL),
(537, 'Kota', 30, NULL, NULL),
(538, 'Nagaur', 30, NULL, NULL),
(539, 'Pali', 30, NULL, NULL),
(540, 'Pratapgarh', 30, NULL, NULL),
(541, 'Rajsamand', 30, NULL, NULL),
(542, 'Sawai Madhopur', 30, NULL, NULL),
(543, 'Sikar', 30, NULL, NULL),
(544, 'Sirohi', 30, NULL, NULL),
(545, 'Sri Ganganagar', 30, NULL, NULL),
(546, 'Tonk', 30, NULL, NULL),
(547, 'Udaipur', 30, NULL, NULL),
(548, 'East Sikkim', 31, NULL, NULL),
(549, 'North Sikkim', 31, NULL, NULL),
(550, 'South Sikkim', 31, NULL, NULL),
(551, 'West Sikkim', 31, NULL, NULL),
(552, 'Ariyalur', 32, NULL, NULL),
(553, 'Chengalpattu', 32, NULL, NULL),
(554, 'Chennai', 32, NULL, NULL),
(555, 'Coimbatore', 32, NULL, NULL),
(556, 'Cuddalore', 32, NULL, NULL),
(557, 'Dharmapuri', 32, NULL, NULL),
(558, 'Dindigul', 32, NULL, NULL),
(559, 'Erode', 32, NULL, NULL),
(560, 'Kallakurichi', 32, NULL, NULL),
(561, 'Kanchipuram', 32, NULL, NULL),
(562, 'Kanyakumari', 32, NULL, NULL),
(563, 'Karur', 32, NULL, NULL),
(564, 'Krishnagiri', 32, NULL, NULL),
(565, 'Madurai', 32, NULL, NULL),
(566, 'Mayiladuthurai ', 32, NULL, NULL),
(567, 'Nagapattinam', 32, NULL, NULL),
(568, 'Namakkal', 32, NULL, NULL),
(569, 'Nilgiris', 32, NULL, NULL),
(570, 'Perambalur', 32, NULL, NULL),
(571, 'Pudukkottai', 32, NULL, NULL),
(572, 'Ramanathapuram', 32, NULL, NULL),
(573, 'Ranipet', 32, NULL, NULL),
(574, 'Salem', 32, NULL, NULL),
(575, 'Sivaganga', 32, NULL, NULL),
(576, 'Tenkasi', 32, NULL, NULL),
(577, 'Thanjavur', 32, NULL, NULL),
(578, 'Theni', 32, NULL, NULL),
(579, 'Thoothukudi', 32, NULL, NULL),
(580, 'Tiruchirappalli', 32, NULL, NULL),
(581, 'Tirunelveli', 32, NULL, NULL),
(582, 'Tirupattur', 32, NULL, NULL),
(583, 'Tiruppur', 32, NULL, NULL),
(584, 'Tiruvallur', 32, NULL, NULL),
(585, 'Tiruvannamalai', 32, NULL, NULL),
(586, 'Tiruvarur', 32, NULL, NULL),
(587, 'Vellore', 32, NULL, NULL),
(588, 'Viluppuram', 32, NULL, NULL),
(589, 'Virudhunagar', 32, NULL, NULL),
(590, 'Adilabad', 33, NULL, NULL),
(591, 'Bhadradri Kothagudem', 33, NULL, NULL),
(592, 'Hyderabad', 33, NULL, NULL),
(593, 'Jagtial', 33, NULL, NULL),
(594, 'Jangaon', 33, NULL, NULL),
(595, 'Jayashankar', 33, NULL, NULL),
(596, 'Jogulamba', 33, NULL, NULL),
(597, 'Kamareddy', 33, NULL, NULL),
(598, 'Karimnagar', 33, NULL, NULL),
(599, 'Khammam', 33, NULL, NULL),
(600, 'Komaram Bheem', 33, NULL, NULL),
(601, 'Mahabubabad', 33, NULL, NULL),
(602, 'Mahbubnagar', 33, NULL, NULL),
(603, 'Mancherial', 33, NULL, NULL),
(604, 'Medak', 33, NULL, NULL),
(605, 'Medchal', 33, NULL, NULL),
(606, 'Mulugu', 33, NULL, NULL),
(607, 'Nagarkurnool', 33, NULL, NULL),
(608, 'Nalgonda', 33, NULL, NULL),
(609, 'Narayanpet', 33, NULL, NULL),
(610, 'Nirmal', 33, NULL, NULL),
(611, 'Nizamabad', 33, NULL, NULL),
(612, 'Peddapalli', 33, NULL, NULL),
(613, 'Rajanna Sircilla', 33, NULL, NULL),
(614, 'Ranga Reddy', 33, NULL, NULL),
(615, 'Sangareddy', 33, NULL, NULL),
(616, 'Siddipet', 33, NULL, NULL),
(617, 'Suryapet', 33, NULL, NULL),
(618, 'Vikarabad', 33, NULL, NULL),
(619, 'Wanaparthy', 33, NULL, NULL),
(620, 'Warangal Rural', 33, NULL, NULL),
(621, 'Warangal Urban', 33, NULL, NULL),
(622, 'Yadadri Bhuvanagiri', 33, NULL, NULL),
(623, 'Dhalai', 34, NULL, NULL),
(624, 'Gomati', 34, NULL, NULL),
(625, 'Khowai', 34, NULL, NULL),
(626, 'North Tripura', 34, NULL, NULL),
(627, 'Sepahijala', 34, NULL, NULL),
(628, 'South Tripura', 34, NULL, NULL),
(629, 'Unakoti', 34, NULL, NULL),
(630, 'West Tripura', 34, NULL, NULL),
(631, 'Agra', 35, NULL, NULL),
(632, 'Aligarh', 35, NULL, NULL),
(633, 'Ambedkar Nagar', 35, NULL, NULL),
(634, 'Amethi', 35, NULL, NULL),
(635, 'Amroha', 35, NULL, NULL),
(636, 'Auraiya', 35, NULL, NULL),
(637, 'Ayodhya', 35, NULL, NULL),
(638, 'Azamgarh', 35, NULL, NULL),
(639, 'Baghpat', 35, NULL, NULL),
(640, 'Bahraich', 35, NULL, NULL),
(641, 'Ballia', 35, NULL, NULL),
(642, 'Balrampur', 35, NULL, NULL),
(643, 'Banda', 35, NULL, NULL),
(644, 'Barabanki', 35, NULL, NULL),
(645, 'Bareilly', 35, NULL, NULL),
(646, 'Basti', 35, NULL, NULL),
(647, 'Bhadohi', 35, NULL, NULL),
(648, 'Bijnor', 35, NULL, NULL),
(649, 'Budaun', 35, NULL, NULL),
(650, 'Bulandshahr', 35, NULL, NULL),
(651, 'Chandauli', 35, NULL, NULL),
(652, 'Chitrakoot', 35, NULL, NULL),
(653, 'Deoria', 35, NULL, NULL),
(654, 'Etah', 35, NULL, NULL),
(655, 'Etawah', 35, NULL, NULL),
(656, 'Farrukhabad', 35, NULL, NULL),
(657, 'Fatehpur', 35, NULL, NULL),
(658, 'Firozabad', 35, NULL, NULL),
(659, 'Gautam Buddha Nagar', 35, NULL, NULL),
(660, 'Ghaziabad', 35, NULL, NULL),
(661, 'Ghazipur', 35, NULL, NULL),
(662, 'Gonda', 35, NULL, NULL),
(663, 'Gorakhpur', 35, NULL, NULL),
(664, 'Hamirpur', 35, NULL, NULL),
(665, 'Hapur', 35, NULL, NULL),
(666, 'Hardoi', 35, NULL, NULL),
(667, 'Hathras', 35, NULL, NULL),
(668, 'Jalaun', 35, NULL, NULL),
(669, 'Jaunpur', 35, NULL, NULL),
(670, 'Jhansi', 35, NULL, NULL),
(671, 'Kannauj', 35, NULL, NULL),
(672, 'Kanpur Dehat', 35, NULL, NULL),
(673, 'Kanpur Nagar', 35, NULL, NULL),
(674, 'Kasganj', 35, NULL, NULL),
(675, 'Kaushambi', 35, NULL, NULL),
(676, 'Kheri', 35, NULL, NULL),
(677, 'Kushinagar', 35, NULL, NULL),
(678, 'Lalitpur', 35, NULL, NULL),
(679, 'Lucknow', 35, NULL, NULL),
(680, 'Maharajganj', 35, NULL, NULL),
(681, 'Mahoba', 35, NULL, NULL),
(682, 'Mainpuri', 35, NULL, NULL),
(683, 'Mathura', 35, NULL, NULL),
(684, 'Mau', 35, NULL, NULL),
(685, 'Meerut', 35, NULL, NULL),
(686, 'Mirzapur', 35, NULL, NULL),
(687, 'Moradabad', 35, NULL, NULL),
(688, 'Muzaffarnagar', 35, NULL, NULL),
(689, 'Pilibhit', 35, NULL, NULL),
(690, 'Pratapgarh', 35, NULL, NULL),
(691, 'Prayagraj', 35, NULL, NULL),
(692, 'Raebareli', 35, NULL, NULL),
(693, 'Rampur', 35, NULL, NULL),
(694, 'Saharanpur', 35, NULL, NULL),
(695, 'Sambhal', 35, NULL, NULL),
(696, 'Sant Kabir Nagar', 35, NULL, NULL),
(697, 'Shahjahanpur', 35, NULL, NULL),
(698, 'Shamli', 35, NULL, NULL),
(699, 'Shravasti', 35, NULL, NULL),
(700, 'Siddharthnagar', 35, NULL, NULL),
(701, 'Sitapur', 35, NULL, NULL),
(702, 'Sonbhadra', 35, NULL, NULL),
(703, 'Sultanpur', 35, NULL, NULL),
(704, 'Unnao', 35, NULL, NULL),
(705, 'Varanasi', 35, NULL, NULL),
(706, 'Almora', 36, NULL, NULL),
(707, 'Bageshwar', 36, NULL, NULL),
(708, 'Chamoli', 36, NULL, NULL),
(709, 'Champawat', 36, NULL, NULL),
(710, 'Dehradun', 36, NULL, NULL),
(711, 'Haridwar', 36, NULL, NULL),
(712, 'Nainital', 36, NULL, NULL),
(713, 'Pauri', 36, NULL, NULL),
(714, 'Pithoragarh', 36, NULL, NULL),
(715, 'Rudraprayag', 36, NULL, NULL),
(716, 'Tehri', 36, NULL, NULL),
(717, 'Udham Singh Nagar', 36, NULL, NULL),
(718, 'Uttarkashi', 36, NULL, NULL),
(719, 'Alipurduar', 37, NULL, NULL),
(720, 'Bankura', 37, NULL, NULL),
(721, 'Birbhum', 37, NULL, NULL),
(722, 'Cooch Behar', 37, NULL, NULL),
(723, 'Dakshin Dinajpur', 37, NULL, NULL),
(724, 'Darjeeling', 37, NULL, NULL),
(725, 'Hooghly', 37, NULL, NULL),
(726, 'Howrah', 37, NULL, NULL),
(727, 'Jalpaiguri', 37, NULL, NULL),
(728, 'Jhargram', 37, NULL, NULL),
(729, 'Kalimpong', 37, NULL, NULL),
(730, 'Kolkata', 37, NULL, NULL),
(731, 'Malda', 37, NULL, NULL),
(732, 'Murshidabad', 37, NULL, NULL),
(733, 'Nadia', 37, NULL, NULL),
(734, 'North 24 Parganas', 37, NULL, NULL),
(735, 'Paschim Bardhaman', 37, NULL, NULL),
(736, 'Paschim Medinipur', 37, NULL, NULL),
(737, 'Purba Bardhaman', 37, NULL, NULL),
(738, 'Purba Medinipur', 37, NULL, NULL),
(739, 'Purulia', 37, NULL, NULL),
(740, 'South 24 Parganas', 37, NULL, NULL),
(741, 'Uttar Dinajpur', 37, NULL, NULL);

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
-- Table structure for table `loads`
--

CREATE TABLE `loads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `from_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_lat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_lng` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_place_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_place_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT -1,
  `time` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'view',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notification` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `remark` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`id`, `name`, `from_address`, `to_address`, `date`, `from_state`, `to_state`, `from_district`, `to_district`, `from_lat`, `from_lng`, `to_lat`, `to_lng`, `to_place_id`, `from_place_id`, `distance`, `admin_id`, `time`, `status`, `created_at`, `updated_at`, `notification`, `remark`, `cancel_by`) VALUES
(1, 'steel', 'chennai', 'tuticorin}', '2021-07-10', 'Tamil Nadu', 'Tamil Nadu', 'Chennai', 'Thoothukudi', '13.0826802', '80.2707184', '8.7641661', '78.1348361', 'ChIJYTN9T-plUjoRM9RjaAunYW4', 'ChIJYTN9T-plUjoRM9RjaAunYW4', '608 km', -1, '9 hours 43 mins', 'booked', '2021-07-10 08:20:52', '2021-07-10 08:23:56', 'no', NULL, NULL),
(2, 'steel', 'chennai', 'madurai}', '2021-07-10', 'Tamil Nadu', 'Tamil Nadu', 'Chennai', 'Madurai', '13.0826802', '80.2707184', '9.9252007', '78.1197754', 'ChIJYTN9T-plUjoRM9RjaAunYW4', 'ChIJYTN9T-plUjoRM9RjaAunYW4', '462 km', -1, '7 hours 36 mins', 'cancel', '2021-07-10 08:46:50', '2021-07-29 13:15:31', 'yes', ',mxzghj', 1),
(3, 'Cemetery', 'Erode, Tamil Nadu, India', 'Salem - Kochi Hwy, Vaikundam, Tamil Nadu 637103, India', '2021-07-14', 'Tamil Nadu', 'India', 'Erode', 'Tamil Nadu', '11.3410364', '77.7171642', '11.5290133', '77.9516972', 'ChIJcUYvdkZvqTsRXvfH2eOmfdk', 'ChIJcUYvdkZvqTsRXvfH2eOmfdk', '35.0 km', -1, '54 mins', 'cancel', '2021-07-14 06:40:26', '2021-07-29 12:58:36', 'yes', 'dhjshj', 1),
(5, 'Steel', 'Hindupur, Andhra Pradesh, India', 'Chennai, Tamil Nadu, India', '2021-07-30', 'Andhra Pradesh', 'Tamil Nadu', 'Anantapuram', 'Chennai', '13.8222599', '77.5009298', '13.0826802', '80.2707184', 'ChIJq0nrWHWjsTsRe12iRIxL9Fo', 'ChIJq0nrWHWjsTsRe12iRIxL9Fo', '412 km', -1, '8 hours 6 mins', 'cancel', '2021-07-29 23:55:27', '2021-07-29 23:58:52', 'no', 'Late', -1),
(6, 'Steel', 'Hindupur, Andhra Pradesh, India', 'Chennai, Tamil Nadu, India', '2021-07-30', 'Andhra Pradesh', 'Tamil Nadu', 'Anantapuram', 'Chennai', '13.8222599', '77.5009298', '13.0826802', '80.2707184', 'ChIJq0nrWHWjsTsRe12iRIxL9Fo', 'ChIJq0nrWHWjsTsRe12iRIxL9Fo', '412 km', -1, '8 hours 6 mins', 'booked', '2021-07-30 00:00:54', '2021-07-30 00:03:21', 'no', NULL, NULL),
(7, 'cement', 'Erode Bus Stand, Sathy Road, Erode Fort, Erode, Tamil Nadu, India', 'Saravana Bhavan, National Highway 544, Vaikuntam, Tamil Nadu, India', '2021-08-08', 'Erode', 'Salem', 'Erode Fort', 'Vaikundam', '11.3467242', '77.7202021', '11.5157729', '77.9283609', 'ChIJy0TzoTdvqTsRhz94RQNCUao', 'ChIJy0TzoTdvqTsRhz94RQNCUao', '33.3 km', -1, '50 mins', 'view', '2021-08-08 04:25:31', '2021-09-03 05:46:57', 'yes', NULL, NULL),
(8, 'Steel', 'Coimbatore International Airport - CJB, Peelamedu - Pudur Main Road, Coimbatore, Tamil Nadu, India', 'Chennai, Tamil Nadu, India', '2021-10-31', 'Coimbatore', 'Tamil Nadu', 'Peelamedu - Pudur Main Road', 'Chennai', '11.0314227', '77.0439211', '13.0826802', '80.2707184', 'ChIJr6lem7xXqDsReEaM9A2hfjE', 'ChIJr6lem7xXqDsReEaM9A2hfjE', '498 km', -1, '8 hours 24 mins', 'view', '2021-10-30 04:57:37', '2021-10-30 05:00:06', 'yes', NULL, NULL);

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
(4, '2021_03_28_073912_create_branches_table', 2),
(5, '2021_03_28_114953_create_district_tables', 2),
(6, '2021_03_28_115026_create_state_tables', 2),
(7, '2021_04_04_194346_transports', 3),
(8, '2021_04_24_063511_load', 4),
(9, '2021_04_25_041407_create_trucks_table', 5),
(10, '2021_06_07_143308_create_bookings_table', 6),
(12, '2021_06_08_033110_create_pushers_table', 7);

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
-- Table structure for table `pushers`
--

CREATE TABLE `pushers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pusher_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pushers`
--

INSERT INTO `pushers` (`id`, `pusher_id`, `user_id`, `role`, `created_at`, `updated_at`) VALUES
(8, '58907069', '2', 'truck', '2021-07-14 06:45:27', '2021-07-14 06:45:27'),
(9, '58907303', '2', 'truck', '2021-07-14 06:46:15', '2021-07-14 06:46:15'),
(10, 'false', '-1', 'master_admin', '2021-07-14 06:59:08', '2021-07-14 06:59:08'),
(11, '59221059', '-1', 'master_admin', '2021-07-21 02:20:19', '2021-07-21 02:20:19'),
(12, 'false', '3', 'transport', '2021-07-24 05:20:46', '2021-07-24 05:20:46'),
(13, '61394465', '-1', 'master_admin', '2021-07-29 08:46:49', '2021-07-29 08:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `state_tables`
--

CREATE TABLE `state_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state_tables`
--

INSERT INTO `state_tables` (`id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Andaman Nicobar', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(2, 'Andhra Pradesh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(3, 'Arunachal Pradesh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(4, 'Assam', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(5, 'Bihar', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(6, 'Chandigarh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(7, 'Chhattisgarh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(8, 'Dadra Nagar Haveli', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(9, 'Daman Diu', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(10, 'Delhi', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(11, 'Goa', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(12, 'Gujarat', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(13, 'Haryana', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(14, 'Himachal Pradesh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(15, 'Jammu Kashmir', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(16, 'Jharkhand', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(17, 'Karnataka', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(18, 'Kerala', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(19, 'Ladakh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(20, 'Lakshadweep', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(21, 'Madhya Pradesh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(22, 'Maharashtra', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(23, 'Manipur', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(24, 'Meghalaya', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(25, 'Mizoram', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(26, 'Nagaland', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(27, 'Odisha', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(28, 'Puducherry', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(29, 'Punjab', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(30, 'Rajasthan', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(31, 'Sikkim', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(32, 'Tamil Nadu', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(33, 'Telangana', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(34, 'Tripura', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(35, 'Uttar Pradesh', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(36, 'Uttarakhand', '2021-03-28 12:07:52', '2021-03-28 12:07:52'),
(37, 'West Bengal', '2021-03-28 12:07:52', '2021-03-28 12:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ideal12#',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_phone` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT -1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `name`, `password`, `phone`, `owner_phone`, `location`, `state`, `district`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'aruna transport', 'ideal12#', '9367734001', '9367734003', 'CHIDAMBARANAGAR, ANNA NAGAR WEST', '32', '579', -1, '2021-07-10 08:13:25', '2021-09-03 06:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `trucks`
--

CREATE TABLE `trucks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transport_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `truck_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_name` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-1',
  `longitude` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-1',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'view',
  `password` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT -1,
  `phone` varchar(240) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trucks`
--

INSERT INTO `trucks` (`id`, `transport_id`, `truck_number`, `d_name`, `model`, `current_location`, `latitude`, `longitude`, `status`, `password`, `admin_id`, `phone`, `created_at`, `updated_at`) VALUES
(1, '1', 'tn69 m 9983', 'ghyvchjfds', 'hbxxl', 'CHIDAMBARANAGAR, ANNA NAGAR WEST', '11.0228418', '77.0760965', 'view', '27861', -1, '9345298941', '2021-07-10 08:19:00', '2021-09-03 06:46:24'),
(2, '1', 'TN34r3477', '', 'TN34r3477', 'Raja Muthiah Rd, Chinnaiyan Colony, Periyamet, Chennai, Tamil Nadu 600007, India', '13.0826802', '80.2707184', 'view', '74618', -1, '9080357318', '2021-07-14 06:29:21', '2021-08-28 07:18:19'),
(3, '1', 'tn18m6651', '', 'xxl', '15C, L&T Bypass Corner, A.G. Pudur (PO), Irugur (Via), CBE -641103, Athappagoundenpudur, Tamil Nadu 641062, India', '11.032407', '77.0760965', 'view', '10177', -1, '8870560828', '2021-07-24 05:22:12', '2021-07-24 05:23:07'),
(4, '1', 'TN34R3471', 'test', 'TN34r3477', '112, Balaji Nagar, New Sidhapudur,', '-1', '-1', 'view', '60199', -1, '3080357311', '2021-09-03 06:40:43', '2021-09-03 06:40:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ideal Roadways', 'Ideal', '$2y$10$IXQEFO3wJqkflBb0fNkObOPS4vu2gDQPX7xf2I0bXu.k7q8OqyxIa', 'master_admin', '-1', NULL, '2021-06-24 10:55:40', '2021-06-24 10:55:40'),
(2, 'ideal chennai', 'idealchennai', '$2y$10$EXP6b6u7XfVnrfs3u12ATeo4BzSXTI5GacFz0oJt3SG4taOSVAxnm', 'admin', '1', NULL, '2021-07-10 08:10:02', '2021-07-10 08:10:02'),
(3, 'aruna transport', 'arunatransport', '$2y$10$9NBvW0eJNi3lNL9RsbY8heDEI8Izc7TvOn3dBLQdy9lY/A0Y/rSDK', 'transport', '1', NULL, '2021-07-10 08:13:25', '2021-09-03 06:35:59'),
(4, 'aruna transport', 'tn69m9983', '$2y$10$LV/Bs6/m70B.NFE2/TKwPOiyUd6qgkjWONNH7/uvfxu0LUzl.pIO2', 'truck', '1', NULL, '2021-07-10 08:19:01', '2021-09-03 06:46:24'),
(5, 'ideal tuticorin', 'idealtuticorin', '$2y$10$tsTCeI4xEHTU4lCVo14JN.gKkN0/XTrK8D00JO2qx0rhFMDvmWepy', 'admin', '2', NULL, '2021-07-10 08:37:03', '2021-07-10 08:37:03'),
(6, 'ideal coimbatore', 'idealcoimbatore', '$2y$10$xPX6Hz6uv2kbkaWIlbmmMei0S2eApMd2nPCeVwHzz7Ep.oZNOj6mm', 'admin', '3', '87138', '2021-07-10 08:38:49', '2021-10-30 05:05:14'),
(7, 'ideal trichy', 'idealtrichy', '$2y$10$27F2xxxcVLkgMvltcCjR5OS5F8CYFb5rEpmCeJlNUwbZeuNWOxHX2', 'admin', '4', NULL, '2021-07-10 08:41:57', '2021-07-10 08:41:57'),
(8, 'ideal pondy', 'idealpondy', '$2y$10$fTHp1BHZ/ME.GWm1u6ChU.gjOQ3V91kK6r9k2YjjIa3sVqUDeSb.W', 'admin', '5', NULL, '2021-07-10 08:43:50', '2021-07-10 08:43:50'),
(9, 'ideal ranipettai', 'idealranipet', '$2y$10$IYRvsXfvkgZMqQ1GYHdDReFQCvkMAkjSPJqknl9Qbt/j4KsXGy23C', 'admin', '6', NULL, '2021-07-10 08:45:07', '2021-07-10 08:45:07'),
(10, 'Tamil', 'TN34r3477', '$2y$10$Z3hOoi7CF7rlVmyBAbpVwOs33Q6QETYzxxFeQUMrg2qNaqQ03A8ZK', 'truck', '2', 'E2v9xbSsAtmqdoWt09rgAagKynW2O4nXrhcC1CoE9AqCgJTsX80vgsd3aoab', '2021-07-14 06:29:22', '2021-07-14 06:29:22'),
(14, 'text', 'tn18m6651', '$2y$10$vavGEgr1wIbDsS57gYXUquWZYZEYgKGNxOYUmasUk2Nk2B.Tumvka', 'truck', '3', NULL, '2021-07-24 05:22:12', '2021-07-24 05:22:12'),
(15, 'aruna transport', 'zadmin', '$2y$10$rmI/xVXqHTbqoejdqBY5GuX3iAkCFnAzRWnFxESmkMneEfpugnThC', 'truck', '4', NULL, '2021-09-03 06:40:43', '2021-09-03 06:46:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district_tables`
--
ALTER TABLE `district_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `loads`
--
ALTER TABLE `loads`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pushers`
--
ALTER TABLE `pushers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_tables`
--
ALTER TABLE `state_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trucks`
--
ALTER TABLE `trucks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `district_tables`
--
ALTER TABLE `district_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=742;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loads`
--
ALTER TABLE `loads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pushers`
--
ALTER TABLE `pushers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `state_tables`
--
ALTER TABLE `state_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trucks`
--
ALTER TABLE `trucks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
