-- MySQL dump 10.13  Distrib 8.0.40, for Linux (x86_64)
--
-- Host: localhost    Database: spotifyDB
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `cancion`
--

DROP TABLE IF EXISTS `cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cancion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genero_id` int DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duracion` int DEFAULT NULL,
  `album` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reproducciones` int DEFAULT NULL,
  `likes` int DEFAULT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` int DEFAULT NULL,
  `album_imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E4620FA0BCE7B795` (`genero_id`),
  CONSTRAINT `FK_E4620FA0BCE7B795` FOREIGN KEY (`genero_id`) REFERENCES `estilo` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancion`
--

LOCK TABLES `cancion` WRITE;
/*!40000 ALTER TABLE `cancion` DISABLE KEYS */;
INSERT INTO `cancion` VALUES (2,4,'Enjoy the Silence',372,'Violator','Depeche Mode',14,13,'songs/EnjoyTheSilence.mp3',1990,'depecheV.jpg'),(3,5,'Move Your Feet',180,'D-D-Don`t Don`t Stop the Beat','Junior Senior',10,7,'songs/MoveYourFeet.mp3',2003,'MoveYourFeet.jpeg'),(4,9,'Bitter Sweet Symphony',278,'Urban Hymns','The Verve',15,1,'songs/BittersweetSymphony.mp3',1997,'bitterSweet.jpeg'),(5,NULL,'La Plage',110,'Les retrouvaille','Yann Tiersen',28,11,'songs/La plage.mp3',2005,'yann.jpeg'),(6,2,'Black or White',212,'Dangerous','Michael Jackson',15,16,'songs/BlackAndWhite.mp3',1991,'dangerous.jpeg'),(7,2,'Blue Jeans',320,'Born to Die','Lana del Rey',17,21,'songs/BlueJeans.mp3',2012,'lana.jpeg');
/*!40000 ALTER TABLE `cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250127222236','2025-02-02 17:23:12',17264),('DoctrineMigrations\\Version20250202231348','2025-02-02 23:14:18',8524),('DoctrineMigrations\\Version20250203004216','2025-02-03 00:42:21',9019),('DoctrineMigrations\\Version20250203004513','2025-02-03 00:45:19',2824),('DoctrineMigrations\\Version20250203011145','2025-02-03 01:11:52',1521),('DoctrineMigrations\\Version20250203150027','2025-02-03 15:00:41',9186),('DoctrineMigrations\\Version20250209180328','2025-02-09 18:04:58',300),('DoctrineMigrations\\Version20250210000650','2025-02-10 00:06:58',305),('DoctrineMigrations\\Version20250210001610','2025-02-10 00:16:15',366),('DoctrineMigrations\\Version20250210022839','2025-02-10 02:28:44',315);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estilo`
--

DROP TABLE IF EXISTS `estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estilo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estilo`
--

LOCK TABLES `estilo` WRITE;
/*!40000 ALTER TABLE `estilo` DISABLE KEYS */;
INSERT INTO `estilo` VALUES (1,'Heavy Metal','El heavy metal es un género de rock caracterizado por guitarras distorsionadas, ritmos rápidos, voces poderosas y temas de rebeldía o oscuridad'),(2,'Pop','Musica accesible y popular con ritmos populares.'),(3,'Rock','Guitarras electricas ritmos fuertes y actitud rebelde.'),(4,'Dark Wave','Música gótica y electrónica con atmósfera melancólica y sonidos sintetizados oscuros.'),(5,'Funk','Ritmos sincopados, bajos potentes, y grooves irresistibles.'),(6,'Hip Hop','Rimas, beats contundentes, y cultura urbana.'),(7,'Grunge','Guitarras distorsionadas, letras introspectivas, y espíritu rebelde.'),(8,'Country','Letras narrativas, guitarras acústicas, y melodías tradicionales.'),(9,'Indie Rock','Sonidos alternativos, producción lo-fi, y espíritu DIY'),(10,'Reaguee','Música electrónica con ritmos afrobeat y percusión africana'),(11,'Jazz','Improvisación, armonías complejas, y ritmos swing.'),(12,'Trap','Beats graves, letras crudas, y ritmos pegajosos.'),(13,'Tecno','Ritmos repetitivos, sintetizadores, y beats bailables.'),(14,'Electronica','Sonidos sintetizados, beats electrónicos, y atmósferas futuristas.'),(15,'Soul','Voces emocionales, letras sentidas, ritmos suaves, y fusión de gospel, R&B y jazz.');
/*!40000 ALTER TABLE `estilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil` (
  `id` int NOT NULL AUTO_INCREMENT,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_96657647DB38439E` (`usuario_id`),
  CONSTRAINT `FK_96657647DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'../imagenes/img002.jpg','Usuario Premium creador de listas variadas',1);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_estilo`
--

DROP TABLE IF EXISTS `perfil_estilo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfil_estilo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `perfil_id` int NOT NULL,
  `estilo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8C8A3EBE57291544` (`perfil_id`),
  KEY `IDX_8C8A3EBE43798DA7` (`estilo_id`),
  CONSTRAINT `FK_8C8A3EBE43798DA7` FOREIGN KEY (`estilo_id`) REFERENCES `estilo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_8C8A3EBE57291544` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil_estilo`
--

LOCK TABLES `perfil_estilo` WRITE;
/*!40000 ALTER TABLE `perfil_estilo` DISABLE KEYS */;
INSERT INTO `perfil_estilo` VALUES (1,1,2),(2,1,3),(3,1,1);
/*!40000 ALTER TABLE `perfil_estilo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist`
--

DROP TABLE IF EXISTS `playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `propietario_id` int NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibilidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reproducciones` int DEFAULT NULL,
  `likes` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D782112D53C8D32C` (`propietario_id`),
  CONSTRAINT `FK_D782112D53C8D32C` FOREIGN KEY (`propietario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist`
--

LOCK TABLES `playlist` WRITE;
/*!40000 ALTER TABLE `playlist` DISABLE KEYS */;
INSERT INTO `playlist` VALUES (1,1,'exitos del rock','publica',NULL,NULL),(2,1,'Variado tardeo','publica',NULL,NULL);
/*!40000 ALTER TABLE `playlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `playlist_cancion`
--

DROP TABLE IF EXISTS `playlist_cancion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `playlist_cancion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `playlist_id` int NOT NULL,
  `cancion_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B5D18BA6BBD148` (`playlist_id`),
  KEY `IDX_5B5D18BA9B1D840F` (`cancion_id`),
  CONSTRAINT `FK_5B5D18BA6BBD148` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5B5D18BA9B1D840F` FOREIGN KEY (`cancion_id`) REFERENCES `cancion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `playlist_cancion`
--

LOCK TABLES `playlist_cancion` WRITE;
/*!40000 ALTER TABLE `playlist_cancion` DISABLE KEYS */;
INSERT INTO `playlist_cancion` VALUES (2,1,2),(3,2,4),(4,2,7),(5,2,6),(6,2,5);
/*!40000 ALTER TABLE `playlist_cancion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'noelyazdani@hotmail.com','Examen123','Noel','1989-04-22'),(2,'pedroLozano@hotmail.com','Examen456','Pedro','1992-11-12'),(3,'alojandroCernada@hotmail.com','Examen789','Alejandro','2007-01-12');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_playlist`
--

DROP TABLE IF EXISTS `usuario_playlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario_playlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `playlist_id` int NOT NULL,
  `reproducida` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3F43E3B4DB38439E` (`usuario_id`),
  KEY `IDX_3F43E3B46BBD148` (`playlist_id`),
  CONSTRAINT `FK_3F43E3B46BBD148` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3F43E3B4DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_playlist`
--

LOCK TABLES `usuario_playlist` WRITE;
/*!40000 ALTER TABLE `usuario_playlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_playlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-10  5:06:17
