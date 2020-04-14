DROP DATABASE IF EXISTS `poll`;
CREATE DATABASE IF NOT EXISTS `poll`;

USE `poll`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_uk_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `users` VALUES (1,'admin@admin.com','$2y$11$a54kWNY14d8wFHULQkwKyuTz8a/w0d56Fy/3Z.mScvYBU6S7i3b1G');


DROP TABLE IF EXISTS `gender`;
CREATE TABLE `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `gender` VALUES (1,'Femenino'),(2,'Masculino'),(3,'Otro');


DROP TABLE IF EXISTS `mentoring`;
CREATE TABLE `mentoring` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `mentoring` VALUES (1,'Nada'),(2,'Algo'),(3,'Bastante'),(4,'Mucho');


DROP TABLE IF EXISTS `interest`;
CREATE TABLE `interest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `interest` VALUES (1,'Nada'),(2,'Algo'),(3,'Bastante'),(4,'Mucho');


DROP TABLE IF EXISTS `dificulty`;
CREATE TABLE `dificulty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `dificulty` VALUES (1,'Baja'),(2,'Media'),(3,'Alta'),(4,'Muy Alta');


DROP TABLE IF EXISTS `expected_grade`;
CREATE TABLE `expected_grade` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `expected_grade` VALUES (1,'No Presentado'),(2,'Suspenso'),(3,'Aprobado'),(4,'Notable'),(5,'Sobresaliente'),(6,'Matriculo de Honor');


DROP TABLE IF EXISTS `assistance`;
CREATE TABLE `assistance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `assistance` VALUES (1,'Menos del 50%'),(2,'Entre 50% y 80%'),(3,'Más de 80%');


DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `age` int NOT NULL,
  `highest_course` int NOT NULL,
  `lowest_course` int NOT NULL,
  `enrollment` int NOT NULL,
  `exam` int NOT NULL,
  `id_gender` int DEFAULT NULL,
  `id_mentoring` int DEFAULT NULL,
  `id_interest` int DEFAULT NULL,
  `id_dificulty` int DEFAULT NULL,
  `id_expected_grade` int DEFAULT NULL,
  `id_assitance` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_fk_id_gender` (`id_gender`),
  KEY `students_fk_id_mentoring` (`id_mentoring`),
  KEY `students_fk_id_interest` (`id_interest`),
  KEY `students_fk_id_dificulty` (`id_dificulty`),
  KEY `students_fk_id_expected_grade` (`id_expected_grade`),
  KEY `students_fk_id_assitance` (`id_assitance`),
  CONSTRAINT `students_fk_id_assitance` FOREIGN KEY (`id_assitance`) REFERENCES `assistance` (`id`),
  CONSTRAINT `students_fk_id_dificulty` FOREIGN KEY (`id_dificulty`) REFERENCES `dificulty` (`id`),
  CONSTRAINT `students_fk_id_expected_grade` FOREIGN KEY (`id_expected_grade`) REFERENCES `expected_grade` (`id`),
  CONSTRAINT `students_fk_id_gender` FOREIGN KEY (`id_gender`) REFERENCES `gender` (`id`),
  CONSTRAINT `students_fk_id_interest` FOREIGN KEY (`id_interest`) REFERENCES `interest` (`id`),
  CONSTRAINT `students_fk_id_mentoring` FOREIGN KEY (`id_mentoring`) REFERENCES `mentoring` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `subtype` varchar(255) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `questions_uk_description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `questions` VALUES (1,'PLANIFICACION DE LA ENSEÑANZA Y APRENDIZAJE',NULL,'El/la profesor/a informa sobre los distintos aspectos de la guía docente o programa dela asignatura (objetivos, actividades, contenidos del temario, metodología, bibliografía,sistemas de evaluación,...)'),(2,'DESARROLLO DE LA DOCENCIA','Cumplimiento de las obligaciones docentes','Imparte las clases en el horario fijado'),(3,'DESARROLLO DE LA DOCENCIA','Cumplimiento de las obligaciones docentes','Asiste regularmente a clase'),(4,'DESARROLLO DE LA DOCENCIA','Cumplimiento de las obligaciones docentes','Cumple adecuadamente su labor de tutoría (presencial o virtual)'),(5,'DESARROLLO DE LA DOCENCIA','Cumplimiento de las obligaciones docentes','Se ajusta a la planificación de la asignatura'),(6,'DESARROLLO DE LA DOCENCIA','Cumplimiento de la Planificación','Se han coordinado las actividades teóricas y prácticas previstas'),(7,'DESARROLLO DE LA DOCENCIA','Cumplimiento de la Planificación','Se ajusta a los sistemas de evaluación especificados en la guía docente/programa de la asignatura'),(8,'DESARROLLO DE LA DOCENCIA','Cumplimiento de la Planificación','La bibliografía y otras fuentes de información recomendadas en el programa son útilespara el aprendizaje de la asignatura'),(9,'DESARROLLO DE LA DOCENCIA','Cumplimiento de la Planificación','El/la profesor/a organiza bien las actividades que se realizan en clase'),(10,'DESARROLLO DE LA DOCENCIA','Metodología Docente','Utiliza recursos didácticos (pizarra, transparencias, medios audiovisuales, material de apoyo en red virtual...) que facilitan el aprendizaje'),(11,'DESARROLLO DE LA DOCENCIA','Metodología Docente','Explica con claridad y resalta los contenidos importantes'),(12,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Se interesa por el grado de comprensión de sus explicaciones'),(13,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Expone ejemplos en los que se ponen en práctica los contenidos de la asignatura'),(14,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Explica los contenidos con seguridad'),(15,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Resuelve las dudas que se le plantean'),(16,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Fomenta un clima de trabajo y participación'),(17,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Propicia una comunicación fluida y espontánea'),(18,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Motiva a los/as estudiantes para que se interesen por la asignatura'),(19,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Es respetuoso/a en el trato con los/las estudiantes'),(20,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Tengo claro lo que se me va a exigir para superar esta asignatura'),(21,'DESARROLLO DE LA DOCENCIA','Competencias docentes desarrolladas por el/la profesor/a','Los criterios y sistemas de evaluación me parecen adecuados, en el contexto de la asignatura'),(22,'RESULTADOS',NULL,'Las actividades desarrolladas (teóricas, prácticas, de trabajo individual, en grupo,...)contribuyen a alcanzar los objetivos de la asignatura'),(23,'RESULTADOS',NULL,'Estoy satisfecho/a con la labor docente de este/a profesor/a');


DROP TABLE IF EXISTS `proffesors`;
CREATE TABLE `proffesors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `proffesors` VALUES (1,'Manuel Jesus Cobo Martin'),(2,'Manuel Palomo Duarte'),(3,'Raquel Ureña Perez'),(4,'Daniel Molina Cabrera'),(5,'Jose Antonio Ortega Perez'),(6,'Carlos Rioja del Rio'),(7,'Jose Alonso de la Huerta'),(8,'Jose Fidel Argudo Argudo'),(9,'Maria Teresa Garcia Horcajadas'),(10,'Jesus Roman Alvarez-Ossorio'),(11,'Joaquin Pizarro Junquera'),(12,'Alfonso Garcia de Prado Fontela'),(13,'Antonio Jesus Molina Cabrera'),(14,'Nestor Mora Nuñez'),(15,'Mercedes Rodriguez Garcia'),(16,'Antonio Balderas Alberico'),(17,'Pablo de la Torre Moreno'),(18,'Andres Yañez Escolano'),(19,'Mercedes Ruiz Carreira'),(20,'Ivan Ruiz Rube'),(21,'Pablo Garcia Sanchez'),(22,'Francisco Palomo Lozano'),(23,'Antonio Sala Perez'),(24,'Jose Miguel Mota Macias'),(25,'Francisco Damian Ortega Molina'),(26,'Gonzalo Ruiz Cagigas'),(27,'Alejandro Calderon Sanchez'),(28,'Victor Manuel Sanchez Corbacho'),(29,'Pedro Delgado Perez'),(30,'Pedro Fernandez Fernandez'),(31,'Alberto Gabriel Salguero Hidalgo'),(32,'Maria Angeles Cifredo Chacon'),(33,'Arturo Morgado Estevez'),(34,'Carlos Rodriguez Cordon'),(35,'Juan Manuel Dodero Beardo'),(36,'Santiago Fandiño Patiño'),(37,'Juan Luis Peralta Saez'),(38,'Maria Dolores Ruiz Jimenez'),(39,'Lorena Gutierrez Madroñal'),(40,'Nuria Hurtado Rodriguez'),(41,'Manuel Matias Casado'),(42,'David Barbosa Rendon'),(43,'Clemente Cobos Sanchez'),(44,'Jose Maria Sierra Fernandez'),(45,'Maria Carmen Castro Cabrera'),(46,'Domingo Javier Holgado Corrales'),(47,'Eugenio Juarez Clavain'),(48,'Francisco Periañez Gomez'),(49,'Jose Luis Isla Montes'),(50,'Juan Boubeta Puig'),(51,'Guadalupe Ortiz Bellot'),(52,'Elena Orta Cuevas'),(53,'Elisa Guerrero Vazquez'),(54,'Manuel Lopez Coello'),(55,'Esther Lidia Silva Ramirez'),(56,'Jose Maria Rodriguez Corral'),(57,'Maria Eloisa Yrayzoz Diaz de Liaño'),(58,'Francisco Jose Gonzalez Gutierrez'),(59,'Juan Jose Monedero Rojo'),(60,'Antonio J. Tomeu Hardasmal'),(61,'Angel Cervera Paz'),(62,'Guillermo Barcena Gonzalez'),(63,'Maria de la Paz Guerrero Lebrero'),(64,'Ignacio Javier Perez Galvez'),(65,'Gerardo Aburruzaga Garcia'),(66,'Jose Antonio Ortega Perez'),(67,'Pedro Luis Galindo Riaño'),(68,'Fernando Perez Peña'),(69,'Antonia Estero Botaro'),(70,'Antonio Jesus Sanchez Guirado'),(71,'Faustino Valdes Diaz'),(72,'Juan Jose Dominguez Jimenez'),(73,'Pablo Garcia Sanchez'),(74,'Miguel Angel Bolivar Perez'),(75,'Inmaculada Medina Bulo'),(76,'Bernabe Dorronsoro Diaz'),(77,'Jose Manuel Enriquez de Salamanca Garcia'),(78,'Francisco Ortus Escuder'),(79,'Higinio Sanchez Sainz'),(80,'Alejandro Perez Peña'),(81,'Maria Luisa Sunico Riaño'),(82,'Agustin Consegliere Castilla'),(83,'Daniel Sanchez Morillo'),(84,'Carlos Corrales Alba'),(85,'Jose Francisco Moreno Verdulla'),(86,'Manuel Prian Rodriguez'),(87,'German Alvarez Tey'),(88,'Juan Manuel Casal Ramos'),(89,'Juan Miguel Nuñez Orihuela'),(90,'Juan Antonio Viso Perez'),(91,'David Gonzalez Robledo'),(92,'Jose M. Sanchez Amaya'),(93,'German Jimenez Ferrer'),(94,'Soledad Moreno Pulido'),(95,'Marina Nicasio Llach'),(96,'Antonio Piqueras Lerena'),(97,'Sonia Velazquez Leris'),(98,'Jose Enrique Diaz Vazquez'),(99,'Jose Maria Garcia Barcena'),(100,'Patricia Ruiz Villalobos'),(101,'Pedro Merino Alcon'),(102,'Luis Rubio Peña'),(103,'Manuel Barrena Izquierdo'),(104,'Luis Garcia Barrachina'),(105,'Perpetua Gonzalez Garcia'),(106,'Manuel Tornell Barbosa'),(107,'Carmen Garcia Lopez'),(108,'Maximo Perez Braza'),(109,'Alberto Sanchez Alzola'),(110,'Milagros Huerta Gomez de Merodio'),(111,'Juan Ignacio Colombo Roquette'),(112,'Pablo Pavon Dominguez'),(113,'Juan Ramon Astorga Ramirez'),(114,'Alvaro Gomez Parra'),(115,'Mariano Marcos Barcena'),(116,'Jose Luis Cardenas Leal'),(117,'Maria Araceli Garcia Yeguas'),(118,'Manuel Jesus Garquez Gonzalez'),(119,'Maria Luisa de la Rosa Portillo'),(120,'Rafael Jimenez Castañeda'),(121,'Severo Raul Fernandez Vidal'),(122,'Rafael Gomez Sanchez'),(123,'Luis Miguel Marin Trechera'),(124,'Jose Luis Gilabert Villard'),(125,'Victor Perez Fernandez'),(126,'Moises Batista Ponce'),(127,'Elisa Moreno Lobaton'),(128,'Pedro Francisco Mayuet Ares'),(129,'Jose Sanchez Ramos'),(130,'Miguel Suffo Pino'),(131,'Alvaro Ruiz Pardo'),(132,'Francisco Jose Sanchez de la Flor'),(133,'Maria del Pilar Villar Castro'),(134,'Juan Luis Beira Jimenez'),(135,'Francisco Mesa Varela'),(136,'David Repeto Garcia'),(137,'Juan Andres Martin Garcia'),(138,'Jose Cano Martin'),(139,'Francisco Fernandez Zacarias'),(140,'Pedro Jose Nadal de Mora'),(141,'Carmen Garcia Lopez'),(142,'Tomas Acedo Alberto'),(143,'Rosario Garcia Garcia'),(144,'Rafael Ravina Ripoll'),(145,'Andres Pastor Fernandez'),(146,'Jose Maria Portela Nuñez'),(147,'Nuria Chinchilla Salcedo'),(148,'Cristina Pinedo Rivilla'),(149,'Miguel Alvarez Alcon'),(150,'Manuel Viseras Pico'),(151,'Alejandro Rincon Casado'),(152,'Enrique Angel Rodriguez Jara'),(153,'Manuel Jesus Lopez Sanchez'),(154,'Jose Lorenzo Trujillo'),(155,'Alberto Fernandez Ros'),(156,'Francisco Javier Garcia Pacheco'),(157,'Miriam Herrera Collado'),(158,'Maria Alonso Garcia'),(159,'Dario Miguel Ramiro Aparicio'),(160,'Ursula Torres Parejo'),(161,'Rafael Bienvenido Barcena'),(162,'Juan Antonio Molina Agea'),(163,'Daniel Moreno Nieto'),(164,'Miguel Angel Fernandez Granero'),(165,'Jose Ricardo Iglesias Quintero'),(166,'Vicente Lopez Pena'),(167,'Antonio Gamez Mellado'),(168,'Lucia Rodriguez Parada'),(169,'Manuel Piñero de los Rios'),(170,'Agueda Vazquez Lopez-Escobar'),(171,'Sergio Ignacio Molina Rubio'),(172,'Sol Saez Martinez'),(173,'Antonio Jose Macias Sanchez'),(174,'Francisco Javier Moreno Dorado'),(175,'Ascension Torres Martinez'),(176,'Maria Alicia Cornejo Barrios'),(177,'Jose Miguel Sanchez Sola'),(178,'Jose Diaz Garcia'),(179,'Isabel Ramirez Brenes'),(180,'Luis Lopez Molina'),(181,'Maria Jose Burgos Navarro'),(182,'Eloisa Ramirez Pousa'),(183,'Angel Quiros Olozabal'),(184,'Jose Maria Guerrero Rodriguez'),(185,'Francisco Jose Lucas Fernandez'),(186,'Eduardo Alejandro Romero Bruzon'),(187,'Francisco Jose Pacheco Ramirez'),(188,'Manuel Otero Mateo'),(189,'Juan Antonio Landroguez Estevez');


DROP TABLE IF EXISTS `degrees`;
CREATE TABLE `degrees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `degrees_uk_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1722 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `degrees` VALUES (1717,'GIDIDP'),(1718,'GIE'),(1719,'GIEI'),(1714,'GII'),(1720,'GIM'),(1721,'GITI');


DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `groups` VALUES (1),(2),(3);


DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `course` int NOT NULL,
  `id_degree` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subjects_uk_name_id_degree` (`name`,`id_degree`),
  KEY `subjects_fk_id_degree` (`id_degree`),
  CONSTRAINT `subjects_fk_id_degree` FOREIGN KEY (`id_degree`) REFERENCES `degrees` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21720050 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `subjects` VALUES (21714001,'Organizacion y Gestion de Empresas',1,1714),(21714002,'Estadistica',1,1714),(21714003,'Fundamentos Fisicos y Electronicos de la Informatica',1,1714),(21714004,'Fundamentos de Estructura de Computadores',1,1714),(21714005,'Informatica General',1,1714),(21714006,'Introduccion a la Programacion',1,1714),(21714007,'Metodologia de la Programacion',1,1714),(21714008,'Algebra',1,1714),(21714009,'Calculo',1,1714),(21714010,'Matematica Discreta',1,1714),(21714011,'Bases de Datos',2,1714),(21714012,'Ingenieria del Software',2,1714),(21714013,'Inteligencia Artificial',2,1714),(21714014,'Analisis de Algoritmos y Estructura de Datos',2,1714),(21714015,'Diseño de Algoritmos',3,1714),(21714016,'Estructura de Datos No Lineales',2,1714),(21714017,'Programacion Orientada a Objetos',2,1714),(21714018,'Proyectos Informaticos',4,1714),(21714019,'Arquitectura de Computadores',2,1714),(21714020,'Programacion Concurrente y de Tiempo Real',2,1714),(21714021,'Redes de Computadores',2,1714),(21714022,'Sistemas Distribuidos',3,1714),(21714023,'Sistemas Operativos',2,1714),(21714024,'Complejidad Computacional',3,1714),(21714025,'Modelos de Computacion',3,1714),(21714026,'Procesadores de Lenguajes',3,1714),(21714027,'Teoria de Automatas y Lenguajes Formales',3,1714),(21714028,'Aprendizaje Computacional',3,1714),(21714029,'Percepcion',3,1714),(21714030,'Reconocimiento de Patrones',3,1714),(21714031,'Sistemas Inteligentes',3,1714),(21714032,'Arquitecturas de Computadores Paralelos y Distribuidos',3,1714),(21714033,'Programacion Paralela y Distribuida',3,1714),(21714034,'Diseño Avanzado de Arquitectura de Computadores',3,1714),(21714035,'Diseño Basado en Microprocesadores',3,1714),(21714036,'Diseño de Computadores Empotrados',3,1714),(21714037,'Tecnicas de Diseño de Computadores',3,1714),(21714038,'Administración y Seguridad de Redes de Computadores',3,1714),(21714039,'Diseño de Redes de Computadores',3,1714),(21714040,'Diseño de Sistema Software',3,1714),(21714041,'Ingenieria de Requisitos',3,1714),(21714042,'Verificacion y Validacion del Software',3,1714),(21714043,'Calidad del Software',3,1714),(21714044,'Direccion y Gestion de Proyectos Software',3,1714),(21714045,'Metodologías y Procesos Software',3,1714),(21714046,'Evolucion del Software',3,1714),(21714047,'Implementacion e Implantacion de Sistemas Software',3,1714),(21714048,'Desarrollo de Sistemas Hipermedia',3,1714),(21714049,'Programacion en Internet',3,1714),(21714050,'Recuperacion de la Informacion',3,1714),(21714051,'Ingenieria de Sistemas de Informacion',3,1714),(21714052,'Sistemas de Informacion en la Empresa',3,1714),(21714053,'Administración de Bases de Datos',3,1714),(21714054,'Tecnologias Avanzadas de Bases de Datos',3,1714),(21714055,'Tecnologias de Inteligencia de Negocio',3,1714),(21714056,'Administración de Servidores',3,1714),(21714057,'Interconexion de Redes',3,1714),(21714058,'Calidad de los Sistemas Informaticos',3,1714),(21714059,'Seguridad en los Sistemas Informaticos',3,1714),(21714060,'Desarrollo de Sistemas Multimedia',3,1714),(21714061,'Ingeniera Web',3,1714),(21714062,'Internet y Negocio Electronico',3,1714),(21714063,'Programacion Web',3,1714),(21714064,'Proyecto de Fin de Grado',4,1714),(21715001,'Algebra y Geometria',1,1721),(21715002,'Calculo',1,1721),(21715003,'Estadistica',1,1721),(21715004,'Ampliacion de Matematicas',2,1721),(21715005,'Fisica I',1,1721),(21715006,'Fisica II',1,1721),(21715007,'Quimica',1,1721),(21715008,'Fundamentos de Informatica',1,1721),(21715009,'Organizacion y Gestion de Empresas',1,1721),(21715010,'Expresion Grafica y Diseño Asistido',1,1721),(21715011,'Termotecnia',2,1721),(21715012,'Mecanica de Fluidos',2,1721),(21715013,'Ciencia E Ingenieria de los Materiales',1,1721),(21715014,'Electrotecnia',2,1721),(21715016,'Automatica',2,1721),(21715017,'Teoria de Mecanismos y Maquinas',2,1721),(21715018,'Elasticidad y Resistencia de Materiales I',2,1721),(21715019,'Ingenieria de Fabricacion',2,1721),(21715020,'Proyectos de Ingenieria',4,1721),(21715021,'Dibujo Industrial',3,1721),(21715023,'Gestion de la Produccion',3,1721),(21715024,'Prevencion Industrial de Riesgos',3,1721),(21715025,'Maquinas Electricas',3,1721),(21715026,'Accionamientos Electricos',3,1721),(21715027,'Instalaciones Electricas',3,1721),(21715028,'Lineas y Redes Electricas',3,1721),(21715029,'Sistemas Electricos de Potencia',3,1721),(21715031,'Centrales Electricas',3,1721),(21715032,'Ampliacion de Electrotecnia',3,1721),(21715038,'Automatizacion Industrial',3,1721),(21715040,'Ingenieria Grafica',3,1721),(21715041,'Calculo, Construccion y Ensayo de Maquinas',3,1721),(21715042,'Ingenieria Termica',3,1721),(21715043,'Elasticidad y Resistencia de Materiales II',3,1721),(21715044,'Calculo y Diseño de Estructuras',3,1721),(21715045,'Ingenieria Fluidomecanica',3,1721),(21715046,'Ingenieria y Tecnología de Materiales',3,1721),(21715047,'Tecnologias de Fabricacion',3,1721),(21715048,'Diseño de Subestaciones y Centros de Transformacion',4,1721),(21715049,'Construccion y Ensayo de Maquinas Electricas',4,1721),(21715050,'Generacion Distribuida de Energia Electrica',4,1721),(21715051,'Mantenimiento Industrial Electrico',4,1721),(21715052,'Calidad de Suministro',4,1721),(21715053,'Medidas Electricas Industriales',4,1721),(21715056,'Dispositivos Electronicos Avanzados',4,1721),(21715057,'Sistemas Automaticos en Edificios Inteligentes',4,1721),(21715058,'Tecnicas Avanzadas de Simulacion y Control de Procesos Industriales',4,1721),(21715060,'Aparatos de Elevacion, Transporte y Manutencion',4,1721),(21715061,'Mecanica de Robots',4,1721),(21715062,'Mecanismos y Maquinas',4,1721),(21715063,'Fabricacion Asistida',4,1721),(21715064,'Ingenieria de Procesos de Conformado con Conservacion de Materiales',4,1721),(21715065,'Ingeniera del Mecanizado',4,1721),(21715066,'Estructuras Metalicas, de Hormigon y Cimentaciones',4,1721),(21715067,'Mecanica Analitica',4,1721),(21715068,'Metodos de Analisis de Estructuras',4,1721),(21715069,'Aplicaciones Micro-Roboticas',4,1721),(21715070,'Gestion de la Calidad Industrial',4,1721),(21715071,'Modelos Matematicos y Estadisticos en Ingenieria',4,1721),(21715072,'Topografia',4,1721),(21715074,'Instalaciones Industriales',4,1721),(21715075,'Mantenimiento Industrial',4,1721),(21715076,'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',4,1721),(21715077,'Trabajo Fin de Grado',4,1721),(21717001,'Estadistica',3,1717),(21717002,'Calculo',1,1717),(21717003,'Organizacion y Gestion de Empresas',1,1717),(21717004,'Fisica I',1,1717),(21717005,'Expresion Grafica y Diseño Asistido',1,1717),(21717006,'Fundamentos de Informatica',1,1717),(21717007,'Algebra y Geometria',1,1717),(21717008,'Quimica',1,1717),(21717009,'Fisica II',1,1717),(21717010,'Teoria y Estetica del Diseño Industrial',1,1717),(21717011,'Ampliacion de Matematicas',2,1717),(21717012,'Ingenieria Energetica y Fluidomecanica',3,1717),(21717013,'Resistencia de Materiales',2,1717),(21717014,'Teoria de Mecanismos y Maquinas',2,1717),(21717016,'Electronica y Automatizacion del Producto',2,1717),(21717017,'Ciencia e Ingenieria de los Materiales',2,1717),(21717018,'Procesos Industriales',2,1717),(21717019,'Dibujo Tecnico del Producto',2,1717),(21717020,'Proyectos de Diseño',4,1717),(21717021,'Desarrollo Historico-Culturales del Diseño Industrial',2,1717),(21717022,'Fundamentos del Diseño',3,1717),(21717023,'Diseño de Comunicacion',3,1717),(21717024,'Metodologia del Diseño',3,1717),(21717025,'Diseño Ergonomico y Ecodiseño',3,1717),(21717026,'Envase y Embalaje',3,1717),(21717027,'Diseño Asistido por Ordenador',3,1717),(21717028,'Ingeniera Grafica del Producto',3,1717),(21717029,'Materiales para el Diseño',3,1717),(21717030,'Calidad y Gestion del Diseño',4,1717),(21717031,'Creacion Digital',4,1717),(21717032,'Diseño Corporativo e Identidad Visual',4,1717),(21717033,'Taller de Diseño',4,1717),(21717034,'Fotografia y Tratamiento Digital',4,1717),(21717035,'Creacion de Nuevos Productos',4,1717),(21717036,'Desarrollo Optimo del Producto y Diseño de Experimentos',4,1717),(21717037,'Gestion del Ciclo de Vida del Producto',4,1717),(21717038,'Gestion y Evaluacion Virtual del Producto',4,1717),(21718001,'Algebra y Geometria',1,1718),(21718002,'Calculo',1,1718),(21718003,'Estadistica',1,1718),(21718004,'Ampliacion de Matematicas',2,1718),(21718005,'Fisica I',1,1718),(21718006,'Fisica II',1,1718),(21718007,'Quimica',1,1718),(21718008,'Fundamentos de Informatica',1,1718),(21718009,'Organizacion y Gestion de Empresas',1,1718),(21718010,'Expresion Grafica y Diseño Asistido',1,1718),(21718011,'Termotecnia',2,1718),(21718012,'Mecanica de Fluidos',2,1718),(21718013,'Ciencia e Ingenieria de los Materiales',1,1718),(21718014,'Electrotecnia ',2,1718),(21718016,'Automatica',2,1718),(21718018,'Elasticidad y Resistencia de Materiales I',2,1718),(21718019,'Ingenieria de Fabricacion',2,1718),(21718020,'Proyectos de Ingenieria',4,1718),(21718021,'Dibujo Industrial',3,1718),(21718023,'Gestion de la Produccion',3,1718),(21718024,'Prevencion Industrial de Riesgos',3,1718),(21718025,'Maquinas Electricas',3,1718),(21718026,'Accionamientos Electricos',3,1718),(21718027,'Instalaciones Electricas',3,1718),(21718028,'Lineas y Redes Electricas',3,1718),(21718029,'Sistemas Electricos de Potencia',3,1718),(21718031,'Centrales Electricas',3,1718),(21718032,'Diseño de Subestaciones y Centros de Transformacion',4,1718),(21718033,'Construccion y Ensayo de Maquinas Electricas',4,1718),(21718034,'Generacion Distribuida de Energia Electrica',4,1718),(21718035,'Mantenimiento Industrial Electrico',4,1718),(21718036,'Calidad de Suministro',4,1718),(21718037,'Medidas Electricas Industriales',4,1718),(21718038,'Aplicaciones Micro-Roboticas',4,1718),(21718039,'Gestion de la Calidad Industrial',4,1718),(21718040,'Modelos Matematicos y Estadisticos en Ingenieria',4,1718),(21718041,'Topografia',4,1718),(21718043,'Instalaciones Industriales',4,1718),(21718044,'Mantenimiento Industrial',4,1718),(21718045,'Oficina Tecnica, Legislación y Normalización en Ingenieria Industrial',4,1718),(21719001,'Algebra y Geometria',1,1719),(21719002,'Calculo',1,1719),(21719003,'Estadistica',1,1719),(21719004,'Ampliacion de Matematicas',2,1719),(21719005,'Fisica I',1,1719),(21719006,'Fisica II',1,1719),(21719007,'Quimica',1,1719),(21719008,'Fundamentos de Informatica',1,1719),(21719009,'Organizacion y Gestion de Empresas',1,1719),(21719010,'Expresion Grafica y Diseño Asistido',1,1719),(21719011,'Termotecnia',2,1719),(21719012,'Mecanica de Fluidos',2,1719),(21719013,'Ciencia e Ingenieria de los Materiales',1,1719),(21719016,'Automatica',2,1719),(21719018,'Elasticidad y Resistencia de Materiales I',2,1719),(21719019,'Ingenieria de Fabricacion',2,1719),(21719020,'Proyectos de Ingenieria',4,1719),(21719021,'Dibujo Industrial',3,1719),(21719023,'Gestion de la Produccion',3,1719),(21719024,'Prevencion Industrial de Riesgos',3,1719),(21719026,'Electronica Analogica',3,1719),(21719027,'Electronica Digital',3,1719),(21719028,'Electronica de Potencia',3,1719),(21719029,'Instrumentacion Electronica',3,1719),(21719030,'Regulacion Automatica',3,1719),(21719031,'Automatizacion Industrial',3,1719),(21719032,'Informatica Industrial',3,1719),(21719033,'Diseño Electronico Configurable',4,1719),(21719034,'Diseño y Desarrollo de Prototipos Electronicos',4,1719),(21719035,'Dispositivos Electronicos Avanzados',4,1719),(21719036,'Sistemas Automaticos en Edificios Inteligentes',4,1719),(21719037,'Tecnicas Avanzadas de Simulacion y Control de Procesos Industriales',4,1719),(21719038,'Sistemas Automaticos Basados en Microcontroladores',4,1719),(21719039,'Aplicaciones Micro-Roboticas',4,1719),(21719040,'Gestion de la Calidad Industrial',4,1719),(21719041,'Modelos Matematicos y Estadisticos en Ingenieria Industrial',4,1719),(21719042,'Topografia',4,1719),(21719044,'Instalaciones Industriales',4,1719),(21719045,'Mantenimiento Industrial',4,1719),(21719046,'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',4,1719),(21720001,'Algebra y Geometria',1,1720),(21720002,'Calculo',1,1720),(21720003,'Estadistica',1,1720),(21720004,'Ampliacion de Matematicas',2,1720),(21720005,'Fisica I',1,1720),(21720006,'Fisica II',1,1720),(21720007,'Química',1,1720),(21720008,'Fundamentos de Informatica',1,1720),(21720009,'Organizacion y Gestion de Empresas',1,1720),(21720010,'Expresion Grafica y Diseño Asistido',1,1720),(21720011,'Termotecnia',2,1720),(21720012,'Mecanica de Fluidos',2,1720),(21720013,'Ciencia e Ingenieria de los Materiales',1,1720),(21720014,'Electrotecnia',2,1720),(21720016,'Automatica',2,1720),(21720017,'Teoria de Mecanismos y Maquinas',2,1720),(21720018,'Elasticidad y Resistencia de Materiales I',2,1720),(21720019,'Ingenieria de Fabricacion',2,1720),(21720020,'Proyectos de Ingenieria',4,1720),(21720021,'Dibujo Industrial',3,1720),(21720023,'Gestion de la Produccion',3,1720),(21720024,'Prevencion Industrial de Riesgos',3,1720),(21720025,'Ingenieria Grafica',3,1720),(21720026,'Calculo, Construccion y Ensayo de Maquinas',3,1720),(21720027,'Ingenieria Termica',3,1720),(21720028,'Elasticidad y Resistencia de Materiales II',3,1720),(21720029,'Calculo y Diseño de Estructuras',3,1720),(21720030,'Ingenieria Fluidomecanica',3,1720),(21720031,'Ingenieria y Tecnologia de Materiales',3,1720),(21720032,'Tecnologias de Fabricacion',3,1720),(21720033,'Aparatos de Elevacion, Transporte y Manutencion',4,1720),(21720034,'Mecanica de Robots',4,1720),(21720035,'Mecanismos y Maquinas',4,1720),(21720036,'Fabricacion Asistida',4,1720),(21720037,'Ingenieria de Procesos de Conformado con Conservacion de Materiales',4,1720),(21720038,'Ingenieria del Mecanizado',4,1720),(21720039,'Estructuras Metalicas, de Hormigon y Cimentaciones',4,1720),(21720040,'Mecanica Analitica',4,1720),(21720041,'Metodos de Analisis de Estructuras',4,1720),(21720042,'Aplicaciones Micro-Roboticas',4,1720),(21720043,'Gestion de la Calidad Industrial',4,1720),(21720044,'Modelos Matematicos y Estadisticos en Ingenieria',4,1720),(21720045,'Topografia',4,1720),(21720047,'Instalaciones Industriales',4,1720),(21720048,'Mantenimiento Industrial',4,1720),(21720049,'Oficina Tecnica, Legislacion y Normalizacion en Ingenieria Industrial',4,1720);


DROP TABLE IF EXISTS `prof_subject`;
CREATE TABLE `prof_subject` (
  `id_subject` int DEFAULT NULL,
  `id_proffesor` int DEFAULT NULL,
  KEY `prof_subject_fk_id_proffesor` (`id_proffesor`),
  KEY `prof_subject_fk_id_subject` (`id_subject`),
  CONSTRAINT `prof_subject_fk_id_proffesor` FOREIGN KEY (`id_proffesor`) REFERENCES `proffesors` (`id`),
  CONSTRAINT `prof_subject_fk_id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `prof_subject` VALUES (21714001,61),(21714002,37),(21714003,42),(21714004,12),(21714004,14),(21714004,41),(21714004,43),(21714004,44),(21714005,45),(21714005,46),(21714005,47),(21714005,48),(21714006,40),(21714006,52),(21714006,57),(21714007,16),(21714007,30),(21714007,47),(21714007,54),(21714007,55),(21714007,59),(21714008,23),(21714008,58),(21714008,77),(21714008,78),(21714009,23),(21714010,58),(21714011,1),(21714011,2),(21714011,3),(21714011,16),(21714012,9),(21714012,40),(21714012,52),(21714013,11),(21714013,29),(21714013,53),(21714013,54),(21714013,55),(21714014,7),(21714014,8),(21714014,9),(21714014,10),(21714015,22),(21714015,29),(21714015,30),(21714015,31),(21714016,7),(21714016,8),(21714016,9),(21714016,38),(21714017,3),(21714017,8),(21714017,65),(21714018,5),(21714018,6),(21714019,12),(21714019,13),(21714019,14),(21714019,15),(21714020,31),(21714020,60),(21714020,64),(21714021,13),(21714021,15),(21714021,68),(21714022,4),(21714022,72),(21714022,73),(21714023,45),(21714023,47),(21714023,48),(21714023,69),(21714023,72),(21714024,21),(21714024,22),(21714024,25),(21714025,60),(21714026,63),(21714027,76),(21714028,11),(21714029,18),(21714029,62),(21714030,63),(21714030,67),(21714031,53),(21714032,12),(21714033,21),(21714033,51),(21714034,14),(21714035,28),(21714036,32),(21714036,33),(21714037,32),(21714038,5),(21714038,6),(21714039,34),(21714040,21),(21714040,35),(21714041,49),(21714042,22),(21714042,45),(21714042,69),(21714042,72),(21714042,75),(21714043,3),(21714043,19),(21714043,20),(21714044,19),(21714044,27),(21714045,20),(21714045,52),(21714046,39),(21714046,40),(21714047,24),(21714047,35),(21714048,24),(21714049,50),(21714049,51),(21714050,1),(21714050,2),(21714050,39),(21714051,50),(21714051,51),(21714052,61),(21714052,70),(21714052,71),(21714053,1),(21714053,2),(21714053,3),(21714054,19),(21714055,20),(21714055,74),(21714055,75),(21714056,1),(21714056,4),(21714057,34),(21714058,17),(21714058,18),(21714059,50),(21714059,69),(21714060,25),(21714060,26),(21714061,20),(21714061,35),(21714062,56),(21714063,64),(21715001,78),(21715002,94),(21715002,95),(21715002,96),(21715003,36),(21715003,109),(21715004,80),(21715008,17),(21715008,27),(21715008,56),(21715008,57),(21715008,60),(21715009,143),(21715009,144),(21715010,111),(21715010,112),(21715011,132),(21715011,152),(21715012,139),(21715012,140),(21715013,91),(21715013,92),(21715014,87),(21715014,107),(21715014,108),(21715016,84),(21715016,85),(21715016,86),(21715017,81),(21715017,151),(21715018,97),(21715018,103),(21715018,104),(21715018,105),(21715019,121),(21715019,126),(21715019,127),(21715020,136),(21715021,99),(21715021,100),(21715023,124),(21715023,125),(21715024,145),(21715024,146),(21715025,79),(21715025,88),(21715026,79),(21715027,101),(21715027,134),(21715028,101),(21715028,120),(21715028,134),(21715028,137),(21715029,122),(21715031,89),(21715031,90),(21715032,79),(21715038,82),(21715038,83),(21715040,130),(21715041,98),(21715042,129),(21715042,131),(21715042,132),(21715042,189),(21715043,97),(21715043,106),(21715044,97),(21715045,129),(21715046,133),(21715047,113),(21715047,149),(21715047,150),(21715048,89),(21715048,101),(21715049,88),(21715049,93),(21715050,120),(21715051,87),(21715051,88),(21715052,87),(21715052,88),(21715053,107),(21715056,102),(21715057,83),(21715058,153),(21715058,154),(21715060,81),(21715061,81),(21715062,138),(21715063,113),(21715063,114),(21715063,115),(21715064,114),(21715064,121),(21715065,121),(21715065,127),(21715065,128),(21715066,97),(21715066,110),(21715067,97),(21715067,104),(21715068,104),(21715068,106),(21715069,32),(21715069,33),(21715069,68),(21715070,115),(21715070,121),(21715070,122),(21715070,123),(21715071,94),(21715071,109),(21715072,111),(21715074,88),(21715074,135),(21715074,136),(21715075,81),(21715075,87),(21715075,88),(21715076,142),(21717001,167),(21717002,156),(21717003,143),(21717004,117),(21717004,169),(21717005,111),(21717005,112),(21717006,3),(21717006,11),(21717006,38),(21717006,48),(21717007,172),(21717008,148),(21717009,117),(21717009,170),(21717010,159),(21717011,156),(21717012,129),(21717013,104),(21717013,110),(21717014,138),(21717016,164),(21717016,165),(21717017,157),(21717018,126),(21717018,127),(21717019,100),(21717020,142),(21717020,146),(21717021,159),(21717022,168),(21717023,163),(21717024,158),(21717024,168),(21717025,162),(21717026,166),(21717027,161),(21717028,112),(21717028,158),(21717029,157),(21717029,171),(21717030,115),(21717031,25),(21717031,26),(21717032,162),(21717033,163),(21717033,168),(21717034,163),(21717035,158),(21717036,160),(21717037,115),(21717038,115),(21718001,172),(21718001,176),(21718002,94),(21718002,95),(21718002,96),(21718003,167),(21718004,80),(21718004,181),(21718004,182),(21718006,116),(21718006,117),(21718006,119),(21718007,173),(21718007,174),(21718007,175),(21718008,17),(21718008,27),(21718008,56),(21718008,57),(21718008,60),(21718009,180),(21718010,111),(21718010,177),(21718011,132),(21718011,152),(21718012,139),(21718012,140),(21718013,91),(21718013,92),(21718014,107),(21718014,108),(21718016,84),(21718016,86),(21718018,97),(21718018,103),(21718018,104),(21718018,105),(21718019,121),(21718019,126),(21718019,127),(21718020,136),(21718021,99),(21718021,100),(21718023,125),(21718023,179),(21718024,145),(21718024,146),(21718025,79),(21718025,88),(21718026,79),(21718027,101),(21718027,134),(21718028,101),(21718028,120),(21718028,134),(21718028,137),(21718029,122),(21718029,137),(21718031,89),(21718031,131),(21718031,132),(21718032,89),(21718032,101),(21718033,88),(21718033,93),(21718034,101),(21718034,120),(21718034,178),(21718035,87),(21718035,88),(21718036,87),(21718036,88),(21718037,107),(21718038,32),(21718038,33),(21718038,80),(21718039,115),(21718039,121),(21718039,122),(21718039,123),(21718040,94),(21718040,109),(21718041,111),(21718043,136),(21718044,81),(21718044,87),(21718044,88),(21718045,142);


DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `id_subject` int NOT NULL,
  `id_group` int NOT NULL,
  `id_proffesor` int NOT NULL,
  `id_question` int NOT NULL,
  `id_student` int NOT NULL,
  `option` int NOT NULL,
  KEY `polls_fk_id_subject` (`id_subject`),
  KEY `polls_fk_id_group` (`id_group`),
  KEY `polls_fk_id_proffesor` (`id_proffesor`),
  KEY `polls_fk_id_question` (`id_question`),
  KEY `polls_fk_id_student` (`id_student`),
  CONSTRAINT `polls_fk_id_group` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`),
  CONSTRAINT `polls_fk_id_proffesor` FOREIGN KEY (`id_proffesor`) REFERENCES `proffesors` (`id`),
  CONSTRAINT `polls_fk_id_question` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`),
  CONSTRAINT `polls_fk_id_student` FOREIGN KEY (`id_student`) REFERENCES `students` (`id`),
  CONSTRAINT `polls_fk_id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
