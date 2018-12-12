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
-- Table structure for table `tbl_produtos`
--

DROP TABLE IF EXISTS `tbl_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` varchar(45) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produtos`
--

LOCK TABLES `tbl_produtos` WRITE;
/*!40000 ALTER TABLE `tbl_produtos` DISABLE KEYS */;
INSERT INTO `tbl_produtos` VALUES (3,'Kotlin com Android','teste','40,00',1,'upload_imagens/90f934bd986ffef73fdfa02413a96982.jpg','1'),(4,'Html e Css - Projete e construa Websites','Bem-vindo a uma melhor maneira de aprender HTML & CSS. SE você quer projetar, construir do zero ou ter mais controle sobre um site existente, este livro lhe ajudará a criar conteúdos atrativos e amigáveis','158.90',1,'upload_imagens/d3b54107566bb29689eb4228b127f3ca.jpg','1'),(5,'Javascript e Jquery - Desenvolvimento de Interfaces Web Interativas','Bem-vindo ao ensino de JavaScript & jQuery. VOcê é iniciante em JavaScript, ou adicionou scripts a sua página web mas quer entender melhor como tudo funciona? Então este livro é para você','80,00',1,'upload_imagens/3834529324a47fa04434943b95e632e5.png','1'),(6,'Jornal','teste','5,00',9,'upload_imagens/527825cec5131a8a179ad2109340f297.jpg','1'),(7,'Mecânica dos materiais','Beer e Johnston são líderes incontestáveis no ensino de mecânica dos sólidos. Utilizado por milhares de estudantes em todo o mundo desde sua primeira edição, Mecânica dos Materiais, 7.ed. oferece uma apresentação precisa da matéria, ilustrada com inúmeros exemplos. O texto enfatiza o correto entendimento dos princípios da mecânica e a sua aplicação na resolução dos problemas de engenharia.','185,10',3,'upload_imagens/a8342e09687fbe29bc8a3900888ec22f.jpg','1'),(8,'teste','teste','50,00',1,'upload_imagens/9402822080286b6bcc92ba499629b1c6.jpg','1'),(9,'teste','teste 2','50,00',3,'upload_imagens/fe5ad6c2512c20e9c41136e91a61d578.jpg','1');
/*!40000 ALTER TABLE `tbl_produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-12 15:39:34
