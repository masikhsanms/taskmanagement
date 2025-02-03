-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: taskmanagement
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `datatask`
--

DROP TABLE IF EXISTS `datatask`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `datatask` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) DEFAULT NULL,
  `deskripsi` text,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tanggaltempo` date DEFAULT NULL,
  `file_ID` int DEFAULT NULL,
  `user_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `datatask`
--

LOCK TABLES `datatask` WRITE;
/*!40000 ALTER TABLE `datatask` DISABLE KEYS */;
INSERT INTO `datatask` VALUES (24,'Test Lagi oke','Oke Mantap','In Progress','2025-02-02 09:10:45','2025-02-03 02:52:12','2025-01-02',NULL,2),(26,'Coba Test Lagi 17','17 Oke Mantap','Pending','2025-02-02 09:29:12','2025-02-02 23:41:02','2025-01-02',17,17);
/*!40000 ALTER TABLE `datatask` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lampiran`
--

DROP TABLE IF EXISTS `lampiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lampiran` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `task_ID` int DEFAULT NULL,
  `nama_file` text,
  `url_file` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lampiran`
--

LOCK TABLES `lampiran` WRITE;
/*!40000 ALTER TABLE `lampiran` DISABLE KEYS */;
INSERT INTO `lampiran` VALUES (17,26,'okes.png','http://test.com/okes.png');
/*!40000 ALTER TABLE `lampiran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` longtext,
  `nama` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'mansur','mansur@mail.com','$2y$10$CF3jV7ng/E2hp4yC50o6DOezTtnOzEh.x97bu81OlAxtzFVv7fUtG','Mansur','2025-01-30 11:16:56','2025-01-30 11:16:56'),(16,'userbaruikhsan','user@example.com','$2y$10$eltUysNuDPjYN6nSm6qSu.0d2aQdD7tZSOJ3H0kdQcPSUFL0YO2Lq','Ikhsan User','2025-02-02 05:06:29','2025-02-02 05:06:29'),(17,'testuserAPI','api@example.com','$2y$10$ZVQZeLB8boCWCLwKbDQFGePcNeXPjaN6Iu4uT1y.MAaBuiEl0bRYi','API User','2025-02-02 05:50:10','2025-02-02 05:50:10'),(18,'ikhsanms','ikhsan@mail.com','$2y$10$ccf70GdyJ8AnwH0msIXh7.nFjKuddxpesTV0ynZNMzmCLOjU5tr8C','ikhsan','2025-02-03 02:39:27','2025-02-03 02:39:27');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'taskmanagement'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-03 10:01:07
