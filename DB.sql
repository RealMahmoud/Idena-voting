-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2020 at 10:36 AM
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
  `credits` int(10) NOT NULL DEFAULT 0,
  `state` varchar(255) NOT NULL DEFAULT 'zero',
  `username` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL DEFAULT 0,
  `lastseen` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` int(11) NOT NULL DEFAULT 0,
  `score` decimal(10,4) NOT NULL DEFAULT 0.0000,
  `password` varchar(255) NOT NULL DEFAULT '0',
  `bio` varchar(255) NOT NULL DEFAULT 'Hi There I am using Idena.Vote',
  `banned` int(11) NOT NULL DEFAULT 0,
  `reachout` varchar(255) NOT NULL DEFAULT '0',
  `hidden` int(11) NOT NULL DEFAULT 0,
  `donate` varchar(255) NOT NULL DEFAULT '0',
  `dailyCredits` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `authenticated` int(11) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fvfs`
--

CREATE TABLE `fvfs` (
  `id` int(11) NOT NULL,
  `addr` varchar(255) NOT NULL DEFAULT '0',
  `location1` varchar(255) NOT NULL DEFAULT '0',
  `location2` varchar(255) NOT NULL DEFAULT '0',
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `endtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `pdesc` text NOT NULL DEFAULT '0',
  `fundaddr` varchar(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT 'No Title',
  `category` varchar(30) NOT NULL DEFAULT 'idena',
  `vip` int(11) NOT NULL DEFAULT 0,
`ann` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `credits` int(11) NOT NULL DEFAULT 0,
  `hash` varchar(255) NOT NULL DEFAULT '0',
  `account` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `addtime` timestamp NULL DEFAULT current_timestamp(),
  `pdesc` text DEFAULT NULL,
  `endtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `addr` varchar(255) NOT NULL,
  `option1` varchar(255) DEFAULT NULL,
  `option2` varchar(255) DEFAULT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `option5` varchar(255) DEFAULT NULL,
  `option6` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'No Title',
  `category` varchar(30) NOT NULL DEFAULT 'idena',
  `vip` int(11) NOT NULL DEFAULT 0,
`ann` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `addr` varchar(255) NOT NULL DEFAULT '0',
  `addtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` int(15) NOT NULL DEFAULT 1,
  `pdesc` text NOT NULL DEFAULT '\'0\'',
  `endtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `option1` varchar(255) NOT NULL DEFAULT 'Yes',
  `option2` varchar(255) NOT NULL DEFAULT 'No',
  `fundaddr` varchar(64) NOT NULL DEFAULT 'NONE',
  `title` varchar(255) NOT NULL DEFAULT 'No Title',
  `category` varchar(30) NOT NULL DEFAULT 'idena',
  `vip` int(11) NOT NULL DEFAULT 0,
`ann` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `fvfs`
--
ALTER TABLE `fvfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `fvfs`
--
ALTER TABLE `fvfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
