
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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `poll` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `poll`;
DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `answers` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `value` tinyint NOT NULL,
  `votes` tinyint NOT NULL,
  `id_question` tinyint DEFAULT NULL,
  `id_proffesor` tinyint DEFAULT NULL,
  `id_students` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_fk_id_question` (`id_question`),
  KEY `answers_fk_id_proffesor` (`id_proffesor`),
  KEY `answers_fk_id_students` (`id_students`),
  CONSTRAINT `answers_fk_id_proffesor` FOREIGN KEY (`id_proffesor`) REFERENCES `proffesors` (`id`),
  CONSTRAINT `answers_fk_id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`),
  CONSTRAINT `answers_fk_id_students` FOREIGN KEY (`id_students`) REFERENCES `students` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `degrees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `degrees` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `degrees_uk_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `degrees` WRITE;
/*!40000 ALTER TABLE `degrees` DISABLE KEYS */;
/*!40000 ALTER TABLE `degrees` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `polls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `polls` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `id_subject` tinyint DEFAULT NULL,
  `id_group` tinyint DEFAULT NULL,
  `id_student` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polls_fk_id_subject` (`id_subject`),
  KEY `polls_fk_id_group` (`id_group`),
  KEY `polls_fk_id_student` (`id_student`),
  CONSTRAINT `polls_fk_id_group` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`),
  CONSTRAINT `polls_fk_id_student` FOREIGN KEY (`id_student`) REFERENCES `students` (`id`),
  CONSTRAINT `polls_fk_id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `polls` WRITE;
/*!40000 ALTER TABLE `polls` DISABLE KEYS */;
/*!40000 ALTER TABLE `polls` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `proffesors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proffesors` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `proffesors` WRITE;
/*!40000 ALTER TABLE `proffesors` DISABLE KEYS */;
/*!40000 ALTER TABLE `proffesors` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `subtype` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `questions_uk_type` (`type`),
  UNIQUE KEY `questions_uk_description` (`description`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `age` varchar(255) NOT NULL,
  `highest_course` tinyint NOT NULL,
  `lowest_course` tinyint NOT NULL,
  `enrollment` tinyint NOT NULL,
  `exam` tinyint NOT NULL,
  `interest` varchar(255) NOT NULL,
  `mentoring` varchar(255) NOT NULL,
  `dificulty` varchar(255) NOT NULL,
  `expected_grade` varchar(255) NOT NULL,
  `assistance` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subjects` (
  `id` tinyint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_degree` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subjects_uk_name` (`name`),
  KEY `subjects_fk_id_degree` (`id_degree`),
  CONSTRAINT `subjects_fk_id_degree` FOREIGN KEY (`id_degree`) REFERENCES `degrees` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `subjects` WRITE;
/*!40000 ALTER TABLE `subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `subjects` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

