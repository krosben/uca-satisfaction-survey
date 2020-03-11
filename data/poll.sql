DROP SCHEMA IF EXISTS poll;
CREATE SCHEMA poll;
USE poll;
CREATE TABLE answer (
  value INT NOT NULL,
  votes INT NOT NULL,
  id_question INT NOT NULL,
  id_proffesor INT NOT NULL,
  id_student INT NOT NULL
);
CREATE TABLE degree (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
ALTER TABLE degree
ADD
  CONSTRAINT UQ_name UNIQUE (name);
CREATE TABLE group (
    id INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (id)
  );
CREATE TABLE poll (
    id_subject INT NOT NULL,
    id_group INT NOT NULL,
    id_student INT NOT NULL
  );
CREATE TABLE proffesor (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
  );
CREATE TABLE question (
    id INT NOT NULL AUTO_INCREMENT,
    type VARCHAR(255) NOT NULL,
    subtype VARCHAR(255) NULL,
    description VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
  );
ALTER TABLE question
ADD
  CONSTRAINT UQ_type UNIQUE (type);
ALTER TABLE question
ADD
  CONSTRAINT UQ_description UNIQUE (description);
CREATE TABLE student (
    id INT NOT NULL AUTO_INCREMENT,
    age INT NOT NULL,
    gender VARCHAR(255) NOT NULL,
    highest_course INT NOT NULL,
    lowest_course INT NOT NULL,
    enrollment INT NOT NULL,
    exam INT NOT NULL,
    interest VARCHAR(255) NOT NULL,
    mentoring VARCHAR(255) NOT NULL,
    dificulty VARCHAR(255) NOT NULL,
    expected_grade VARCHAR(255) NOT NULL,
    assistance FLOAT NOT NULL,
    PRIMARY KEY (id)
  );
CREATE TABLE subject (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    id_degree INT NOT NULL,
    PRIMARY KEY (id)
  );
ALTER TABLE subject
ADD
  CONSTRAINT UQ_name UNIQUE (name);
ALTER TABLE subject
ADD
  CONSTRAINT FK_degree_TO_subject FOREIGN KEY (id_degree) REFERENCES degree (id);
ALTER TABLE poll
ADD
  CONSTRAINT FK_subject_TO_poll FOREIGN KEY (id_subject) REFERENCES subject (id);
ALTER TABLE poll
ADD
  CONSTRAINT FK_group_TO_poll FOREIGN KEY (id_group) REFERENCES group (id);
ALTER TABLE answer
ADD
  CONSTRAINT FK_question_TO_answer FOREIGN KEY (id_question) REFERENCES question (id);
ALTER TABLE answer
ADD
  CONSTRAINT FK_proffesor_TO_answer FOREIGN KEY (id_proffesor) REFERENCES proffesor (id);
ALTER TABLE poll
ADD
  CONSTRAINT FK_student_TO_poll FOREIGN KEY (id_student) REFERENCES student (id);
ALTER TABLE answer
ADD
  CONSTRAINT FK_student_TO_answer FOREIGN KEY (id_student) REFERENCES student (id);