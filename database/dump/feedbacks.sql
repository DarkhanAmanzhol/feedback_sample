-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: feedback_db
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.4

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
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image_path` text,
  `message` text NOT NULL,
  `status` tinyint DEFAULT NULL,
  `is_updated_by_admin` tinyint NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (1,'Bakdaulet Nnn','baha@gmail.com',NULL,'Класс спасибо за рекламу',NULL,0,'2023-08-13 03:15:08','2023-08-13 03:15:08'),(2,'Qumus Quiop','qumus@email.com',NULL,'Уже не первый раз обращаюсь к этим ребятам, крутые ролики снимают! Удачи',NULL,0,'2023-08-13 03:15:08','2023-08-13 03:15:08'),(3,'Ерасыл Есен','erasyl@gmail.com',NULL,'Очень красивая картинка во всех моих проектах, за что большой рахмет!',NULL,0,'2023-08-13 03:15:08','2023-08-13 03:15:08'),(16,'Жума Кудайберген','juma@email.com','uploads/cute-cartoon-puppy-funny-dog-illustration-for-kids-illustration-with-black-outline-happy-cartoon-puppy-sits-portrait-of-a-cute-dog-a-dog-friend-with-love-free-vector.jpg','не раз обращались за видеороликами, все понравилось! качество видео супер ? сделали все так, как мы хотели.\r\nуютный офис, профессионалы своего дела! всем рекомендую!!!',NULL,0,'2023-08-13 03:20:19','2023-08-13 03:20:19'),(17,'Светлана Светлана','svetlana@gmail.com','uploads/dog-logo-cartoon-cute-pet-smile-puppy-mascot-wear-glasses-on-white-background-vector.jpg','Заказывала фотосессию и проморолик для своего бренда, супер отзывчивые и понимающие ребята, все отсняли как я хотела. Обращусь за услугой ведения инстаграма. Спасибо ??',NULL,0,'2023-08-13 03:21:47','2023-08-13 03:21:47'),(18,'Dauren Togissov','dauren@gmail.com','uploads/vector-cute-children-character-holding-white-banner-for-children-day.jpg','Цены очень даже демократичные для такого вида услуг, привлекал ребят для съемок лавстори, понравился профессионализм подход к делу планирование на вышке! Рахмет✊',NULL,0,'2023-08-13 03:22:39','2023-08-13 03:22:39'),(19,'Аубакир Емилбай','aubakir@gmail.com',NULL,'Если нужны качественные видеоролики снять обращайтесь к ним , все очень супер, буду постоянными клиентом !!!',NULL,0,'2023-08-13 03:23:02','2023-08-13 03:23:02'),(20,'Apple User','apple@user.com','uploads/animal-illustration-with-cute-little-dog-vector.jpg','Заказал лав стори и целый банкет, просто на высшем уровне!',1,0,'2023-08-13 03:23:43','2023-08-13 03:49:20'),(21,'Daulet Zhomart','daulet@gmail.com','uploads/cute-baby-cat-illustration-vector.jpg','Очень редко пишу отзывы, но эти ребята заслуживают честных и хороших слов. Очень профессионально подошли к моим задачам и от и до сняли и смонтировали качественно мой проект. Все мои задумки на видео были выполнены!!',NULL,0,'2023-08-13 03:40:41','2023-08-13 03:40:41'),(22,' ​Мустафа Шерияздан','mustafa@gmail.com',NULL,'Спасибо KOLENKE за крутое видео ❤️',NULL,0,'2023-08-13 03:42:56','2023-08-13 03:42:56'),(23,'​Рустам Кемпиров','rustam@mail.ru',NULL,'Качественно отсняли мероприятие\r\nСвежий взгляд, профессиональный подход, все в срок, качество',0,0,'2023-08-13 03:43:38','2023-08-13 03:49:12'),(24,' ​Ержан Рахмжан','erzhan@mail.ru',NULL,'Команда профессионалов! Работаю с ними уже более 3х лет! Ни разу не подвели по срокам, качеством. Не стоят на месте, всегда обновляют Оборудование (что радует ) Рекомендую ',1,0,'2023-08-13 03:44:23','2023-08-13 03:45:22');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-13  3:50:53
