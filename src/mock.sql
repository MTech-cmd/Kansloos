USE `AssociationDB`;

INSERT INTO `Admins` (FirstName, LastName) VALUES
('Felix', 'Huel'),
('Mehdi', 'El Khallouki');

INSERT INTO `Profile` (FirstName, Alias, StartDate) VALUES
('Saitama', 'One Punch Man', '2024-02-03');

INSERT INTO `Accounts` (AdminID, Username, Password, RecoveryEmail) VALUES
(2, 'root', 'password', 'mehdiek03@gmail.com');

INSERT INTO `Accounts` (HeroID, Username, Password, RecoveryEmail) VALUES
(1, 'hero', 'password', 'mehdiek@outlook.com');