/* creates database */
DROP DATABASE IF EXISTS richard_davis_student_db;
CREATE DATABASE richard_davis_student_db;
USE richard_davis_student_db;

/* creates major table */
CREATE TABLE major (
  majorID     INT(11)       NOT NULL   AUTO_INCREMENT,
  majorName   VARCHAR(255)  NOT NULL,
  PRIMARY KEY (majorID)
);

/* creates student table */
CREATE TABLE student (
  studentID   INT(11)       NOT NULL   AUTO_INCREMENT,
  majorID     INT(11)       NOT NULL,
  lastName    VARCHAR(255)  NOT NULL,
  firstName   VARCHAR(255)  NOT NULL,
  gender      VARCHAR(255)  NOT NULL,
  PRIMARY KEY (studentID),
  FOREIGN KEY (majorID) REFERENCES major(majorID)
);

/* inserts test data into major table */
INSERT INTO major VALUES
(1, 'Computer Science'),
(2, 'Art'),
(3, 'Architecture');

/* inserts test data into student table */
INSERT INTO student VALUES
(1, '1', 'Davis', 'Richard', 'Male'),
(2, '1', 'Smith', 'John', 'Male'),
(3, '3', 'Johnson', 'Ron', 'Male'),
(4, '1', 'Lopez', 'Mary', 'Female');

/* creates user */
GRANT SELECT, INSERT, UPDATE, DELETE
ON richard_davis_student_db.*
TO richardricardo1@localhost
IDENTIFIED BY 'richardisgreat'
