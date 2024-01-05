-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: scandiweb_junior_test
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;

/*!40103 SET TIME_ZONE='+00:00' */
;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;

/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;

--
-- Table structure for table `products`
--
DROP TABLE IF EXISTS `products`;

DROP TABLE IF EXISTS `attributes`;

/*!40101 SET @saved_cs_client     = @@character_set_client */
;

/*!40101 SET character_set_client = utf8 */
;

-- Table structure for table `products`
CREATE TABLE `products` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(13, 2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_uindex` (`sku`)
) ENGINE = InnoDB AUTO_INCREMENT = 34 DEFAULT CHARSET = utf8mb4;

-- Table structure for table `attributes`
CREATE TABLE `attributes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes_product_id_foreign` (`product_id`),
  CONSTRAINT `attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = utf8mb4;

/*!40101 SET character_set_client = @saved_cs_client */
;

--
-- Dumping data for table `products`
--
LOCK TABLES `products` WRITE;

/*!40000 ALTER TABLE `products` DISABLE KEYS */
;

INSERT INTO
  `products` (`id`, `sku`, `name`, `price`)
VALUES
  (1, 'JVC200123', 'Acme DISC', 1.00),
  (2, 'JVC200124', 'Acme DISC', 1.00),
  (3, 'JVC200125', 'Acme DISC', 1.00),
  (4, 'JVC200126', 'Acme DISC', 1.00),
  (5, 'GGWP0007', 'War and Peace', 20.00),
  (8, 'GGWP0008', 'War and Peace', 20.00),
  (9, 'GGWP0009', 'War and Peace', 20.00),
  (10, 'GGWP0010', 'War and Peace', 20.00);

INSERT INTO
  `attributes` (`product_id`, `name`, `value`)
VALUES
  (1, 'Weight', '700 MB'),
  (2, 'Weight', '700 MB'),
  (3, 'Weight', '700 MB'),
  (4, 'Weight', '700 MB'),
  (5, 'Weight', '2KG'),
  (8, 'Weight', '2KG'),
  (9, 'Weight', '2KG'),
  (10, 'Weight', '2KG');

/*!40000 ALTER TABLE `products` ENABLE KEYS */
;

UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;

-- Dump completed on 2022-02-27 23:41:49