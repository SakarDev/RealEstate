-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2023 at 06:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestatedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(6, 'Erbil'),
(9, 'karkuk'),
(10, 'Halabja'),
(11, 'Baghdada'),
(14, 'Sulaymaniah');

-- --------------------------------------------------------

--
-- Table structure for table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `login_logs_id` int(11) NOT NULL,
  `ipAddress` varbinary(16) NOT NULL,
  `tryTime` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `property_id` int(11) NOT NULL,
  `property_title` varchar(100) NOT NULL,
  `property_type_id_propertyfk` int(11) DEFAULT NULL,
  `transaction_type` enum('sale','rent') NOT NULL,
  `city_id_propertyfk` int(11) DEFAULT NULL,
  `town_id_propertyfk` int(11) DEFAULT NULL,
  `street_id_propertyfk` int(11) DEFAULT NULL,
  `user_id_propertyfk` int(11) DEFAULT NULL,
  `area` decimal(10,4) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `no_bedrooms` int(5) NOT NULL,
  `no_bathrooms` int(5) NOT NULL,
  `no_garages` int(5) NOT NULL,
  `no_floors` int(5) NOT NULL,
  `property_image` varchar(100) NOT NULL,
  `property_telephone` int(11) NOT NULL,
  `description` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`property_id`, `property_title`, `property_type_id_propertyfk`, `transaction_type`, `city_id_propertyfk`, `town_id_propertyfk`, `street_id_propertyfk`, `user_id_propertyfk`, `area`, `price`, `no_bedrooms`, `no_bathrooms`, `no_garages`, `no_floors`, `property_image`, `property_telephone`, `description`, `time`) VALUES
(44, 'Vel dolores ex minim', 40, 'rent', 9, NULL, NULL, 32, '57.0000', '63.00', 931, 4, 11, 269, 'uploads/646aa9006d7a00.98126511.jpg', 2147483647, 'Quaerat non esse non', '2023-05-21 23:28:00'),
(45, 'Amet Nam maiores op', 40, 'rent', 6, NULL, 16, 32, '84.0000', '976.00', 148, 702, 639, 451, 'uploads/646aa912024d36.97725246.jpg', 2147483647, 'Sed voluptate ut ut', '2023-05-21 23:28:18'),
(46, 'Consectetur nostrum', 41, 'sale', 6, NULL, 10, 32, '22.0000', '177.00', 223, 696, 913, 334, 'uploads/646aa91f237051.12670699.jpg', 2147483647, 'Dignissimos eu persp', '2023-05-21 23:28:31'),
(47, 'Expedita aut eum ill', 40, 'rent', 9, NULL, 7, 36, '3.0000', '444.00', 24, 894, 203, 172, 'uploads/646aa95ee59e47.63741377.jpg', 2147483647, 'Earum exercitationem', '2023-05-21 23:29:34'),
(48, 'Et sit adipisicing', 41, 'rent', 10, NULL, 8, 36, '35.0000', '35.00', 441, 643, 474, 458, 'uploads/646aa97809a8c7.36099639.jpg', 2147483647, 'Doloremque ratione u', '2023-05-21 23:30:00'),
(49, 'Vel quas nobis quos', 40, 'sale', 9, NULL, 7, 35, '17.0000', '224.00', 149, 545, 818, 472, 'uploads/646aaaf8275e71.17960514.jpg', 2147483647, 'Sapiente quam sunt a', '2023-05-21 23:36:24'),
(50, 'Temporibus ea accusa', 40, 'rent', 14, 15, 24, 35, '32.0000', '324.00', 589, 259, 960, 349, 'uploads/646aab1dd95e42.08245023.jpg', 2147483647, 'Omnis voluptatem Do', '2023-05-21 23:37:01'),
(51, 'Veritatis quia enim', 41, 'rent', 10, NULL, 8, 42, '83.0000', '221.00', 708, 984, 445, 377, 'uploads/646aab41caca63.10190346.jpg', 2147483647, 'Rerum reprehenderit', '2023-05-21 23:37:37'),
(52, 'Perspiciatis evenie', 40, 'rent', 6, NULL, 10, 42, '19.0000', '701.00', 20, 259, 306, 51, 'uploads/646aab51120153.98103067.jpg', 2147483647, 'Eu perspiciatis cor', '2023-05-21 23:37:53'),
(53, 'Impedit repudiandae', 40, 'sale', 14, NULL, 25, 43, '19.0000', '955.00', 997, 25, 213, 805, 'uploads/646aab8a9f9134.41592241.jpg', 2147483647, 'Nesciunt illum sim', '2023-05-21 23:38:50'),
(54, 'Maxime officia dolor', 40, 'sale', 6, NULL, 16, 43, '40.0000', '519.00', 777, 240, 765, 895, 'uploads/646aab96bd0ef2.75582530.jpg', 2147483647, 'Itaque minima adipis', '2023-05-21 23:39:02'),
(55, 'Ducimus aliquid eve', 41, 'rent', 11, NULL, 27, 49, '38.0000', '143.00', 246, 179, 835, 621, 'uploads/646aabf7af6aa2.14100153.jpg', 2147483647, 'Molestiae accusamus', '2023-05-21 23:40:39'),
(56, 'Sint facilis unde ut', 41, 'sale', 14, NULL, 23, 49, '21.0000', '405.00', 998, 818, 378, 158, 'uploads/646aac013acce1.98148690.jpg', 2147483647, 'Eius amet iusto sun', '2023-05-21 23:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `property_type_id` int(11) NOT NULL,
  `property_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`property_type_id`, `property_type_name`) VALUES
(40, 'House'),
(41, 'Villa');

-- --------------------------------------------------------

--
-- Table structure for table `street`
--

CREATE TABLE `street` (
  `street_id` int(11) NOT NULL,
  `street_name` varchar(100) NOT NULL,
  `city_id_streetfk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `street`
--

INSERT INTO `street` (`street_id`, `street_name`, `city_id_streetfk`) VALUES
(7, 'Sanandaj', 9),
(8, 'Ababayle', 10),
(9, 'Kasnazan', 6),
(10, 'Ankawa', 6),
(11, 'Ghazali', 6),
(16, 'Brayaty', 6),
(21, 'Candace Jacobs', 6),
(23, 'TuyMalik', 14),
(24, 'Ashty', 14),
(25, 'Saholaka', 14),
(26, 'Mamostaian', 14),
(27, 'Haifa Street', 11),
(28, 'Al Rasheed Street', 11);

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `town_id` int(11) NOT NULL,
  `town_name` varchar(100) NOT NULL,
  `city_id_townfk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`town_id`, `town_name`, `city_id_townfk`) VALUES
(2, 'Penjwen', 14),
(10, 'Sarau', 10),
(11, 'Koya', 6),
(12, 'Arbat', 14),
(13, 'Saidsadq', 14),
(14, 'Soran', 6),
(15, 'Sitak', 14),
(19, 'town', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `telephone` varchar(22) NOT NULL,
  `role` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstName`, `lastName`, `email`, `pass`, `telephone`, `role`) VALUES
(30, 'Amela', 'Bolton', 'sakarAdmin@gmail.com', '$2y$10$cWRkw8Ic8sHwFH87N/YUa.HTWLUWXJu309cLPe1g3EAkjusyT8ARa', '09906984701', 1),
(31, 'Wade', 'Vazquez', 'sikoq@mailinator.com', '$2y$10$5HFC0CPU9XBiDe8SnEPWze2951rydcAhaUrZN3FAVxMAxtQfWfhq6', '08807536039', 1),
(32, 'Cullen', 'Leblanc', 'sakarUser@gmail.com', '$2y$10$jilwEhi5bOHBFNvGfa3UueF74Ybnkz7VMFWIWQB0M1SLXnjaOaNma', '07703082894', 0),
(33, 'Yolanda', 'Welch', 'divat@mailinator.com', '$2y$10$nWuqAg.fAD3PH2JvtRQhwOs5.7QguWo0Xd5txBHQwfIMfPe1iuxPu', '00001084866', 0),
(34, 'Tana', 'Macdonald', 'pese@mailinator.com', '$2y$10$GpRF4Wr45115Wj0jVt8trO/yja0X0..FBQUeY1.cscui1GtyW1/lK', '00001898304', 0),
(35, 'Felicia', 'Gaines', 'pahufe@mailinator.com', '$2y$10$qAaHfLqOOnVdq8hp/7z4UeCjT78jni19OoWb2PgM6VPBW5TaC/wzm', '00007467674', 0),
(36, 'Lucas', 'Weber', 'fuhilukavo@mailinator.com', '$2y$10$GZRb6xhD2q.ABwop38Tgm.1QV8q.PEKFM6NLrgUxCGMV4UJDoKkVK', '11119016466', 0),
(37, 'Jamal', 'Sawyer', 'dehuximomi@mailinator.com', '$2y$10$blB0vSGrvPVHZss/6xfaXegmJn48/EdmX5CwHwxh6KRXvgxiKMvdq', '00009956644', 0),
(38, 'Neve', 'Chase', 'ryvokir@mailinator.com', '$2y$10$1HMyv2Xrfhy4LZYhb5c8y.8pfqBmtqHQyvZOtj4jHbVdr5vlMloeq', '00009263742', 0),
(39, 'Tyler', 'Harvey', 'sefuv@mailinator.com', '$2y$10$aWGJSejnDbbA.rwzatLyj.WPhrVgNa3vb.3iEspPxakmsra5Jzeb2', '00005657629', 0),
(40, 'Hedley', 'Frost', 'cagevepoza@mailinator.com', '$2y$10$L3QvwwDnE1fa4NBUddXup.qqKVpjB00zw09hoXq8hQ4YBOl8ueu4S', '99991644174', 0),
(41, 'Macy', 'Barlow', 'fiqu@mailinator.com', '$2y$10$3yjCRF0qnLC52NKl2HNjOuX7.Q9C//jYVTusixk99I7ejDi6Fk7xO', '00001695373', 0),
(42, 'Germaine', 'Meyer', 'vovy@mailinator.com', '$2y$10$j/yyFdtWxxFIGT0sIbSiI.YfO1iOuRp7MtDE8OANu4hWrAJEzBOIe', '00006797393', 0),
(43, 'Pascale', 'Murray', 'vedogeq@mailinator.com', '$2y$10$HqacfbbjDB/dgpbHvcDIhuzcT8OlRlLQpWyj69MZn.4XEthZvEJJ.', '99992224127', 0),
(44, 'Nichole', 'Reeves', 'kahitux@mailinator.com', '$2y$10$jeWy9Mwyufy4JtqtOWPHyuGSGO2TUXPgoYaAvUllRTS1KOANRwEAC', '00000725468', 1),
(45, 'Hashim', 'Pace', 'jojybemovu@mailinator.com', '$2y$10$85dUcHzNEsTxWjt5Sj3gsOuZfL0ZsJayARSJmq.WfIx2cDeRqcC/e', '00059139341', 0),
(46, 'Aladdin', 'Goodwin', 'xuwedupo@mailinator.com', '$2y$10$Kbq42kjxj2AzPJmQGLyy5eyPj67Jpq9kGHs/tvxGuCoU046KmR3AO', '11239876634', 0),
(47, 'Ebony', 'Hampton', 'redoxy@mailinator.com', '$2y$10$qNnnm6IKMuIcO6NmUGSXQ.4CMwiAi0U6KiICAOsIKHPnQDC4jBE1e', '09994362245', 0),
(48, 'Graiden', 'Palmer', 'zojynuji@mailinator.com', '$2y$10$RD0qWYPEcTnzsQy.gT3My.aHJhPdkzDXUu2A5MgJny2pIk28uvmEi', '00973318505', 0),
(49, 'Kuame', 'Huber', 'qugolugir@mailinator.com', '$2y$10$cFaYv0Vcb8d2xvxuFdSKZusJ7L5h5EebJGJKOh6Kt9taBjKcOHUXC', '15849078841', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `loginlogs`
--
ALTER TABLE `loginlogs`
  ADD PRIMARY KEY (`login_logs_id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `user_id_propertyfk_constraint` (`user_id_propertyfk`),
  ADD KEY `property_type_id_propertyfk_constraint` (`property_type_id_propertyfk`),
  ADD KEY `street_id_propertyfk_constraint` (`street_id_propertyfk`),
  ADD KEY `city_id_propertyfk_constraint` (`city_id_propertyfk`),
  ADD KEY `town_id_propertyfk` (`town_id_propertyfk`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`property_type_id`);

--
-- Indexes for table `street`
--
ALTER TABLE `street`
  ADD PRIMARY KEY (`street_id`),
  ADD KEY `city_id_streetfk_constraint` (`city_id_streetfk`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`town_id`),
  ADD KEY `city_id_townfk_constraint` (`city_id_townfk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `loginlogs`
--
ALTER TABLE `loginlogs`
  MODIFY `login_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `property_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `street`
--
ALTER TABLE `street`
  MODIFY `street_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `town_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property`
--
ALTER TABLE `property`
  ADD CONSTRAINT `city_id_propertyfk_constraint` FOREIGN KEY (`city_id_propertyfk`) REFERENCES `city` (`city_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `property_type_id_propertyfk_constraint` FOREIGN KEY (`property_type_id_propertyfk`) REFERENCES `property_type` (`property_type_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `street_id_propertyfk_constraint` FOREIGN KEY (`street_id_propertyfk`) REFERENCES `street` (`street_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `town_id_propertyfk` FOREIGN KEY (`town_id_propertyfk`) REFERENCES `town` (`town_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `user_id_propertyfk_constraint` FOREIGN KEY (`user_id_propertyfk`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `street`
--
ALTER TABLE `street`
  ADD CONSTRAINT `city_id_streetfk_constraint` FOREIGN KEY (`city_id_streetfk`) REFERENCES `city` (`city_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `city_id_townfk_constraint` FOREIGN KEY (`city_id_townfk`) REFERENCES `city` (`city_id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
