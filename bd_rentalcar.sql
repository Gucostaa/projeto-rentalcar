-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/05/2024 às 02:48
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

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id`, `marca_id`, `cor_id`, `tipo_id`, `ano_id`, `acessorios`, `cambio`, `caminho_imagem`, `nome`, `preco`, `quilometragem`) VALUES
(1, 1, 3, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'polo-track.png', 'Polo Robust', 89290.00, 0.00),
(2, 1, 5, 1, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'polo-robust.png\r\n', 'Polo Track', 89290.00, 0.00),
(7, 1, 1, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'polo-mpi.png', 'Polo MPI Branco', 89290.00, 0.00),
(8, 1, 5, 1, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'polo-tsi.png', 'Polo TSI Prata', 89290.00, 0.00),
(9, 1, 2, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'polo-sense.png', 'Polo Sense Cinza', 89290.00, 0.00),
(10, 1, 2, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som, controle de estabilidade', 'Automático', 'comfortline.png', 'Comfortline Cinza', 89290.00, 0.00),
(11, 1, 6, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som, controle de estabilidade', 'Automático', 'highline.png', 'Highline Vermelho', 89290.00, 0.00),
(12, 1, 6, 1, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som, controle de estabilidade, teto solar panorâmico', 'Automático', 'gts250-tsi.png', 'GTS 250 TSI Vermelho', 99990.00, 0.00),
(13, 1, 2, 2, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'virtus-tsi.png', 'Virtus TSI', 89290.00, 25.00),
(14, 1, 1, 2, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'virtus-comfortline.png', 'Virtus Comfortline', 89290.00, 25.00),
(15, 1, 4, 2, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'virtus-highline.png', 'Virtus Highline', 89290.00, 25.00),
(16, 1, 3, 2, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'virtus-exclusive.png', 'Virtus Exclusive', 89290.00, 25.00),
(17, 1, 6, 2, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'jetta-gli.png', 'Jetta GLI 350 TSI', 89290.00, 25.00),
(18, 1, 1, 3, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'nivus-sense.png', 'Nivus Sense 200 TSI', 89290.00, 25.00),
(19, 1, 4, 3, 25, 'Ar condicionado, direção elétrica, airbags, controle de estabilidade', 'Automático', 'nivus-comfortline.png', 'Nivus Comfortline 200 TSI', 89290.00, 25.00),
(20, 1, 3, 3, 25, 'Ar condicionado, direção elétrica, airbags, sistema de som', 'Manual', 'nivus-highline.png', 'Nivus Highline 200 TSI', 89290.00, 25.00);

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
(2, 'Nathy Neon', 'Nathy', 'naty@gmail.com', '19 99998 8888', '$2y$10$pqJFOpWpNNSujRECfw6ZPuy9Pu9AOvIwY4tPh0gd9zYCu6aM9fZHS', 'M', '2024-04-25 00:00:00', 'images/homilindo.png'),
(3, 'Andre', 'Andrelindo', 'Andrealmeida@gmail.com', '19 22222 2222', '$2y$10$a0x0v/hk0L/Te/c0M/dH4uCdhB3r21DPZKAvzf88KyxWJa2aa5buO', 'M', '2024-05-06 00:00:00', NULL);

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
(1, 'Volkswagen');

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
(3, 'SUV');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
