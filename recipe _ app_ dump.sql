-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2025 at 05:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Receitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `Categoria`
--

CREATE TABLE `Categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `nome`) VALUES
(1, 'Rápida'),
(2, 'Sobremesa');

-- --------------------------------------------------------

--
-- Table structure for table `Ingrediente`
--

CREATE TABLE `Ingrediente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Ingrediente`
--

INSERT INTO `Ingrediente` (`id`, `nome`) VALUES
(1, 'Esparguete'),
(2, 'Ovos'),
(3, 'Bacon'),
(4, 'Queijo parmesão'),
(5, 'Cogumelos'),
(6, 'Bolacha Maria'),
(7, 'Café'),
(8, 'Manteiga'),
(9, 'Açúcar'),
(10, 'Ovo');

-- --------------------------------------------------------

--
-- Table structure for table `Receita`
--

CREATE TABLE `Receita` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `tempo_preparo` int(11) NOT NULL,
  `doses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Receita`
--

INSERT INTO `Receita` (`id`, `nome`, `descricao`, `tempo_preparo`, `doses`) VALUES
(3, 'Carbonara', 'Massa italiana', 20, 2),
(4, 'Bolo de Bolacha', 'Sobremesa portuguesa', 50, 9);

-- --------------------------------------------------------

--
-- Table structure for table `receita_categoria`
--

CREATE TABLE `receita_categoria` (
  `id` int(11) NOT NULL,
  `id_receita` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receita_categoria`
--

INSERT INTO `receita_categoria` (`id`, `id_receita`, `id_categoria`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `receita_ingrediente`
--

CREATE TABLE `receita_ingrediente` (
  `id` int(11) NOT NULL,
  `id_Ingrediente` int(11) DEFAULT NULL,
  `id_receita` int(11) DEFAULT NULL,
  `quantidade` decimal(10,2) DEFAULT NULL,
  `unidade_medida` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receita_ingrediente`
--

INSERT INTO `receita_ingrediente` (`id`, `id_Ingrediente`, `id_receita`, `quantidade`, `unidade_medida`) VALUES
(1, 1, 1, 200.00, 'g'),
(2, 2, 1, 2.00, 'unidades'),
(3, 3, 1, 100.00, 'g'),
(4, 4, 1, 50.00, 'g'),
(5, 5, 1, 100.00, 'g'),
(6, 6, 2, 200.00, 'g'),
(7, 7, 2, 1.00, 'chávena'),
(8, 8, 2, 200.00, 'g'),
(9, 9, 2, 150.00, 'g'),
(10, 10, 2, 1.00, 'unidade');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `Ingrediente`
--
ALTER TABLE `Ingrediente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Receita`
--
ALTER TABLE `Receita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receita_categoria`
--
ALTER TABLE `receita_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receita_ingrediente`
--
ALTER TABLE `receita_ingrediente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Ingrediente`
--
ALTER TABLE `Ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Receita`
--
ALTER TABLE `Receita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `receita_categoria`
--
ALTER TABLE `receita_categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `receita_ingrediente`
--
ALTER TABLE `receita_ingrediente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
