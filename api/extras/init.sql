-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2020 at 03:07 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `dados_covid`
--

CREATE TABLE `dados_covid` (
  `id_registro` int(11) NOT NULL,
  `uf` varchar(4) DEFAULT NULL,
  `casos_acumulado` int(11) DEFAULT NULL,
  `obitos_acumulado` int(11) DEFAULT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dados_covid`
--

INSERT INTO `dados_covid` (`id_registro`, `uf`, `casos_acumulado`, `obitos_acumulado`, `last_updated`) VALUES
(866, 'SP', 101556, 7275, '2020-05-30 00:37:22'),
(867, 'CE', 38395, 2859, '2020-05-30 00:37:22'),
(868, 'RJ', 47953, 5079, '2020-05-30 00:37:22'),
(869, 'AM', 38909, 2011, '2020-05-30 00:37:22'),
(870, 'PE', 32255, 2669, '2020-05-30 00:37:22'),
(871, 'PA', 36486, 2827, '2020-05-30 00:37:22'),
(872, 'MA', 30482, 911, '2020-05-30 00:37:22'),
(873, 'BA', 16917, 609, '2020-05-30 00:37:22'),
(874, 'ES', 12903, 560, '2020-05-30 00:37:22'),
(875, 'SC', 8530, 134, '2020-05-30 00:37:22'),
(876, 'MG', 9232, 257, '2020-05-30 00:37:22'),
(877, 'DF', 8722, 154, '2020-05-30 00:37:22'),
(878, 'PB', 12011, 327, '2020-05-30 00:37:22'),
(879, 'AP', 8469, 207, '2020-05-30 00:37:22'),
(880, 'RS', 8234, 213, '2020-05-30 00:37:22'),
(881, 'AL', 8618, 406, '2020-05-30 00:37:22'),
(882, 'SE', 6462, 142, '2020-05-30 00:37:22'),
(883, 'RN', 6463, 268, '2020-05-30 00:37:22'),
(884, 'PR', 4236, 173, '2020-05-30 00:37:22'),
(885, 'PI', 4503, 146, '2020-05-30 00:37:22'),
(886, 'RO', 4502, 145, '2020-05-30 00:37:22'),
(887, 'AC', 5841, 135, '2020-05-30 00:37:22'),
(888, 'RR', 3098, 108, '2020-05-30 00:37:22'),
(889, 'GO', 3319, 119, '2020-05-30 00:37:22'),
(890, 'TO', 3611, 70, '2020-05-30 00:37:22'),
(891, 'MT', 2103, 56, '2020-05-30 00:37:22'),
(892, 'MS', 1356, 18, '2020-05-30 00:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `obitos`
--

CREATE TABLE `obitos` (
  `id_registro` int(11) NOT NULL,
  `novos` int(11) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obitos`
--

INSERT INTO `obitos` (`id_registro`, `novos`, `last_updated`) VALUES
(3, 674, '2020-05-18 22:50:49'),
(4, 1179, '2020-05-19 22:51:22'),
(5, 888, '2020-05-20 22:51:40'),
(6, 1188, '2020-05-21 22:51:53'),
(7, 1001, '2020-05-22 22:52:07'),
(8, 965, '2020-05-23 22:44:59'),
(9, 653, '2020-05-24 21:37:44'),
(10, 807, '2020-05-25 21:38:46'),
(11, 1039, '2020-05-26 21:39:07'),
(12, 1156, '2020-05-28 22:11:19'),
(13, 1124, '2020-05-30 00:37:35');

-- --------------------------------------------------------

--
-- Table structure for table `recuperados`
--

CREATE TABLE `recuperados` (
  `id_registro` int(11) NOT NULL,
  `novos` int(11) NOT NULL,
  `recuperados` int(11) NOT NULL,
  `acompanhamento` int(11) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recuperados`
--

INSERT INTO `recuperados` (`id_registro`, `novos`, `recuperados`, `acompanhamento`, `last_updated`) VALUES
(3, 13140, 100459, 136969, '2020-05-18 22:38:28'),
(4, 17408, 106794, 146863, '2020-05-19 20:32:19'),
(5, 19951, 116683, 156037, '2020-05-20 20:16:41'),
(6, 18508, 116683, 156037, '2020-05-21 17:46:44'),
(7, 20803, 135430, 174412, '2020-05-22 21:40:44'),
(8, 16508, 142587, 182798, '2020-05-23 22:43:55'),
(10, 15813, 142587, 182798, '2020-05-24 21:40:20'),
(11, 11687, 153833, 197592, '2020-05-25 21:38:09'),
(12, 16324, 158593, 208117, '2020-05-26 21:38:50'),
(13, 26417, 177604, 233880, '2020-05-28 22:11:11'),
(14, 26928, 189476, 247812, '2020-05-30 00:37:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dados_covid`
--
ALTER TABLE `dados_covid`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indexes for table `obitos`
--
ALTER TABLE `obitos`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indexes for table `recuperados`
--
ALTER TABLE `recuperados`
  ADD PRIMARY KEY (`id_registro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dados_covid`
--
ALTER TABLE `dados_covid`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=893;

--
-- AUTO_INCREMENT for table `obitos`
--
ALTER TABLE `obitos`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `recuperados`
--
ALTER TABLE `recuperados`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;