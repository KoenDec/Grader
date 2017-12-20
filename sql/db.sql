DROP DATABASE `graderDB`;

CREATE DATABASE `graderDB` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `graderDB`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(100) NOT NULL UNIQUE,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `gender` enum('M', 'F') NOT NULL,
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
  `teacherId` int NOT NULL,
  `creatorId` int,
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id),
  FOREIGN KEY(teacherId) REFERENCES teachers(teacherId),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `doelstellingscategories` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `moduleId` int NOT NULL,
  `inGebruik` tinyint(1) NOT NULL DEFAULT 1,
  `creatorId` int,
  FOREIGN KEY(moduleId) REFERENCES modules(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `doelstellingen` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doelstellingscategorieId` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `inGebruik` tinyint(1) NOT NULL DEFAULT 1,
  `creatorId` int,
  FOREIGN KEY(doelstellingscategorieId) REFERENCES doelstellingscategories(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `evaluatiecriteria` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `doelstellingId` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `gewicht` int NOT NULL DEFAULT 1,
  `inGebruik` tinyint(1) NOT NULL DEFAULT 1,
  `creatorId` int,
  FOREIGN KEY(doelstellingId) REFERENCES doelstellingen(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `aspecten` (
  `id`int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `evaluatiecriteriumId` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `inGebruik` tinyint(1) NOT NULL DEFAULT 1,
  `gewicht` int NOT NULL DEFAULT 1,
  `creatorId` int,
  FOREIGN KEY(evaluatiecriteriumId) REFERENCES evaluatiecriteria(id),
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

create table `studenten_modules` (
  `moduleId` int NOT NULL,
  `studentId` int NOT NULL,
  `opleidingId` int DEFAULT NULL,
  `status` enum('Volgt','Beëindigd') NOT NULL DEFAULT 'Volgt',
  CONSTRAINT PK_studenten_modules PRIMARY KEY (moduleId, studentId),
  FOREIGN KEY(moduleId) REFERENCES modules(id),
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id),
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)

  -- TODO DODO
  --
  -- opleidingId in modules CAN BE NULL because some modules are general and are used in alle opleidingen.
  -- opleidingId in studenten_modules is default null because the opleidingId is already mentioned in modules.
  -- SO!!
  -- if you add a record in studenten_modules and for the module that that doelstellingscategorie belongs to the opleidingId is null,
  -- a constraint should oblige you to fill out the opleidingId in studenten_doelstellingscategories.
  -- (if dat is possible in mysql)
);

CREATE TABLE `evaluaties` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(150) NOT NULL UNIQUE,
  `studentId` int NOT NULL,
  `moduleId` int NOT NULL,
  `datum` date NOT NULL,
  FOREIGN KEY(studentId) REFERENCES studenten(studentId),
  FOREIGN KEY(moduleId) REFERENCES modules(id)
);

CREATE TABLE `evaluaties_criteria` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `evaluatieId` int NOT NULL,
  `criteriumId` int NOT NULL,
  `criteriumBeoordeling`  enum('G', 'V', 'OV', 'RO', 'A', 'NVT') NOT NULL,
  FOREIGN KEY(evaluatieId) REFERENCES evaluaties(id),
  FOREIGN KEY(criteriumId) REFERENCES evaluatiecriteria(id)
);

CREATE TABLE `evaluaties_aspecten` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `evaluatieId` int NOT NULL,
  `aspectId` int NOT NULL,
  `aspectBeoordeling`  tinyint(1) NOT NULL,
  FOREIGN KEY(evaluatieId) REFERENCES evaluaties(id),
  FOREIGN KEY(aspectId) REFERENCES aspecten(id)
);

CREATE TABLE `rapporten` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `studentId` int NOT NULL,
  `name` varchar(150) NOT NULL,
  `class` varchar(50),
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `commentaarKlassenraad` text,
  `commentaarAlgemeen` text,
  CONSTRAINT rapportUniqueNamePerStudent UNIQUE(studentId, name),
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)
);

CREATE TABLE `rapporten_modules` (
  `rapportId` int NOT NULL,
  `moduleId` int NOT NULL,
  `commentaar` text,
  CONSTRAINT PK_rapporten_modules PRIMARY KEY (rapportId, moduleId),
  FOREIGN KEY(moduleId) REFERENCES modules(id),
  FOREIGN KEY(rapportId) REFERENCES rapporten(id)
);

CREATE TABLE `rapporten_scores` (
  `rapportId` int NOT NULL,
  `doelstellingId` int NOT NULL,
  `score` enum('ZG', 'G', 'V', 'OV', 'RO', 'A', 'NVT') NOT NULL,
  `opmerking` text,
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
