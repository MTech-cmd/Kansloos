USE `AssociationDB`;

INSERT INTO `admins` (`AdminID`, `FirstName`, `LastName`) VALUES
(1, 'Felix', 'Huel'),
(2, 'Mehdi', 'El Khallouki');

INSERT INTO `Profiles` (`HeroID`, `FirstName`, `LastName`, `Alias`, `Picture`, `BirthDate`, `StartDate`, `PrimaryEmail`, `PhoneNumber`, `EmergencyContact`, `ELO`, `Rank`) 
VALUES
    (1, 'Arno', 'Q', 'Meatballman', 'uploads/65cdd854975a4_meatballman.jpg', '1988-01-09', '2024-02-15', 'djdjdk@fkdkkd.nl', '', '', 9001, 'S'),
    (2, 'Joris', 'Schelfhout', 'The Visionary Virtuoso', 'uploads/65cddc94397ca_visionary.jpg', '1998-03-10', '2024-02-15', 'joris@mail.com', '', '', 8100, 'S'),
    (3, 'Fubuki', '', 'Miss Blizzard', 'uploads/65cde5e53daf3_fubuki.jpg', '2001-05-15', '2024-02-15', 'fubuki@outlook.com', '', '', 1200, 'C'),
    (4, 'Kaito', 'Yamada', 'Fatigue Man', 'uploads/65cdee0668b7b_Fatigueman.jpg', '2004-12-03', '2024-02-15', 'kaito@gmail.com', '', '', 1200, 'C'),
    (5, 'Yui', 'Nakamura', 'Spectral Guardian', 'uploads/65cdf0982c1ce_guardian.jpg', '2001-11-30', '2024-02-15', 'spectral@hero.net', '', '', 1200, 'C'),
    (6, 'Hiro', 'Suzuki', 'Meteor Blaze', 'uploads/65cdf244c3b9c_meteor.jpg', '1999-06-12', '2024-02-15', 'meteor@blaze.co', '', '', '1200', 'C'),
    (7, 'Jan', 'Vrouw', 'Jammer Man', 'uploads/65cdf4293a18a_jammerman.jpg', '1970-07-16', '2024-02-15', 'jammerman@nederland.nl', '', '', '1200', 'C');

INSERT INTO `Backstory` (`BackstoryID`, `HeroID`, `OriginStory`, `Motivation`)
VALUES
    (1, 1, 'Meatballman was a normal, day to day Italian cook...UNTIL he was robbed and fell into a giant pot with meatballs with a special ingredient: Formula M! From that day on he was...Meatballman!', 'It is my meaty calling'),
    (2, 2, 'His company, SMIT Innovations, was on the brink of unveiling a technology that would revolutionize the worlds energy resources. However, during a catastrophic event where his tech was manipulated by dark forces, he encountered a mysterious cosmic entity.', 'My mom said I could be whatever I want if I believe in myself'),
    (3, 3, 'I was born in the city of Z-City. I am a normal human until I was struck by a mysterious beam of light. I gained psychic powers. I decided to use her powers to protect the city.', 'I want to be the strongest psychic in the world.'),
    (4, 4, 'I was an ordinary high school student with a passion for helping others. However, I struggled with chronic fatigue. One night, a mysterious crystal landed in my backyard. Upon touching it, I was granted extraordinary powers of stamina and endurance', 'I aim to inspire those who feel overwhelmed by their daily struggles, showing them that their greatest weakness can become their most potent strength'),
    (5, 5, 'After a near-death experience, Yui gained the ability to see spirits, using this power to fight malevolent entities.', 'To bridge the gap between the living and the dead, ensuring peace and protection for both realms.'),
    (6, 6, 'Hiro was an astronaut struck by a meteorite in space, granting him control over fire and the ability to fly.', 'To be a beacon of hope, using his cosmic powers to guard Earth against celestial dangers.'),
    (7, 7, 'My mom always told me "Jammer man"', 'Because otherwise I will get it');

INSERT INTO `Powers` (`PowersID`, `HeroID`, `PrimaryPower`, `Info`)
VALUES
    (1, 1, 'Generating meatballs at incredible speeds', 'I am meatball bullit proof'),
    (2, 2, 'ability to visualize and manipulate energy fields', 'create shields, project energy blasts, and even fly. His glasses, a remnant of his past life, are now enhanced with technology that lets him see energy patterns and weaknesses in his opponents defenses.'),
    (3, 3, 'Psychic Powers', 'Fubuki can create psychic barriers.'),
    (4, 4, 'stamina and endurance', ''),
    (5, 5, 'Spirit Fighting', ''),
    (6, 6, 'Fire powers', ''),
    (7, 7, 'Bringing bad luck', 'Jammer man');

INSERT INTO `Accounts` (`AccountID`, `AdminID`, `HeroID`, `Username`, `Password`, `RecoveryEmail`)
VALUES
    (1, NULL, 1, 'Spicyball', '$2y$10$wyEgAclN1/qGd4CRYmu8/ud5.AhmfeR2nEPV9ZqrsJDmlBOFaxDBK', 'felix.huel6@gmail.com'), -- password = meat
    (2, NULL, 2, 'TheVisionary', '$2y$10$twQH0znfnFN39evEgeTZ4eXtzaC1BZdcPD8NZWE1LqpW8sakvLqiS', 'joris@mail.com'), -- password = vision
    (3, NULL, 3, 'blizzard', '$2y$10$w3jspyMgXj.3dcj/MZaFN.R/rURH3vy.drX26AZnZMVtJBIIhw3zW', 'fubuki@outlook.com'), -- password = fubuki
    (4, NULL, 4, 'kaitoy', '$2y$10$XHgNjAp99BLja5irRU7g0eSMl0QZZeJf/Pqxdg0eyqXw884OYC6X2', 'kaito@gmail.com'), -- password = tired
    (5, NULL, 5, 'guardian', '$2y$10$x.wtz9a70D9Ptu55UX3kveD1IdtT2r.H/4xK70bgVq2JuU1aJo5Mq', 'spectral@hero.net'), -- password = yui
    (6, NULL, 6, 'meteor', '$2y$10$.Y2spQPddAMSYOXgvZGLK.LSe0PQr296uCVGDwtPFd4nZ9F6TLYhC', 'meteor@blaze.co'), -- password = blaze
    (7, NULL, 7, 'jammerman', '$2y$10$xryfu6yy7pPDDWR0ZnUrkuf1XuJyuoUPJovlepo/nLMIOfEKWyhzW', 'jammerman@nederland.nl'), -- password = jammer
    (8, 1, NULL, 'admin', '$2y$10$1Yr1qomL0H7rZQOeNNIQc.PMeBE7rMJCW.Qn24zQJptXKAU0smvwq', 'felix.huel6@gmail.com'),
    (9, 2, NULL, 'root', '$2y$10$CG2woYxSQ5nwS4ih/yHDqe4WSFsun2D3bie8DPL2ckO0c1ptQKlee', 'mehdiek03@gmail.com');