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
	('KM','Keukenmedewerker','keukenmedewerker',3),
    ('TT', 'Opleiding 2', 'testtest', 3);

INSERT INTO werkfiches(code,name,description,creatorId) VALUES
    ('IK', 'Initiatie keuken', 'initiatie keuken', 3),
    ('KT', 'Keukentechnieken', 'keukentechnieken', 3),
	('TV', 'Taalgebonden vaardigheden', 'taalgebonden vaardigheden', 3),
    ('AV', 'Algemene vorming', 'algemene vorming', 3);

INSERT INTO modules(name,description, teacherId, creatorId) VALUES
	('Veiligheid, hygiëne en milieubewustzijn', 'veiligheid, hygiëne en milieubewustzijn', 4, 3),
	('Houdingen noodzakelijk voor de uitoefening van het beroep', 'houdingen noodzakelijk voor de uitoefening van het beroepn', 4, 3),
   	('Functionele vaardigheden voor de uitoefening van het beroep', 'functionele vaardigheden voor de uitoefening van het beroep', 4, 3),
   	('Eigen werkzaamheden organiseren', 'eigen werkzaamheden organiseren', 5, 3),
   	('Voorbereidende werkzaamheden', 'voorbereidende werkzaamheden', 5, 3),
   	('Elementaire technieken', 'elementaire technieken', 4, 3),
   	('Vaat volgens procedures uitvoeren', 'vaat volgens procedures uitvoeren', 5, 3),
    ('Functionele taalvaardigheid / NT2', 'functionele taalvaardigheid', 4, 3),
    ('Vaardigheden (specifiek taalgebonden)', 'vaardigheden taalgebonden', 4, 3),
    ('ATTITUDES (specifiek taalgebonden)', 'attitudes taalgebonden', 4, 3),
    ('FUNCTIONELE REKENVAARDIGHEID', 'functionele rekenvaardigheid', 4, 3),
    ('FUNCTIONELE INFORMATIEVERWERVING EN -VERWERKING', 'functionele informatieverwerving en -verwerking', 4, 3),
    ('ORGANISATIEBEKWAAMHEID', 'organisatiebekwaamheid', 4, 3),
    ('TIJD- EN RUIMTEBEWUSTZIJN', 'tijd- en ruimtebewustzijn', 4, 3),
    ('FUNCTIONELE WETENSCHAPPELIJKE VAARDIGHEID', 'functionele wetenschappelijke vaardigheid', 4, 3),
    ('ATTITUDE', 'attitude', 4, 3);

INSERT INTO opleidingen_werkfiches(opleidingId, werkficheId) VALUES
	(1,1),
    (1,2),
    (1,3),
    (1,4),
    (2,3),
    (2,4);

INSERT INTO werkfiches_modules(werkficheId,moduleId) VALUES
	(1,1),
	(1,2),
	(1,3),
	(1,4),
	(1,5),
	(1,6),
	(1,7),
    (3,8),
    (3,9),
    (3,10),
    (4,11),
    (4,12),
    (4,13),
    (4,14),
    (4,15),
    (4,16);
    
INSERT INTO studenten_modules_opleidingen(studentId,moduleId, opleidingId) VALUES
	(6,1,1),
    (6,2,1),
    (6,3,1),
    (6,5,1),
	(7,2,1),
    (7,3,1),
    (7,4,1),
    (7,6,1),
	(7,7,1),
	(9,5,1),
    (9,6,1),
    (9,7,1),
    (10,3,1),
    (10,4,1),
    (10,5,1),
    (6,8,1),
    (7,8,1),
    (9,8,1),
    (10,8,1),
    (8,8,2);
    
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
	(7,'Kan gewassen stukken controleren en opbergen',3),
    (8, 'Kijk- en luistervaardigheid', 3),
    (8, 'Leesvaardigheid', 3),
    (8, 'Spreekvaardigheid', 3),
    (8, 'Schrijfvaardigheid', 3),
    (8, 'Grammatica (inzicht)', 3),
    (8, 'Woordenschat', 3),
    (8, 'Spelling', 3),
    (9, 'Kan reflecteren op taalgebruik', 3),
    (9, 'Kan opzoeken, bronnen vinden', 3),
    (10, 'Is bereid zich te concentreren op de taaltaak', 3),
    (10, 'Is bereid te luisteren, te lezen, te spreken, te schrijven en gesprekken te voeren in het Nederlands', 3),
    (10, 'Is bereid correctheid in de formulering na te streven', 3),
    (11, 'Grootheden', 3),
    (11, 'Percent', 3),
    (11, 'Regel van drie', 3),
    (11, 'Schaal', 3),
    (11, 'Schematische voorstellingen', 3),
    (11, '(Basisbewerkingen: +,-,:,x)', 3),
    (12, 'ICT', 3),
    (12, 'Informatie vinden en selecteren', 3),
    (13, 'Groepsopdrachten', 3),
    (13, 'Individuele opdrachten', 3),
    (13, 'Omgaan met geld', 3),
    (13, 'Organisatie eigen leven', 3),
    (14, 'Actualiteit en dagelijks leven', 3),
    (14, 'Eigen regio', 3),
    (14, 'Situeren, oriënteren en verplaatsen', 3),
    (14, 'Wereldproblemen', 3),
    (15, 'Duurzame leefomgeving', 3),
    (15, 'Natuurwetenschappelijke verschijnselen', 3),
    (16, 'Houding t.o.v. de groep', 3),
    (16, 'Houding t.o.v. de leerkracht', 3),
    (16, 'Inzet/Interesse', 3),
    (16, 'Kritische zin', 3),
    (16, 'Respect voor leefmilieu en historisch - cultureel erfgoed', 3),
    (16, 'Samenwerking', 3),
    (16, 'Inleving in socioculturele diversiteit', 3);
    
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
    
INSERT INTO meldingen(teacherId, titel, tekst) VALUES
	(4, "welkom", "het CLW heet iedereen welkom"),
    (4, "Nulla labortis", "Nulla lobortis aliquam placerat. Quisque at justo maximus, commodo diam sit amet, feugiat arcu. Mauris non suscipit ex, vitae tincidunt magna.
            Etiam neque sem, euismod ac odio vel, rhoncus interdum mauris. Morbi aliquet sollicitudin nisl, sit amet tempus lorem interdum sit amet.
            Nam sagittis tempus mattis. Etiam mattis eros eget eros vulputate, quis vestibulum lorem convallis. Suspendisse quis sollicitudin enim.
            Nulla metus dolor, venenatis ut lacus ut, dictum interdum ante. Sed suscipit mi at ante vulputate, quis maximus elit tempor.
            Nullam elementum venenatis commodo. Etiam vel tristique massa. Etiam libero mauris, posuere sed massa nec, tristique vehicula lacus.
            Donec lacinia, lorem et mattis tincidunt, lectus metus imperdiet mi, in tempor turpis lectus id lacus.."),
	(5, "pan meebrengen", "morgen iedereen een pan meebrengen naar de les aub");
    
INSERT INTO meldingen_opleidingen(meldingId,opleidingId) VALUES
	(1, 1),
    (1, 2),
    (2, 1),
    (2, 2),
    (3, 1);
