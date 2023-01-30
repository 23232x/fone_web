-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 26-Jun-2019 às 13:49
-- Versão do servidor: 10.1.37-MariaDB-0+deb9u1
-- PHP Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phone_web`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_secretary` int(11) NOT NULL,
  `departament` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `confidential` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ldap`
--

CREATE TABLE `ldap` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ldap`
--

INSERT INTO `ldap` (`id`, `name`, `domain`, `server`, `port`, `status`) VALUES
(6, 'Informática', '@ti.sapiranga.net', '10.100.104.253', '389', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_logs` varchar(255) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_acesso`
--

CREATE TABLE `logs_acesso` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  `ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'Acesso a números confidenciais'),
(2, 'Criação de contatos'),
(3, 'Edição de contatos'),
(4, 'Criar usuários'),
(5, 'Editar usuários'),
(6, 'Gerenciar configurações');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions_users`
--

CREATE TABLE `permissions_users` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `secretary`
--

CREATE TABLE `secretary` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `secretary`
--

INSERT INTO `secretary` (`id`, `name`, `status`) VALUES
(1, 'Secretaria Municipal de PLANEJAMENTO, HABITAÇÃO, SEGURANÇA E MOBILIDADE ', 0),
(2, 'Secretaria Municipal de INDÚSTRIA, COMÉRCIO E TURISMO ', 0),
(3, 'Secretaria Municipal de EDUCAÇÃO, CULTURA E DESPORTO ', 0),
(4, 'Secretaria Municipal de SAÚDE ', 0),
(5, 'Secretaria Municipal de AGRICULTURA', 0),
(6, 'Secretaria Municipal de ADMINISTRAÇÃO', 0),
(7, 'Secretaria Municipal de FAZENDA', 0),
(8, 'Secretaria Municipal de ASSISTÊNCIA SOCIAL', 0),
(9, 'Secretaria Municipal de OBRAS PÚBLICAS E SERVIÇOS URBANOS ', 0),
(10, 'PROCURADORIA GERAL do Município', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `type_logs`
--

CREATE TABLE `type_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `type_logs`
--

INSERT INTO `type_logs` (`id`, `name`, `status`) VALUES
(1, 'Inserido', 1),
(2, 'Alterado', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_ldap` varchar(55) NOT NULL,
  `id_ldap` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_secretary` (`id_secretary`);

--
-- Indexes for table `ldap`
--
ALTER TABLE `ldap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_type_logs` (`type_logs`),
  ADD KEY `fk_contacts_id` (`id_contact`);

--
-- Indexes for table `logs_acesso`
--
ALTER TABLE `logs_acesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`id_user`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_permission` (`id_permission`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_logs`
--
ALTER TABLE `type_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ldap` (`id_ldap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ldap`
--
ALTER TABLE `ldap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs_acesso`
--
ALTER TABLE `logs_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `permissions_users`
--
ALTER TABLE `permissions_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secretary`
--
ALTER TABLE `secretary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `type_logs`
--
ALTER TABLE `type_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_secretary` FOREIGN KEY (`id_secretary`) REFERENCES `secretary` (`id`);

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_contacts_id` FOREIGN KEY (`id_contact`) REFERENCES `contacts` (`id`),
  ADD CONSTRAINT `fk_users_id` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `logs_acesso`
--
ALTER TABLE `logs_acesso`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `permissions_users`
--
ALTER TABLE `permissions_users`
  ADD CONSTRAINT `fk_permission_users_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kf_permissions_users_permission` FOREIGN KEY (`id_permission`) REFERENCES `permission` (`id`);

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_ldap_users` FOREIGN KEY (`id_ldap`) REFERENCES `ldap` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
