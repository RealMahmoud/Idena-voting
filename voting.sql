-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2020 at 04:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lastlogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `votescount` int(11) NOT NULL,
  `dev` tinyint(1) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'undefined',
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `address`, `lastlogin`, `votescount`, `dev`, `status`, `username`) VALUES
(1, '0xB30348813590e02907dA79E1C46fBA4Edca5a2d8', '2020-05-09 22:45:08', 0, 1, 'undefined', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `nonce` varchar(255) DEFAULT NULL,
  `sig` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `authenticated` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `token`, `nonce`, `sig`, `addr`, `authenticated`) VALUES
(50, '47588623-8DC0-4AD3-A0F7-BFB40B235755', '3E410F07-F580-4C01-A2EE-A055A4772F59', '0xd1a41e9ab9eb8848af21e7c86d4025454be1c904ad30c5c36d09c1df6001e8fe60ad2fa58059f769800d8d87f8970039463cbb2f3a40fe720ff94fc2754a870d00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `pdesc` text DEFAULT NULL,
  `endtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `addr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `addtime`, `pdesc`, `endtime`, `addr`) VALUES
(1, '2020-05-16 13:17:19', 'Will idena Beat BTC ?', '2020-05-16 13:17:19', '0xb30348813590e02907da79e1c46fba4edca5a2d8'),
(2, '2020-05-16 14:13:09', 'Will idena beat btc?', '2020-05-16 14:13:09', '0xb30348813590e02907da79e1c46fba4edca5a2d8');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `addr` varchar(255) NOT NULL DEFAULT '0',
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` int(15) NOT NULL DEFAULT 1,
  `pdesc` text NOT NULL DEFAULT '\'0\'',
  `endtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `addr`, `addtime`, `amount`, `pdesc`, `endtime`) VALUES
(1, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-16 13:32:55', 10000, 'Idena polls and voting for projects', '2020-05-16 14:17:37'),
(2, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-16 14:24:25', 1000, 'Cookies Store', '2020-05-16 14:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `vote` int(11) NOT NULL DEFAULT 1,
  `type` varchar(50) NOT NULL DEFAULT 'poll',
  `pid` int(55) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `addr`, `time`, `vote`, `type`, `pid`) VALUES
(4, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-16 13:52:36', 1, 'poll', 1),
(5, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-16 13:53:26', 1, 'poll', 1),
(6, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-16 13:53:27', 1, 'poll', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
