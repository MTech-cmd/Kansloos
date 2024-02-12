DROP DATABASE IF EXISTS `AssociationDB`;

CREATE DATABASE `AssociationDB`;

USE `AssociationDB`;

CREATE TABLE `Profile` (
    HeroID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    HeroAlias VARCHAR(50),
    BirthDate DATE,
    StartDate DATE NOT NULL,
    PrimaryEmail VARCHAR(50),
    PhoneNumber VARCHAR(20),
    EmergencyContact VARCHAR(50),
    ELO INT,
    Rank ENUM('S', 'A', 'B', 'C')
);

CREATE TABLE `Backstory` (
    HeroID INT PRIMARY KEY,
    OriginStory VARCHAR(300),
    Motivation VARCHAR(150),
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
    UserName VARCHAR(50),
    Password VARCHAR(100),
    RecoveryEmail VARCHAR(50),
    AdminRights BOOLEAN,
    FOREIGN KEY (AdminID) REFERENCES Admins(AdminID),
    FOREIGN KEY (HeroID) REFERENCES Profile(HeroID)
);