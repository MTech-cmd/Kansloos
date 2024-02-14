DROP DATABASE IF EXISTS `AssociationDB`;

CREATE DATABASE `AssociationDB`;

USE `AssociationDB`;

CREATE TABLE Profiles (
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
    Rank ENUM('S', 'A', 'B', 'C') NOT NULL DEFAULT 'C'
);

CREATE TABLE `Backstory` (
    BackstoryID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    HeroID INT NOT NULL UNIQUE,
    OriginStory VARCHAR(300),
    Motivation VARCHAR(150),
    FOREIGN KEY (HeroID) REFERENCES Profiles(HeroID)
);

CREATE TABLE `Powers` (
    PowersID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    HeroID INT NOT NULL UNIQUE,
    PrimaryPower VARCHAR(50),
    Info TEXT,
    FOREIGN KEY (HeroID) REFERENCES Profiles(HeroID)
);

CREATE TABLE `Chronicle` (
    ChronicleID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    HeroID INT NOT NULL UNIQUE,
    DeedDate DATE,
    DeedDescription VARCHAR(500),
    Affiliation VARCHAR(100),
    FOREIGN KEY (HeroID) REFERENCES Profiles(HeroID)
);

CREATE TABLE `Admins` (
    AdminID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50)
);

CREATE TABLE `Accounts` (
    AccountID INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    AdminID INT UNIQUE,
    HeroID INT UNIQUE,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(100) NOT NULL,
    RecoveryEmail VARCHAR(50) NOT NULL,
    FOREIGN KEY (AdminID) REFERENCES Admins(AdminID),
    FOREIGN KEY (HeroID) REFERENCES Profiles(HeroID)
);