DROP SCHEMA IF EXISTS poll;

CREATE SCHEMA poll DEFAULT CHARACTER SET utf8;
USE poll;

CREATE TABLE uca_answer
(
  value        INT NOT NULL,
  votes        INT NOT NULL,
  id_question  INT NOT NULL,
  id_proffesor INT NOT NULL,
  id_student   INT NOT NULL
);

CREATE TABLE uca_degree
(
  id   INT          NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE uca_degree
  ADD CONSTRAINT UQ_name UNIQUE (name);

CREATE TABLE uca_group
(
  id INT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id)
);

CREATE TABLE uca_poll
(
  id_subject INT NOT NULL,
  id_group   INT NOT NULL,
  id_student INT NOT NULL
);

CREATE TABLE uca_proffesor
(
  id   INT          NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE uca_question
(
  id          INT          NOT NULL AUTO_INCREMENT,
  type        VARCHAR(255) NOT NULL,
  subtype     VARCHAR(255) NULL    ,
  description VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE uca_question
  ADD CONSTRAINT UQ_type UNIQUE (type);

ALTER TABLE uca_question
  ADD CONSTRAINT UQ_description UNIQUE (description);

CREATE TABLE uca_student
(
  id             INT          NOT NULL AUTO_INCREMENT,
  age            INT          NOT NULL,
  gender         VARCHAR(255) NOT NULL,
  highest_course INT          NOT NULL,
  lowest_course  INT          NOT NULL,
  enrollment     INT          NOT NULL,
  exam           INT          NOT NULL,
  interest       VARCHAR(255) NOT NULL,
  mentoring      VARCHAR(255) NOT NULL,
  dificulty      VARCHAR(255) NOT NULL,
  expected_grade VARCHAR(255) NOT NULL,
  assistance     FLOAT        NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE uca_subject
(
  id        INT          NOT NULL AUTO_INCREMENT,
  name      VARCHAR(255) NOT NULL,
  id_degree INT          NOT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE uca_subject
  ADD CONSTRAINT UQ_name UNIQUE (name);

ALTER TABLE uca_subject
  ADD CONSTRAINT FK_uca_degree_TO_uca_subject
    FOREIGN KEY (id_degree)
    REFERENCES uca_degree (id);

ALTER TABLE uca_poll
  ADD CONSTRAINT FK_uca_subject_TO_uca_poll
    FOREIGN KEY (id_subject)
    REFERENCES uca_subject (id);

ALTER TABLE uca_poll
  ADD CONSTRAINT FK_uca_group_TO_uca_poll
    FOREIGN KEY (id_group)
    REFERENCES uca_group (id);

ALTER TABLE uca_answer
  ADD CONSTRAINT FK_uca_question_TO_uca_answer
    FOREIGN KEY (id_question)
    REFERENCES uca_question (id);

ALTER TABLE uca_answer
  ADD CONSTRAINT FK_uca_proffesor_TO_uca_answer
    FOREIGN KEY (id_proffesor)
    REFERENCES uca_proffesor (id);

ALTER TABLE uca_poll
  ADD CONSTRAINT FK_uca_student_TO_uca_poll
    FOREIGN KEY (id_student)
    REFERENCES uca_student (id);

ALTER TABLE uca_answer
  ADD CONSTRAINT FK_uca_student_TO_uca_answer
    FOREIGN KEY (id_student)
    REFERENCES uca_student (id);