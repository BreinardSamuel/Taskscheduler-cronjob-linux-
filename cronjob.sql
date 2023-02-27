-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 28, 2023 at 04:16 AM
-- Server version: 8.0.32-0ubuntu0.22.10.2
-- PHP Version: 8.1.7-1ubuntu3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cronjob`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL COMMENT 'auto incremented admin id',
  `email` varchar(100) NOT NULL COMMENT 'email of the admin',
  `password` varchar(50) NOT NULL COMMENT 'password for admin login'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '123456admin');

-- --------------------------------------------------------

--
-- Table structure for table `cronDetails`
--

CREATE TABLE `cronDetails` (
  `cron_id` int NOT NULL COMMENT 'to know number of crons',
  `cron_label` varchar(200) NOT NULL COMMENT 'Name of the cron job',
  `cron_url` varchar(250) DEFAULT NULL COMMENT 'URL which needs to be triggered for cronjob',
  `minute` varchar(20) NOT NULL DEFAULT '*' COMMENT 'indicates the minute when the cron needs to executed',
  `hour` varchar(20) NOT NULL DEFAULT '*' COMMENT 'indicates the hour when the cron needs to executed',
  `days` varchar(20) NOT NULL DEFAULT '*' COMMENT 'indicates the days when the cron needs to executed',
  `month` varchar(20) NOT NULL DEFAULT '*' COMMENT 'indicates the month when the cron needs to executed',
  `day_of_the_week` varchar(20) NOT NULL DEFAULT '*' COMMENT 'indicates the Day of the week when the cron needs to executed',
  `reccurance` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '∞',
  `reccured` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `seperator` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '/',
  `cron_command` varchar(250) NOT NULL COMMENT 'the cron command which needs to be executed',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'created date of this cronjob',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'edited or updated date of this cronjob'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cronDetails`
--

INSERT INTO `cronDetails` (`cron_id`, `cron_label`, `cron_url`, `minute`, `hour`, `days`, `month`, `day_of_the_week`, `reccurance`, `reccured`, `seperator`, `cron_command`, `created_on`, `updated_on`) VALUES
(49, 'BINU', '', '*', '*', '*', '*', '*', '∞', '0', '/', '* * * * * /usr/bin/php /var/www/html/cronjob/app/Scripts/CronURLScript.php >> /home/breinard/Downloads/log.log 2>&1 ', '2023-02-27 21:12:46', '2023-02-27 21:12:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cronDetails`
--
ALTER TABLE `cronDetails`
  ADD PRIMARY KEY (`cron_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT COMMENT 'auto incremented admin id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cronDetails`
--
ALTER TABLE `cronDetails`
  MODIFY `cron_id` int NOT NULL AUTO_INCREMENT COMMENT 'to know number of crons', AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
