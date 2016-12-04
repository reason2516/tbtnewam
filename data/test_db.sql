CREATE DATABASE  IF NOT EXISTS `testdb` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `testdb`;
-- MySQL dump 10.13  Distrib 5.5.53, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: testdb
-- ------------------------------------------------------
-- Server version	5.5.53-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `am_admin`
--

DROP TABLE IF EXISTS `am_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '用户名',
  `password` char(40) COLLATE utf8_bin NOT NULL COMMENT '密码',
  `salt` char(4) COLLATE utf8_bin NOT NULL COMMENT '密码盐值',
  `realname` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `last_login_time` datetime NOT NULL COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_admin`
--

LOCK TABLES `am_admin` WRITE;
/*!40000 ALTER TABLE `am_admin` DISABLE KEYS */;
INSERT INTO `am_admin` VALUES (1,'admin','af60e5ff3ef25430177599c5f039e35ecd6f82a3','1q2q','王明旭','2016-12-26 12:00:00');
/*!40000 ALTER TABLE `am_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_member`
--

DROP TABLE IF EXISTS `am_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `realname` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '员工姓名',
  `job_number` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '工号',
  `phonenumber` varchar(11) COLLATE utf8_bin NOT NULL COMMENT '手机号码',
  `status` int(3) unsigned NOT NULL DEFAULT '1' COMMENT '账户状态： 1正常 2暂停 11删除 12彻底删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_number_UNIQUE` (`job_number`),
  UNIQUE KEY `phonenumber_UNIQUE` (`phonenumber`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_member`
--

LOCK TABLES `am_member` WRITE;
/*!40000 ALTER TABLE `am_member` DISABLE KEYS */;
INSERT INTO `am_member` VALUES (1,'王明旭1','0001','18810498066',11),(2,'李鑫','0002','18809010901',11),(3,'李兴国','0003','18812312312',11);
/*!40000 ALTER TABLE `am_member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-05  1:02:19
