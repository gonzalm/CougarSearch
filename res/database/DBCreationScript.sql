CREATE DATABASE  IF NOT EXISTS `cougar_search` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cougar_search`;
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: cougar_search
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `admin` (
  `username` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dog_listings`
--

DROP TABLE IF EXISTS `dog_listings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `dog_listings` (
  `listingID` int(11) NOT NULL AUTO_INCREMENT,
  `dogName` varchar(45) NOT NULL,
  `gender` varchar(12) NOT NULL,
  `dogDesc` varchar(120) NOT NULL,
  `breed` varchar(45) NOT NULL,
  `age` int(11) NOT NULL,
  `datePosted` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `picture` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`listingID`),
  UNIQUE KEY `listingID_UNIQUE` (`listingID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dog_listings`
--

LOCK TABLES `dog_listings` WRITE;
/*!40000 ALTER TABLE `dog_listings` DISABLE KEYS */;
INSERT INTO `dog_listings` VALUES (2,'Hank','Male','Brown 6 year old boxer','Boxer',6,'2019-04-20 00:00:00',1,'2.jpg'),(4,'Daisy','Female','white 8 year old west highland terrier','Terrier',8,'2019-04-20 00:00:00',2,'4.jpg'),(5,'Bailey','Female','brown and black 5 ear old yorkshire terrier','Yorkshire Terrier',5,'2019-04-20 00:00:00',3,'5.jpg'),(7,'Duncan','Male','white 10 year old west highland terrier','Terrier',10,'2019-04-20 00:00:00',1,'7.jpg'),(9,'Bailey','Female','brown and black 5 ear old yorkshire terrier','Yorkshire Terrier',5,'2019-04-20 00:00:00',3,'9.jpg'),(10,'Bruce','Male','white 2 year old pug','Pug',2,'2019-04-20 00:00:00',6,'10.jpg'),(11,'Macy','Female','white 3 year old Labrador, trained as an emotional support animal','Labrador',3,'2019-04-20 00:00:00',5,'11.jpg'),(12,'Ricky','Male','white 7 year old Chiuaua with napoleanic syndrome','Chihuaua',7,'2019-04-20 00:00:00',1,'12.jpg'),(13,'Hotrod','Male','black 1 year old Great Dane,  6\'4 240lbs','Great Dane',1,'2019-04-20 00:00:00',2,'13.png');
/*!40000 ALTER TABLE `dog_listings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `moderator` (
  `username` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator`
--

LOCK TABLES `moderator` WRITE;
/*!40000 ALTER TABLE `moderator` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phonenumber` varchar(13) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `userID_UNIQUE` (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jarvisjl','jarvis30','jarvis@miamioh.edu','740-610-5933'),(2,'bobbyb','bi7182','billy@yahoo.com','553-412-2638'),(3,'sheltercc','lovedogs','shel@gmail.com','552-718-1829'),(4,'jamesl','jim301','jimmy@miamioh.edu','740-620-5934'),(5,'bricyb','bi7182','bob@yahoo.com','553-482-2838'),(6,'sheltrw','hatedogs','swel@gmail.com','552-738-1839'),(7,'','','','5555555555');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cougar_search'
--
/*!50003 DROP PROCEDURE IF EXISTS `spAddListing` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spAddListing`(
		IN dogName varchar(25),
		IN gender VARCHAR(6),
		IN dogDesc varchar(120),
		IN breed VARCHAR(20),
		IN age INT,
		IN userID varChar(25),
        IN picture varChar(25) )
BEGIN
	INSERT INTO dog_listings
    (	dogName,
		gender,
		dogDesc,
        breed,
        age,
        datePosted,
        userID,
        picture)
    VALUES
    (	dogName,
		gender,
		dogDesc,
        breed,
        age,
        CURDATE(),
        userID,
        picture);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spRemoveListing` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spRemoveListing`( 
IN userID VARCHAR(25),
IN dogName VARCHAR(45)
)
BEGIN
	DELETE FROM dog_listings
    WHERE dog_listings.userID = userID AND dog_listing.dogName = dogName;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `spViewAllListings` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `spViewAllListings`()
BEGIN
	SELECT * FROM dog_listings;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-29 14:58:02
