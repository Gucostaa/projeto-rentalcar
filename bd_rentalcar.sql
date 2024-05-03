-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/05/2024 às 03:08
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_rentalcar`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `ano`
--

CREATE TABLE `ano` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ano`
--

INSERT INTO `ano` (`id`, `nome`) VALUES
(11, '2010'),
(12, '2011'),
(13, '2012'),
(14, '2013'),
(15, '2014'),
(16, '2015'),
(17, '2016'),
(18, '2017'),
(19, '2018'),
(20, '2019'),
(21, '2020'),
(22, '2021'),
(23, '2022'),
(24, '2023'),
(25, '2024');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id` int(11) NOT NULL,
  `marca_id` int(11) DEFAULT NULL,
  `cor_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `ano_id` int(11) DEFAULT NULL,
  `acessorios` varchar(255) DEFAULT NULL,
  `cambio` varchar(50) DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `quilometragem` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `genero` char(1) DEFAULT NULL,
  `data_inclusao` datetime DEFAULT NULL,
  `caminho_imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `usuario`, `email`, `telefone`, `senha`, `genero`, `data_inclusao`, `caminho_imagem`) VALUES
(1, 'Gabriel', 'GaybrielXD', 'gabalmeidayasper@outlook.com', '+55 19 99996666', '$2y$10$Z83MudfBbpKf8cILmnpvhOsvzuFqS1Z97Eo/hyAcYrLODswkeEweu', '', '2024-04-24 00:00:00', NULL),
(2, 'Nathy Neon', 'Nathy', '', '', '$2y$10$SH8TV0CMrRyJ0K5TB5PvdOakXUgSh0T6oR8DzHg5bmknknXPwBCbm', 'M', '2024-04-25 00:00:00', 'images/picape.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cor`
--

CREATE TABLE `cor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cor`
--

INSERT INTO `cor` (`id`, `nome`) VALUES
(1, 'Branco'),
(2, 'Cinza'),
(3, 'Preto'),
(4, 'Azul'),
(5, 'Prata'),
(6, 'Vermelho'),
(7, 'Marrom'),
(8, 'Verde'),
(9, 'Amarelo'),
(10, 'Laranja');

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`) VALUES
(1, 'Volkswagen'),
(2, 'Fiat'),
(3, 'Chevrolet'),
(4, 'Hyundai'),
(5, 'Toyota'),
(6, 'Jeep'),
(7, 'Renault'),
(8, 'Honda'),
(9, 'Nissan'),
(10, 'Peugeot'),
(11, 'Citroen');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tipo`
--

INSERT INTO `tipo` (`id`, `nome`) VALUES
(1, 'Hatch'),
(2, 'Sedan'),
(3, 'SUV'),
(4, 'Crossover'),
(5, 'Minivan'),
(6, 'Picape');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `ano`
--
ALTER TABLE `ano`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca_id` (`marca_id`),
  ADD KEY `cor_id` (`cor_id`),
  ADD KEY `tipo_id` (`tipo_id`),
  ADD KEY `ano_id` (`ano_id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cor`
--
ALTER TABLE `cor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ano`
--
ALTER TABLE `ano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cor`
--
ALTER TABLE `cor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`marca_id`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `carros_ibfk_2` FOREIGN KEY (`cor_id`) REFERENCES `cor` (`id`),
  ADD CONSTRAINT `carros_ibfk_3` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`),
  ADD CONSTRAINT `carros_ibfk_4` FOREIGN KEY (`ano_id`) REFERENCES `ano` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
