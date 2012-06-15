CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `account_type` varchar(30) DEFAULT NULL,
  `signup_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notifications` text
);
CREATE TABLE IF NOT EXISTS `wikis` (
  `ownerid` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `wikiid` int(11) NOT NULL AUTO_INCREMENT primary key,
  `editors` text
);
CREATE TABLE IF NOT EXISTS `wiki_data` (
  `wikiid` int(11) DEFAULT NULL,
  `versionid` int(11) DEFAULT NULL,
  `wiki_title` text,
  `wiki_description` text,
  `editorid` int(11) DEFAULT NULL
);
