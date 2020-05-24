-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2020 at 02:11 AM
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
  `credits` tinyint(10) NOT NULL DEFAULT 2,
  `state` varchar(255) NOT NULL DEFAULT 'undefined',
  `username` varchar(50) NOT NULL,
  `lastseen` timestamp NOT NULL DEFAULT current_timestamp(),
  `age` int(11) NOT NULL DEFAULT 0,
  `score` decimal(10,4) NOT NULL DEFAULT 0.0000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `address`, `lastlogin`, `votescount`, `credits`, `state`, `username`, `lastseen`, `age`, `score`) VALUES
(4, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-22 08:05:04', 0, 2, 'Verified', '0xb3034881', '2020-05-23 23:21:56', 6, '1.0000'),
(5, '0x930348813590e02907da79e1c46fba4edca5a2d5', '2020-05-22 08:05:04', 0, 2, 'Verified', '0xb3034881', '2020-05-23 19:11:13', 6, '0.0000'),
(6, '0x830348813590e02907da79e1c46fba4edca502d5', '2020-05-22 08:05:04', 0, 2, 'Newbie', '0xb3034881', '2020-05-23 19:11:13', 6, '0.0000'),
(7, '0x000348810590e02907da79e1c46fba4edca5a2d5', '2020-05-22 08:05:04', 0, 2, 'Human', '0xb3034881', '2020-05-23 19:11:13', 6, '0.0000');

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
(50, '47588623-8DC0-4AD3-A0F7-BFB40B235755', '3E410F07-F580-4C01-A2EE-A055A4772F59', '0xd1a41e9ab9eb8848af21e7c86d4025454be1c904ad30c5c36d09c1df6001e8fe60ad2fa58059f769800d8d87f8970039463cbb2f3a40fe720ff94fc2754a870d00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(51, '99553215-92E0-4898-9794-A037386603BC', '98B5CC72-853B-490F-894C-8AF767550AC6', '0xd4a8144bee77b5cc4fd536a1434cba767f80fdfe2c96e727db421495cee4972848fdcbd13ff29c9bb8b6970edb46ce24792bfca2a9f75f9fbaa691c8f3bc457100', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(52, '2873397b-8269-4685-b272-e401e88e964c', '0E7FCE55-4257-4215-8333-B490A134AE60', '0x81f3f7d84fb6451771b7f6b2a4d3f3f412b3c01874fc30a63951f6bb8149e21d657483a8ce3daef03c620f25e2735050c2fb81541d0d1ba562ee4541f2e7521c01', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(53, '28476373-7860-4B0B-957B-AE49AAD12060', '2CB00AB5-BC63-4002-8849-0ACBAE7E0514', '0x5a44d55e5360a467a44b8e05a90a9cbc46c0cd267f8e29fea204a13516330ed708849e12b8ddeadf5d4827fc568acc839c9ecd5783c002b1824aea03b4239b1601', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(54, 'C90EF439-C596-4DDE-9395-ABB3095D734A', '9AD08C9C-8641-4624-B3C5-9B785EE1FCE4', '0xa6c1f8923d3a0c5f26b80d5cbfef806dfd30f613c0774bab71ee17ff311adf32198455ec2f2a1a696b6548da0d89537f3f6a4fed477387cde476f5de56e9e1af00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(55, 'C28F83ED-29F7-488E-AE95-BA75B4F483F0', 'C54EE0DC-7F41-4C3B-BF3F-ECAFB8658184', '0x7d864dac9f3246c5c059f2f6e6048e5e37f357666abf69303cac7fc8d4160de25f87cccba80bfd5530a56e9e2947814d5500d2abbee5b4b693917969219925fa01', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(56, '980D725A-9136-4544-89DB-0EE09AE2D1F3', '491BC445-225C-4FE9-8FDA-A13506274C36', '0x20faeeb1ba84fe8aa31004c42db41c15dd053b336210e2972fb6dfbfed3be2d36d39859ee69b8829c033a3684966e4860088ed70760e53456fb28f7ae55ba19900', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(57, '12A86E69-15EC-4D0D-8BD3-1E6E9B4418A7', '236706EC-65D5-487D-A48A-45A2F6E620D1', '0xf86ddcd0ac507f36fc01a00393901a4ed7a6daec7c900c7cc5e1f78ebae4044261aecd5b33ad54e5a5501e42fe1350e49d5f947be97f58cffadab26f3a73870900', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(58, '84963AE1-D97B-4200-A142-679F9AE7A0D0', '584A35B0-EDE9-4B46-BEEC-B656A09C17DB', '0x0d63cea57646b54c50ece0893acb684f9bac7f3e95ae3c5f5b050628b6fd24144ba8738d57be57096f3de0a9f7f61282e1dd9007a06598b3ab9e7741ece6f78800', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(59, 'C63966C1-894D-4760-BC2D-488B1486AEDF', 'D32808D4-E678-4EA7-9153-F412FD310966', '0x538c75f410041651312d012336540cd659b9eb33cb8b1f1d2a56ec22928b72e8611745097821123a91700a3ca53833ac270f9a0e5b578b295b51d5f1bf1c818200', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(60, '01F52829-62C2-4B1E-9E9A-C7BF15476EED', '198B9095-D516-40B8-AD07-6C184A434CC7', '0x8ec10abdd981c36dc8a9e215b427fd3b296f6a69a09b80ed246fdc4f8722826d3a538efb75fa15c00bebf02318c6545f53c3bc2fedf2bcc6cfcfcb5bdc54c3d301', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(61, 'B52D29B8-F27C-4B40-9F57-E2C083B79652', '66F89F39-96C4-4C5D-AC4C-5D50985C89A6', '0x150e6cd75abeb42fa57e5d2706e0c1d30a7196da8e964f0023a8834293e974ef5ac4599e90b3c0e26f16cd3537d37cd1bab5f0c2c33e9bc6af463f0d26d5d47800', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(62, '98B49227-AEFB-448E-AE07-4B599670D3B9', '5D420DC1-B95F-4186-AC4E-40248A690A9B', '0xc7f2c19a0adcb85862a372bf15d814c6752e94fb9a13f2f9f4774b5df473110a3dfc3779de118573acd0124741e6b7cc03a4c146f76f187f826c1d27f5f23ea701', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(63, '2B314226-7997-48C6-BCF2-28C71818A522', '0B7A99A9-85BE-4D1B-914D-9B76113DACDC', '0x8041d709b7a87fea760e2c06c478c51d71a87a42b557a2eab2c50dcda995e65858be96e163e21400e387cc42a50e2f21a60fd9677055055012a11309194c586001', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1),
(64, '1BADB108-ACC9-4FCA-AED4-0540E65AB432', '3DFCD901-E69A-41CE-9826-663BEC919769', '0xd02e93376e0735f03107c9a452891fd80f50bc32bed67c4362ba9c2f79ef674c2d4df7480287510eff3cc12d5a93a1d616fbdd4b9e7c6ffe198589ea0c90204e01', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 1);

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
  `option6` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `addtime`, `pdesc`, `endtime`, `addr`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`) VALUES
(12, '2020-05-21 23:42:06', 'Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?Do you like Cookies ?', '2020-05-22 00:42:55', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', 'Fuck off', '', '', ''),
(13, '2020-05-22 20:57:24', 'Do you like Cookies ?', '2020-05-23 08:55:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2020-05-22 21:02:55', 'Do you like Cookies ?', '2020-05-23 09:01:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', ''),
(15, '2020-05-22 23:24:30', 'Do you like Cookies ?', '2020-05-23 11:24:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', ''),
(16, '2020-05-22 23:24:34', 'Do you like Cookies ?', '2020-05-23 11:24:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', ''),
(17, '2020-05-22 23:24:40', 'Do you like Cookies ?', '2020-05-23 11:24:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', ''),
(18, '2020-05-22 23:25:08', 'Do you like Cookies ?', '2020-05-23 11:24:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', ''),
(19, '2020-05-22 23:25:12', 'Do you like Cookies ?', '2020-05-23 11:24:00', '0xb30348813590e02907da79e1c46fba4edca5a2d8', 'Yes', 'No', '', '', '', '');

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
  `step1` mediumtext NOT NULL,
  `option1` varchar(255) NOT NULL DEFAULT 'Yes',
  `option2` varchar(255) NOT NULL DEFAULT 'No',
  `fundaddr` varchar(64) NOT NULL DEFAULT 'NONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `addr`, `addtime`, `amount`, `pdesc`, `endtime`, `step1`, `option1`, `option2`, `fundaddr`) VALUES
(8, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-22 23:53:38', 1000, 'hi', '2020-05-23 11:53:00', '', 'Yes', 'No', '0xb30348813590e02907da79e1c46fba4edca5a2d8'),
(9, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-22 23:54:52', 1000, 'hi', '2020-05-23 11:53:00', '', 'Yes', 'No', '0xb30348813590e02907da79e1c46fba4edca5a2d8');

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
(9, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-21 18:47:07', 1, 'poll', 3),
(17, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-21 21:03:01', 3, 'poll', 1),
(20, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-21 22:23:29', 1, 'poll', 9),
(21, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-21 23:13:54', 1, 'poll', 9),
(25, '0xb30348813590e02907da79e1c46fba4edca5a2d8', '2020-05-22 23:07:36', 1, 'proposal', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
