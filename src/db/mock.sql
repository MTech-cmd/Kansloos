USE `AssociationDB`;

INSERT INTO `Admins` (FirstName, LastName) VALUES
('Felix', 'Huel'),
('Mehdi', 'El Khallouki');

INSERT INTO `Accounts` (AdminID, Username, Password, RecoveryEmail) VALUES
(1, 'admin', '$2y$10$1Yr1qomL0H7rZQOeNNIQc.PMeBE7rMJCW.Qn24zQJptXKAU0smvwq', 'felix.huel6@gmail.com'),
(2, 'root', '$2y$10$CG2woYxSQ5nwS4ih/yHDqe4WSFsun2D3bie8DPL2ckO0c1ptQKlee', 'mehdiek03@gmail.com');

INSERT INTO `Profile` (FirstName, LastName, Alias, BirthDate, StartDate, PrimaryEmail, PhoneNumber, EmergencyContact, ELO, Rank) VALUES
('Saitama', '', 'Caped Baldy', '1999-02-07', '2015-10-04', 'saitama@gmail.com', '0612345678', '', '', 'A'); 