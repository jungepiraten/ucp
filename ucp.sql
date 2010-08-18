CREATE TABLE IF NOT EXISTS `verifiedMail` (
  `mail` varchar(100) NOT NULL,
  `uid` varchar(50) NOT NULL,
  PRIMARY KEY  (`mail`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `listVerifyQueue` (
  `mail` varchar(50) NOT NULL,
  `list` varchar(30) NOT NULL,
  PRIMARY KEY  (`mail`,`list`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
