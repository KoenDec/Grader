DROP DATABASE `graderDB`;

CREATE DATABASE `graderDB`;

USE `graderDB`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(100) NOT NULL UNIQUE,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `language` enum('NL','EN') NOT NULL DEFAULT 'NL',
  `activationKey` varchar(100) DEFAULT NULL,
  `status` enum('WAIT_ACTIVATION','ACTIVE','DISABLED') NOT NULL DEFAULT 'WAIT_ACTIVATION',
  `accountCreatedTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resetcode` char(36) DEFAULT NULL,
  `creatorId` int
);

CREATE TABLE `admins` (
  `adminId` int NOT NULL,
  `stillAdmin` tinyint(1) NOT NULL DEFAULT '1',
  FOREIGN KEY(adminId) REFERENCES users(id)
);

ALTER TABLE `users` ADD CONSTRAINT FK_users_creator FOREIGN KEY(creatorId) REFERENCES admins(adminId);

CREATE TABLE `loginTokens` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` char(64) NOT NULL UNIQUE,
  `userId` int NOT NULL,
  FOREIGN KEY(userId) REFERENCES users(id)
);

CREATE TABLE `teachers` (
  `teacherId` int NOT NULL,
  `stillTeacher` tinyint(1) NOT NULL DEFAULT '1',
  FOREIGN KEY(teacherId) REFERENCES users(id)
);

CREATE TABLE `studenten` (
  `studentId` int NOT NULL,
  `stilLStudent` tinyint(1) NOT NULL DEFAULT '1',
  FOREIGN KEY(studentId) REFERENCES users(id)
);

CREATE TABLE `opleidingen` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL UNIQUE,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `modules` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `opleidingId` int,
  `creatorId` int,
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `doelstellingscategories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) NOT NULL,
  `moduleId` int NOT NULL,
  `teacherId` int NOT NULL,
  `creatorId` int,
  FOREIGN KEY(moduleId) REFERENCES modules(id),
  FOREIGN KEY(teacherId) REFERENCES teachers(teacherId),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

create table `studenten_doelstellingscategories` (
  `doelstellingscategorieId` int NOT NULL,
  `studentId` int NOT NULL,
  `opleidingId` int DEFAULT NULL,
  `status` enum('Volgt','Beëindigd') NOT NULL DEFAULT 'Volgt',
  CONSTRAINT PK_studenten_doelstellingen PRIMARY KEY (doelstellingscategorieId, studentId),
  FOREIGN KEY(doelstellingscategorieId) REFERENCES doelstellingscategories(id),
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id),
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)
  
	-- TODO DODO
    --
    -- opleidingId in werkfiches can be null because some werkfiches are general and are used in all opleidingen.
    -- opleidingId in studenten_doelstellingscategories is default null because the opleidingId is already mentioned in werkfiches.
    -- SO
    -- if you add a record in studenten_doelstellingscategories and for the werkfiche that that module belongs to the oplidingId is null
    -- a constraint should oblige you to fill out the opleidingId in studenten_doelstellingscategories.
    -- (if dat is possible in mysql)
  
);

CREATE TABLE `doelstellingen` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doelstellingscategorieId` int NOT NULL,
  `weergaveTitel` varchar(200) NOT NULL,
  `inGebruik` tinyint(1) NOT NULL DEFAULT 1,
  `creatorId` int,
  FOREIGN KEY(doelstellingscategorieId) REFERENCES doelstellingscategories(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `rapporten` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `studentId` int NOT NULL,
  `feedback` text,
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)
);

CREATE TABLE `rapporten_scores` (
  `rapportId` int NOT NULL,
  `doelstellingId` int NOT NULL,
  `score` enum('ZG', 'G', 'V', 'OV', 'RO', 'A') NOT NULL,
  CONSTRAINT PK_rapporten_scores PRIMARY KEY (rapportId, doelstellingId),
  FOREIGN KEY(rapportId) REFERENCES rapporten(id),
  FOREIGN KEY(doelstellingId) REFERENCES doelstellingen(id)
);

CREATE TABLE `meldingen` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `teacherId` int NOT NULL,
  `titel` varchar(100),
  `tekst` text NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(teacherId) REFERENCES teachers(teacherId)
);

CREATE TABLE `meldingen_opleidingen` (
  `meldingId` int NOT NULL,
  `opleidingId` int NOT NULL,
  CONSTRAINT PK_meldingen_opleidingen PRIMARY KEY (meldingId, opleidingId),
  FOREIGN KEY(meldingId) REFERENCES meldingen(id),
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id)
);