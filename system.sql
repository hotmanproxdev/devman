# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.24)
# Database: Prosystem
# Generation Time: 2016-02-11 14:44:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_admin_menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_admin_menus`;

CREATE TABLE `prosystem_admin_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `row` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `statu` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_administrator
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_administrator`;

CREATE TABLE `prosystem_administrator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ccode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_hash_time` int(14) DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_info` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` int(11) NOT NULL DEFAULT '1',
  `user_lock` int(11) DEFAULT '1',
  `role` text COLLATE utf8_unicode_ci NOT NULL,
  `system_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_number` int(11) DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `occupation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_time` int(11) DEFAULT NULL,
  `all_time_spent` int(14) DEFAULT '0',
  `hash_time_spent` int(14) DEFAULT '0',
  `last_hash_time_spent` int(14) DEFAULT '0',
  `all_average_time_spent_for_every_hash` float DEFAULT '0',
  `all_hash_number` int(14) DEFAULT '0',
  `user_where` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `logout` int(2) DEFAULT '0',
  `logout_time` int(14) DEFAULT '0',
  `created_by` int(14) DEFAULT NULL,
  `is_mobile` int(14) DEFAULT NULL,
  `is_tablet` int(14) DEFAULT NULL,
  `is_desktop` int(14) DEFAULT NULL,
  `is_bot` int(14) DEFAULT NULL,
  `browser_family` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os_family` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `all_clicked` int(14) DEFAULT '0',
  `hash_clicked` int(14) DEFAULT '0',
  `operations` int(14) DEFAULT '0',
  `success_operations` int(14) DEFAULT '0',
  `fail_operations` int(14) DEFAULT '0',
  `manipulation` int(14) DEFAULT '0',
  `noauth_area_operations` int(14) DEFAULT '0',
  `last_token` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_post` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `hash` (`hash`),
  KEY `updated_at` (`updated_at`),
  KEY `system_number` (`system_number`),
  KEY `status` (`status`),
  KEY `logout` (`logout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_administrator` WRITE;
/*!40000 ALTER TABLE `prosystem_administrator` DISABLE KEYS */;

INSERT INTO `prosystem_administrator` (`id`, `ccode`, `username`, `password`, `email`, `hash`, `last_hash`, `fullname`, `last_ip`, `first_hash_time`, `created_at`, `updated_at`, `photo`, `extra_info`, `lang`, `user_lock`, `role`, `system_name`, `system_number`, `phone_number`, `address`, `occupation`, `website`, `last_login_time`, `all_time_spent`, `hash_time_spent`, `last_hash_time_spent`, `all_average_time_spent_for_every_hash`, `all_hash_number`, `user_where`, `status`, `logout`, `logout_time`, `created_by`, `is_mobile`, `is_tablet`, `is_desktop`, `is_bot`, `browser_family`, `os_family`, `all_clicked`, `hash_clicked`, `operations`, `success_operations`, `fail_operations`, `manipulation`, `noauth_area_operations`, `last_token`, `last_post`)
VALUES
	(1,'devSde','aligurbuz','7ada520f7fb0eb935a11f392511fe86e','info@booksyst.com','720231d4f95ef7227368a4ac0304fed2','720231d4f95ef7227368a4ac0304fed2','Ali Bilge Gürbüz','127.0.0.1',1454078251,1447331070,1455198950,'48832.jpg','it can be written later',1,1,'1@3','Developer\n',0,'0545 906 29 92','Ankara','Software Developer','http://www.booksyst.com',1455198395,231643,3256,228387,2638.34,89,'/api/services/test',1,0,0,NULL,0,0,1,0,'Chrome','MacOSX',7190,15,483,303,202,344,344,'1dcd2bf2a1b863b8c5605941e728ba6e','eyJpZCI6IjEiLCJfdG9rZW4iOiIxZGNkMmJmMmExYjg2M2I4YzU2MDU5NDFlNzI4YmE2ZSIsImFjY2Vzc19zZXJ2aWNlX2tleSI6IjEiLCJjY29kZSI6Imd1ZXN0IiwiaXAiOiIxMjcuMC4wLjEiLCJhcGlrZXkiOiJhbGlndXJidXoiLCJoYXNoX251bWJlciI6IjEiLCJoYXNoX2xpbWl0IjoiMyIsInJlcXVlc3RfdHlwZSI6IjEiLCJyZXF1ZXN0IjoiMTAwMCIsImFwaV9jb2RpbmdfaW5zZXJ0IjoiMSIsImFwaV9jb2RpbmdfdXBkYXRlIjoiMSIsImFwaV9jb2RpbmdfZGVsZXRlIjoiMSIsImFwaV9kZXZlbG9wX3VybF9maWx0ZXIiOiIxIn0='),
	(47,'teknasyon','test','bae9b68c1442c765eb9abe91da44a769','test1@teknasyon.coma','791c7602b30093993dc5d574422713b6','791c7602b30093993dc5d574422713b6','Test User','127.0.0.1',1454078289,1454056854,1455118080,'default.png','teest',1,1,'1@2@3@4@5@6@7@8@9@10@11@12','manager',1,'','Ankara','Testing','',1455117636,5476,447,5476,740.375,8,'/mandev/logout',1,1,1455118083,1,0,0,1,0,'Chrome','MacOSX',144,15,10,6,4,23,38,'cbb2b1ee41acf1040c331c79f76db0c6','eyJfdG9rZW4iOiJjYmIyYjFlZTQxYWNmMTA0MGMzMzFjNzlmNzZkYjBjNiIsImRlZmF1bHRfcm9sZXMiOiIxLTFAMkAzQDRANUA2QDdAOEA5QDEwQDExQDEyIiwicm9sZV9hc3NpZ24iOlsiMSIsIjIiLCIzIiwiNCIsIjUiLCI2IiwiNyIsIjgiLCI5IiwiMTAiLCIxMSIsIjEyIl19'),
	(48,'teknasyon','test2','bae9b68c1442c765eb9abe91da44a769','test@gmail.com','',NULL,'Test User2','',0,1454067176,0,'default.png','',1,1,'1@3','normal',2,'',NULL,NULL,NULL,NULL,0,0,0,0,0,NULL,1,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,NULL,NULL),
	(49,'teknasyon','fahri','e3a5c7d489dac6f5a7ba9d8e11c1f437','face@tatilkasabasi.com','',NULL,'Fahri Kasaplar','',0,1454944961,0,'default.png','',1,1,'1@3','normal',2,'',NULL,NULL,NULL,NULL,0,0,0,0,0,NULL,1,0,0,1,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,0,0,0,0,NULL,NULL);

/*!40000 ALTER TABLE `prosystem_administrator` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table prosystem_administrator_process_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_administrator_process_logs`;

CREATE TABLE `prosystem_administrator_process_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `userip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` char(255) COLLATE utf8_unicode_ci DEFAULT '0',
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
  `url_path_valid` int(2) DEFAULT '1',
  `log_process` int(11) NOT NULL,
  `msg` text COLLATE utf8_unicode_ci,
  `postdata` text COLLATE utf8_unicode_ci NOT NULL,
  `no_route` int(2) DEFAULT '0',
  `noauth_area_operations` int(11) DEFAULT '0',
  `success_operations` tinyint(11) DEFAULT '0',
  `fail_operations` int(11) DEFAULT '0',
  `manipulation` int(11) DEFAULT '0',
  `query_json` longtext COLLATE utf8_unicode_ci,
  `process_count_sql` int(11) DEFAULT '0',
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
  KEY `fail` (`fail_operations`),
  KEY `manipulation` (`manipulation`),
  KEY `url_path_valid` (`url_path_valid`),
  KEY `userip` (`userip`),
  KEY `no_route` (`no_route`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_api_accesses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_api_accesses`;

CREATE TABLE `prosystem_api_accesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_ccode` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ccode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apikey` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `statu` int(11) NOT NULL DEFAULT '1',
  `created_at` int(11) DEFAULT NULL,
  `hash` char(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `standart_key` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash_number` int(11) DEFAULT '0',
  `hash_limit` int(2) DEFAULT '3',
  `access_service_key` int(11) DEFAULT '1',
  `access_services` longtext COLLATE utf8_unicode_ci,
  `forbidden_access_services` longtext COLLATE utf8_unicode_ci,
  `api_coding_insert` int(2) DEFAULT '1',
  `api_coding_update` int(2) DEFAULT '1',
  `api_coding_delete` int(2) DEFAULT '1',
  `api_develop_url_filter` int(2) DEFAULT '0',
  `request` int(11) DEFAULT '1000',
  `request_number` int(11) DEFAULT '0',
  `all_request_number` int(11) DEFAULT '0',
  `service_request_number` longtext COLLATE utf8_unicode_ci,
  `all_service_request_number` longtext COLLATE utf8_unicode_ci,
  `request_type` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_api_accesses` WRITE;
/*!40000 ALTER TABLE `prosystem_api_accesses` DISABLE KEYS */;

INSERT INTO `prosystem_api_accesses` (`id`, `system_ccode`, `ccode`, `ip`, `apikey`, `statu`, `created_at`, `hash`, `standart_key`, `hash_number`, `hash_limit`, `access_service_key`, `access_services`, `forbidden_access_services`, `api_coding_insert`, `api_coding_update`, `api_coding_delete`, `api_develop_url_filter`, `request`, `request_number`, `all_request_number`, `service_request_number`, `all_service_request_number`, `request_type`)
VALUES
	(1,'devsde','guest','127.0.0.1','aligurbuz',1,1455191900,'da1fe50ffc1d5a7a357968c14e1d6787','7d40c8cdfa699c26138080090c09a678',1,3,1,NULL,NULL,1,1,1,1,1000,123,123,'{\"test\":87,\"admin\":20,\"getSameIpUsers\":1,\"api\":9,\"words\":1,\"mysql_slow\":1,\"default_roles\":1,\"logs\":3}','{\"test\":87,\"admin\":20,\"getSameIpUsers\":1,\"api\":9,\"words\":1,\"mysql_slow\":1,\"default_roles\":1,\"logs\":3}',1);

/*!40000 ALTER TABLE `prosystem_api_accesses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table prosystem_api_custom_models
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_api_custom_models`;

CREATE TABLE `prosystem_api_custom_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `custom_models` char(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `users` longtext COLLATE utf8_unicode_ci NOT NULL,
  `statu` int(2) DEFAULT '1',
  `created_at` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_api_custom_models` WRITE;
/*!40000 ALTER TABLE `prosystem_api_custom_models` DISABLE KEYS */;

INSERT INTO `prosystem_api_custom_models` (`id`, `custom_models`, `users`, `statu`, `created_at`)
VALUES
	(8,'getSameIpUsers','0',1,1453974971);

/*!40000 ALTER TABLE `prosystem_api_custom_models` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table prosystem_default_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_default_roles`;

CREATE TABLE `prosystem_default_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_number` int(14) DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci,
  `role_row` int(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_default_roles` WRITE;
/*!40000 ALTER TABLE `prosystem_default_roles` DISABLE KEYS */;

INSERT INTO `prosystem_default_roles` (`id`, `role_name`, `system_number`, `roles`, `role_row`)
VALUES
	(1,'developer',0,NULL,3),
	(2,'manager',1,'1@2@3@4@5@6@7@8@9@10@11@12@13',2),
	(3,'normal',2,'1@3',1);

/*!40000 ALTER TABLE `prosystem_default_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table prosystem_hotels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_hotels`;

CREATE TABLE `prosystem_hotels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_search_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` int(11) NOT NULL,
  `province` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `town` int(11) NOT NULL,
  `hotel_type` int(11) NOT NULL,
  `sea_distinct` double(8,2) NOT NULL,
  `sea_unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bus_distinct` double(8,2) NOT NULL,
  `bus_unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `airbus_distinct` double(8,2) NOT NULL,
  `airbus_unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_enable` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_description` text COLLATE utf8_unicode_ci NOT NULL,
  `hotel_tags` text COLLATE utf8_unicode_ci NOT NULL,
  `hotel_seo` text COLLATE utf8_unicode_ci NOT NULL,
  `hotel_properties` text COLLATE utf8_unicode_ci NOT NULL,
  `hotel_base_price_json` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_name` (`hotel_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_locations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_locations`;

CREATE TABLE `prosystem_locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `seo_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `statu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_mysql_slow_process_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_mysql_slow_process_logs`;

CREATE TABLE `prosystem_mysql_slow_process_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_path` text COLLATE utf8_unicode_ci NOT NULL,
  `query_log` text COLLATE utf8_unicode_ci,
  `query_bindings` text COLLATE utf8_unicode_ci,
  `query_time` double(8,2) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table prosystem_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_roles`;

CREATE TABLE `prosystem_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_define` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_info` text COLLATE utf8_unicode_ci NOT NULL,
  `role_layer` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auth_define` (`role_define`,`lang`,`status`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_roles` WRITE;
/*!40000 ALTER TABLE `prosystem_roles` DISABLE KEYS */;

INSERT INTO `prosystem_roles` (`id`, `role_define`, `role_info`, `role_layer`, `lang`, `created_at`, `updated_at`, `status`)
VALUES
	(1,'main','Kullanici anasayfadaki verileri gorebilsin mi?','page',1,0,0,1),
	(2,'users','Kullanici -kullanicilar bolumu- sayfasindaki verileri gorebilsin mi?','page',1,0,0,1),
	(3,'profile','Kullanici kendi profil sayfasini gorebilsin mi?','page',1,0,0,1),
	(4,'users','Kullanici -kullanicilar bolumu- sayfasinda yeni kullanıcı oluşturma sayfasini gorebilsin mi?','page',1,0,0,1),
	(5,'users','Kullanici -kullanicilar bolumu- sayfasinda yeni kullanıcı oluşturma sayfasinda yeni kullanici olusturma butonunu kullanabilsin mi ?','button',1,0,0,1),
	(6,'users','Yonetici bir baskasinin profilini goruntuleyebilsin mi?','page',1,0,0,1),
	(7,'users','Kullanici yeni kullanici olusturma bolumunde yeni kullanicinin rollerini degistirebilsin mi?','tab',1,0,0,1),
	(8,'profile','Kullanici bir baskasinin profilindeki kisisel bilgileri degistirebilsin mi? (yonetici yetkisine sahip olanlar icin)','button',1,0,0,1),
	(9,'profile','Yonetici kendi profilindeki yetkilerini duzenleyebilsin mi?','self',1,0,0,1),
	(10,'profile','Kullanici bir baskasinin profilinde sifre degisikligi yapabilsin mi? (yonetici yetkisine sahip olanlar icin)','button',1,0,0,1),
	(11,'profile','Kullanici bir baskasinin profilinde profil resmi degisikligi yapabilsin mi? (yonetici yetkisine sahip olanlar icin)','button',1,0,0,1),
	(12,'profile','Kullanici bir baskasinin profilinde yetki degisikligi yapabilsin mi? (yonetici yetkisine sahip olanlar icin)','button',1,0,0,1),
	(13,'api','Kullanici api merkezini gorebilsin mi?','page',1,0,0,1);

/*!40000 ALTER TABLE `prosystem_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table prosystem_words
# ------------------------------------------------------------

DROP TABLE IF EXISTS `prosystem_words`;

CREATE TABLE `prosystem_words` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `word_data` text COLLATE utf8_unicode_ci NOT NULL,
  `lang` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_path` (`url_path`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `prosystem_words` WRITE;
/*!40000 ALTER TABLE `prosystem_words` DISABLE KEYS */;

INSERT INTO `prosystem_words` (`id`, `url_path`, `word_data`, `lang`, `updated_at`)
VALUES
	(1,'login','{\"login_password\":\"\\u015eifreniz\",\"loginTop\":\"Panel Giri\\u015f Formu\",\"login_warning\":\"Herhangi bir kullan\\u0131c\\u0131 ad\\u0131 yada \\u015fifre girmediniz\",\"ccode\":\"Kullan\\u0131c\\u0131 Kodunuz\"}',1,1450861289),
	(2,'default','{\"username\":\"Kullan\\u0131c\\u0131 Ad\\u0131\",\"login\":\"Giri\\u015f\",\"remember\":\"Beni Hat\\u0131rla\",\"not\":\"De\\u011filim?\",\"approximately\":\"Yakla\\u015f\\u0131k\",\"second\":\"Saniye\",\"before\":\"\\u00d6nce\",\"minute\":\"Dakika\",\"hour\":\"Saat\",\"day\":\"G\\u00fcn\",\"month\":\"Ay\",\"year\":\"Y\\u0131l\",\"mainsearch\":\"Bir data aray\\u0131n\",\"dashboard\":\"\",\"dashboard_info\":\"\",\"lockscreen\":\"Kilit Ekran\\u0131\",\"logout\":\"\\u00c7\\u0131k\\u0131\\u015f Yap\",\"tasks\":\"G\\u00f6revlerim\",\"Profile\":\"Profilim\",\"save_changes\":\"De\\u011fi\\u015fiklikleri Kaydet\",\"validation_warning\":\"Bu alan\\u0131 bo\\u015f b\\u0131rakamazs\\u0131n\\u0131z\",\"warning\":\"Uyar\\u0131.\",\"error\":\"Hata Kayd\\u0131\",\"empty_warning\":\"Se\\u00e7ene\\u011fini Bo\\u015f G\\u00f6nderemezsiniz.L\\u00fctfen \\u0130lgili Alan\\u0131 Doldurunuz\",\"minchar_warning\":\"Se\\u00e7ene\\u011fi \\u0130\\u00e7in En Az 8 Karakter Bekleniyor\",\"summary\":\"\\u00d6zet Bilgi\",\"active\":\"Aktif\",\"passive\":\"Pasif\",\"log_false\":\"Config dosyas\\u0131nda log tutma kapat\\u0131lm\\u0131\\u015f.L\\u00fctfen sistem geli\\u015ftiricisine ba\\u015fvurunuz.\",\"user_capter_menu\":\"Y\\u00f6neticiler B\\u00f6l\\u00fcm\\u00fc\",\"developer\":\"Geli\\u015ftirici\",\"manager\":\"Y\\u00f6netici\",\"normal\":\"Normal\",\"user_status\":\"Kullan\\u0131c\\u0131 Stat\\u00fcs\\u00fc\",\"never_login_time\":\"Bu Kullan\\u0131c\\u0131 Hi\\u00e7 Login Olmad\\u0131\",\"online_statu\":\"Online Durumu\",\"system_auth\":\"Sistem Yetkisi\",\"profil\":\"Profil\",\"email\":\"Email\",\"hash\":\"Oturum \\u015eifresi\",\"fullname\":\"Ger\\u00e7ek \\u0130smi\",\"user_where\":\"Kullan\\u0131c\\u0131n\\u0131n Son Bulundu\\u011fu Yer\",\"browser_family\":\"Taray\\u0131c\\u0131\",\"hash_you\":\"Oturum Sahibi Sizsiniz\",\"api_center\":\"Api Merkezi\",\"formprocess\":\"Form \\u0130\\u015flemi\",\"route\":\"Rota\",\"logprocess\":\"Form Y\\u00f6ntemi\",\"date\":\"Tarih\",\"update_profile_manipulation\":\"Manipulation Yapt\\u0131n\\u0131z,Kendi grubunuz harici ki\\u015filere m\\u00fcdahale edemezsiniz\",\"noauth\":\"Yetkisiz B\\u00f6lgeye Giri\\u015f Yapt\\u0131n\\u0131z.Bu \\u00f6zelli\\u011fi kullanabilmeniz i\\u00e7in y\\u00f6neticinizle irtibata ge\\u00e7iniz\",\"statu\":\"Durum\",\"develop_no_role\":\"Geli\\u015ftirici rol\\u00fcndesiniz.Geli\\u015ftiricilerin hi\\u00e7 bir rol k\\u0131s\\u0131tlamas\\u0131 bulunmamaktad\\u0131r\",\"manipulation\":\"Manipulation i\\u015flemi yapt\\u0131n\\u0131z,sistem kayd\\u0131n\\u0131za manipulation kayd\\u0131 olarak girdik.L\\u00fctfen sistemin size sundu\\u011fu olanaklar\\u0131n d\\u0131\\u015f\\u0131na \\u00e7\\u0131kmay\\u0131n\",\"success_point\":\"Ba\\u015far\\u0131 Puan\\u0131\",\"token_invalid\":\"Bir sayfada bir i\\u015flemi sadece ayn\\u0131 token ile yapabilirsiniz.\",\"activities_chart\":\"\",\"chart1\":\"\",\"chart\":\"\",\"linechart\":\"\",\"more\":\"Daha fazla bilgi ve y\\u00f6netim i\\u00e7in\",\"contact\":\"Sistem geli\\u015ftiricinize ba\\u015fvurunuz\",\"ccode\":\"Sistem Kodu\",\"process\":\"\\u0130\\u015flem\",\"edit\":\"D\\u00fczenle\",\"access_all_services_info\":\"T\\u00fcm servislere eri\\u015febilir\",\"successful\":\"Post \\u0130\\u015flem Sonucu\",\"warning_info\":\"Bir hata meydana geldi,k\\u0131sa s\\u00fcre i\\u00e7inde tekrar deneyiniz\"}',1,1455198396),
	(3,'lockScreen','{\"info\":\"Hesap Kilitli\",\"not\":\"De\\u011fil misin?\"}',1,1447765078),
	(4,'home','{\"mainsearch\":\"Bir data aray\\u0131n\",\"dashboard\":\"Anasayfa - Genel \\u0130statistikler\",\"dashboard_info\":\"Sisteminizdeki genel istatistiklerin bulundu\\u011fu b\\u00f6l\\u00fcmdesiniz...\"}',1,1447683519),
	(7,'test','{\"dashboard\":\"Test Sayfas\\u0131\",\"dashboard_info\":\"Test Sayfas\\u0131 Olu\\u015fturuldu\"}',1,1448369582),
	(8,'foo','{\"dashboard\":\"Test Sayfas\\u0131\",\"dashboard_info\":\"Test Sayfas\\u0131 Olu\\u015fturuldu\"}',1,1448371080),
	(9,'profile','{\"dashboard\":\"Profil Sayfas\\u0131\",\"dashboard_info\":\"Profil Sayfas\\u0131 (Ki\\u015fisel Ayarlar Merkezi)\",\"profile_tab1\":\"Profil Bilgisi\",\"profile_tab2\":\"Hesab\\u0131m\",\"profile_tab3\":\"Yetkiler\",\"profile_tab4\":\"G\\u00f6revler\",\"personal_info\":\"Ki\\u015fisel Bilgiler\",\"profil_picture\":\"Profil Resmi\",\"change_password\":\"\\u015eifre De\\u011fi\\u015ftir\",\"private_settings\":\"\\u00d6zel Ayarlar\",\"username\":\"Ad\\u0131n\\u0131z Soyad\\u0131n\\u0131z\",\"company_code\":\"Sistem Kodu\",\"notchange\":\"De\\u011fi\\u015ftirilemez\",\"mobilphone\":\"Telefon Numaras\\u0131\",\"login_name\":\"Kullan\\u0131c\\u0131 Ad\\u0131\",\"address\":\"\\u0130kamet Adresi\",\"occupation\":\"Meslek\",\"about\":\"Hakk\\u0131nda\",\"website\":\"Website\",\"username_info\":\"Bu alan login giri\\u015fi i\\u00e7in kullan\\u0131lacak kullan\\u0131c\\u0131 ismidir.\",\"new_password\":\"Yeni \\u015eifreniz.\",\"renew_password\":\"Yeni \\u015eifrenizi Tekrar Yaz\\u0131n\\u0131z.\",\"profil_field_top_info\":\"Bu alanda profil fotonuzu g\\u00f6rebilir ve yenisini ekleyebilirsiniz.Profil fotonuz sistemdeki tek fotonuzdur\",\"pick_picture\":\"Bir resim se\\u00e7in.\",\"warning_profil_picture_size\":\"L\\u00fctfen b\\u00fcy\\u00fck resimler y\\u00fcklemeye \\u00f6zen g\\u00f6steriniz.\",\"change_password_msg_success\":\"\\u015eifreniz Ba\\u015far\\u0131 \\u0130le De\\u011fi\\u015ftirildi\",\"change_password_title_success\":\"\\u015eifre De\\u011fi\\u015fikli\\u011fi\",\"change_password_not_same_warning_msg\":\"Girilen \\u015eifreler Uyumlu G\\u00f6r\\u00fcnm\\u00fcyor.L\\u00fctfen Ayn\\u0131 \\u015eifre Yaz\\u0131n\\u0131z\",\"change_password_not_same_warning_title\":\"\\u015eifre Hatas\\u0131\",\"update_profile_msg_success\":\"Profil bilgilerinizi ba\\u015far\\u0131 ile de\\u011fi\\u015ftirdiniz.\",\"update_profile_title_success\":\"Profil Bilgi De\\u011fi\\u015fikli\\u011fi\",\"update_profile_msg_warning\":\"G\\u00fcncelleme i\\u00e7in herhangi bir de\\u011fi\\u015fiklik alg\\u0131layamad\\u0131k\",\"update_profile_title_warning\":\"G\\u00fcncelleme Hatas\\u0131\",\"file_upload_msg_success\":\"Profil resminizi ba\\u015far\\u0131 ile de\\u011fi\\u015ftirdiniz.\",\"file_upload_title_success\":\"Profil Resim De\\u011fi\\u015fikli\\u011fi\",\"file_upload_msg_warning\":\"Profil resminizi de\\u011fi\\u015ftiremedik l\\u00fctfen tekrar deneyiniz.\",\"file_upload_title_warning\":\"Profil Resim De\\u011fi\\u015fikli\\u011fi Hatas\\u0131\",\"file_upload_false_msg_warning\":\"Profil resminizi de\\u011fi\\u015ftiremedik l\\u00fctfen tekrar deneyiniz.Dosya y\\u00fcklenmedi,izinlerinizi kontrol ediniz\",\"file_upload_false_title_warning\":\"Profil Resim De\\u011fi\\u015fikli\\u011fi Hatas\\u0131\",\"online_statu\":\"Online Durumu\",\"last_login\":\"Son Login\",\"member_date\":\"\\u00dcyelik Tarihi\",\"user_where\":\"Bulundu\\u011fu Yer\",\"last_ip\":\"Son Ip\",\"admin_last_actions\":\"Son Hareketler\",\"mail\":\"Mail Adresiniz\",\"profile_roles_auth_info\":\"Sistem yetkilerinize sadece y\\u00f6neticileriniz ve geli\\u015ftiriciler m\\u00fcdahale edebilir,normal kullan\\u0131c\\u0131n\\u0131n yetkilere m\\u00fcdahale etmesi m\\u00fcmk\\u00fcn de\\u011fildir.\",\"profile_auth_list\":\"Yetki Listeniz\",\"page_role_define\":\"Sayfa Rol Tan\\u0131m\\u0131\",\"role_explain\":\"Rol A\\u00e7\\u0131klamas\\u0131\",\"role_layer\":\"Rol Katman\\u0131\",\"profile_role_msg_success\":\"Kullan\\u0131c\\u0131 yetkileri ba\\u015far\\u0131 ile d\\u00fczenlendi\",\"profile_role_title_success\":\"Yetki D\\u00fczenleme \\u0130\\u015flemi\",\"profile_role_msg_warning\":\"Kullan\\u0131c\\u0131 i\\u00e7in yetkileri g\\u00fcncellemede bir problem meydana geldi\",\"profil_false_route\":\"Alan\\u0131n\\u0131z d\\u0131\\u015f\\u0131ndaki profil bilgisine giri\\u015f yapmaya \\u00e7al\\u0131\\u015f\\u0131yorsunuz.\",\"profil_no_user\":\"B\\u00f6yle bir kullan\\u0131c\\u0131 mevcut de\\u011fil.L\\u00fctfen manipulation yapmadan sistemi kullan\\u0131n\\u0131z\"}',1,1453994883),
	(10,'users','{\"dashboard\":\"Kullan\\u0131c\\u0131 Listeleri\",\"dashboard_info\":\"Kullan\\u0131c\\u0131 Listeleri sayfas\\u0131nda,kendi alan\\u0131n\\u0131za ait t\\u00fcm kullan\\u0131c\\u0131lar\\u0131 g\\u00f6rebilir ve bunlar\\u0131 y\\u00f6netebilirsiniz.\",\"defined_all_users\":\"Alan\\u0131n\\u0131zdaki T\\u00fcm Kullan\\u0131c\\u0131lar\\u0131n Listesi\",\"user_general_infos\":\"Kullan\\u0131c\\u0131 Genel Bilgileri\",\"user_roles\":\"Kullan\\u0131c\\u0131 Yetkileri\",\"create_new_user\":\"Yeni Kullan\\u0131c\\u0131n\\u0131z\\u0131 Olu\\u015fturmaya Ba\\u015flay\\u0131n\",\"form_new_user\":\"Yeni Kullan\\u0131c\\u0131 Formu\",\"attention_while_new_user_create\":\"Kullan\\u0131c\\u0131 Olu\\u015ftururken Dikkat Etmeniz Gerekenler\",\"new_user_create_rules\":\"Yeni kullan\\u0131c\\u0131n\\u0131z\\u0131 olu\\u015ftururken ccode diye tabir edilen sistem kodunu mutlaka\\n        belirtmelisiniz,kullan\\u0131c\\u0131n\\u0131z\\u0131n login name,password ve tam ismi bo\\u015f ge\\u00e7ilemeyecek zorunlu aland\\u0131r,yetkilendirmede varsay\\u0131lan olarak normal kullan\\u0131c\\u0131 ozellikleri gelir,\\n        siz kullan\\u0131c\\u0131n\\u0131z\\u0131 kendi insiyatifinizde stat\\u00fclendirebilirsiniz.\",\"new_user_ccode\":\"Kullan\\u0131c\\u0131 Sistem Kodu\",\"new_user_login_name\":\"Kullan\\u0131c\\u0131 Login \\u0130smi\",\"new_user_login_password\":\"Kullan\\u0131c\\u0131 Login \\u015eifresi\",\"new_user_email\":\"Kullan\\u0131c\\u0131 Email Adresi\",\"new_user_fullname\":\"Kullan\\u0131c\\u0131 Ger\\u00e7ek \\u0130smi\",\"new_user_phone_number\":\"Kullan\\u0131c\\u0131 Telefonu\",\"new_user_status\":\"Kullan\\u0131c\\u0131 Stat\\u00fcs\\u00fc\",\"new_user_post_true\":\"Yeni Kullan\\u0131c\\u0131 Ba\\u015far\\u0131 \\u0130le Olu\\u015fturuldu\",\"new_user_post_header\":\"Yeni Kullan\\u0131c\\u0131 Olu\\u015fturma Bilgisi\",\"new_user_post_false\":\"Yeni Kullan\\u0131c\\u0131 Olu\\u015fturulamad\\u0131.Sistemlerimizde Bir Hata Meydana Geldi.L\\u00fctfen Daha Sonra Tekrar Deneyiniz\",\"user_roles_capter\":\"Kullan\\u0131c\\u0131 Yetkileri B\\u00f6l\\u00fcm\\u00fc\",\"user_page_role_define\":\"Sayfa Rol Tan\\u0131m\\u0131\",\"user_page_role_explain\":\"Rol A\\u00e7\\u0131klamas\\u0131\",\"user_page_role_layer\":\"Rol Katman\\u0131\",\"user_page_role_assign\":\"Atama\",\"last_login_ip\":\"Son Giri\\u015f \\u0130p\",\"users_created_date\":\"Kullan\\u0131c\\u0131 Olu\\u015fturulma Tarihi\",\"user_lang\":\"Kullan\\u0131c\\u0131 Dili\",\"user_phone\":\"Kullan\\u0131c\\u0131 Telefonu\",\"last_login_time\":\"Son Giri\\u015f Zaman\\u0131\",\"last_logout_time\":\"Son \\u00c7\\u0131k\\u0131\\u015f Zaman\\u0131\",\"created_by\":\"Olu\\u015fturan Ki\\u015fi\",\"device\":\"Ayg\\u0131t\",\"user_where_time\":\"Son Sayfa Zaman\\u0131\",\"user_hash_terminated\":\"Kullan\\u0131c\\u0131n\\u0131n Oturumu Sonland\\u0131r\\u0131ld\\u0131\",\"all_admin_clickeds\":\"T\\u00fcm T\\u0131klamalar\",\"hash_admin_clickeds\":\"Oturum T\\u0131klamalar\\u0131\",\"all_admin_operations\":\"T\\u00fcm \\u0130\\u015flemler\",\"success_admin_operations\":\"Ba\\u015far\\u0131l\\u0131 Post \\u0130\\u015flemleri\",\"fail_admin_operations\":\"Ba\\u015far\\u0131s\\u0131z Post \\u0130\\u015flemleri\",\"noauth_area_operations\":\"Yetkisiz Eri\\u015fimler\",\"manipulation\":\"Manipulation Giri\\u015fimler\",\"new_user_create\":\"Yeni Kullan\\u0131c\\u0131 Olu\\u015ftur\",\"$fail_admin_operations\":\"Ba\\u015far\\u0131s\\u0131z Post \\u0130\\u015flemleri\",\"$noauth_area_operations\":\"Yetkisiz Eri\\u015fimler\",\"all_time_spent\":\"Panelde T\\u00fcm Harcanan S\\u00fcre\",\"hash_time_spent\":\"Oturumda Harcanan S\\u00fcre\",\"all_average_time_spent_for_every_hash\":\"T\\u00fcm Oturumlar Genel Zaman Averaj\\u0131\",\"all_hash_number\":\"T\\u00fcm Oturum Say\\u0131s\\u0131\",\"first_hash_time\":\"\\u0130lk Login Zaman\\u0131\"}',1,1454330223),
	(11,'api','{\"dashboard\":\"Api Servis Merkezi\",\"dashboard_info\":\"Api Servis Merkezi - outsource json data\",\"api_top_info\":\"Api merkezinde sistem datalar\\u0131n\\u0131z\\u0131 outsource yapabilir ve bunlar\\u0131 y\\u00f6netebilirsiniz.Api servis kayna\\u011f\\u0131 default olarak json data sa\\u011flamaktad\\u0131r.Siz bu kaynaklar\\u0131 d\\u0131\\u015f paket\\n          y\\u00f6netimi vas\\u0131tas\\u0131yla outsource edebilir ve sisteminizi kullanan ba\\u011f\\u0131ml\\u0131 kullan\\u0131c\\u0131lar\\u0131 d\\u00fczenleyebilirsiniz.Api olu\\u015fturaca\\u011f\\u0131n\\u0131z sistem kullan\\u0131c\\u0131lar\\u0131,developer,coding ve quest mod\\n          olmak \\u00fczere 3 e ayr\\u0131lmaktad\\u0131r.Outsource yapaca\\u011f\\u0131n\\u0131z d\\u0131\\u015f kullan\\u0131c\\u0131lar\\u0131n\\u0131z quest modda datalar\\u0131n\\u0131z\\u0131 g\\u00f6r\\u00fcnt\\u00fcleyebilmektedir.\",\"api_top_info1\":\"Data g\\u00fcvenli\\u011fi ve loglama\",\"api_top_info2\":\"Data g\\u00fcvenli\\u011fi outsource sa\\u011flanan kullan\\u0131c\\u0131lar\\u0131n\\u0131z i\\u00e7in belirlenen header paketleriyle\\n          sa\\u011flanman\\u0131n yan\\u0131 s\\u0131ra ba\\u011f\\u0131ml\\u0131 kullan\\u0131c\\u0131lar\\u0131n\\u0131za static ip ve \\u015fifre talebi gerekmektedir.Bu \\u015fartlar\\u0131n sa\\u011flanmamas\\u0131 apinin hi\\u00e7 bir \\u015fekilde cevap vermemesine (response send)\\n          sebep olmaktad\\u0131r.B\\u00fct\\u00fcn api eri\\u015fimleri en detayl\\u0131 bir \\u015fekilde sistemde loglanmaktad\\u0131r.\",\"api_table_info\":\"Api Sa\\u011flanan Kullan\\u0131c\\u0131lar\",\"api_group\":\"Api Grubu\",\"daily_hash_number\":\"G\\u00fcnl\\u00fck Oturum Say\\u0131s\\u0131\",\"daily_hash_limit\":\"G\\u00fcnl\\u00fck Oturum Limiti\",\"access_services\":\"Eri\\u015fim Servisleri\",\"api_edit_page_title\":\"Api Kullan\\u0131c\\u0131 D\\u00fczenleme Sayfas\\u0131\",\"api_edit_page_info\":\"Api kullan\\u0131c\\u0131s\\u0131n\\u0131n t\\u00fcm api bilgilerini bu sayfada g\\u00f6rebilir ve d\\u00fczenleyebilirsiniz.\",\"api_user_info\":\"Api Kullan\\u0131c\\u0131s\\u0131 Bilgileri\",\"api_static_ip_info\":\"Kullan\\u0131c\\u0131n\\u0131n static ipsi,quest mode i\\u00e7in \\u015fartt\\u0131r\",\"api_static_ip_warning\":\"Develop mode i\\u00e7in static ip \\u015fart\\u0131 aranmaz\",\"api_api_key_info\":\"Apiye eri\\u015fim i\\u00e7in connector name olarak atan\\u0131r.Mecburidir\",\"api_hash_number_info\":\"G\\u00fcnl\\u00fck oturum say\\u0131s\\u0131,kullan\\u0131c\\u0131n\\u0131n oturum limiti kadar servisten hash alabilme olana\\u011f\\u0131n\\u0131 sunar\",\"api_hash_limit_info\":\"Api eri\\u015fimi sa\\u011flayan kullan\\u0131c\\u0131n\\u0131n g\\u00fcnl\\u00fck hash alabilme limiti bu limitle s\\u0131n\\u0131rl\\u0131d\\u0131r\",\"access_services_info\":\"Kullan\\u0131c\\u0131 belirtilen servislere eri\\u015fim yapabilir,se\\u00e7ilmi\\u015f servislerin d\\u0131\\u015f\\u0131na eri\\u015fim yapamaz\",\"insert_mode_info\":\"Kullan\\u0131c\\u0131 coding modeda insert i\\u015flemlerinde yetkili olup olmad\\u0131g\\u0131n\\u0131 tayin eder\",\"update_mode_info\":\"Kullan\\u0131c\\u0131 coding modeda update i\\u015flemlerinde yetkili olup olmad\\u0131g\\u0131n\\u0131 tayin eder\",\"delete_mode_info\":\"Kullan\\u0131c\\u0131 coding modeda delete i\\u015flemlerinde yetkili olup olmad\\u0131g\\u0131n\\u0131 tayin eder\",\"api_update_user\":\"Api Kullan\\u0131c\\u0131s\\u0131n\\u0131n Api Bilgileri Ba\\u015far\\u0131 \\u0130le D\\u00fczenlendi\",\"api_mode_info\":\"Develop modedaki kullan\\u0131c\\u0131 coding yapabilir,quest mode sadece eri\\u015fim yapabilir\",\"api_mode_warning\":\"Guest mode i\\u00e7in static ip aran\\u0131r.\",\"filter_mode_info\":\"Servis i\\u00e7in filtreleme y\\u00f6nteminin kullan\\u0131l\\u0131p kullan\\u0131lmad\\u0131\\u011f\\u0131n\\u0131 ifade eden anahtard\\u0131r\",\"daily_request_limit\":\"Servis G\\u00fcnl\\u00fck \\u0130stek Limiti\",\"api_request_limit_info\":\"Servis g\\u00fcnl\\u00fck istek say\\u0131s\\u0131,kullan\\u0131c\\u0131n\\u0131n servise att\\u0131\\u011f\\u0131 g\\u00fcnl\\u00fck request miktar\\u0131d\\u0131r,bu limiti ge\\u00e7en kullan\\u0131c\\u0131lar\\u0131n g\\u00fcnl\\u00fck servis eri\\u015fimi kapan\\u0131r\",\"daily_request_limit_number\":\"Servis G\\u00fcnl\\u00fck \\u0130stek Say\\u0131s\\u0131\",\"forbidden_access_services\":\"Yasakl\\u0131 Eri\\u015fim Servisleri\",\"forbidden_access_services_info\":\"Api kullan\\u0131c\\u0131s\\u0131 burada belirtilen servislere asla eri\\u015femez\",\"api_request_type_limit_info\":\"Tek Service yada t\\u00fcm\\u00fc i\\u00e7in limit ko\\u015fulu\",\"one_service\":\"Tek Servis \\u0130\\u00e7in\",\"all_total_service\":\"T\\u00fcm Servisler Toplam\\u0131 \\u0130\\u00e7in\",\"service_request_type\":\"Servis \\u0130stek \\u015eart\\u0131\"}',1,1455201651);

/*!40000 ALTER TABLE `prosystem_words` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
