-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: sistema_reservas
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Juan Pérez','juanperez@gmail.com','123456789'),(2,'Ana Gómez','anagomez@gmail.com','987654321'),(3,'Lucía Fernández','lucia.fernandez@email.com','555321654'),(4,'Martín Pérez','martin.perez@email.com','555654987'),(5,'Sofía García','sofia.garcia@email.com','555987321'),(6,'Diego Rodríguez','diego.rodriguez@email.com','555741258'),(7,'Raúl Gómez','raul.gomez@email.com','555852369'),(8,'Laura Martínez','laura.martinez@email.com','555963741'),(9,'Andrés López','andres.lopez@email.com','555147258'),(10,'Carmen Sánchez','carmen.sanchez@email.com','555258369'),(11,'Miguel Torres','miguel.torres@email.com','555369147'),(12,'Ana Ruiz','ana.ruiz@email.com','555471258'),(13,'José Díaz','jose.diaz@email.com','555582369'),(14,'Isabel Pérez','isabel.perez@email.com','555693471'),(15,'Tomás Martínez','tomas.martinez@email.com','555804572'),(16,'Patricia Gómez','patricia.gomez@email.com','555915684'),(17,'Antonio García','antonio.garcia@email.com','555026795'),(18,'Rosa Hernández','rosa.hernandez@email.com','555137806'),(19,'Carlos Jiménez','carlos.jimenez@email.com','555248917'),(20,'Elena Fernández','elena.fernandez@email.com','555359028');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disponibilidad`
--

DROP TABLE IF EXISTS `disponibilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `disponibilidad` (
  `id_disponibilidad` int(11) NOT NULL AUTO_INCREMENT,
  `id_sede` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `personas_reservadas` int(11) NOT NULL,
  PRIMARY KEY (`id_disponibilidad`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `disponibilidad_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disponibilidad`
--

LOCK TABLES `disponibilidad` WRITE;
/*!40000 ALTER TABLE `disponibilidad` DISABLE KEYS */;
/*!40000 ALTER TABLE `disponibilidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `num_acompanantes` int(11) NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_sede` (`id_sede`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_sede`) REFERENCES `sedes` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (2,1,1,'2024-11-11','13:39:00',3),(3,3,1,'2024-11-28','11:00:00',3),(4,4,1,'2024-11-28','13:00:00',2),(5,5,1,'2024-11-28','15:00:00',1),(6,6,1,'2024-11-28','17:00:00',4),(7,7,1,'2024-11-28','19:00:00',3),(8,8,1,'2024-11-28','11:30:00',2),(9,9,1,'2024-11-28','14:30:00',5),(10,10,1,'2024-11-28','16:00:00',1),(11,11,1,'2024-11-28','18:30:00',2),(12,12,1,'2024-11-28','12:00:00',3),(13,13,1,'2024-11-28','14:00:00',4),(14,14,1,'2024-11-28','16:30:00',2),(15,15,1,'2024-11-28','18:00:00',3),(16,16,1,'2024-11-28','11:45:00',1),(17,17,1,'2024-11-28','13:30:00',2),(18,18,1,'2024-11-28','15:30:00',4),(19,19,1,'2024-11-28','17:30:00',3),(20,20,1,'2024-11-28','19:30:00',2),(21,4,2,'2024-11-28','13:00:00',2),(22,5,3,'2024-11-28','15:00:00',1),(23,10,2,'2024-11-28','16:00:00',1),(24,11,3,'2024-11-28','18:30:00',2),(25,13,2,'2024-11-28','14:00:00',4),(26,14,3,'2024-11-28','16:30:00',2);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sedes`
--

DROP TABLE IF EXISTS `sedes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sedes` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(100) NOT NULL,
  `capacidad_maxima` int(11) NOT NULL,
  `horario_apertura` time NOT NULL,
  `horario_cierre` time NOT NULL,
  PRIMARY KEY (`id_sede`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sedes`
--

LOCK TABLES `sedes` WRITE;
/*!40000 ALTER TABLE `sedes` DISABLE KEYS */;
INSERT INTO `sedes` VALUES (1,'Casa Blanca',20,'11:00:00','21:00:00'),(2,'San José',25,'11:00:00','21:00:00'),(3,'California',30,'11:00:00','21:00:00'),(4,'El Golf',15,'11:00:00','21:00:00');
/*!40000 ALTER TABLE `sedes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-27 16:25:18
