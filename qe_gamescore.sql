CREATE TABLE `qe_gamescore` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `useremail` varchar(32) NOT NULL DEFAULT '',
  `score` int(10) unsigned DEFAULT NULL,
  `gamename` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_game` (`useremail`,`gamename`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;