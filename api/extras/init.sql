-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2020 at 03:07 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

CREATE DATABASE IF NOT EXISTS `covid`;

use `covid`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
--

-- --------------------------------------------------------

--
-- Table structure for table `dados_covid`
--
-- DROP TABLE IF NOT EXISTS `dados_covid`;
CREATE TABLE `dados_covid` (
  `id_registro` int(11) NOT NULL,
  `uf` varchar(4) DEFAULT NULL,
  `casos_acumulado` int(11) DEFAULT NULL,
  `obitos_acumulado` int(11) DEFAULT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `obitos`
--
-- DROP TABLE IF NOT EXISTS `obitos`;
CREATE TABLE `obitos` (
  `id_registro` int(11) NOT NULL,
  `novos` int(11) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `obitos`
--

-- --------------------------------------------------------

--
-- Table structure for table `recuperados`
--
-- DROP TABLE IF NOT EXISTS `recuperados`;
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