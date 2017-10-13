CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(100) NOT NULL UNIQUE,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `language` enum('NL','EN') NOT NULL DEFAULT 'EN',
  `activationKey` varchar(100) DEFAULT NULL,
  `status` enum('WAIT_ACTIVATION','ACTIVE','DISABLED') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'WAIT_ACTIVATION',
  `accountCreatedTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resetcode` char(36) DEFAULT NULL,
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `admins` (
  `adminId` int NOT NULL,
  `stillAdmin` tinyint(1) NOT NULL DEFAULT '1',
  FOREIGN KEY(adminId) REFERENCES users(id)
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
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `werkfiches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `opleidingId` int NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `modules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `werkfiches_modules` (
  `werkficheId` int NOT NULL,
  `moduleId` int NOT NULL,
  CONSTRAINT PK_werkfiches_modules PRIMARY KEY (werkficheId, moduleId),
  FOREIGN KEY(werkficheId) REFERENCES werkfiches(id),
  FOREIGN KEY(moduleId) REFERENCES modules(id)
);

create table `studenten_modules` (
  `moduleId` int NOT NULL,
  `studentId` int NOT NULL,
  `status` enum('Volgt','Beëindigd') NOT NULL,
  FOREIGN KEY(moduleId) REFERENCES modules(id),
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)
);

CREATE TABLE `evaluatiecriteria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `moduleId` int NOT NULL,
  `weergaveTitel` varchar(200) NOT NULL,
  `inGebruik` tinyint(1) NOT NULL,
  `creatorId` int,
  FOREIGN KEY(creatorId) REFERENCES admins(adminId)
);

CREATE TABLE `rapporten` (
  `id` int NOT NULL AUTO_INCREMENT,
  `studentId` int NOT NULL,
  `feedback` text,
  FOREIGN KEY(studentId) REFERENCES studenten(studentId)
);

CREATE TABLE `rapporten_scores` (
  `rapportId` int NOT NULL,
  `evaluatiecriteriumId` int NOT NULL,
  `score` enum('ZG', 'G', 'V', 'OV', 'RO', 'A') NOT NULL,
  CONSTRAINT PK_rapporten_scores PRIMARY KEY (rapportId, evaluatiecriteriumId),
  FOREIGN KEY(rapportId) REFERENCES rapporten(id),
  FOREIGN KEY(evaluatiecriteriumId) REFERENCES evaluatiecriteria(id)
);

CREATE TABLE `meldingen` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `teacherId` int NOT NULL,
  FOREIGN KEY(teacherId) REFERENCES teachers(teacherId)
);

CREATE TABLE `meldingen_opleidingen` (
  `meldingId` int NOT NULL,
  `opleidingId` int NOT NULL,
  CONSTRAINT PK_meldingen_opleidingen PRIMARY KEY (meldingId, opleidingId),
  FOREIGN KEY(meldingId) REFERENCES meldingen(meldingId),
  FOREIGN KEY(opleidingId) REFERENCES opleidingen(id)
);