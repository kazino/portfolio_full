-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 20 Décembre 2014 à 19:56
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tuto`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`) VALUES
(1, 'Wordpress 4', 'wordpress'),
(2, 'Symfony 2', 'symfony'),
(3, 'Silex', 'silex');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `work_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `work_id` (`work_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `name`, `work_id`) VALUES
(8, '8.jpg', 2),
(9, '9.jpg', 3),
(7, '7.jpg', 2),
(10, '10.jpg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Structure de la table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `image_id` (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `works`
--

INSERT INTO `works` (`id`, `name`, `slug`, `content`, `category_id`, `image_id`) VALUES
(2, 'AMG', 'amgkaz', '<p>63 fr&eacute;ro tu me voie plus</p>\r\n<p>&nbsp;</p>\r\n<p><strong>AMGZER</strong> uiuiuiui</p>', 1, 7),
(3, 'Bmw M5', 'bmw-m5', '<h1><span style="text-decoration: underline;">BMW <em>M5</em></span></h1>\r\n<p>BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW BMW&nbsp;</p>', 2, 9);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
