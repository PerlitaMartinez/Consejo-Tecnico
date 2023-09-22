-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: consejo_consultivo_data
-- ------------------------------------------------------
-- Server version	8.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `solicitud_materia_unica`
--

DROP TABLE IF EXISTS `solicitud_materia_unica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud_materia_unica` (
  `id_solicitud_mu` bigint NOT NULL AUTO_INCREMENT,
  `fecha_solicitud` datetime DEFAULT NULL,
  `semestre` varchar(15) DEFAULT NULL,
  `fecha_impresion` datetime DEFAULT NULL,
  `fecha_hora_tutor` datetime DEFAULT NULL,
  `estado_solicitud` varchar(15) DEFAULT NULL,
  `clave_unica` bigint DEFAULT NULL,
  `rpe_tutor` bigint DEFAULT NULL,
  `rpe_staff` bigint DEFAULT NULL,
  `id_sesion_hctc` bigint DEFAULT NULL,
  `clave_materia` char(6) DEFAULT NULL,
  PRIMARY KEY (`id_solicitud_mu`),
  KEY `id_sesion_hctc_idx` (`id_sesion_hctc`),
  CONSTRAINT `id_sesion_hctc` FOREIGN KEY (`id_sesion_hctc`) REFERENCES `sesion_hctc` (`id_sesion_hctc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_materia_unica`
--

LOCK TABLES `solicitud_materia_unica` WRITE;
/*!40000 ALTER TABLE `solicitud_materia_unica` DISABLE KEYS */;
/*!40000 ALTER TABLE `solicitud_materia_unica` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-21 21:15:13
