/* Delete Database*/
DROP DATABASE IF EXISTS hometech;

/* Create Database */
CREATE DATABASE hometech;

/* Use Database */
Use hometech;

/* Delete Tables*/
DROP TABLE IF EXISTS Users;

/* User Table */
CREATE TABLE Users (
    UserID int NOT NULL AUTO_INCREMENT,
    FullName varchar(255) NOT NULL,
    Username varchar(255) NOT NULL UNIQUE,
    Email VARCHAR(255) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN DEFAULT FALSE,
    PRIMARY KEY(UserID)
);