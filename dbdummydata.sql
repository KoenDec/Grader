use graderDB;

INSERT INTO users(email, firstname, lastname, password, language, status) VALUES
	('kenny.depecker@student.howest.be', 'Kenny', 'Depecker', 'Student', 'NL', 'ACTIVE'),
	('koen.declerck@student.howest.be', 'Koen', 'Declerck', 'Student', 'NL', 'ACTIVE'),
	('riwan.carpentier@student.howest.be', 'Riwan', 'Carpentier', 'Student', 'NL', 'ACTIVE'),
	('teacher1@hotmail.com', 'Teacher', 'Dummy', 'Teacher', 'NL', 'ACTIVE'),
	('teacher2@hotmail.com', 'Teacher', 'Dummy', 'Teacher', 'NL', 'ACTIVE'),
	('student1@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'),
	('student2@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'),
	('student3@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'),
	('student4@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'),
	('student5@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE');
    
INSERT INTO admins(adminId) VALUES (1),(2),(3);

INSERT INTO teachers(teacherId) VALUES(4), (5);

INSERT INTO studenten(studentId) VALUES(6), (7), (8), (9), (10);

INSERT INTO opleidingen(code,name,description,creatorId) VALUES
	('KM','Keukenmedewerker','keukenmedewerker',3);

INSERT INTO werkfiches(opleidingId,code,name,description,creatorId) VALUES
	(1, 'IK', 'Initiatie keuken', 'initiatie keuken', 3);

INSERT INTO modules(name,description, teacherId, creatorId) VALUES
	('Veiligheid, hygiëne en milieubewustzijn', 'veiligheid, hygiëne en milieubewustzijn', 4, 3),
	('Houdingen noodzakelijk voor de uitoefening van het beroep', 'houdingen noodzakelijk voor de uitoefening van het beroepn', 4, 3),
   	('Functionele vaardigheden voor de uitoefening van het beroep', 'functionele vaardigheden voor de uitoefening van het beroep', 4, 3),
   	('Eigen werkzaamheden organiseren', 'eigen werkzaamheden organiseren', 5, 3),
   	('Voorbereidende werkzaamheden', 'voorbereidende werkzaamheden', 5, 3),
   	('Elementaire technieken', 'elementaire technieken', 4, 3),
   	('Vaat volgens procedures uitvoeren', 'vaat volgens procedures uitvoeren', 5, 3);

INSERT INTO opleidingen_modules(opleidingId, moduleId) VALUES
	(1,1),
    (1,2),
    (1,3),
    (1,4),
    (1,5),
    (1,6),
    (1,7);

INSERT INTO werkfiches_modules(werkficheId,moduleId) VALUES
	(1,1),
	(1,2),
	(1,3),
	(1,4),
	(1,5),
	(1,6),
	(1,7);
    
INSERT INTO studenten_modules(studentId,moduleId) VALUES
	(6,1),
    (6,2),
    (6,3),
    (6,5),
	(7,2),
    (7,3),
    (7,4),
    (7,6),
	(7,7),
	(9,5),
    (9,6),
    (9,7),
    (10,3),
    (10,4),
    (10,5);
    
INSERT INTO evaluatiecriteria(moduleId,weergaveTitel,creatorId) VALUES
	(1,'Kan ergonomisch werken',3),
	(1,'Kan economisch werken',3),
	(1,'Kan handelen volgens de regels van de voedselveiligheid',3),
	(1,'Kan voorschriften en instructies inzake veiligheid, hygiëne of milieu toepassen',3),
	(1,'Kan persoonlijke beschermingsmiddelen gebruiken',3),
	(1,'Kan de werkplek en directe omgeving onderhouden',3),
	(1,'Kan producten, apparaten, machines en arbeidsmiddelen volgens voorschriften gebruiken',3),
	(1,'Kan apparaten, machines en arbeidsmiddelen volgens de voorschriften reinigen',3),
	(1,'Kan afval en restproducten sorteren',3),
	(1,'Kan storingen en afwijkingen melden',3),
	(2,'Kan klantgericht werken',3),
	(2,'Kan samenwerken',3),
	(2,'Kan zin voor verantwoordelijkheid tonen',3),
	(2,'Kan nauwkeurig werken',3),
	(2,'Kan doorzettingsvermogen tonen',3),
	(2,'Kan met tijd- en werkdruk omgaan',3),
	(2,'Kan de opgelegde taken uitvoeren',3),
	(3,'Kan informatie selecteren en verwerken',3),
	(3,'Kan dimensies meten en berekenen',3),
	(3,'Kan gewichtseenheden en inhoudsmaten omrekenen',3),
	(3,'Kan verhoudingen respecteren',3),
	(3,'Kan verbale en non-verbale communicatie toepassen',3),
	(4,'Kan eigen werkzaamheden voorbereiden',3),
	(4,'Kan eigen werkzaamheden uitvoeren',3),
	(4,'Kan eigen werkzaamheden evalueren',3),
	(4,'Kan eigen werkzaamheden bijsturen',3),
	(5,'Kan ingrediënten klaarzetten',3),
	(5,'Kan vooraadtekorten melden',3),
	(5,'Kan groenten reinigen',3),
	(5,'Kan fruit reinigen',3),
	(5,'Kan groenten versnijden',3),
	(5,'Kan fruit versnijden',3),
	(5,'Kan ingrediënten verpakken, etiketteren en bewaren',3),
	(6,'Kan groenten stoven',3),
	(6,'Kan fruit stoven',3),
	(6,'Kan groenten koken',3),
	(6,'Kan fruit pocheren',3),
	(6,'Kan maaltijdcomponenten portioneren',3),
	(6,'Kan elementaire dresseertechnieken toepassen',3),
	(7,'Kan etensresten verwijderen',3),
	(7,'Kan serviesgoed en bestek sorteren',3),
	(7,'Kan manueel afwassen en afdrogen',3),
	(7,'Kan machinaal afwassen en afdrogen',3),
	(7,'Kan gewassen stukken controleren en opbergen',3);
    
INSERT INTO rapporten(studentId,feedback) VALUES
	(6, 'Goed gewerkt, proficiat.'),
    (7, 'Niet goed gewerkt, niet proficiat.');
    
INSERT INTO rapporten_scores(rapportId,evaluatiecriteriumId,score) VALUES
	(1, 1, 'G'),
	(1, 2, 'G'),
	(1, 3, 'G'),
	(1, 4, 'G'),
	(1, 5, 'G'),
	(1, 6, 'G'),
	(1, 7, 'G'),
	(1, 8, 'G'),
	(1, 9, 'G'),
	(1, 10, 'G'),
	(1, 18, 'G'),
	(1, 19, 'G'),
	(1, 20, 'G'),
	(1, 21, 'G'),
	(1, 22, 'G');

/* NOG GEEN DUMMYDATA VOOR VOLGENDE TABELLEN:

INSERT INTO meldingen(teacherId, tekst) VALUES();
INSERT INTO meldingen_opleidingen(meldingId,opleidingId) VALUES();

*/
