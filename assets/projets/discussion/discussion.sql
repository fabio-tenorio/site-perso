-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2020 at 11:36 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discussion`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` varchar(140) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_utilisateur`, `date`) VALUES
(119, 'eu estava na beira da praia', 1, '2020-12-02'),
(120, 'ouvindo as pancadas das ondas do mar', 1, '2020-12-02'),
(121, 'mesmo quando tudo pede um pouco mais de alma', 2, '2020-12-02'),
(122, 'atÃ© quando tudo pede um pouco mais de alma', 2, '2020-12-02'),
(123, 'kilario! Raiou o dia! Eu vi chover em minha horta!', 3, '2020-12-02'),
(124, 'ai ai meu Deus do cÃ©u como eu sofri ao ver a natureza morta', 3, '2020-12-02'),
(125, 'la bohÃ¨me, la bohÃ¨me, Ã§a voulait dire \"on Ã©tait heureux\".', 5, '2020-12-02'),
(127, 'tout va bien, si finit bien.', 5, '2020-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'lia', '$2y$10$q8WmDC7Pxq0rNqDv/G6Bou/gOqW1p7CCDOMSu/DGrdW3lAel0jPEu'),
(2, 'lenine', '$2y$10$qrvemZfOIjlGvH39quw4zeVGFC8pY4BKUc7QrNPuB3aZCwTgMvkmC'),
(3, 'dimelo', '$2y$10$gzOHTKUHQH4y/3t7HAFTtev3YUEbRTGepIZmmV0O04.TE.FUzxfbq'),
(4, 'alceu', '$2y$10$hHB1quDUGw/5eRS73zS3auW.9Hki.vJRRWcIX3x9tIAa0wAelJD.a'),
(5, 'jack', '$2y$10$n0or9d6E.hPlSiy9dSMKpe/jXP7TR2r0FMvYvK5zoBhBLGJ4QfCPG'),
(6, 'noemi', '$2y$10$GKPZrLmVF/TDAQ610LhF/Or0et6A7xzKjPSBlAaUUQHiGm5JezLcq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
