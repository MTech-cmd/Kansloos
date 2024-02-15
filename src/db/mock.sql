USE `AssociationDB`;

INSERT INTO `Admins` (`FirstName`, `LastName`) 
VALUES
    ('Felix', 'Huel'),
    ('Mehdi', 'El Khallouki');

INSERT INTO `Accounts` (`AdminID`, `Username`, `Password`, `RecoveryEmail`) 
VALUES
    (1, 'admin', '$2y$10$1Yr1qomL0H7rZQOeNNIQc.PMeBE7rMJCW.Qn24zQJptXKAU0smvwq', 'felix.huel6@gmail.com'),
    (2, 'root', '$2y$10$CG2woYxSQ5nwS4ih/yHDqe4WSFsun2D3bie8DPL2ckO0c1ptQKlee', 'mehdiek03@gmail.com');

INSERT INTO `Profiles` (`FirstName`, `LastName`, `Alias`, `Picture`, `BirthDate`, `StartDate`, `PrimaryEmail`, `PhoneNumber`, `EmergencyContact`, `ELO`, `Rank`) 
VALUES
    ('Burasuto', '', 'Blast', 'uploads/blast.jpg', '1987-06-23', '2005-11-14', 'blast@gmail.com', '0687654321', '', '2000', 'S'),
    ('Saitama', '', 'Caped Baldy', 'uploads/saitama.jpg', '1999-02-07', '2015-10-04', 'saitama@gmail.com', '0612345678', '', '1200', 'A'),
    ('Fubuki', '', 'Miss Blizzard', 'uploads/fubuki.jpg', '2001-05-15', '2017-06-20', 'fubuki@gmail.com', '0698765432', '', '1500', 'B'),
    ('Umabon', '', 'Horse-Bone', 'uploads/horsebone.jpg', '1991-09-01', '2013-03-02', 'umabon@gmail.com', '0623456789', '', '1000', 'C');

INSERT INTO `Backstory` (`HeroID`, `OriginStory`, `Motivation`)
VALUES
    (1, 'Burasuto was born in the city of Z-City. He was a normal human until he was struck by a mysterious beam of light. He gained superhuman strength and speed. He decided to use his powers to protect the city.', 'Burasuto wants to protect the city from any threat that comes its way.'),
    (2, 'Saitama was a normal human until he trained so hard that he lost all of his hair. He gained superhuman strength and speed. He decided to use his powers to protect the city.', 'Saitama wants to find a worthy opponent.'),
    (3, 'Fubuki was born in the city of Z-City. She was a normal human until she was struck by a mysterious beam of light. She gained psychic powers. She decided to use her powers to protect the city.', 'Fubuki wants to be the strongest psychic in the world.'),
    (4, 'Umabon was born in the city of Z-City. He was a normal human until he was struck by a mysterious beam of light. He gained superhuman strength and speed. He decided to use his powers to protect the city.', 'Umabon wants to be the strongest hero in the world.');

INSERT INTO `Powers` (`HeroID`, `PrimaryPower`, `Info`)
VALUES
    (1, 'Superhuman Strength', 'Burasuto can lift up to 100 tons.'),
    (2, 'Superhuman Strength', 'Saitama can defeat any opponent with a single punch.'),
    (3, 'Psychic Powers', 'Fubuki can create psychic barriers.'),
    (4, 'Superhuman Strength', 'Umabon can lift up to 100 tons.');

INSERT INTO `Chronicle` (`HeroID`, `DeedDate`, `DeedDescription`, `Affiliation`)
VALUES
    (1, '2020-01-01', 'Burasuto saved the city from a giant monster.', 'Hero Association'),
    (2, '2020-01-01', 'Saitama saved the city from a giant monster.', 'Hero Association'),
    (3, '2020-01-01', 'Fubuki saved the city from a giant monster.', 'Hero Association'),
    (4, '2020-01-01', 'Umabon saved the city from a giant monster.', 'Hero Association');

INSERT INTO `Accounts` (`HeroID`, `Username`, `Password`, `RecoveryEmail`)
VALUES
    (1, 'blast', '$2y$10$ABcdEfGhIjKlmNopQrStuVwXyzAbCdEfGhIjKlmNopQrStuVwXyz', 'blast@gmail.com'), // password: blast
    (2, 'saitama', '$2y$10$CDefGhIjKlMnOpQrStUvWxYz.ABcDeFGhIjKlMnOpQrStUvWxYz', 'saitama@gmail.com'), // password: bald
    (3, 'fubuki', '$2y$10$CDefGhIjKlMnOpQrStUvWxYz.ABcDeFGhIjKlMnOpQrStUvWxYz', 'fubuku@gmail.com'), // password: miss
    (4, 'umabon', '$2y$10$XyZAbCdeFGhIjKlMnOpqRs.tUvWxYzAbCdeFGhIjKlMnOpqRs.tUv', 'umabon@gmail.com'); // password: horse