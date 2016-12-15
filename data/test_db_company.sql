-- MySQL dump 10.13  Distrib 5.6.19, for osx10.9 (x86_64)
--
-- Host: localhost    Database: testdb
-- ------------------------------------------------------
-- Server version	5.6.25

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
INSERT INTO `am_admin` VALUES (1,'admin','af60e5ff3ef25430177599c5f039e35ecd6f82a3','1q2q','王明旭','2016-12-14 18:36:56');
/*!40000 ALTER TABLE `am_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_lottery`
--

DROP TABLE IF EXISTS `am_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_lottery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT '名称',
  `time_start` datetime NOT NULL COMMENT '开始时间',
  `time_end` datetime NOT NULL COMMENT '结束时间',
  `ctime` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='抽奖活动';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_lottery`
--

LOCK TABLES `am_lottery` WRITE;
/*!40000 ALTER TABLE `am_lottery` DISABLE KEYS */;
INSERT INTO `am_lottery` VALUES (1,'测试抽奖活动01','2016-12-14 18:38:19','2016-12-22 18:00:00','2016-12-14 15:58:19');
/*!40000 ALTER TABLE `am_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_lottery_item`
--

DROP TABLE IF EXISTS `am_lottery_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_lottery_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `name` varchar(40) COLLATE utf8_bin NOT NULL COMMENT '奖项名称',
  `lottery_id` int(10) unsigned NOT NULL COMMENT '归属抽奖活动id',
  `total` int(4) unsigned NOT NULL COMMENT '数量',
  `sort` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='奖项';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_lottery_item`
--

LOCK TABLES `am_lottery_item` WRITE;
/*!40000 ALTER TABLE `am_lottery_item` DISABLE KEYS */;
INSERT INTO `am_lottery_item` VALUES (1,'特等奖',1,1,0),(2,'一等奖',1,3,1),(3,'二等奖',1,5,2);
/*!40000 ALTER TABLE `am_lottery_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `am_lottery_result`
--

DROP TABLE IF EXISTS `am_lottery_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `am_lottery_result` (
  `member_id` int(10) unsigned NOT NULL COMMENT '成员id',
  `lottery_item_id` int(10) unsigned NOT NULL COMMENT '奖项id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='抽奖结果';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_lottery_result`
--

LOCK TABLES `am_lottery_result` WRITE;
/*!40000 ALTER TABLE `am_lottery_result` DISABLE KEYS */;
/*!40000 ALTER TABLE `am_lottery_result` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `am_member`
--

LOCK TABLES `am_member` WRITE;
/*!40000 ALTER TABLE `am_member` DISABLE KEYS */;
INSERT INTO `am_member` VALUES (1,'王明旭','0001','18810498066',1),(2,'李鑫','0002','18809010901',1),(3,'李兴国','0003','18812312312',1),(4,'郭晓丽','0005','18813123131',1);
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

-- Dump completed on 2016-12-15 13:50:55
