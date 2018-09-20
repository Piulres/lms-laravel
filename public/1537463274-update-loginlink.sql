-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 11-Set-2018 às 20:20
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wp_atvos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `wp_atvos_options`
--

UPDATE `wp_atvos_options` SET `option_value` = 'a:4:{s:23:\"wpau-send-approve-email\";b:1;s:25:\"wpau-send-unapprove-email\";b:1;s:18:\"wpau-approve-email\";s:209:\"Bem-vindo ao Território da Marca Atvos!\r\n\r\nPara fazer login, acesse o link: <a href=\"LOGINLINK\"/>Clique aqui</a>\r\n\r\nUtilize o e-mail esenha cadastrados.\r\n\r\n------------------\r\n\r\nEquipe de Comunicação Atvos\";s:20:\"wpau-unapprove-email\";s:124:\"Desculpe!!!\r\n\r\nVocê não foi aprovadoao Território da Marca Atvos!\r\n\r\n------------------\r\n\r\nEquipe de Comunicação Atvos\";}' WHERE `wp_atvos_options`.`option_id` = 438 