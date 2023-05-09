CREATE DATABASE test;

USE test;

CREATE TABLE `test`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `password` VARCHAR(20) NOT NULL,
  `cpf` VARCHAR(14) NOT NULL,
  `dt_birth` DATE,
  `gender` VARCHAR(20),
  `marital_status` VARCHAR(20),
  `education_level` VARCHAR(200),
  `courses` VARCHAR(200),
  `professional_experience` VARCHAR(200),
  `salary_claim` INT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`));