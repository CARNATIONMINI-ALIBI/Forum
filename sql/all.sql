DROP DATABASE IF EXISTS `forum`;
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;


-- Dumping structure for table forum.answers
DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.answers: ~2 rows (approximately)
DELETE FROM `answers`;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `body`, `topic_id`, `created_on`, `user_id`) VALUES
	(1, 'xxxx', 2, '2014-08-24 16:43:39', 1),
	(2, 'Bez PHP', 2, '2014-08-24 16:43:52', 2);
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;


-- Dumping structure for table forum.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.categories: ~0 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `order_id`) VALUES
	(1, 'sdgfdfg', 1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table forum.forums
DROP TABLE IF EXISTS `forums`;
CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.forums: ~2 rows (approximately)
DELETE FROM `forums`;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` (`id`, `name`, `category_id`, `order_id`) VALUES
	(1, 'Domashni', 4, 1),
	(2, 'Teamworks', 4, 2),
	(3, 'Zapozananstava', 1, 1);
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;


-- Dumping structure for table forum.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.roles: ~2 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'user'),
	(2, 'moderator'),
	(3, 'administrator');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table forum.topics
DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `forum_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.topics: ~2 rows (approximately)
DELETE FROM `topics`;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `summary`, `body`, `forum_id`, `created_on`, `user_id`, `views`) VALUES
	(2, 'Homework PHP - Functions && objects', 'Na vi resheniqta', 1, '2014-08-20 21:14:25', 2, 0),
	(3, 'Kak se pravi musaka', 'Molya vi kajete mi kak da si napravia musaka', 1, '2014-08-22 19:21:26', 2, 0),
	(15, 'Kak se pravi vsichko', '?????', 1, '2014-08-24 16:47:19', 1, 0);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;


-- Dumping structure for table forum.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `avatar` varchar(50) DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `register_date` datetime DEFAULT NULL,
  `last_click` datetime DEFAULT NULL,
  `last_page` varchar(50) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `role_id`, `register_date`, `last_click`, `last_page`, `votes`) VALUES
	(1, 'RoYaLL', '202cb962ac59075b964b07152d234b70', 'mymail@mail.bg', '', 1, '2014-08-23 19:44:36', '2014-08-25 19:55:31', 'Users/logout', 100),
	(2, 'GoShow', 'caf1a3dfb505ffed0d024130f58c5cfa', 'mymail@abv.bg', '', 1, '2014-08-25 18:53:47', '2014-08-25 19:22:57', 'Topics/all', 50),
	(3, 'BaiHui', 'afsdgdfg', 'sgfdfg', '0', 0, '2014-08-25 18:53:41', '2014-08-25 19:06:47', 'Forums/view', NULL);
