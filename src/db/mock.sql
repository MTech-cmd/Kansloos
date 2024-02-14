USE `AssociationDB`;

INSERT INTO `Admins` (FirstName, LastName) 
VALUES
    ('Felix', 'Huel'),
    ('Mehdi', 'El Khallouki');

INSERT INTO `Accounts` (AdminID, Username, Password, RecoveryEmail) 
VALUES
    (1, 'admin', '$2y$10$1Yr1qomL0H7rZQOeNNIQc.PMeBE7rMJCW.Qn24zQJptXKAU0smvwq', 'felix.huel6@gmail.com'),
    (2, 'root', '$2y$10$CG2woYxSQ5nwS4ih/yHDqe4WSFsun2D3bie8DPL2ckO0c1ptQKlee', 'mehdiek03@gmail.com');

INSERT INTO `Profiles` (FirstName, LastName, Alias, Picture, BirthDate, StartDate, PrimaryEmail, PhoneNumber, EmergencyContact, ELO, Rank) 
VALUES
    ('Burasuto', '', 'Blast', 'uploads/blast.jpg', '1987-06-23', '2005-11-14', 'blast@gmail.com', '0687654321', '', '2000', 'S'),
    ('Saitama', '', 'Caped Baldy', 'uploads/saitama.jpg', '1999-02-07', '2015-10-04', 'saitama@gmail.com', '0612345678', '', '1200', 'A'),
    ('Fubuki', '', 'Miss Blizzard', 'uploads/fubuki.jpg', '2001-05-15', '2017-06-20', 'fubuki@gmail.com', '0698765432', '', '1500', 'B'),
    ('Umabon', '', 'Horse-Bone', 'uploads/horsebone.jpg', '1991-09-01', '2013-03-02', 'umabon@gmail.com', '0623456789', '', '1000', 'C');