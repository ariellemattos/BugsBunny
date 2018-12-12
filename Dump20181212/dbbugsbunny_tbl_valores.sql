-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: dbbugsbunny
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
-- Table structure for table `tbl_valores`
--

DROP TABLE IF EXISTS `tbl_valores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_valores`
--

LOCK TABLES `tbl_valores` WRITE;
/*!40000 ALTER TABLE `tbl_valores` DISABLE KEYS */;
INSERT INTO `tbl_valores` VALUES (8,'Missão','Disponibilizamos um acervo de títulos completo, com equipe de colaboradores competente e treinada, orientada a fazer do momento da compra uma experiência única de descoberta e prazer',1),(10,'Visão','Nosso objetivo é ser a melhor loja de entretenimento e informação, nos consolidando como a grande referência do setor. Quanto mais crescermos, mais vamos disseminar essa informação, ajudando as pessoas a construir e viver em um mundo melhor e mais justo.',1),(11,'Ética','Conduzimos nossos negócios e relações profissionais com moral e transparência.',1),(12,'Diversidade','Essa é uma palavra que nos define. A variedade do nosso acervo e os diferentes perfis de nossos colaboradores e clientes são o espelho desse valor.',1),(13,'Excelência','Estamos em busca incessante em levar o novo aos nossos clientes. Esse é um perfil que buscamos em nossos colaboradores. Desafiamos o “sempre foi assim”. Se algo funciona, já está obsoleto.',1),(14,'Responsabilidade','Acreditamos que a responsabilidade cultural contribui para uma sociedade mais conscientizada sobre desenvolvimento econômico, social e ambiental com sustentabilidade',1),(16,'teste','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.\r\nNunc viverra imperdiet enim. Fusce est. Vivamus a tellus.\r\n',1);
/*!40000 ALTER TABLE `tbl_valores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-12 15:39:33
