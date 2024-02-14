DROP DATABASE IF EXISTS `AssociationDB`;

CREATE DATABASE `AssociationDB`;

USE `AssociationDB`;

CREATE TABLE `Profile` (
    HeroID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Alias VARCHAR(50),
    Picture VARCHAR(255),
    BirthDate DATE,
    StartDate DATE NOT NULL,
    PrimaryEmail VARCHAR(50),
    PhoneNumber VARCHAR(30),
    EmergencyContact VARCHAR(50),
    ELO INT,
    Rank ENUM('S', 'A', 'B', 'C') NOT NULL
);

CREATE TABLE `Backstory` (
    HeroID INT PRIMARY KEY,
    OriginStory VARCHAR(300),
    Motivation VARCHAR(150),
    FOREIGN KEY (HeroID) REFERENCES Profile(HeroID)
);

CREATE TABLE `Powers` (
    HeroID INT PRIMARY KEY,
    PrimaryPower VARCHAR(50),
    Info TEXT,
    FOREIGN KEY (HeroID) REFERENCES Profile(HeroID)
);

CREATE TABLE `Chronicle` (
    ChronicleID INT AUTO_INCREMENT PRIMARY KEY,
    HeroID INT,
    DeedDate DATE,
    DeedDescription VARCHAR(500),
    Affiliation VARCHAR(100),
    FOREIGN KEY (HeroID) REFERENCES Profile(HeroID)
);

CREATE TABLE `Admins` (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50)
);

CREATE TABLE `Accounts` (
    AdminID INT,
    HeroID INT,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(100) NOT NULL,
    RecoveryEmail VARCHAR(50) NOT NULL,
    FOREIGN KEY (AdminID) REFERENCES Admins(AdminID),
    FOREIGN KEY (HeroID) REFERENCES Profile(HeroID)
);