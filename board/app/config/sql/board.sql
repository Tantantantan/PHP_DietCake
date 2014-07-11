--
-- Create database
--
CREATE DATABASE IF NOT EXISTS board;
GRANT SELECT, INSERT, UPDATE, DELETE ON board.* TO board_root@localhost IDENTIFIED BY 'board_root';
FLUSH PRIVILEGES;
--
-- Create tables
--
USE board;
CREATE TABLE IF NOT EXISTS user (
id 			INT UNSIGNED NOT NULL AUTO_INCREMENT,
nickname	VARCHAR(10)  NOT NULL,
username 	VARCHAR(20)  NOT NULL,
password 	VARCHAR(20)  NOT NULL,
email		VARCHAR(255) NOT NULL,
PRIMARY KEY (id),
UNIQUE (username, email)
)ENGINE=InnoDB;