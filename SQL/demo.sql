-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 02:45 PM
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
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `highschool_percentage` int(11) NOT NULL,
  `intermediate_percentage` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `height` int(11) DEFAULT NULL,
  `prefered_job_location` varchar(255) NOT NULL,
  `prefered_exam_center` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `job_id`, `highschool_percentage`, `intermediate_percentage`, `address`, `height`, `prefered_job_location`, `prefered_exam_center`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 3, 66, 95, 'UP', 5, 'Pratapgarh', 'sdfa', 'Rejected', '2024-04-06 01:18:09', '2024-04-08 05:43:10', '0000-00-00 00:00:00'),
(2, 3, 8, 55, 66, 'UP', 5, 'PBH', 'kanpur', 'Accepted', '2024-04-06 01:22:23', '2024-04-08 05:40:16', '0000-00-00 00:00:00'),
(3, 3, 10, 55, 95, 'asdasd', 5, 'Lucknow', 'Agra', 'Rejected', '2024-04-13 11:42:15', '2024-04-15 08:52:16', NULL),
(4, 1, 3, 55, 66, 'UP', 5, 'Pratapgarh', 'Gujuraty', 'Rejected', '2024-04-06 03:24:41', '2024-04-08 05:43:52', '0000-00-00 00:00:00'),
(9, 1, 3, 90, 70, 'UP', 5, 'Pratapgarh', 'sdfa', 'Accepted', '2024-04-06 04:05:21', '2024-04-08 05:44:34', '0000-00-00 00:00:00'),
(10, 1, 3, 83, 66, 'UP', 5, 'AMD', 'sdfa', 'pending', '2024-04-06 04:53:23', '2024-04-08 05:44:20', '0000-00-00 00:00:00'),
(12, 3, 13, 65, 78, 'sadfbasd fasdf', 6, 'Sultanpur', 'PBH', 'Accepted', '2024-04-08 04:23:35', '2024-04-08 05:38:34', '0000-00-00 00:00:00'),
(13, 1, 17, 99, 99, 'Quo sit non nostrum ', 88, 'Et facilis culpa am', ' eiusmod', 'Rejected', '2024-04-10 00:01:53', '2024-04-15 08:55:36', '0000-00-00 00:00:00'),
(14, 21, 3, 0, 0, 'hgasdf efbh as', 5, '', '', 'Accepted', '2024-04-13 02:18:09', '2024-04-15 08:55:41', '0000-00-00 00:00:00'),
(17, 21, 15, 85, 91, 'Aut asperiores dolor', 95, 'Ipsam inventore reru', 'Aut tempor enim est ', 'Pending', '2024-04-13 03:19:48', '2024-04-15 07:43:03', NULL),
(59, 21, 20, 95, 87, 'nmabsdf adf asjkfas', 6, 'Aut', ' vero', 'Pending', '2024-04-13 12:43:19', '2024-04-13 12:43:19', NULL),
(70, 21, 13, 70, 70, 'Recusandae Dolor qu', 37, 'Sultanpur', 'Prayagraj', 'Pending', '2024-04-15 04:30:23', '2024-04-15 06:10:10', NULL),
(75, 21, 10, 55, 78, 'Molestiae est id sit', 8, 'Lucknow', 'Agra', 'Accepted', '2024-04-15 05:04:01', '2024-04-15 08:52:28', NULL),
(81, 21, 10, 55, 78, 'Molestiae est id sit', 8, 'Lucknow', 'Agra', 'Accepted', '2024-04-15 05:04:43', '2024-04-15 08:52:28', NULL),
(82, 21, 17, 98, 52, 'Dolore expedita pers', 88, 'Et facilis culpa am', 'Atque', 'Pending', '2024-04-15 05:06:34', '2024-04-15 05:06:34', NULL),
(83, 21, 8, 81, 75, 'Aut eum cupidatat bl', 7, 'kolkata', 'Ahmedabad', 'Rejected', '2024-04-15 05:06:54', '2024-04-15 09:23:08', NULL),
(84, 29, 10, 65, 75, 'dfgsd', 6, 'Lucknow', 'Agra', 'Pending', '2024-04-15 08:56:59', '2024-04-15 08:56:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `registration_start` date NOT NULL,
  `registration_end` date NOT NULL,
  `minimum_age` int(11) DEFAULT NULL,
  `maximum_age` int(11) DEFAULT NULL,
  `minimum_height` varchar(11) DEFAULT NULL,
  `job_location` varchar(255) NOT NULL,
  `exam_center` varchar(255) NOT NULL,
  `exam_date` date DEFAULT NULL,
  `minimum_highschool_percentage` int(11) DEFAULT NULL,
  `minimum_intermediate_percentage` int(11) DEFAULT NULL,
  `job_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `post`, `registration_start`, `registration_end`, `minimum_age`, `maximum_age`, `minimum_height`, `job_location`, `exam_center`, `exam_date`, `minimum_highschool_percentage`, `minimum_intermediate_percentage`, `job_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Job title', 'jksdgl', '2024-04-12', '2024-04-15', 12, 19, '5', 'gujrat', 'kolkata', '2024-04-30', 55, 65, 'Data updated.............................................', '2024-04-05 09:59:45', '2024-04-12 13:30:03', '0000-00-00 00:00:00'),
(8, 'Job title 2', '[post..', '2024-04-12', '2024-04-13', 25, 25, '5', 'kolkata', 'Ahmedabad', '2024-04-20', 65, 70, 'updated form.............', '2024-04-05 13:17:23', '2024-04-12 13:28:27', '0000-00-00 00:00:00'),
(10, 'XYZ', 'abc', '2024-04-10', '2024-04-19', 18, 30, '4', 'Lucknow', 'Agra', '2024-04-26', 50, 70, 'asb dfashb f', '2024-04-08 05:38:20', '2024-04-08 05:38:20', '0000-00-00 00:00:00'),
(13, 'UP Police', 'Constable', '2024-04-08', '2024-04-20', 20, 25, '5', 'Prayagraj,Lucknow,Sultanpur,Pratapgarh', 'Prayagraj', '2024-04-28', 65, 70, 'Up police constable job', '2024-04-08 09:44:58', '2024-04-08 09:44:58', '0000-00-00 00:00:00'),
(15, 'Pariatur Ex velit e', 'Eu cillum voluptatem', '2024-04-12', '2024-04-12', 98, 99, '12', 'Ipsam inventore reru', 'Aut tempor enim est ', '2024-04-26', 46, 3, 'Sed expedita laboris', '2024-04-09 05:19:08', '2024-04-12 13:28:49', '0000-00-00 00:00:00'),
(17, 'Harum impedit cumqu', 'Omnis consequuntur i', '2024-04-10', '2024-04-11', 22, 58, '85', 'Et facilis culpa am', 'Atque, eiusmod, enim, ndf', '2024-04-15', 97, 41, 'Quibusdam ut ipsam q', '2024-04-10 05:17:37', '2024-04-10 05:18:08', '0000-00-00 00:00:00'),
(20, 'Laudantium voluptas', 'Quas duis facere com', '2024-04-12', '2024-04-13', 10, 25, '5', 'Aut, quia, qui, laboris', 'Quo, vero, dolore, nemo', '2024-04-15', 94, 79, 'Ut hic ipsum adipisi', '2024-04-12 09:40:53', '2024-04-12 09:40:53', '0000-00-00 00:00:00'),
(24, 'Perferendis autem di', 'Consectetur ut aperi', '2024-04-16', '2024-04-17', 18, 25, '51', 'Quis incididunt sunt', 'Animi eos voluptas ', '2024-04-20', 40, 47, 'Nam et et occaecat d', '2024-04-16 11:12:29', '2024-04-16 11:12:29', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `phone`, `gender`, `dob`, `photo`, `role`, `created_at`, `updated_at`, `deleted_at`, `password`) VALUES
(1, 'Satyam', 'Kr', 'Singh', 'admin@gamil.com', '6394779858', 'M', '2000-07-20', NULL, 'admin', '2024-04-05 05:23:17', '2024-04-12 06:19:44', NULL, '123'),
(2, 'Satyam', 'Kumar', 'Singh', 'admin@gmail.com', '7887260207', 'M', '2002-06-18', NULL, 'admin', '2024-04-05 05:25:35', '2024-04-05 05:26:01', NULL, '123'),
(3, 'Satyam', 'Kumar', 'Singh', 'satyamkumar.silversky@gmail.com', '6394779855', 'M', '2000-06-20', NULL, 'user', '2024-04-05 13:22:43', '2024-04-05 13:22:43', NULL, '123'),
(4, 'Cynthia', 'Wesley Conley', 'Mckay', 'pajibaju@mailinator.com', '', 'F', '1978-10-22', NULL, 'user', '2024-04-08 13:09:30', '2024-04-08 13:09:30', NULL, 'Pa$$w0rd!'),
(6, 'Jelani', 'Amethyst Dunn', 'Dalton', '', '9875642852', 'M', '2007-01-23', NULL, 'user', '2024-04-08 13:32:29', '2024-04-08 13:32:29', NULL, '123'),
(7, 'MacKensie', 'Cole Bell', 'Harding', 'dyno@mailinator.com', '6895632540', 'M', '1985-04-18', NULL, 'user', '2024-04-08 13:36:21', '2024-04-08 13:36:21', NULL, '123'),
(8, 'Kylynn', 'Keiko Kerr', 'Wise', 'fofo@mailinator.com', '9876542586', 'F', '1979-06-08', NULL, 'user', '2024-04-09 04:08:33', '2024-04-09 04:08:33', NULL, '123'),
(9, 'a', 'b', 'c', 'bolagiqo@mailinator.com', '45', 'Male', '1996-11-10', NULL, 'user', '2024-04-10 11:46:40', '2024-04-10 11:46:40', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(11, 'Quail', 'Dariu12s Fitzgerald', 'Baker', 'xoramai@linator.com', '6198587596', 'Male', '2016-08-27', NULL, 'user', '2024-04-10 12:44:51', '2024-04-10 12:44:51', NULL, '202cb962ac59075b964b07152d234b70'),
(12, 'Autumn32', 'Davis Albert', 'Atkins', 'zezegyfaqy@mailinator.com', '44', 'Male', '1997-09-09', NULL, 'user', '2024-04-10 13:14:28', '2024-04-10 13:14:28', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(13, 'da', 'Avye', 'Wilkins', 'a@m.com', '9854785632', 'Male', '2005-02-03', 'admin.jpg', 'admin', '2024-04-11 04:44:16', '2024-04-16 11:24:19', NULL, '202cb962ac59075b964b07152d234b70'),
(16, 'Satyam', 'Kumar', 'Singh', 'xuvaf@mailinazxtor.com', '7887260200', 'Female', '2024-04-11', NULL, 'user', '2024-04-11 05:07:15', '2024-04-11 05:07:15', NULL, '202cb962ac59075b964b07152d234b70'),
(17, 'Abdul', 'Zena', 'Cardenas', 'pezikidec@mailinator.com', '7268287282', 'Male', '1992-06-05', NULL, 'user', '2024-04-11 10:32:22', '2024-04-11 10:32:22', NULL, '202cb962ac59075b964b07152d234b70'),
(19, 'Sydnee', 'Medge', 'Calhoun', 'nidamut@mailinator.com', '9775846259', 'Female', '1977-04-27', NULL, 'user', '2024-04-11 11:28:39', '2024-04-11 11:28:39', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(20, 'Colton', 'Baker', 'Small', 'tahosesaj@mailinator.com', '6451265896', 'Male', '2012-03-16', NULL, 'user', '2024-04-11 11:30:19', '2024-04-11 11:30:19', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3'),
(21, 'Satyam', 'Kumar', 'Singh', 'user@gmail.com', '6589658965', 'Male', '2024-04-11', 'user.png', 'user', '2024-04-13 04:58:49', '2024-04-16 09:08:42', NULL, '202cb962ac59075b964b07152d234b70'),
(22, 'User', 'asa', 'Name', 'usr@gmail.com', '6589658968', 'Male', '2024-04-10', NULL, 'user', '2024-04-13 05:01:14', '2024-04-13 05:01:14', NULL, '202cb962ac59075b964b07152d234b70'),
(26, 'User', 'asa', 'Name', 'usr@ms4sail.com', '6589655234', 'Male', '2024-04-10', NULL, 'user', '2024-04-13 05:27:32', '2024-04-13 05:27:32', NULL, '58238e9ae2dd305d79c2ebc8c1883422'),
(27, 'User', 'asa', 'Name', 'usr@s4sail.com', '6589655134', 'Male', '2024-04-10', NULL, 'user', '2024-04-13 05:27:49', '2024-04-13 05:27:49', NULL, '202cb962ac59075b964b07152d234b70'),
(28, 'User', 'asa', 'Name', 'usr@s4sasail.com', '6589651134', 'Male', '2024-04-10', NULL, 'user', '2024-04-13 05:33:15', '2024-04-13 05:33:15', NULL, '202cb962ac59075b964b07152d234b70'),
(29, 'Donovan', 'Fitzgerald', 'Webb', 'gylysuhy@mailinator.com', '9865748526', 'Male', '1995-04-26', NULL, 'user', '2024-04-15 08:56:19', '2024-04-15 08:56:19', NULL, '202cb962ac59075b964b07152d234b70'),
(30, 'Erin', 'Jelan', 'Cooley', 'neda@mailinator.com', '9865848231', 'Female', '2023-12-16', NULL, 'user', '2024-04-16 04:53:51', '2024-04-16 04:53:51', NULL, '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`),
  ADD KEY `applications_ibfk_1` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
