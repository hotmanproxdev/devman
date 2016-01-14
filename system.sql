# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.24)
# Database: Prosystem
# Generation Time: 2016-01-14 14:01:14 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table prosystem_administrator_process_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_administrator_process_logs`;

CREATE TABLE `prosystem_administrator_process_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `userip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userHash` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isoCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` double(8,2) DEFAULT NULL,
  `lon` double(8,2) DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `continent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isMobile` int(11) DEFAULT NULL,
  `isTablet` int(11) DEFAULT NULL,
  `isDesktop` int(11) DEFAULT NULL,
  `isBot` int(11) DEFAULT NULL,
  `browserFamily` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browserVersionMajor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browserVersionMinor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browserVersionPatch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `osFamily` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `osVersionMajor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `osVersionMinor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `osVersionPatch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceFamily` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deviceModel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobileGrade` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cssVersion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `javaScriptSupport` int(11) DEFAULT NULL,
  `referer` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formprocess` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_path_explain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `log_process` int(11) NOT NULL,
  `msg` text COLLATE utf8_unicode_ci,
  `postdata` text COLLATE utf8_unicode_ci NOT NULL,
  `noauth_area_operations` int(11) DEFAULT '0',
  `success_operations` int(11) DEFAULT '0',
  `fail_operations` int(11) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `created_at` (`created_at`),
  KEY `log_process` (`log_process`),
  KEY `is_mobile` (`isMobile`),
  KEY `is_tablet` (`isTablet`),
  KEY `is_desktop` (`isDesktop`),
  KEY `is_bot` (`isBot`),
  KEY `os_family` (`osFamily`),
  KEY `url_path_explain` (`url_path_explain`),
  KEY `country` (`country`),
  KEY `noauth` (`noauth_area_operations`),
  KEY `success` (`success_operations`),
  KEY `fail` (`fail_operations`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_administrator_process_logs` WRITE;
/*!40000 ALTER TABLE `prosystem_administrator_process_logs` DISABLE KEYS */;

INSERT INTO `prosystem_administrator_process_logs` (`id`, `userid`, `userip`, `userHash`, `isoCode`, `country`, `city`, `state`, `postal_code`, `lat`, `lon`, `timezone`, `continent`, `isMobile`, `isTablet`, `isDesktop`, `isBot`, `browserFamily`, `browserVersionMajor`, `browserVersionMinor`, `browserVersionPatch`, `osFamily`, `osVersionMajor`, `osVersionMinor`, `osVersionPatch`, `deviceFamily`, `deviceModel`, `mobileGrade`, `cssVersion`, `javaScriptSupport`, `referer`, `formprocess`, `user_agent`, `user_host`, `url_path`, `url_path_explain`, `log_process`, `msg`, `postdata`, `noauth_area_operations`, `success_operations`, `fail_operations`, `created_at`)
VALUES
	(76,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/users','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/home','/mandev/home',1,'access','[]',0,0,0,1452778721),
	(77,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/users','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/login','/mandev/login',1,'access','[]',0,0,0,1452778721),
	(78,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/login','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/login','/mandev/login',2,'access','{\"_token\":\"oG6eMdyv87rWpZkTaBY1UVcpVl5EYzfqlQBGaVom\",\"ccode\":\"devSde\",\"username\":\"aligurbuz\",\"password\":\"280384483082\"}',0,0,0,1452778727),
	(79,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/login','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/home','/mandev/home',1,'access','[]',0,0,0,1452778727),
	(80,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/login','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/home','/mandev/home',1,'access','[]',0,0,0,1452778766),
	(81,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/login','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/home','/mandev/home',1,'access','[]',0,0,0,1452778852),
	(82,1,'127.0.0.1',NULL,'US','United States','New Haven','CT','06510',41.31,-72.92,'America/New_York','NA',0,0,1,0,'Chrome','0','0','0','MacOSX','0','0','0','','','','1',1,'http://localhost:8070/projects/devman/devman/public/mandev/home','Normal Request','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36','localhost:8070','http://localhost:8070/projects/devman/devman/public/mandev/home','/mandev/home',1,'access','[]',0,0,0,1452778908);

/*!40000 ALTER TABLE `prosystem_administrator_process_logs` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
