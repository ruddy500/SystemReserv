-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: adaenterprise_db
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `ambientes`
--

DROP TABLE IF EXISTS `ambientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ambientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Ubicacion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Capacidad` int DEFAULT NULL,
  `Habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `nombre_ambientes_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ambientes_nombre_ambientes_id_foreign` (`nombre_ambientes_id`),
  CONSTRAINT `ambientes_nombre_ambientes_id_foreign` FOREIGN KEY (`nombre_ambientes_id`) REFERENCES `nombre_ambientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ambientes`
--

LOCK TABLES `ambientes` WRITE;
/*!40000 ALTER TABLE `ambientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ambientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docentes_materias`
--

DROP TABLE IF EXISTS `docentes_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `docentes_materias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `docentes_id` bigint unsigned DEFAULT NULL,
  `materias_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `docentes_materias_docentes_id_foreign` (`docentes_id`),
  KEY `docentes_materias_materias_id_foreign` (`materias_id`),
  CONSTRAINT `docentes_materias_docentes_id_foreign` FOREIGN KEY (`docentes_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `docentes_materias_materias_id_foreign` FOREIGN KEY (`materias_id`) REFERENCES `materias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docentes_materias`
--

LOCK TABLES `docentes_materias` WRITE;
/*!40000 ALTER TABLE `docentes_materias` DISABLE KEYS */;
INSERT INTO `docentes_materias` VALUES (1,2,2),(2,2,3),(3,2,1),(4,3,4),(5,3,5),(6,3,6),(7,3,7),(8,4,8),(9,5,10);
/*!40000 ALTER TABLE `docentes_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fechas`
--

DROP TABLE IF EXISTS `fechas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fechas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `dia` int DEFAULT NULL,
  `mes` int DEFAULT NULL,
  `anio` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fechas`
--

LOCK TABLES `fechas` WRITE;
/*!40000 ALTER TABLE `fechas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fechas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarios`
--

DROP TABLE IF EXISTS `horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechas_id` bigint unsigned DEFAULT NULL,
  `periodos_id` bigint unsigned DEFAULT NULL,
  `ambientes_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `horarios_fechas_id_foreign` (`fechas_id`),
  KEY `horarios_periodos_id_foreign` (`periodos_id`),
  KEY `horarios_ambientes_id_foreign` (`ambientes_id`),
  CONSTRAINT `horarios_ambientes_id_foreign` FOREIGN KEY (`ambientes_id`) REFERENCES `ambientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `horarios_fechas_id_foreign` FOREIGN KEY (`fechas_id`) REFERENCES `fechas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `horarios_periodos_id_foreign` FOREIGN KEY (`periodos_id`) REFERENCES `periodos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Grupo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,'Elementos de programacion',1),(2,'Elementos de programacion',2),(3,'Elementos de programacion',3),(4,'Ecuaciones Diferenciales',10),(5,'Calculo 2',11),(6,'Calculo 1',9),(7,'Ecuaciones Diferenciales',3),(8,'Aplicacion de Sistemas Operativos',14),(9,'Estadistica 2',7),(10,'Simulacion de Sistemas',8);
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias_seleccionado`
--

DROP TABLE IF EXISTS `materias_seleccionado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias_seleccionado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservas_id` bigint unsigned DEFAULT NULL,
  `materias_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `materias_seleccionado_reservas_id_foreign` (`reservas_id`),
  CONSTRAINT `materias_seleccionado_reservas_id_foreign` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias_seleccionado`
--

LOCK TABLES `materias_seleccionado` WRITE;
/*!40000 ALTER TABLE `materias_seleccionado` DISABLE KEYS */;
/*!40000 ALTER TABLE `materias_seleccionado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_usuarios_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_03_29_000001_create_fechas_table',1),(6,'2024_03_29_000002_create_periodos_table',1),(7,'2024_03_29_000003_create_nombre_ambientes_table',1),(8,'2024_03_29_000004_create_reservas_table',1),(9,'2024_03_29_000005_create_ambientes_table',1),(10,'2024_03_29_000006_create_horarios_table',1),(11,'2024_04_18_000001_create_materias_table',1),(12,'2024_04_18_000002_create_docentes_materias_table',1),(13,'2024_04_20_131303_create_periodos_seleccionado_table',1),(14,'2024_04_20_131329_create_materias_seleccionado_table',1),(15,'2024_04_21_230510_create_reservas_ambiente_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nombre_ambientes`
--

DROP TABLE IF EXISTS `nombre_ambientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nombre_ambientes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Usado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nombre_ambientes`
--

LOCK TABLES `nombre_ambientes` WRITE;
/*!40000 ALTER TABLE `nombre_ambientes` DISABLE KEYS */;
INSERT INTO `nombre_ambientes` VALUES (1,'690 A',0),(2,'690 B',0),(3,'690 C',0),(4,'690 D',0),(5,'691 A',0),(6,'691 B',0),(7,'691 C',0),(8,'691 D',0),(9,'691 E',0);
/*!40000 ALTER TABLE `nombre_ambientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos`
--

DROP TABLE IF EXISTS `periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `HoraIntervalo` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos`
--

LOCK TABLES `periodos` WRITE;
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
INSERT INTO `periodos` VALUES (1,'06:45 - 08:15'),(2,'08:15 - 09:45'),(3,'09:45 - 11:15'),(4,'11:15 - 12:45'),(5,'12:45 - 14:15'),(6,'14:15 - 15:45'),(7,'15:45 - 17:15'),(8,'17:15 - 18:45'),(9,'18:45 - 20:15'),(10,'20:15 - 21:45');
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos_seleccionado`
--

DROP TABLE IF EXISTS `periodos_seleccionado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodos_seleccionado` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservas_id` bigint unsigned DEFAULT NULL,
  `periodos_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `periodos_seleccionado_reservas_id_foreign` (`reservas_id`),
  CONSTRAINT `periodos_seleccionado_reservas_id_foreign` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos_seleccionado`
--

LOCK TABLES `periodos_seleccionado` WRITE;
/*!40000 ALTER TABLE `periodos_seleccionado` DISABLE KEYS */;
/*!40000 ALTER TABLE `periodos_seleccionado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `CantEstudiante` int DEFAULT NULL,
  `Motivo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Estado` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha` int DEFAULT NULL,
  `docentes_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservas_docentes_id_foreign` (`docentes_id`),
  CONSTRAINT `reservas_docentes_id_foreign` FOREIGN KEY (`docentes_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas_ambiente`
--

DROP TABLE IF EXISTS `reservas_ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas_ambiente` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ambientes_id` bigint unsigned DEFAULT NULL,
  `reservas_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservas_ambiente_ambientes_id_foreign` (`ambientes_id`),
  KEY `reservas_ambiente_reservas_id_foreign` (`reservas_id`),
  CONSTRAINT `reservas_ambiente_ambientes_id_foreign` FOREIGN KEY (`ambientes_id`) REFERENCES `ambientes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservas_ambiente_reservas_id_foreign` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas_ambiente`
--

LOCK TABLES `reservas_ambiente` WRITE;
/*!40000 ALTER TABLE `reservas_ambiente` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas_ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Administrador','Administrador@gmail.com',NULL,'$2y$10$gWz0kwXLjSJcQj3XuVBXPe0kSkZxZm5Qe9zxiyTyQiTK6a5L79rKy','admin',NULL,'2024-04-24 23:50:04','2024-04-24 23:50:04'),(2,'Leticia','leticia@gmail.com',NULL,'$2y$10$2fcQ1Re4TPebg.BRw3PGXeGHzZK16Mdq9MH6AimqK9lxmBxkOWHu6','docente',NULL,'2024-04-24 23:50:05','2024-04-24 23:50:05'),(3,'Catari','catari@gmail.com',NULL,'$2y$10$T46kwyZhinq1UQVl8DpYyuKDJszxmoroSJvF7334da5Uk4EAreo8O','docente',NULL,'2024-04-24 23:50:05','2024-04-24 23:50:05'),(4,'Cussi','cussi@gmail.com',NULL,'$2y$10$XvGlNRkvZ8Tnp7p7OFy3P.phdj7wb6LJfv8THveyJOGwAp3gGVO3W','docente',NULL,'2024-04-24 23:50:05','2024-04-24 23:50:05'),(5,'Henry','henry@gmail.com',NULL,'$2y$10$RoP.i3dbw7A7gxXXg4S6R.oCAQAeGYdrUDrKaAW1o5/PXd8VYpKIK','docente',NULL,'2024-04-24 23:50:05','2024-04-24 23:50:05');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-24 15:56:00
