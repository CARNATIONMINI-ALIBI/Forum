CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `forum`;


-- Dumping structure for table forum.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `topic_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.answers: ~0 rows (approximately)
DELETE FROM `answers`;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` (`id`, `body`, `topic_id`, `created_on`, `user_id`, `username`) VALUES
	(1, 'Ама не е невъзможно.', 1, '2014-08-27 16:51:26', 2, ''),
	(2, 'addslashes() :D', 2, '2014-08-27 16:52:03', 0, 'Гост :)');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;


-- Dumping structure for table forum.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.categories: ~2 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `order_id`) VALUES
	(1, 'Programming', 1),
	(2, 'Solar system', 1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table forum.forums
CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `is_closed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.forums: ~5 rows (approximately)
DELETE FROM `forums`;
/*!40000 ALTER TABLE `forums` DISABLE KEYS */;
INSERT INTO `forums` (`id`, `name`, `category_id`, `order_id`, `is_closed`) VALUES
	(1, 'PHP', 1, 1, 0),
	(2, 'C#', 1, 1, 0),
	(3, 'Assembly', 1, 1, 0),
	(4, 'Venus', 2, 1, 0),
	(5, 'Earth', 2, 1, 0);
/*!40000 ALTER TABLE `forums` ENABLE KEYS */;


-- Dumping structure for table forum.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.roles: ~3 rows (approximately)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`) VALUES
	(1, 'user'),
	(2, 'moderator'),
	(3, 'administrator');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


-- Dumping structure for table forum.topics
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.topics: ~0 rows (approximately)
DELETE FROM `topics`;
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `summary`, `body`, `forum_id`, `created_on`, `user_id`, `views`, `is_closed`) VALUES
	(1, 'Как се прави форум с РНР', 'Трудно, ако е с двама човека', 1, '2014-08-27 16:44:31', 1, 5, 0),
	(2, 'Как не се прави форум с РНР', 'mysql_connect()', 1, '2014-08-27 16:50:28', 1, 4, 0);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;


-- Dumping structure for table forum.topic_tags
CREATE TABLE IF NOT EXISTS `topic_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.topic_tags: ~6 rows (approximately)
DELETE FROM `topic_tags`;
/*!40000 ALTER TABLE `topic_tags` DISABLE KEYS */;
INSERT INTO `topic_tags` (`id`, `topic_id`, `tag`) VALUES
	(11, 1, 'php'),
	(12, 1, 'mysql'),
	(13, 1, 'forums'),
	(14, 2, 'php'),
	(15, 2, 'mysql'),
	(16, 2, 'mysqli'),
	(17, 2, 'pdo');
/*!40000 ALTER TABLE `topic_tags` ENABLE KEYS */;


-- Dumping structure for table forum.users
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
  `votes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table forum.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `role_id`, `register_date`, `last_click`, `last_page`, `votes`) VALUES
	(1, 'RoYaL', '202cb962ac59075b964b07152d234b70', 'royal@ourteam.com', '0', 3, '2014-08-27 16:34:03', '2014-08-27 16:50:59', 'Users/logout', 0),
	(2, 'GoShow', 'caf1a3dfb505ffed0d024130f58c5cfa', 'goshow@ourteam.com', '0', 3, '2014-08-27 16:34:23', '2014-08-27 16:51:32', 'Users/logout', 0),
	(3, 'jury', '', 'jury@theirteam.com', '0', 1, '2014-08-27 16:34:57', '2014-08-27 16:34:58', NULL, 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table forum.user_votes
CREATE TABLE IF NOT EXISTS `user_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voter_id` int(11) NOT NULL DEFAULT '0',
  `voted_id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `vote` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `voter_id_voted_id_topic_id_vote` (`voter_id`,`voted_id`,`topic_id`,`vote`),
  UNIQUE KEY `voter_id_voted_id_answer_id_vote` (`voter_id`,`voted_id`,`answer_id`,`vote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table forum.user_votes: ~0 rows (approximately)
DELETE FROM `user_votes`;