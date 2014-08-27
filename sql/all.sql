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
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.answers: ~8 rows (approximately)
DELETE FROM `answers`;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `body`, `topic_id`, `created_on`, `user_id`, `username`) VALUES
	(1, 'xxxx????', 2, '2014-08-28 16:43:39', 1, NULL),
	(3, 'sdgfdfg', 0, '2014-08-25 21:41:33', 1, ''),
	(4, 'sfsgdfghfgh', 0, '2014-08-25 21:41:51', 0, 'az sam we'),
	(5, 'asdfsdfs', 0, '2014-08-25 21:42:33', 0, 'ti li si we '),
	(6, 'dsfdfg', 17, '2014-08-25 21:43:05', 0, 'qqq'),
	(8, 'safsdfsdg', 2, '2014-08-26 21:53:51', 0, '213124324'),
	(9, '131313', 2, '2014-08-26 22:05:32', 0, '131313');
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
  `is_closed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.forums: ~3 rows (approximately)
DELETE FROM `forums`;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` (`id`, `name`, `category_id`, `order_id`, `is_closed`) VALUES
	(1, 'Domashni', 4, 1, 0),
	(2, 'Teamworks', 4, 2, 0),
	(3, 'Zapozananstava', 1, 1, 0);
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
  `is_closed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.topics: ~3 rows (approximately)
DELETE FROM `topics`;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `summary`, `body`, `forum_id`, `created_on`, `user_id`, `views`, `is_closed`) VALUES
	(2, 'Homework PHP - Functions && objects', 'Na vi resheniqta', 1, '2014-08-20 21:14:25', 2, 4, 0),
	(16, 'asdfsdf SHEST', 'dfsdgdfgdfh1111', 6, '2014-08-25 20:56:22', 8, 0, 0),
	(17, 'dsfdf', 'sdfsdfg', 5, '2014-08-25 20:58:16', 1, 0, 0);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;


-- Dumping structure for table forum.topic_tags
DROP TABLE IF EXISTS `topic_tags`;
CREATE TABLE IF NOT EXISTS `topic_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.topic_tags: ~10 rows (approximately)
DELETE FROM `topic_tags`;
/*!40000 ALTER TABLE `topic_tags` DISABLE KEYS */;
INSERT INTO `topic_tags` (`id`, `topic_id`, `tag`) VALUES
	(4, 17, 'al'),
	(5, 17, 'ui'),
	(6, 17, 'asdasd'),
	(19, 2, 'shest'),
	(20, 2, 'sedem'),
	(21, 16, 'uq mi'),
	(22, 15, 'asd'),
	(23, 15, 'das'),
	(24, 15, 'dsaa'),
	(25, 15, 'kur');
/*!40000 ALTER TABLE `topic_tags` ENABLE KEYS */;


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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table forum.users: ~5 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `role_id`, `register_date`, `last_click`, `last_page`, `votes`) VALUES
	(1, 'RoYaLL', '202cb962ac59075b964b07152d234b70', 'mymail@mail.bg', '', 2, '2014-08-23 19:44:36', '2014-08-27 00:31:58', 'Users/logout', 100),
	(2, 'GoShow', 'caf1a3dfb505ffed0d024130f58c5cfa', 'mymail@abv.bg', '', 1, '2014-08-25 18:53:47', '2014-08-25 19:22:57', 'Topics/all', 50),
	(3, 'BaiHui', 'afsdgdfg', 'sgfdfg', '0', 0, '2014-08-25 18:53:41', '2014-08-25 19:06:47', 'Forums/view', NULL),
	(4, 'RoYaL_BG', '81dc9bdb52d04dc20036dbd8313ed055', 'sffsdg@dsfsdf.com', '', 1, '2014-08-27 00:32:19', '2014-08-27 00:33:01', 'Users/logout', NULL),
	(5, 'dsfdg', 'fae0b27c451c728867a567e8c1bb4e53', 'dsfsdg', '', 1, '2014-08-27 00:33:20', '2014-08-27 08:40:36', 'Forums/view', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table forum.user_votes
DROP TABLE IF EXISTS `user_votes`;
CREATE TABLE IF NOT EXISTS `user_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL DEFAULT '0',
  `voted_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `voter_id_voted_id` (`voter_id`,`voted_id`)
) ENGINE=InnoDB;

-- Dumping data for table forum.user_votes: ~0 rows (approximately)
DELETE FROM `user_votes`;