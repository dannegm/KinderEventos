-- Adminer 4.2.0 MySQL dump

SET NAMES utf8mb4;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `pictures`;
CREATE TABLE `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `md5` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pictures` (`id`, `md5`, `filename`, `created_at`, `updated_at`) VALUES
(6,	'5bf6cc5c2f163d06c7981d1ee5e689bd',	'5bf6cc5c2f163d06c7981d1ee5e689bd.jpg',	'2017-09-25 05:25:07',	'2017-09-25 05:25:07'),
(7,	'133a5f6651bd8acef862531899d12695',	'133a5f6651bd8acef862531899d12695.jpg',	'2017-09-25 05:26:59',	'2017-09-25 05:26:59'),
(8,	'd81aba79f597ed1b7359f0e69cc060dc',	'd81aba79f597ed1b7359f0e69cc060dc.jpg',	'2017-09-25 05:27:39',	'2017-09-25 05:27:39'),
(9,	'9d228e480e00f3eb168a58580adecea8',	'9d228e480e00f3eb168a58580adecea8.jpg',	'2017-09-25 05:28:46',	'2017-09-25 05:28:46');

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_office` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture_md5` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quotes` (`id`, `quote`, `author_name`, `author_office`, `author_country`, `created_at`, `updated_at`, `picture_md5`) VALUES
(4,	'México es un país con una cultura muy creativa y sus problemas económicos y sociales hacen que los artistas y la creatividad sea muy aguda.',	'Alek Syntek',	'Cantante, Productor, Compositor',	'México',	'2017-09-25 05:25:33',	'2017-09-25 05:25:33',	'5bf6cc5c2f163d06c7981d1ee5e689bd'),
(5,	'Nuestros pueblos han tenido que echar mano de la creatividad para sobrevivir',	'Eugenia León',	'Cantante, Promotora Cultural',	'México',	'2017-09-25 05:27:18',	'2017-09-25 05:27:18',	'133a5f6651bd8acef862531899d12695'),
(6,	'Los invito a todos a que nos unamos en este frente común, en este frente naranja de la creatividad.',	'Guadalupe Pineda',	'Cantante',	'México',	'2017-09-25 05:27:55',	'2017-09-25 05:27:55',	'd81aba79f597ed1b7359f0e69cc060dc'),
(7,	'-',	'Mario Domm',	'Cantante, Compositor',	'México',	'2017-09-25 05:29:29',	'2017-09-25 05:29:29',	'9d228e480e00f3eb168a58580adecea8');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Daniel García',	'dannegm@gmail.com',	'$2y$10$G5EjIpMolUJn9yPQ2bj6.OnYu8v5tTzufL1BrBaGQPcxjwr1/twIW',	'svvpDquDlc68qoCgO3EiRIBEoeFxLf1cWfFeeTO67yN2aFf1kqNkIZE0yvUz',	'2017-09-24 21:37:01',	'2017-09-25 02:10:19');

-- 2017-09-25 02:53:31
