CREATE TABLE IF NOT EXISTS `verifiedMail` (
  `mail` varchar(100) NOT NULL,
  `uid` varchar(50) NOT NULL,
  PRIMARY KEY  (`mail`, `uid`),
  KEY `mail` (`mail`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
