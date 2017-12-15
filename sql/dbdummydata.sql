use graderDB;

INSERT INTO users(email, firstname, lastname, password, language, status) VALUES
	('kenny.depecker@student.howest.be', 'Kenny', 'Depecker', 'Student', 'NL', 'ACTIVE'), -- 1
	('koen.declerck@student.howest.be', 'Koen', 'Declerck', 'Student', 'NL', 'ACTIVE'), -- 2
	('riwan.carpentier@student.howest.be', 'Riwan', 'Carpentier', '$2y$10$TOVnkl/zFUzGeKIJccvdquNWiT2tFFf1Dd/HayZj8ouyUOZJtIqx.', 'NL', 'ACTIVE'), -- 3
	('teacher1@hotmail.com', 'Joline', 'Soete', 'Teacher', 'NL', 'ACTIVE'), -- 4
	('teacher2@hotmail.com', 'Teacher', 'Dummy', 'Teacher', 'NL', 'ACTIVE'), -- 5
	('student1@hotmail.com', 'Faisal', 'Nizami', 'Student', 'NL', 'ACTIVE'), -- 6
	('student2@hotmail.com', 'Tatjana', 'Eekchout', 'Student', 'NL', 'ACTIVE'), -- 7
	('student3@hotmail.com', 'Student', 'Kapper', 'Student', 'NL', 'ACTIVE'), -- 8
	('student4@hotmail.com', 'Student', 'Kok', 'Student', 'NL', 'ACTIVE'), -- 9
	('student5@hotmail.com', 'Student', 'Tegelzetter', 'Student', 'NL', 'ACTIVE'), -- 10
	('thomas.de.nil@student.howest.be', 'Thomas', 'De Nil', 'Student', 'NL', 'ACTIVE'), -- 11
	('teacher3@hotmail.com', 'Koen', 'Feys', 'Teacher', 'NL', 'ACTIVE'), -- 12
  	('teacher4@hotmail.com', 'Ann', 'Bert', 'Teacher', 'NL', 'ACTIVE'), -- 13
    ('student6@hotmail.com', 'Student', 'Voeger', 'Student', 'NL', 'ACTIVE'); -- 14
    
INSERT INTO admins(adminId) VALUES (1),(2),(3), (11);

INSERT INTO teachers(teacherId) VALUES(4), (5), (12), (13);

INSERT INTO studenten(studentId) VALUES(6), (7), (8), (9), (10), (14);

INSERT INTO opleidingen(name, creatorId) VALUES
	('Keukenmedewerker', 3), -- 1
    ('Kapper', 3),
    ('Tegelzetter', 3),
    ('Winkelbediende', 3),
    ('Klantencontact', 3), -- 5
    ('Voeger', 3);

INSERT INTO modules(name, opleidingId, teacherId, creatorId) VALUES
    ('Initiatie keuken', 1, 4, 3), -- 1
    ('Keukentechnieken', 1, 4, 3),
	('Taalgebonden vaardigheden', null, 5, 3),
    ('Algemene vorming', null, 5, 3),
    ('Vak Engels', null, 5, 3), -- 5
    ('Haarverzorging', 2, 5, 3),
    ('Basistechnieken tegelzetten', 3, 12, 3),
    ('Verkoop', 4, 13, 3), -- TODO not teacher 13
    ('Klantencontact', 4, 13, 3),
    ('Plaatsen van wandtegels', 3, 12, 3), -- 10
    ('Basismetselen', 6, 12, 3),
    ('Voegwerk in cement', 6, 12, 3),
    ('Elastisch voegwerk', 6, 12, 3);

INSERT INTO doelstellingscategories(name, moduleId, creatorId) VALUES
	('Veilig, hygiënisch en milieubewust werken conform welzijn op het werk en de geldende regelgevingen', 1, 3), -- 1
	('Noodzakelijke houdingen voor de uitoefening van het beroep aannemen', 1, 3),
   	('Functionele vaardigheden voor de uitoefening van het beroep toepassen', 1, 3),
   	('Eigen werkzaamheden organiseren', 1, 3),
   	('Volgens bedrijfseigen procedures voorbereidende werkzaamheden (mise en place) uitvoeren', 1, 3), -- 5
   	('Volgens bedrijfseigen procedures elementaire technieken toepassen', 1, 3),
   	('Volgens bedrijfseigen procedures de vaat uitvoeren', 1, 3),
    ('Functionele taalvaardigheid / NT2', 3, 3),
    ('Vaardigheden (specifiek taalgebonden)', 3, 3),
    ('ATTITUDES (specifiek taalgebonden)', 3, 3), -- 10
    ('FUNCTIONELE TAALVAARDIGHEID', 4, 3),
    ('FUNCTIONELE REKENVAARDIGHEID', 4, 3),
    ('FUNCTIONELE INFORMATIEVERWERVING EN -VERWERKING', 4, 3),
    ('ORGANISATIEBEKWAAMHEID', 4, 3),
    ('TIJD- EN RUIMTEBEWUSTZIJN', 4, 3), -- 15
    ('FUNCTIONELE WETENSCHAPPELIJKE VAARDIGHEID', 4, 3),
    ('ATTITUDE', 4, 3),
    ('VAKONDERDELEN', 5, 3),
    ('ATTITUDES', 5, 3),
    ('Neemt deel aan de organisatie van het kapsalon', 6, 3), -- 20
    ('Bereidt zich voor op de toe te passen haarverzorging', 6, 3),
    ('Bereidt de werkpost i.f.v. een haarverzorging voor', 6, 3),
    ('Past shampoos en specifieke haarverzorging toe', 6, 3),
    ('Ruimt de werpost na een haarverzorging op en maakt deze schoon', 6, 3),
    ('Te integreren kennis', 6, 3), -- 25
    ('Basistechnieken van tegelzetten uitvoeren', 7, 3),
    ('Veilig, hygiënisch en milieubewust werken', 8, 3),
    ('Noodzakelijke houdingen voor de uitoefening van het beroep aannemen', 8, 3),
    ('Functionele vaardigheden voor de uitoefening van het beroep toepassen', 8, 3),
    ('Eigen werkzaamheden organiseren', 8, 3), -- 30
    ('Artikelen op klantvriendelijke wijze volgens bedrijfseigen procedures verkopen', 8, 3),
    ('Diensten na verkoop op klantvriendelijke wijze volgens bedrijfseigen procedures verzorgen', 8, 3),
    ('Veilig, hygiënisch en milieubewust werken', 9, 3),
    ('Noodzakelijke houding voor de uiteofening van het beroep', 9, 3),
    ('Functionele vaardigheden voor de uitoefening van het beroep', 9, 3), -- 35
    ('Eigen werkzaamheden organiseren', 9, 3),
    ('Op klantvriendelijke wijze volgens bedrijfseigen procedures handelen', 9, 3),
    ('Diefstalpreventie volgens bedrijfseigen procedures toepassen', 9, 3),
    ('Wandtegels plaatsen',10, 3),
    ('Veilig, hygiënisch en milieubewust werken conform de nota welzijn op het werk zoals:', 11, 3), -- 40
    ('Noodzakelijke houdingen voor de uitoefening van het beroep aannemen', 11, 3),
    ('Functionele vaardigheden voor de uitvoering van het beroep toepassen', 11, 3),
    ('Eigen werkzaamheden organiseren', 11, 3),
    ('Metselwerk uitvoeren', 11, 3),
    ('Veilig, hygiënisch en milieubewust werken conform de nota welzijn op het werk zoals:', 12, 3), -- 45
    ('Noodzakelijke houdingen voor de uitvoering van het beroep aannemen', 12, 3),
    ('Functionele vaardigheden voor de uitvoering van het beroep toepassen', 12, 3),
    ('Eigen werkzaamheden organiseren', 12, 3),
    ('Voegwerken voorbereiden', 12, 3),
    ('Voegwerken in cement uitvoeren', 12, 3), -- 50
    ('Veilig, hygiënisch en milieubewust werken conform de nota welzijn op het werk zoals:', 13, 3),
    ('Noodzakelijke houdingen voor de uitoefening van het beroep aannemen', 13, 3),
    ('Functionele vaardigheden voor de uitvoering van het beroep toepassen', 13, 3),
    ('Eigen werkzaamheden organiseren', 13, 3),
    ('Voegwerken voorbereiden', 13, 3), -- 55
    ('Elastische voegwerken uitvoeren', 13, 3);
    
INSERT INTO doelstellingen(doelstellingscategorieId,name,creatorId) VALUES
	(1,'Ergonomisch werken',3), -- 1
	(1,'Economisch werken',3),
	(1,'Volgens de regels van de voedselveiligheid handelen',3),
	(1,'Voorschriften en instructies inzake veiligheid, hygiëne of milieu toepassen',3),
	(1,'Persoonlijke beschermingsmiddelen gebruiken',3), -- 5
	(1,'Werkplek en directe omgeving onderhouden/schoonhouden',3),
	(1,'Producten, apparatuur, machines en arbeidsmiddelen volgens voorschriften gebruiken',3),
	(1,'Apparatuur, machines en arbeidsmiddelen volgens de voorschriften reinigen',3),
	(1,'Afval en restproducten beperken en volgens wettelijke voorschriften sorteren',3),
	(1,'Storingen of afwijkingen aan producten, apparatuur, machines of arbeidsmiddelen melden',3), -- 10
	(2,'Klantgericht werken',3),
	(2,'Zin voor samenwerking tonen',3),
	(2,'Zin voor verantwoordelijkheid tonen',3),
	(2,'Nauwkeurig werken',3),
	(2,'Doorzettingsvermogen tonen',3), -- 15
	(2,'Met tijds- en werkdruk omgaan',3),
	(2,'Opgelegde taken uitvoeren',3),
	(3,'Informatie selecteren en verwerken',3),
	(3,'Dimensies meten en berekenen',3),
	(3,'Gewichtseenheden en inhoudsmaten omrekenen',3), -- 20
	(3,'Verhoudingen respecteren',3),
	(3,'Verbale en non-verbale communicatie toepassen',3),
	(4,'Eigen werkzaamheden voorbereiden',3),
	(4,'Eigen werkzaamheden uitvoeren',3),
	(4,'Eigen werkzaamheden evalueren',3), -- 25
	(4,'Eigen werkzaamheden bijsturen',3),
	(5,'Ingrediënten klaarzetten',3),
	(5,'Vooraadtekorten melden',3),
	(5,'Groenten en fruit reinigen',3),
	(5,'Groenten en fruit in functie van vorm en grootte snijden',3), -- 30
	(5,'Kan ingrediënten verpakken, etiketteren en bewaren',3),
	(6,'Groenten voor het bereiden van salades en basissoepen stoven en koken',3),
	(6,'Maaltijdcomponenten portioneren',3),
	(6,'Elementaire dresseertechnieken toepassen',3),
	(7,'Etensresten verwijderen',3), -- 35
	(7,'Serviesgoed en bestek sorteren',3),
	(7,'Manueel of machinaal afwassen en afdrogen',3),
	(7,'Buffet en banket aanvullen',3),
	(7,'##########################',3),
	(7,'##########################',3), -- 40
	(7,'##########################',3),
	(7,'##########################',3),
	(7,'##########################',3),
	(7,'##########################',3),
    (8, 'Kijk- en luistervaardigheid', 3), -- 45
    (8, 'Leesvaardigheid', 3),
    (8, 'Spreekvaardigheid', 3),
    (8, 'Schrijfvaardigheid', 3),
    (8, 'Grammatica (inzicht)', 3),
    (8, 'Woordenschat', 3), -- 50
    (8, 'Spelling', 3),
    (9, 'Kan reflecteren op taalgebruik', 3),
    (9, 'Kan opzoeken, bronnen vinden', 3),
    (10, 'Is bereid zich te concentreren op de taaltaak', 3),
    (10, 'Is bereid te luisteren, te lezen, te spreken, te schrijven en gesprekken te voeren in het Nederlands', 3), -- 55
    (10, 'Is bereid correctheid in de formulering na te streven', 3),
    (11, 'Kijk- en luistervaardigheid',3),
    (11, 'Leesvaardigheid', 3),
    (11, 'Schrijfvaardigheid', 3),
    (11, 'Spreekvaardigheid', 3), -- 60
    (12, 'Grootheden', 3),
    (12, 'Percent', 3),
    (12, 'Regel van drie', 3),
    (12, 'Schaal', 3),
    (12, 'Schematische voorstellingen', 3), -- 65
    (12, '(Basisbewerkingen: +,-,:,x)', 3),
    (13, 'ICT', 3),
    (13, 'Informatie vinden en selecteren', 3),
    (14, 'Groepsopdrachten', 3),
    (14, 'Individuele opdrachten', 3), -- 70
    (14, 'Omgaan met geld', 3),
    (14, 'Organisatie eigen leven', 3),
    (15, 'Actualiteit en dagelijks leven', 3),
    (15, 'Eigen regio', 3),
    (15, 'Situeren, oriënteren en verplaatsen', 3), -- 75
    (15, 'Wereldproblemen', 3),
    (16, 'Duurzame leefomgeving', 3),
    (16, 'Natuurwetenschappelijke verschijnselen', 3),
    (17, 'Houding t.o.v. de groep', 3),
    (17, 'Houding t.o.v. de leerkracht', 3), -- 80
    (17, 'Inzet/Interesse', 3),
    (17, 'Kritische zin', 3),
    (17, 'Respect voor leefmilieu en historisch - cultureel erfgoed', 3),
    (17, 'Samenwerking', 3),
    (17, 'Inleving in socioculturele diversiteit', 3), -- 85
    (26, 'Ondergrond evalueren', 3),
    (26, 'Niet te betegelen elementen beschermen', 3),
    (26, 'Oppervlakte schoonmaken', 3),
    (26, 'Oppervlakte voorbehandelen', 3),
    (26, 'Tegels selecteren', 3), -- 90
    (26, 'Species aanmaken', 3),
    (26, 'Tegels plaatsen', 3), 
    (27, 'Ergonomisch werken', 3),
    (27, 'Economisch werken', 3),
    (27, 'Persoonlijke beschermingsmiddelen gebruiken', 3), -- 95
    (27, 'Hygiënebewust werken', 3),
    (27, 'Voor netheid en orde van de winkelomgeving instaan', 3),
    (27, 'Veiligheidsvoorschriften en -instructies inzake arbeidsmiddelen toepassen', 3),
    (28, 'Zin voor samenwerking tonen', 3),
    (28, 'Nauwkeurig zijn', 3), -- 100
    (28, 'Voorkomen verzorgen', 3),
    (28, 'Discreet zijn', 3),
    (28, 'Op wisselende omstandigheden inspelen', 3),
    (28, 'Zorgzaam met goederen omgaan', 3),
    (29, 'ICT gebruiken', 3), -- 105
    (29, 'Informatie selecteren en gebruiken', 3),
    (29, 'Verbale en non-verbale communicatie toepassen', 3),
    (29, 'Rekenvaardigheden toepassen', 3),
    (30, 'Eigen werkzaamheden voorbereiden', 3),
    (30, 'Eigen werkzaamheden uitvoeren', 3), -- 110
    (30, 'Eigen werkzaamheden evalueren', 3),
    (30, 'Eigen werkzaamheden bijsturen', 3),
    (31, 'Klant informeren en adviseren', 3),
    (31, '', 3),
    (31, 'Verkooptechnieken op klantentypes afstemmen en toepassen', 3), -- 115
    (31, 'Bestellingen opnemen', 3),
    (31, 'Verkooptransacties afhandelen', 3),
    (31, 'Op een aantrekkelijke manier verkochte artikelen inpakken', 3),
    (32, 'Bestellingen doorgeven', 3),
    (32, 'Bij aankomst van bestelde artikelen klant verwittigen', 3), -- 120
    (32, 'Klantgericht telefoneren', 3),
    (33, 'Ergonomisch werken', 3),
    (33, 'Economisch werken', 3),
    (33, 'Persoonlijke beschermingsmiddelen gebruiken', 3),
    (33, 'Hygiënebewust werken', 3), -- 125
    (33, 'Voor netheid en orde van de winkelomgeving instaan', 3),
    (33, 'Veiligheidsvoorschriften en -instructies inzake arbeidsmiddelen toepassen', 3),
    (33, 'Afval- en restproducten sorteren', 3),
    (34, 'Zin voor samenwerking tonen', 3),
    (34, 'Nauwkeurig zijn',3), -- 130
    (34, 'Voorkomen verzorgen', 3),
    (34, 'Discreet zijn', 3),
    (34, 'Op wisselende omstandigheden inspelen', 3),
    (34, 'Zorgzaam met goederen omgaan', 3),
    (35, 'Informatie selecteren en verwerken', 3), -- 135
    (35, 'Verbale en non-verbale communicatie toepassen', 3),
    (35, 'Rekenvaardigheden toepassen', 3),
    (36, 'Eigen werkzaamheden voorbereiden', 3),
    (36, 'Eigen werkzaamheden uitvoeren', 3),
    (36, 'Eigen werkzaamheden evalueren', 3), -- 140
    (36, 'Eigen werkzaamheden bijsturen', 3),
    (37, 'Klanten begroeten', 3),
    (37, 'Klanten met vragen of klachten verder helpen', 3),
    (37, 'Plaats van een artikel aanduiden', 3),
    (37, 'Van klanten afscheid nemen', 3), -- 145
    (37, 'Conflictbeheersingstechnieken toepassen', 3),
    (37, 'Standaarduitdrukkingen in minimum één vreemde taal gebruiken', 3),
    (38, 'Diefstalpreventietechnieken toepassen', 3),
    (38, 'Diefstalgevoelige producten afschermen', 3),
    (38, 'Beveiligingssystemen aanbrengen', 3), -- 150
    (38, 'Klantengedrag observeren', 3),
    (38, 'Verdacht gedrag herkennen', 3),
    (38, 'Richtlijnen bij verdacht gedrag naleven', 3),
    (39, 'Kan ondergrond evalueren', 3),
    (39, 'Kan oude tegels uitbreken en verwijderen', 3), -- 155
    (39, 'Kan grote scheuren opvullen', 3),
    (39, 'Kan onderkader of wand plaatsen', 3),
    (39, 'Kan reien vastklemmen', 3),
    (39, 'Kan lijm aanmaken', 3),
    (39, 'Kan muren inlijmen', 3), -- 160
    (39, 'Kan profielen aanbrengen', 3),
    (39, 'Kan tegels snijden, knippen en zagen', 3),
    (39, 'Kan wandtegels plaatsen', 3),
    (39, 'Kan wandtegels inwassen', 3),
    (39, 'Kan geplaatste wandtegels afwerken', 3), -- 165
    (40, 'Ergonomisch werken', 3),
    (40, 'Economisch werken', 3),
    (40, 'Persoonlijke beschermingsmiddelen gebruiken', 3),
    (40, 'Collectieve beschermingsmiddelen gebruiken', 3),
    (40, 'Producten met gevaarlijke eigenschappen correct gebruiken', 3), -- 170
    (40, 'Veiligheidsvoorschriften en -instructies inzake arbeidsmiddelen toepassen', 3),
    (40, 'Afval- en restproducten sorteren', 3),
    (40, 'Gereedschap en machines gebruiken', 3),
    (40, 'Gereedschap en machines reinigen', 3),
    (41, 'Met zin voor precisie werken', 3), -- 175
    (41, 'Zin voor samenwerking tonen', 3),
    (41, 'Doorzettingsvermogen tonen', 3),
    (42, 'Dimensies (lengte, breedte, dikte, oppervlakte, inhoud, ...) meten en berekenen', 3),
    (42, 'Meetinstrumenten gebruiken', 3),
    (42, 'Technische tekeningen gebruiken', 3), -- 180
    (43, 'Eigen werkzaamheden voorbereiden', 3),
    (43, 'Eigen werkzaamheden uitvoeren', 3),
    (43, 'Eigen werkzaamheden evalueren', 3),
    (43, 'Eigen werkzaamheden bijsturen', 3),
    (44, 'Mortel aanmaken', 3), -- 185
    (44, 'Halfsteense muren metselen', 3),
    (44, 'Eénsteense muren metselen', 3),
    (44, 'Kleine elementen in metselwerk plaatsen', 3),
    (44, 'Voegen uitkrabben', 3),
    (44, 'Meegaand voegen', 3), -- 190
    (45, 'Ergonomisch werken', 3),
    (45, 'Economisch werken', 3),
    (45, 'Persoonlijke beschermingsmiddelen gebruiken', 3),
    (45, 'Collectieve beschermingsmiddelen gebruiken', 3),
    (45, 'Producten met gevaarlijke eigenschappen correct gebruiken', 3), -- 195
    (45, 'Veiligheidsvoorschriften en -instructies inzake arbeidsmiddelen toepassen', 3),
    (45, 'Ladders en stelling gebruiken', 3),
    (45, 'Afval- en restproducten sorteren', 3),
    (45, 'Gereedschap en machines gebruiken', 3),
    (45, 'Gereedschap en machines reinigen', 3), -- 200
    (46, 'Met zin voor precisie werken', 3), 
    (46, 'Zin voor samenwerking tonen', 3),
    (46, 'Doorzettingsvermogen tonen', 3),
    (46, 'Opgelegde taken uitvoeren', 3),
    (46, 'Op wisselende weersomstandigheden inspelen', 3), -- 205
    (47, 'Dimensies (lengte, breedte, dikte, oppervlakte, inhoud, ...) meten en berekenen', 3),
    (47, 'Meetinstrumenten gebruiken', 3),
    (48, 'Eigen werkzaamheden voorbereiden', 3),
    (48, 'Eigen werkzaamheden uitvoeren', 3),
    (48, 'Eigen werkzaamheden evalueren', 3), -- 210
    (48, 'Eigen werkzaamheden bijsturen', 3),
    (49, 'Werkzone afschermen', 3),
    (49, 'Oude voegvulling verwijderen', 3),
    (49, 'Voegen reinigen', 3),
    (49, 'Muuruitslag evalueren', 3), -- 215
    (49, 'Herstellen en metselwerken uitvoeren', 3),
    (50, 'Voegspecie aanmaken', 3),
    (50, 'Addititeven toevoegen', 3),
    (50, 'Voegwerken uitvoeren', 3),
    (50, 'Voegwerken afwerken', 3), -- 220
    (50, 'Voegwerken herstellen', 3),
    (51, 'Ergonomisch werken', 3),
    (51, 'Economisch werken', 3),
    (51, 'Persoonlijke beschermingsmiddelen gebruiken', 3),
    (51, 'Collectieve beschermingsmiddelen gebruiken', 3), -- 225
    (51, 'Producten met gevaarlijke eigenschappen correct gebruiken', 3),
    (51, 'Veiligheidsvoorschriften en -instructies inzake arbeidsmiddelen toepassen', 3),
    (51, 'Afval- en restproducten sorteren', 3),
    (51, 'Gereedschap en machines gebruiken', 3),
    (51, 'Gereedschap en machines reinigen', 3), -- 230
    (52, 'Met zin voor precisie werken', 3), 
    (52, 'Zin voor samenwerking tonen', 3),
    (52, 'Doorzettingsvermogen tonen', 3),
    (53, 'Dimensies (lengte, breedte, dikte, oppervlakte, inhoud, ...) meten en berekenen', 3),
    (53, 'Meetinstrumenten gebruiken', 3), -- 235
    (53, 'Technische tekeningen gebruiken', 3),
    (54, 'Eigen werkzaamheden voorbereiden', 3),
    (54, 'Muren metselen in gevelstenen en snelbouwstenen', 3),
    (54, 'Eigen werkzaamheden evalueren', 3), 
    (54, 'Eigen werkzaamheden bijsturen', 3), -- 240
    (55, 'Werkzone afschermen', 3),
    (55, 'Oude voegvulling verwijderen', 3),
    (55, 'Voegen uitkrabben', 3),
    (55, 'Voegen reinigen', 3),
    (55, 'Muuruitslag evalueren', 3), -- 245
    (55, 'Herstellen in metselwerk uitvoeren', 3),
    (56, 'Diepe voegen voorvullen', 3),
    (56, 'Producten aanmaken', 3),
    (56, 'Kleuren combineren', 3),
    (56, 'Voegwerken uitvoeren', 3), -- 250
    (56, 'Constructie-elementen opspuiten', 3),
    (56, 'Gevelelementen aansluiten', 3), 
    (56, 'Voegwerken herstellen en afwerken', 3);
    
INSERT INTO evaluatiecriteria(doelstellingId, name, creatorId) VALUES
	(1, 'correcte werkhouding toepassen bij het bij het reinigen van groenten en fruit', 3), -- 1
    (1, 'de juiste hef-en tiltechnieken toepassen bij het verplaatsen van (kratten met) groenten en fruit', 3),
    (1, 'een correcte werkhouding toepassen bij het uitvoeren van de vaat', 3),
    (1, 'de juiste hef- en til technieken gebruiken bij uitvoeren van de vaat', 3),
    (2, 'een minimum aan afval creëren bij het reinigen van groenten en fruit', 3), -- 5
    (2, 'zorgzaam omgaan met materieel zoals servies, glaswerk e.d. bij het uitvoeren van de vaat', 3),
    (2, 'ingrediënten volgens instructies correct verpakken om verlies door middel van verontreiniging en/of bederf te voorkomen', 3),
    (2, 'zuinig omgaan met het gebruik van water en detergent', 3),
    (3, 'ingrediënten volgens instructies op een correcte manier verpakken om kruisbesmetting te voorkomen', 3),
    (3, 'vaat en reinigen van voedingsmiddelen gescheiden houden', 3), -- 10
    (3, 'juiste snijplanken gebruiken', 3),
    (3, 'ingrediënten volgens instructies op de juiste plaats in de koeling plaatsen', 3),
    (4, 'kent de richtlijnen voor persoonlijke hygiëne', 3),
    (4, 'de richtlijnen van een persoonlijke hygiëne op zichzelf toepassen', 3),
    (4, 'messen op een correcte manier verplaatsen en opbergen', 3), -- 15
    (4, 'de instructies in het reinigingsplan voor het reinigen van de vaatwasruimte toepassen', 3),
    (4, 'de richtlijnen van werkplaatsreglement in de keuken toepassen', 3),
    (5, 'schone werkkledij dragen', 3),
    (5, 'geschikte (veiligheids)schoenen dragen (gesloten, afwasbaar, voorzien van anti-slipzool, enkel voor gebruik in de keuken)', 3),
    (5, 'gebruikt steeds een droge handdoek bij het hanteren van warme voorwerpen', 3), -- 20
    (5, 'een hoofddeksel dragen om te voorkomen dat er haar of huidschilfers in de voedingswaren terecht komen (baardnetje indien nodig)', 3),
    (5, 'wegwerphandschoenen gebruiken bij wonden', 3),
    (6, 'de vaatwasruimte op hygiëne controleren voor het aanvangen van activiteiten', 3),
    (6, 'de vaatwasruimte reinigen na gebruik', 3),
    (6, 'de vaatwasruimte ordelijk houden met het oog op de veiligheid', 3), -- 25
    (6, 'een vervuilde vaatwasruimte reinigen voor het aanvangen van activiteiten', 3),
    (7, 'de veiligheidsinstructiefiche van de vaatwasmachine gebruiken', 3),
    (7, 'de vaatwasmachine volgens de voorschriften gebruiken', 3),
    (7, 'veiligheidsinstructiekaarten van detergenten en vaatwasproducten raadplegen voor gebruik', 3),
    (7, 'het juiste mes kiezen in functie van het gebruik', 3), -- 30
    (8, 'reinigingsmiddelen in een correcte verhouding gebruiken', 3),
    (8, 'messen op een veilige manier reinigen', 3),
    (8, 'de vaatwasmachine reinigen volgens de voorschriften op de de veiligheidsinstructiekaart', 3),
    (9, 'afval zoals PMD, papier, karton, glas, GFT, restafval, gebroken servies,  … correct sorteren', 3),
    (10, 'storingen of afwijkingen aan toestellen in de vaatwasruimte melden', 3), -- 35
    (86, 'vlakheid van de muur', 3), 
    (86, 'vlakheid van de vloer', 3),
    (87, 'vloer beschermen', 3),
    (87, 'aansluiting met plafond of andere muur beschermen', 3),
    (87, 'aansluiting ramen en deuren beschermen', 3), -- 40
    (88, 'verwijderen van restvuil', 3),
    (88, 'ondergrond stofvrij maken', 3),
    (89, 'Primer of hechtingslaag kunnen aanbrengen', 3),
    (90, 'Juiste type tegels (wand of vloertegels) bepalen', 3),
    (90, 'Fouten kunnen opmerken (breuken, productiefouten', 3), -- 45
    (91, 'Tegellijm voor vloertegels', 3),
    (91, 'Tegellijm voor wandtegels', 3),
    (92, 'Noodzakelijke lijnen aftekenen (loodlijnen en aanzetlijnen) voor wandtegels', 3),
    (92, 'Noodzakelijke lijnen aftekenen (loodlijnen en aanzetlijnen) voor vloertegels', 3),
    (11, 'Het belang van een zuivere vaat in eigen woorden uitleggen', 3), -- 50
    (11, 'Het verband tussen een zuivere vaat en tevredenheid van de klanten in eigen woorden omschrijven', 3),
    (12, 'Bij problemen hulp inroepen (bijvoorbeeld zware kratten, zware stukken, grote hoeveelheden, ...)', 3),
    (12, 'Bij problemen hulp aanbieden (bijvoorbeeld zware kratten, zware stukken, grote hoeveelheden, ...)', 3),
    (12, 'Op een gepaste wijze met collega\'s en hiërarchie omgaan', 3),
    (13, 'Zich flexibel opstellen bij wijzigende opdrachten', 3), -- 55
    (13, 'De voorbereidinsgkeuken / koude keuken net achterlaten', 3),
    (13, 'De vaatwasruimte net achterlaten', 3),
    (14, 'Voor een zuivere vaat zorgen', 3),
    (14, 'Aandacht besteden aan de uitvoering van een taak', 3),
    (14, 'Aangegeven hoeveelheden respecteren', 3), -- 60
    (14, 'Groenten en fruit grondig reinigen (geen residu)', 3),
    (15, 'Voert de vaat uit tot deze volledig volbracht is', 3),
    (15, 'Grote hoeveelheden groenten en fruit correct reinigen', 3),
    (16, 'Vaat uitvoeren binnen een bepaalde tijdsmarge', 3),
    (16, 'Groenten en fruit reinigen binnen een bepaalde tijdsmarge', 3), -- 65
    (17, 'Taken aanvaarden en uitvoeren', 3),
    (18, 'Groenten en fruit benoemen', 3),
    (18, 'Reinigingstechnieken voor groenten en fruit in eigen woorden uitleggen', 3),
    (18, 'Volgorde van de vaat opnoemen', 3),
    (19, 'Een gepaste keuze maken tussen de keukenmaterialen en de te bereiden hoeveelheid grondstoffen', 3), -- 70
    (20, 'Hoeveelheden van liter omzetten naar milliliter en omgekeerd', 3),
    (20, 'Hoeveelheden van kilogram omzetten naar gram en omgekeerd', 3),
    (21, 'Vaatwasmiddel voor de machinale vaat juist doseren', 3),
    (21, 'De juiste hoeveelheid vetstof bepalen bij het aanstoven van groenten / fruit', 3),
    (21, 'De juiste hoeveelheid water bepalen voor het koken van groenten / fruit', 3), -- 75
    (21, 'Vaatwasmiddel (detergent) voor de handmatige vaat juist doseren', 3),
    (22, 'Op een gepaste wijze communiceren met kok / hulpkok', 3),
    (22, 'Op een gepaste wijze communiceren met het zaalpersoneel bij de vaat', 3),
    (22, 'In eigen woorden het verschil tussen verbale en non-verbale communicatie uitleggen', 3),
    (23, 'Uit een werkopdracht afleiden welke ingrediënten ze nodig hebben voor het reinigen van groenten en fruit', 3), -- 80
    (23, 'Uit een werkopdracht afleiden welk materiaal ze nodig hebben bij het reinigen van groenten en fruit', 3),
    (23, 'Een werkvolgorde voor het reinigen van groenten en fruit opstellen', 3),
    (23, 'Een werkvolgorde voor de vaat opstellen', 3),
    (23, 'Uit een werkopdracht afleiden hoeveel ingrediënten ze nodig hebben voor het reinigen van groenten en fruit', 3),
    (24, 'Opdracht uitvoeren volgens een eigen of opgelegde werkvolgorde', 3), -- 85
    (25, 'Objectief oordelen over het resultaat van de vaat', 3),
    (25, 'Objectief oordelen over het resultaat van het reinigen van groenten', 3),
    (26, 'Aanpassingen formuleren bij knelpunten', 3),
    (26, 'Rekening houden met geformuleerde aanpassingen', 3),
    (27, 'De juiste ingrediënten kiezen uit de voorraadruimte / koeling / diepvries', 3), -- 90
    (27, 'De juiste hoeveelheid ingrediënten klaarzetten in functie van de bereiding', 3),
    (28, 'Aangeven als er een tekort is aan ingrediënten (groenten en fruit)', 3),
    (28, 'Aangeven als er een tekort is aan reinigingsproducten (vaat)', 3),
    (29, 'Basistechnieken voor het reinigen van groenten en fruit toepassen', 3),
    (30, 'Groenten en fruit volgens de aangeboden instructies versnijden', 3), -- 95
    (30, 'De begeleidende en snijdende handtechniek toepassen', 3),
    (31, 'Het juiste verpakkingsmateriaal kiezen', 3),
    (31, 'Ingrediënten volgens instructies op de juiste temperatuur bewaren', 3),
    (31, 'De juiste gegevens op het label vermelden', 3),
    (32, 'De basistechniek voor het stoven van groenten en fruit toepassen', 3), -- 100
    (32, 'De basistechniek voor het koken van groenten en fruit toepassen', 3),
    (33, 'Maaltijdcomponenten in de juiste hoeveelheid verdelen', 3),
    (33, 'Een gevraagde hoeveelheid vaste stof met een weegschaal of schepmaat afwegen', 3),
    (33, 'Een gevraagde hoeveelheid vloeistof met een maatbeker correct afmeten', 3),
    (34, 'Hoeveelheden respecteren', 3), -- 105
    (34, 'Vlekken en spatten op het servies reinigen na het dresseren', 3),
    (34, 'Klassieke dresseertechnieken toepassen', 3),
    (35, 'Afval en etensresten van de vaat correct sorteren', 3),
    (35, 'Gebroken of beschadigde stukken veilig verwijderen', 3),
    (35, 'Vuile stukken grondig af- en/of voorspoelen', 3), -- 110
    (36, 'De vuile stukken veilig stapelen', 3),
    (36, 'De vuile stukken sorteren in: glaswerk, servies, bestek en keukenmateriaal', 3),
    (37, 'Vuile vaat grondig met de hand wassen', 3),
    (37, 'Vuile vaat in de vaatwasmachine inladen', 3),
    (37, 'Gereinigde vaat drogen', 3), -- 115
    (37, 'Machinaal gereinigde vaat uitladen', 3),
    (37, 'De vaatwasmachine correct uitzetten', 3),
    (37, 'De wasbakken reinigen', 3),
    (37, 'De vaatwasmachine reinigen', 3),
    (37, 'Gereinigde vaat naspoelen', 3), -- 120
    (38, 'Gereinigde stukken controleren op schade', 3),
    (38, 'Gereinigde stukken veilig stapelen', 3),
    (38, 'Gereinigde stukken op de juiste plek opbergen', 3),
    (154, 'Vlakheid en loodrechtheid', 3),
    (154, 'Droogheid (vocht, scheuren, ...)', 3), -- 125
    (154, 'Beschadigingen', 3),
    (155, 'Uitbreken', 3),
    (155, 'Verwijderen / afvoeren', 3),
    (156, '', 3),
    (157, 'Onderkader voor een bad', 3), -- 130
    (157, 'Wand plaatsen', 3),
    (158, '', 3),
    (159, '', 3),
    (160, '', 3),
    (161, 'Hoek- en eindprofielen', 3), -- 135
    (162, 'Snijden', 3),
    (162, 'Knippen', 3),
    (162, 'Zagen', 3),
    (163, '', 3),
    (164, 'Voegspecie aanmaken', 3), -- 140
    (164, 'Inwassen', 3),
    (165, 'Eindcontrole', 3),
    (165, 'Opkitten hoeken en overgangen', 3),
    (166, 'Hef- en tiltechnieken', 3),
    (166, 'Werkhouding', 3), -- 145
    (167, 'Op tijd', 3),
    (167, 'Op materiaal', 3),
    (168, 'Algemene werkkledij', 3),
    (168, 'Bijkomende PBM\'s in functie van de activiteit (veiligheidsbril, gehoorbescherming, ...)', 3),
    (169, 'Eigen werkzone', 3), -- 150
    (169, 'Veiligheidsdoorgangen', 3),
    (170, '', 3),
    (171, 'Werkplaatsreglement volgen', 3),
    (171, 'Instructies (VIK)', 3),
    (172, 'Sorteren', 3), -- 155
    (172, 'Opslaan', 3),
    (173, 'Gereedschappen', 3),
    (173, 'Machines', 3),
    (174, 'Gereedschappen', 3),
    (174, 'Machines', 3), -- 160
    (175, '', 3),
    (176, '', 3),
    (177, '', 3),
    (178, 'Meten', 3),
    (178, 'Berekenen', 3), -- 165
    (179, 'Meetgereedschappen', 3),
    (179, 'Controlegereedschappen', 3),
    (180, 'Tekeningen lezen', 3),
    (181, 'Materiaalhoeveelheden bepalen', 3),
    (181, 'Noodzakelijke gereedschappen bepalen', 3), -- 170
    (181, 'Noodzakelijke machines bepalen', 3),
    (181, 'Eenvoudig stappenplan', 3),
    (182, '', 3),
    (183, 'Tussentijdse controle', 3),
    (183, 'Eindcontroles:', 3), -- 175
    (184, 'Bijsturingen in functie van de tussentijdse controles', 3),
    (184, 'Bijsturingen in functie van de eindcontrole', 3),
    (185, '', 3),
    (186, 'Algemeen', 3),
    (186, 'Metselverband', 3), -- 180
    (187, 'Algemeen', 3),
    (187, 'Metselverband', 3),
    (188, '', 3),
    (189, '', 3),
    (190, '', 3), -- 185
    (191, 'Hef- en tiltechnieken', 3),
    (191, 'Werkhouding', 3),
    (192, 'Op tijd', 3),
    (192, 'Op materiaal', 3),
    (193, 'Algemene werkkledij', 3), -- 190
    (193, 'Bijkomende PBM\'s in functie van de activiteit (veiligheidsbril, gehoorbescherming, ...)', 3),
    (194, 'Eigen werkzone', 3),
    (194, 'Veiligheidsdoorgangen', 3),
    (195, '', 3),
    (196, 'Werkplaatsreglement (centrum-werkplek) volgen', 3), -- 195
    (196, 'Instructies (VIK)', 3),
    (197, 'Algemeen', 3),
    (197, 'Ladder', 3),
    (197, '(Rol)stelling', 3),
    (198, 'Sorteren', 3), -- 200
    (198, 'Opslaan', 3),
    (199, 'Gereedschappen', 3),
    (199, 'Machines', 3),
    (200, 'Gereedschappen', 3),
    (200, 'Machines', 3), -- 205
    (201, '', 3),
    (202, '', 3),
    (203, '', 3),
    (204, '', 3),
    (205, '', 3), -- 210
    (206, 'Meten', 3),
    (206, 'Berekenen', 3),
    (207, 'Meetgereedschappen', 3),
    (207, 'Controlegereedschappen', 3),
    (208, 'Materiaalhoeveelheden bepalen', 3), -- 215
    (208, 'Noodzakelijke gereedschappen bepalen', 3),
    (208, 'Noodzakelijke machines bepalen', 3),
    (208, 'Eenvoudig stappenplan', 3),
    (210, 'Tussentijdse controle', 3),
    (210, 'Eindcontroles:', 3), -- 220
    (211, 'Bijsturingen in functie van de tussentijdse controles', 3),
    (211, 'Bijsturingen in functie van de eindcontrole', 3),
    (212, '', 3),
    (213, 'Manueel', 3),
    (213, 'Machinaal', 3), -- 225
    (214, 'Manueel reinigen', 3),
    (214, 'Nat reinigen', 3),
    (215, '', 3),
    (216, '', 3),
    (217, 'Manueel', 3), -- 230
    (217, 'Machinaal', 3),
    (218, '', 3),
    (219, '', 3),
    (220, '', 3),
    (221, '', 3), -- 235
    (222, 'Hef- en tiltechnieken', 3),
    (222, 'Werkhouding', 3),
    (223, 'Op tijd', 3),
    (223, 'Op materiaal', 3),
    (224, 'Algemene werkkledij', 3), -- 240
    (224, 'Bijkomende PBM\'s in functie van de activiteit (veiligheidsbril, gehoorbescherming, ...)', 3),
    (225, 'Eigen werkzone', 3),
    (225, 'Veiligheidsdoorgangen', 3),
    (226, '', 3),
    (227, 'Werkplaatsreglement', 3), -- 245
    (227, 'Instructies (VIK)', 3),
    (228, 'Sorteren', 3),
    (228, 'Opslaan', 3),
    (229, 'Gereedschappen', 3),
    (229, 'Machines', 3), -- 250
    (230, 'Gereedschappen', 3),
    (230, 'Machines', 3),
    (231, '', 3),
    (232, '', 3),
    (233, '', 3), -- 255
    (234, 'Meten', 3),
    (234, 'Berekenen', 3),
    (235, 'Meetgereedschappen', 3),
    (235, 'Controlegereedschappen', 3),
    (236, 'Tekeningen lezen', 3), -- 260
    (237, 'Materiaalhoeveelheden bepalen', 3),
    (237, 'Noodzakelijke gereedschappen bepalen', 3),
    (237, 'Noodzakelijke machines bepalen', 3),
    (237, 'Eenvoudig stappenplan', 3),
    (239, 'Tussentijdse controle:', 3), -- 265
    (239, 'Eindcontroles:', 3), 
    (240, 'Bijsturingen in functie van de tussentijdse controles', 3),
    (240, 'Bijsturingen in functie van de eindcontrole', 3),
    (241, '', 3),
    (242, '', 3), -- 270
    (243, '', 3),
    (244, '', 3),
    (245, '', 3),
    (246, '', 3),
    (247, '', 3), -- 275
    (248, '', 3),
    (249, '', 3),
    (250, '', 3),
    (251, '', 3),
    (252, '', 3), -- 280
    (253, 'Herstellen:', 3),
    (253, 'Afwerken:', 3);
    
INSERT INTO aspecten(evaluatiecriteriumId, name, creatorId) VALUES
    (36, 'controleert en beoordeelt de vlakheid van de muur', 3), -- 1
    (36, 'controleert en beoordeelt de loodrechtheid van de muur', 3), 
    (36, 'controleert en beoordeelt de staat van de muur (gebreken, beschadigingen, vochtplekken, ...)', 3), 
    (37, 'controleert en beoordeelt de vlakheid va nde vloer', 3), 
    (37, 'controleert en beoordeelt de loodrechtheid van de vloer', 3), -- 5
    (37, 'controleert en beoordeelt de staat van de vloer (gebreken, beschadigingen, vochtplekken, ...)', 3),
    (38, 'beschermt de vloer waar nodig met karton of papier', 3),
    (38, 'beschermen van bad of douchebak', 3),
    (39, 'plakt overgangen (muur-plafond of vloer-muur- af met plakband', 3),
    (39, 'plaatst waar nodig beschermfolie', 3), -- 10
    (40, 'plakt overgangen (ramen en deuren) af met plakband', 3),
    (40, 'plaatst waar nodig beschermfolie', 3),
    (41, 'verwijdert alle afval uit de ruimte', 3),
    (41, 'verwijdert rest- of overtollig materiaal van het te betegelen oppervlakte (bezetsel-, chaperesten)', 3),
    (42, 'veegt het te betegelen vloeroppervlakte schoon', 3), -- 15
    (42, 'veegt het te betegelen wandoppervlakte schoon', 3),
    (42, 'stofzuigt indien nodig de te betegelen oppervlakte', 3),
    (43, 'leest de productinfo', 3),
    (43, 'maakt het product gebruiksklaar volgens voorschrift van de producent', 3),
    (43, 'brengt het product op de voorgeschreven wijze aan', 3), -- 20
    (43, 'respecteert de juiste wachttijd', 3),
    (44, 'herkent het doel van de tegel (wand- of vloertegel)', 3),
    (45, 'controleert de tegels op producteigenschap (serienummer, kleur, ...)', 3),
    (45, 'productiefouten in tegels kunnen opmerken (spatten, haarscheurtjes, ...)', 3),
    (45, 'kleurverschillen tussen tegels kunnen vaststellen', 3), -- 25
    (46, 'schat de noodzakelijke hoeveelheid aan te maken lijm/specie in', 3),
    (46, 'juiste verhouding kunnen bepalen', 3),
    (46, 'lijm aanmaken volgens de voorschriften van de producent', 3),
    (46, 'mengtijden respecteren', 3),
    (47, 'schat de noodzakelijk aan te maken hoeveelheid lijm in', 3), -- 30
    (47, 'juiste verhouding kunnen bepalen', 3),
    (47, 'lijm aanmaken volgens de voorschriften van de producent', 3),
    (47, 'mengtijden respecteren', 3),
    (48, 'bepaalt en tekent de startlijn af op de wand', 3),
    (48, 'bepaalt de passtukken aan de zijkanten (breedte uitzetten van het tegelwerk', 3), -- 35
    (48, 'plaatst de loodlijnen op de wand', 3),
    (48, 'brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (48, 'plaatst de tegel op de loodlijn', 3),
    (48, 'drukt de tegel voldoende aan', 3),
    (48, 'plaatst de kruisjes (voegafstandhouders)', 3), -- 40
    (48, 'controleert de vlakheid van de overgangen tussen de tegels', 3),
    (48, 'meet de passtukken op', 3),
    (48, 'plaatst de passtukken', 3),
    (49, 'verdeelt de te betegelen ruimte (lengte- en breedteverdeling', 3),
    (49, 'tekent de eerste lijn af op de vloer', 3), -- 45
    (49, 'brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (49, 'plaatst de tegel op de verdeellijn', 3),
    (49, 'drukt de tegel voldoende aan', 3),
    (49, 'plaatst de kruisjes (voegafstandhouders)', 3),
    (49, 'controleert de vlakheid van de overgangen tussen de tegels', 3), -- 50
    (49, 'meet de passtukken op', 3),
    (49, 'plaatst de passtukken', 3),
    (124, 'Controleert en beoordeelt de vlakheid van de muur', 3),
    (124, 'Controleert en beoordeelt de loodrechtheid van de muur', 3),
    (124, 'Controleert de haaksheid van de hoeken', 3), -- 55
    (125, 'Controleert of er geen vochtige plekken aanwezig zijn', 3),
    (125, 'Controleert of het pleisterwerk voldoende droog is', 3),
    (125, 'Controleert de luchtvochtigheidsgraad in de ruimte', 3),
    (126, 'Controleert of de te betegelen oppervlakte geen losse delen bevat', 3),
    (126, 'Controleert of de hoeken zuiver afgewerkt zijn (geen resten van pleisterwerk)', 3), -- 60
    (126, 'Controleert of er geen scheuren of barsten aanwezig zijn', 3),
    (126, 'Controleert of er geen brokken aan de te betegelen gedeelten zijn (hoeken zuiver)', 3),
    (127, 'Bepaalt of het uitbreken manueel of machinaal kan gebeuren', 3),
    (127, 'Beschermt de vloer en de elementen tegen beschadigingen', 3),
    (127, 'Bepaalt de beginplaats voor de uitbreekwerkzaamheden', 3), -- 65
    (127, 'Breekt op een gecontroleerde wijze de tegels uit', 3),
    (127, 'Voert een eindcontrole uit op de uitbreekwerkzaamheden', 3),
    (128, 'Bepaalt de meest geschikte afvoermethode', 3),
    (128, 'Voert op een gecontroleerde manier de werkzaamheden uit', 3),
    (128, 'Voorkomt beschadigingen aan andere oppervlakten of elementen', 3), -- 70
    (129, 'Beoordeelt de scheur', 3),
    (129, 'Verwijdert losse delen (bezetsel)', 3),
    (129, 'Maakt de scheur stofvrij', 3),
    (129, 'Kiest de juiste producten om de scheuren op te vullen', 3),
    (129, 'Maakt de vulmortel aan volgens de voorschriften van de producent', 3), -- 75
    (129, 'Vult de scheuren op de juiste manier op', 3),
    (129, 'Vlakt het oppervlak nadien uit (afschuren)', 3),
    (130, 'Bepaalt het te gebruiken materiaal voor het onderkader', 3),
    (130, 'Bepaalt de grootte van het onderkader', 3),
    (130, 'Zet de omtrekslijnen van het onderkader uit', 3), -- 80
    (130, 'Stelt het houten onderkader samen', 3),
    (130, 'Plaatst het onderkader en verankert het op correcte wijze', 3),
    (130, 'Bouwt het onderkader op in gipsblokken', 3),
    (130, 'Maakt het onderkader klaar om te betegelen (hechtingslaag aanbrengen)', 3),
    (131, 'Bepaalt het te gebruiken materiaal voor de wand', 3), -- 85
    (131, 'Zet de omtrekslijnen van de wand uit', 3),
    (131, 'Stelt de houten wand samen', 3),
    (131, 'Plaatst de wand en verankert hem op correcte wijze', 3),
    (131, 'Bouwt de wand op in gipsblokken', 3),
    (131, 'Maakt de wand klaar om te betegelen (hechtingslaag aanbrengen)', 3), -- 90
    (132, 'Bepaalt de plaats van de rei', 3),
    (132, 'Bepaalt de bevestigingsmethode', 3),
    (132, 'Bepaalt de plaats van de muurhaken', 3),
    (132, 'Bevestigt de rei op de muur volgens de hoogtelijn', 3),
    (133, 'Schat de noodakelijk aan te maken hoeveelheid lijm in', 3), -- 95
    (133, 'Juiste verhouding kunnen bepalen', 3),
    (133, 'Lijm aanmaken volgens de voorschriften van de producent', 3),
    (133, 'Mengtijden respecteren', 3),
    (134, 'Bepaalt de juiste lijmkan in functie van het uit te voeren werk', 3),
    (134, 'Bepaalt de grootte van de in te lijmen oppervlakken', 3), -- 100
    (134, 'Brengt de lijm gelijkmatig aan op het volledige tegeloppervlak', 3),
    (134, 'Verwijdert overtollige lijmresten', 3),
    (135, 'Bepaalt de plaats van het profiel', 3),
    (135, 'Maakt het profiel op de juiste lengte', 3),
    (135, 'Plaatst het profiel in de lijm en drukt het op de juiste plaats', 3), -- 105
    (135, 'Plaatst het tegelwerk over het profiel', 3),
    (135, 'Controleert de aansluitingen tussen profiel en tegelwerk', 3),
    (135, 'Werkt de overgang correct af (overtollige lijm verwijderen, afwassen, ...)', 3),
    (136, 'Tekent de tegel juist af', 3),
    (136, 'Plaatst de tegel correct en vlak onder de tegelsnijder', 3), -- 110
    (136, 'Snijdt de tegels op een correcte manier (één vloeiende beweging)', 3),
    (136, 'Breekt de tegel op de juiste manier', 3),
    (137, 'Tekent de tegel juist af', 3),
    (137, 'Knipt in kleine stapjes', 3),
    (137, 'Zorgt voor voldoende steunvlak van de tegel tijdens het knippen', 3), -- 115
    (138, 'Tekent de tegel juist af', 3),
    (138, 'Kiest het juiste zaagblad in functie van de tegel', 3),
    (138, 'Zaagt op een gecontroleerde en juiste manier', 3),
    (138, 'Heeft oog voor de veiligheid', 3),
    (139, 'Bepaalt en tekent de sttartlijn af op de tegelwand', 3), -- 120
    (139, 'Bepaalt de passtukken aan de zijkanten (breedte uitzetten van het tegelwerk', 3),
    (139, 'Plaatst de loodlijnen op de wand', 3),
    (139, 'Brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (139, 'Plaatst de tegel op de loodlijn', 3),
    (139, 'Plaatst de touw of kruisjes', 3), -- 125
    (139, 'Plaatst de volgende rij tegels', 3),
    (139, 'Controleert de voegafstanden', 3),
    (139, 'Drukt de tegel voldoende aan', 3),
    (139, 'Controleert de vlakheid van de overgangen tussen de tegels', 3),
    (139, 'Meet de passtukken op', 3), -- 130
    (139, 'Plaatst de passtukken', 3),
    (140, 'Schat de noodzakelijk aan te maken hoeveelhied lijm / specie in', 3),
    (140, 'Bepaalt de juiste verhouding', 3),
    (140, 'Maakt voegspecie aan volgens de voorschriften van de producent', 3),
    (140, 'Respecteert de mengtijden', 3), -- 135
    (141, 'Wast de muur af zodat tegels vuilvrij zijn', 3),
    (141, 'Maakt de voegen lijmvrij', 3),
    (141, 'Brengt de specie in voldoende mate aan op de muur', 3),
    (141, 'Zorgt dat de voegen volledig gevuld zijn', 3),
    (141, 'Overtollige specie verwijderen en het tegeloppervlak reinigen', 3), -- 140
    (141, 'Kuist de muur af met een vochtige spons', 3),
    (141, 'Wrijft de muur na met een droge doek', 3),
    (142, 'Tegels nakuisen met vochtige / droge doek', 3),
    (142, 'Kleine gaatjes in het voegwerk herstellen', 3),
    (143, 'Houdt het pistool onder de juiste hoek', 3), -- 145
    (143, 'Brengt voegsel gelijkmatig aan', 3),
    (143, 'Brengt voegsel in een vloeiende beweging aan', 3),
    (143, 'Zorgt voor naadloze overgangen', 3),
    (143, 'Haalt de spanning van het pistool af als het pistool wordt verwijderd van de voeg', 3),
    (143, 'Houdt de spuitmond proper tijdens en na afloop van de werkzaamheden', 3), -- 150
    (143, 'Sluit de spuitmond op correcte wijze af na de werkzaamheden', 3),
    (144, 'Bepaalt en selecteert de juiste hulpmiddelen in functie van de werkzaamheden', 3),
    (144, 'Gebruikt de hulpmiddelen op correcte wijze', 3),
    (144, 'Plaatst de voeten vlak en voldoende gespreid voor het optillen van zware lasten', 3),
    (144, 'Gaat voldoende door de knieën', 3), -- 155
    (144, 'Houdt de rug tijdens het tillen zo recht mogelijk', 3),
    (145, 'Bepaalt op voorhand de meest natuurlijke houding voor het uitvoeren van de werkzaamheden', 3),
    (145, 'Bepaalt of er hulpmiddelen noodzakelijk zijn om het werk uit te voeren (ladders, kniebescherming, ...)', 3),
    (145, 'Verplaatst zich indien nodig voor het uitvoeren van het werk en neemt geen risicovolle werkhoudingen aan (reiken op een ladder, buiten de steiger hangen, ...', 3),
    (146, 'Volgt een opgestelde planning', 3), -- 160
    (146, 'Voert een opracht voor basismetselen binnen een opgegeven tijd correct uit', 3),
    (147, 'Verwerkt eerst aangebroken producten', 3),
    (147, 'Maakt beperkte materiaalhoeveelheden aan in functie van de werktijd', 3),
    (147, 'Draagt zorg voor de opslag en bewaarprocedure van materialen', 3),
    (148, 'Draagt veiligheidsschoenen', 3), -- 165
    (148, 'Draagt een werkpak', 3),
    (148, 'Draagt een helm', 3),
    (149, 'Checkt de veiligheidsinstructiekaart', 3),
    (149, 'Selecteert de juiste PBM', 3),
    (149, 'Gebruikt de PBM op de juiste manier', 3), -- 170
    (150, 'Bepaalt zijn eigen werkzone', 3),
    (150, 'Bakent zijn eigen werkzone af', 3),
    (151, 'Zet geen materiaal in veiligszones', 3),
    (151, 'Houdt doorgangen (deuropeningen) vrij', 3),
    (151, 'Respecteert veiligheidspictogrammen', 3), -- 175
    (152, 'Leest de handleiding/etiket', 3),
    (152, 'Leest de H- en P-zinnen per product', 3),
    (152, 'Voert de verwerking van producten uit volgens de voorschriften', 3),
    (153, 'Past de gedragsregels toe', 3),
    (153, 'Volgt de afgesproken procedures', 3), -- 180
    (153, 'Past de voorschriften met betrekking tot netheid en hygiëne op de werkplek toe', 3),
    (154, 'Gebruikt de veiligheidsinstructiekaarten vor aanvang van de werkzaamheden', 3),
    (154, 'Volgt de op te nemen acties van de VIK correct op', 3),
    (154, 'Anticipeert op mogelijk gevaarlijke situaties (preventief)', 3),
    (155, 'Sorteert afval zoals pmd, papier, karton, restafval, ... correct', 3), -- 185
    (155, 'Sorteert restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct', 3),
    (155, 'Vraagt om informatie in geval van twijfel', 3),
    (156, 'Respecteert de milieuvoorschriften', 3),
    (156, 'Slaat restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct op', 3),
    (156, 'Slaat afval zoals pmd, papier, karton, restafval, ... correct op', 3), -- 190
    (157, 'Controleert de gereedschappen voor gebruik', 3),
    (157, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3),
    (157, 'Wendt de gereedschappen correct en vakkundig aan', 3),
    (158, 'Controleert de machines voor gebruik', 3),
    (158, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3), -- 195
    (158, 'Wendt de machines correct en vakkundig aan', 3),
    (159, 'Reinigt persoonlijke handgereedschappen zorgvuldig (zoals truweel, voegijzers, pleisterspaan, ...)', 3),
    (159, 'Reinigt gemeenschappelijke gereedschappen zorgvuldig (zoals kruiwagens, mortelkuipen, mortelemmers, ...)', 3),
    (159, 'Slaat persoonlijke gereedschappen na de werkzaamheden correct op', 3),
    (159, 'Slaat gemeenschappelijke gereedschappen na de werkzaamheden correct op', 3), -- 200
    (160, 'Reinigt gemeenschappelijke machines na gebruik correct (zoals de betonmolen, ...)', 3),
    (160, 'Reinigt handmachines na gebruik correct (zoals de boormachine met mixer, boorhamer, ...)', 3),
    (160, 'Slaat de bouwmachines volgens de voorgeschreven regels op', 3),
    (160, 'Slaat handmachines volgens de voorgeschreven regels op', 3),
    (161, 'Heeft oog voor een ordelijke werkomgeving', 3), -- 205
    (161, 'Heeft de wil om kwaliteitsvol werk te leveren', 3),
    (161, 'Werkt nauwkeurig tijdens het uitvoeren van het werk (opmetingen, berekeningen, materiaal klaarmaken, afwerking, ...', 3),
    (162, 'Neemt raad aan van collega\'s en medeleerlingen', 3),
    (162, 'Helpt iemand spontaan', 3),
    (162, 'Werkt gericht en positief samen', 3), -- 210
    (163, 'Neemt een leergierige houding aan', 3),
    (163, 'Zoekt mee naar oplossingen bij problemen', 3),
    (163, 'Geeft de moed niet op, ook bij minder goede resultaten', 3),
    (164, 'Meet de lengtematen op', 3),
    (164, 'Meet de breedtematen op', 3), -- 215
    (164, 'Meet de hoogtematen op', 3),
    (165, 'Berekent de totale oppervlakte', 3),
    (165, 'Berekent de hoeveelheid noodzakelijk materiaal', 3),
    (165, 'Bepaalt de hoeveelheid grondstoffen in functie van de mengverhouding', 3),
    (166, 'Selecteert de juiste meetgereedschappen', 3), -- 220
    (166, 'Gebruikt de meetgereedschappen op correcte wijze', 3),
    (166, 'Reinigt en bergt de meetgereedschappen op correcte wijze op', 3),
    (167, 'Plaatst de waterpas op correcte wijze in functie van een horizontale controle', 3),
    (167, 'Plaatst de waterpas op correcte wijze in functie van een verticale controle', 3),
    (167, 'Leest de resultaten op correcte wijze af', 3), -- 225
    (168, 'Herkent materialen via de tekening (soorten stenen)', 3),
    (168, 'Herkent steenformaten (halve steen, drieklezoor, klezoor)', 3),
    (168, 'Kan eenvoudige metselverbanden afleiden van de tekening', 3),
    (168, 'Kan eenvoudige afmetingen terugvinden via de tekening', 3),
    (169, 'Kan het aantal stenen bepalen', 3),
    (169, 'Kan de noodzakelijke hoeveelheid mortel inschatten', 3), -- 230
    (170, 'Kan de noodzakelijke handgereedschappen selecteren in functie van de opdracht (truweel, voegijzer, ...)', 3),
    (170, 'Kan de noodzakelijke controlegereedschappen bepalen (waterpas, regel, ...)', 3),
    (170, 'Kan de noodzakelijke hulpmiddelen bepalen (mortelkuip, kruiwagen, ...)', 3),
    (171, 'Kan de noodzakelijke machine kiezen in functie van mortel maken', 3),
    (171, 'Kan de noodzakelijke machine kiezen voor het op maat maken van de stenen', 3), -- 235
    (172, 'Kan een stappenplan volgen', 3),
    (172, 'Kan in grote lijnen de volgorde van de stappen weergeven', 3),
    (172, 'Houdt rekening met de opmerkingen / aandachtspunten in een stappenplan', 3),
    (172, 'Kan een eenvoudig stappenplan opstellen', 3),
    (174, 'Controleert of de producten en materialen gebruiksklaar zijn', 3), -- 240
    (174, 'Beoordeelt of de gereedschappen gebruiksklaar zijn', 3),
    (174, 'Voert een tussentijdse controle uit van zijn werk', 3),
    (175, 'Controleert zijn werk op afmetingen', 3),
    (175, 'Controleert zijn werk op kwaliteit (gestelde eisen)', 3),
    (176, 'Bij problemen hulp vragen', 3), -- 245
    (176, 'Fouten toegeven', 3),
    (176, 'Gemaakte fouten corrigeren', 3),
    (177, 'Uit gemaakte fouten verbeterpunten aanduiden naar de toekomst', 3),
    (178, 'Bepaalt de plaats van de profielen', 3),
    (178, 'Plaatst de profielen loodrecht en stabiel', 3), -- 250
    (178, 'Bepaalt de meterpas (slangwaterpas, niveaumeter of laser)', 3),
    (178, 'Zet de lagenmaat uit op de profielen', 3),
    (178, 'Plaatst de metseldraad', 3),
    (178, 'Gebruikt voldoende mortel', 3),
    (178, 'Spreidt de mortel correct', 3), -- 255
    (178, 'Plaatst de stenen op correcte wijze', 3),
    (178, 'Verwijdert de overtollige mortel', 3),
    (178, 'Metselt met voldoende vlotheid en de juiste techniek', 3),
    (179, 'Respecteert de verhoudingen van het metselverband', 3),
    (179, 'Respecteert het metselverband', 3), -- 260
    (179, 'Bewaakt de voegbreedte', 3),
    (179, 'Bewaakt de plaats van de stootvoegen', 3),
    (180, 'Bepaalt de plaats van de profielen', 3),
    (180, 'Plaatst de profielen loodrecht en stabiel', 3),
    (180, 'Bepaalt de meterpas (slangwaterpas, niveaumeter of laser)', 3), -- 265
    (180, 'Zet de lagenmaat uit op de profielen', 3),
    (180, 'Plaatst de metseldraad', 3),
    (180, 'Gebruikt voldoende mortel', 3),
    (180, 'Spreidt de mortel correct', 3),
    (180, 'Plaatst de stenen op correcte wijze', 3), -- 270
    (180, 'Verwijdert de overtollige mortel', 3),
    (180, 'Metselt met voldoende vlotheid en de juiste techniek', 3),
    (181, 'Respecteert de verhoudingen van het metselverband', 3),
    (181, 'Respecteert het metselverband', 3),
    (181, 'Bewaakt de voegbreedte', 3), -- 275
    (181, 'Bewaakt de plaats van de stootvoegen', 3),
    (183, 'Bepaalt de plaats van het element', 3),
    (183, 'Plaatst het element', 3),
    (183, 'Controleert de plaatsing', 3),
    (183, 'Werkt het element af', 3), -- 280
    (184, 'Past de juiste techniek toe voor het uitkrabben van de voegen', 3),
    (184, 'Krabt de voegen uit tot een diepte van 10mm', 3),
    (184, 'Borstelt de voegen na het uitkrabben', 3),
    (185, 'Past de juiste techniek toe om meegaand te voegen', 3),
    (185, 'Voegt de opdracht egaal en even diep', 3), -- 285
    (185, 'Borstelt het voegwerk', 3),
    (186, 'Bepaalt de juiste hulpmiddelen in functie van de werkzaamheden', 3),
    (186, 'Selecteert de juiste hulpmiddelen in functie van de werkzaamheden', 3),
    (186, 'Gebruikt de hulpmiddelen op correcte wijze', 3),
    (186, 'Plaatst de voeten vlak en voldoende gespreid voor het optillen van zware lasten', 3), -- 290
    (186, 'Gaat voldoende door de knieën', 3),
    (186, 'Houdt de rug tijdens het tillen zo recht mogelijk', 3),
    (187, 'Bepaalt op voorhand de meest natuurlijke houding voor het uitvoeren van de werkzaamheden (zittend op de knieën, staande houdingen, ...)', 3),
    (187, 'Bepaalt of er hulpmiddelen noodzakelijk zijn om het werk uit te voeren (steigers, (trap)ladders, ...)', 3),
    (187, 'Verplaatst zich indien nodig voor het uitvoeren van het werk en neemt geen risicovolle werkhoudingen aan (reiken op een ladder, buiten de steiger hangen, ...', 3), -- 295
    (188, 'Volgt een opgestelde planning', 3),
    (188, 'Voert een opracht voor voegwerk in cement binnen een opgegeven tijd correct uit', 3),
    (189, 'Verwerkt eerst aangebroken producten (cement, kleurstoffen, detergenten, ...)', 3),
    (189, 'Maakt beperkte materiaalhoeveelheden aan in functie van de werktijd', 3),
    (189, 'Draagt zorg voor de opslag en bewaarprocedure van materialen', 3), -- 300
    (190, 'Draagt veiligheidsschoenen', 3),
    (190, 'Draagt een werkpak', 3),
    (190, 'Draagt een helm', 3),
    (191, 'Checkt de veiligheidsinstructiekaart', 3),
    (191, 'Selecteert de juiste PBM', 3), -- 305
    (191, 'Gebruikt de PBM op de juiste manier', 3),
    (192, 'Bepaalt zijn eigen werkzone', 3),
    (192, 'Bakent zijn eigen werkzone af', 3),
    (193, 'Zet geen materiaal in veiligszones', 3),
    (193, 'Houdt doorgangen (deuropeningen) vrij', 3), -- 310
    (193, 'Respecteert veiligheidspictogrammen', 3),
    (193, 'Controleert de steigers op gebreken (zoals bijv. ontbreken van CBM\'s zoals plinten, leuningen, ...)', 3),
    (194, 'Leest de handleiding/etiket', 3),
    (194, 'Leest de H- en P-zinnen per product', 3),
    (194, 'Voert de verwerking van producten uit volgens de voorschriften van de producent', 3), -- 315
    (195, 'Past de gedragsregels toe', 3),
    (195, 'Volgt de afgesproken procedures', 3),
    (195, 'Past de voorschriften met betrekking tot netheid en hygiëne toe', 3),
    (196, 'Gebruikt de veiligheidsinstructiekaarten vor aanvang van de werkzaamheden', 3),
    (196, 'Volgt de op te nemen acties van de VIK correct op', 3), -- 320
    (196, 'Anticipeert op mogelijk gevaarlijke situaties (preventief)', 3),
    (197, 'Bepaalt in functie van de uit te voeren werkzaamheden het gebruik van een ladder of steiger', 3),
    (197, 'Betreedt en verlaat de ladder of steiger op correcte wijze', 3),
    (197, 'Respecteert de algemene veiligheidsregels voor het werken op ladders en steigers', 3),
    (197, 'Neemt geen onnodige risico\'s tijdens het werken op ladders en/of steigers', 3), -- 325
    (198, 'Beoordeelt de staat van een ladder', 3),
    (198, 'Stelt de ladder op volgens de juiste hellingsgraad', 3),
    (198, 'Zekeret de opstelling van de ladder indien nodig', 3),
    (199, 'Beoordeelt de staat van de stelling', 3),
    (199, 'Monteert / demonteert de stelling volgens voorschrift van de producent (VIK)', 3), -- 330
    (199, 'Monteert / demonteert op een stelling een werkvloer', 3),
    (199, 'Monteert / demonteert op een stelling leuningen', 3),
    (199, 'Monteert / demonteert op een stelling kantplanken', 3),
    (199, 'Zekert de opstelling van de stelling indien nodig', 3),
    (200, 'Sorteert afval zoals pmd, papier, karton, restafval, ... correct', 3), -- 335
    (200, 'Sorteert restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct', 3),
    (200, 'Vraagt om informatie in geval van twijfel', 3),
    (201, 'Respecteert de milieuvoorschriften', 3),
    (201, 'Slaat restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct op', 3),
    (201, 'Slaat afval zoals pmd, papier, karton, restafval, ... correct op', 3), -- 340
    (202, 'Controleert de gereedschappen voor gebruik', 3),
    (202, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3),
    (202, 'Wendt de gereedschappen correct en vakkundig aan', 3),
    (203, 'Controleert de machines voor gebruik', 3),
    (203, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3), -- 345
    (203, 'Wendt de machines correct en vakkundig aan', 3),
    (204, 'Reinigt persoonlijke handgereedschappen zorgvuldig (zoals truweel, voegijzers, pleisterspaan, ...)', 3),
    (204, 'Reinigt gemeenschappelijke gereedschappen zorgvuldig (zoals kruiwagens, mortelkuipen, mortelemmers, ...)', 3),
    (204, 'Slaat persoonlijke gereedschappen na de werkzaamheden correct op', 3),
    (204, 'Slaat gemeenschappelijke gereedschappen na de werkzaamheden correct op', 3), -- 350
    (205, 'Reinigt gemeenschappelijke machines na gebruik correct (zoals de betonmolen, ...)', 3),
    (205, 'Slaat de bouwmachines volgens de voorgeschreven regels op', 3),
    (206, 'Heeft oog voor een ordelijke werkomgeving', 3),
    (206, 'Heeft de wil om kwaliteitsvol werk te leveren', 3),
    (206, 'Werkt nauwkeurig tijdens het uitvoeren van het werk (opmetingen, berekeningen, materiaal klaarmaken, afwerking, ...', 3), -- 355
    (207, 'Neemt raad aan van collega\'s en medeleerlingen', 3),
    (207, 'Helpt iemand spontaan', 3),
    (207, 'Werkt gericht en positief samen', 3),
    (208, 'Neemt een leergierige houding aan', 3),
    (208, 'Zoekt mee naar oplossingen bij problemen', 3), -- 360
    (208, 'Geeft de moed niet op, ook bij minder goede resultaten', 3),
    (209, 'Gaat op een respectvolle manier om met de hiërarchie binnen het bedrijf / centrum', 3),
    (209, 'Op een correcte manier communiceren indien de uitvoering van opgelegde taken in het gedrang komt', 3),
    (209, 'Voert de afspraken uit zoals ze zijn gemaakt', 3),
    (210, 'Beoordeelt de weersomstandigheden in functie vna het werk', 3), -- 365
    (210, 'Plant de uit te voeren werkzaamheden in functie van de werkomstandigheden', 3),
    (210, 'Neemt beslissingen in het belang van de werkzaamheden bij plotse werkveranderingen', 3),
    (210, 'Past de werkmethode aan in functie van de plaatselijke weersomstandigheden', 3),
    (211, 'Meet de lengtematen op', 3),
    (211, 'Meet de breedtematen op', 3), -- 370
    (211, 'Meet de hoogtematen op', 3),
    (212, 'Berekent de totale oppervlakte', 3),
    (212, 'Berekent de hoeveelheid noodzakelijk materiaal', 3),
    (212, 'Bepaalt de hoeveelheid grondstoffen in functie van de mengverhouding', 3),
    (213, 'Selecteert de juiste meetgereedschappen', 3), -- 375
    (213, 'Gebruikt de meetgereedschappen op correcte wijze', 3),
    (213, 'Reinigt en bergt de meetgereedschappen op correcte wijze op', 3),
    (214, 'Herkent vochtproblemen', 3),
    (214, 'Voert op een correcte manier een vochtmeting uit', 3),
    (214, 'Leest en interpreteert de resultaten van de meting', 3), -- 380
    (215, 'Kan de hoeveelheid bestandsdelen van de voegmortel inschatten', 3),
    (215, 'Kan de hoeveelheid voegmortel inschatten', 3),
    (216, 'Kan de noodzakelijke handgereedschappen selecteren in functie van de opdracht (truweel, voegplaat, voegijzer, ...)', 3),
    (216, 'Kan de noodzakelijke controlegereedschappen bepalen (meter, vochtmeter, ...)', 3),
    (216, 'Kan de noodzakelijke hulpmiddelen bepalen (mortelkuip, kruiwagen, ...)', 3), -- 385
    (217, 'Kan de noodzakelijke machine kiezen in functie van mortel maken', 3),
    (217, 'Kan de noodzakelijke machine kiezen voor het verwijderen van oude voegen', 3),
    (218, 'Kan een stappenplan volgen', 3),
    (218, 'Kan in grote lijnen de volgorde van de stappen weergeven', 3),
    (218, 'Houdt rekening met de opmerkingen / aandachtspunten in een stappenplan', 3), -- 390
    (218, 'Kan een eenvoudig stappenplan opstellen', 3),
    (219, 'Controleert of de producten en materialen gebruiksklaar zijn', 3),
    (219, 'Beoordeelt of de gereedschappen gebruiksklaar zijn', 3),
    (219, 'Voert een tussentijdse controle uit van zijn werk', 3),
    (220, 'Controleert zijn werk op voegtechniek', 3), -- 395
    (220, 'Controleert zijn werk op kwaliteit (gestelde eisen)', 3),
    (221, 'Bij problemen hulp vragen', 3),
    (221, 'Fouten toegeven', 3),
    (221, 'Gemaakte fouten corrigeren', 3),
    (222, 'Uit gemaakte fouten verbeterpunten aanduiden naar de toekomst', 3), -- 400
    (223, 'Stofbescherming op correcte wijze aanbrengen', 3),
    (223, 'Signalisatie op correcte wijze plaatsen', 3),
    (224, 'Selecteert de noodzakelijke gereedschappen', 3),
    (224, 'Past de juiste techniek toe voor het uitkrabben van de voegen', 3),
    (224, 'Krabt de lintvoegen uit tot op 10 mm diepte', 3), -- 405
    (224, 'Krabt de stootvoegen uit tot op 10 mm diepte', 3),
    (225, 'Seleteert de noodzakelijke machines en gereedschappen', 3),
    (225, 'Freest/slijpt de voegen uit tot op 10 mm diepte', 3),
    (225, 'Gebruikt de juiste techniek voor het materiaal verwijderen van oude voegvulling', 3),
    (225, 'Beschermt de omgeving tegen de invloeden van het uitslijpen/uitfrezen van de voegen', 3), -- 410
    (226, 'De mate van verontreiniging beoordelen', 3),
    (226, 'De op te voegen delen zo stofvrij mogelijk maken met handveger', 3),
    (226, 'Verwijdert het vuil op de grond voordat hij verder gaat', 3),
    (227, 'De voor- en nadelen van deze techniek in eigen woorden omschrijven', 3),
    (227, 'Gebruikt de correcte techniek om voegen te reinigen met een waterstraal', 3), -- 415
    (227, 'Beschermt de omgeving tegen de invloed van het water', 3),
    (227, 'Reinigt de voegen met de meest gepaste waterstraal (kracht, breedte, vuilfrees)', 3),
    (228, 'De oorzaken van muuruitslag verwoorden', 3),
    (228, 'Goede voorstellen doen om te behandelen', 3),
    (228, 'Een behandeling tegen muuruitslag op correcte wijze uitvoeren', 3), -- 420
    (228, 'De gevolgen van muuruitslag voor het voegwerk in eigen woorden omschrijven', 3),
    (229, 'Herstellingsmogelijkheden voor metselwerk voorstellen', 3),
    (229, 'De juiste materialen kiezen (reparatiemortel) in functie van de situatie', 3),
    (229, 'Reparatiewerken aan scheuren op correcte wijze uitvoeren', 3),
    (229, 'De oorzaak van de scheuren opsporen (vocht, het werken van de gevel, ...)', 3), -- 425
    (229, 'Het bestaande voegsel perfect kunnen benaderen op kleur', 3),
    (230, 'Selecteert de juiste bestanddelen', 3),
    (230, 'Mengt de bestanddelen in de juiste verhouding (droog mengen)', 3),
    (230, 'Voegt voldoende water toe', 3),
    (230, 'Mengt het geheel tot een goede voegmortel', 3), -- 430
    (231, 'Selecteert de juiste bestanddelen', 3),
    (231, 'Schept de grondstoffen in verhouding in de machine', 3),
    (231, 'Voegt stelselmatig voldoende water toe', 3),
    (231, 'Mengt het geheel tot een goede voegmortel', 3),
    (232, 'Volgens de door de producent voorgeschreven dosering additieven toevoegen aan de mortel tegen schimmels, bacteriënvochtindringing en micro-organisme', 3), -- 435
    (232, 'Mengt voegmortels in verschillende natuurlijke kleuren (wit and, zavel, cement, ...)', 3),
    (232, 'Met behulp van pigmentstoffen een voegmortel aanmaken in de gewenste kleur', 3),
    (233, 'Selecteert de juiste gereedschappen', 3),
    (233, 'Voegt eerst de stootvoegen in combinatie met de lintvoegen', 3),
    (233, 'Voegt met de juiste techniek', 3), -- 440
    (233, 'Voegt de voegen voldoende vol', 3),
    (233, 'Heeft goede overgangen tussen de stoot- en lintvoegen', 3),
    (234, 'Bepaalt de staat van de opgevulde voeg', 3),
    (234, 'Verwijdert grote hoeveelheden voegmortel', 3),
    (234, 'Werkt de voeg af met een handveger', 3), -- 445
    (234, 'Voert een eindcontrole uit', 3),
    (234, 'Ruimt de restmortel op', 3),
    (235, 'De oorzaak van de beschadiging vaststellen', 3),
    (235, 'Beschadigd voegwerk verwijderen', 3),
    (235, 'Ondergrond reinigen', 3), -- 450
    (235, 'De kleur van het bestaande voegsel zo correct mogelijk benaderen', 3),
    (235, 'Onopvallendheid van de herstellingswerken bewaken', 3),
    (236, 'Bepaalt en selecteert de juiste hulpmiddelen in functie van de werkzaamheden', 3),
    (236, 'Gebruikt de hulpmiddelen op correcte wijze', 3),
    (236, 'Plaatst de voeten vlak en voldoende gespreid voor het optillen van zware lasten', 3), -- 455
    (236, 'Gaat voldoende door de knieën', 3),
    (236, 'Houdt de rug tijdens het tillen zo recht mogelijk', 3),
    (237, 'Bepaalt op voorhand de meest natuurlijke houding voor het uitvoeren van de werkzaamheden', 3),
    (237, 'Bepaalt of er hulpmiddelen noodzakelijk zijn om het werk uit te voeren (ladders, kniebescherming, ...)', 3),
    (237, 'Verplaatst zich indien nodig voor het uitvoeren van het werk en neemt geen risicovolle werkhoudingen aan (reiken op een ladder, buiten de steiger hangen, ...', 3), -- 460
    (238, 'Volgt een opgestelde planning', 3),
    (238, 'Voert een opracht voor elastisch voegwerk binnen een opgegeven tijd correct uit', 3),
    (239, 'Verwerkt eerst aangebroken producten', 3),
    (239, 'Maakt beperkte materiaalhoeveelheden aan in functie van de werktijd', 3),
    (239, 'Draagt zorg voor de opslag en bewaarprocedure van materialen', 3), -- 465
    (240, 'Draagt veiligheidsschoenen', 3),
    (240, 'Draagt een werkpak', 3),
    (240, 'Draagt een helm', 3),
    (241, 'Checkt de veiligheidsinstructiekaart', 3),
    (241, 'Selecteert de juiste PBM', 3), -- 470
    (241, 'Gebruikt de PBM op de juiste manier', 3),
    (242, 'Bepaalt zijn eigen werkzone', 3),
    (242, 'Bakent zijn eigen werkzone af', 3),
    (243, 'Zet geen materiaal in veiligszones', 3),
    (243, 'Houdt doorgangen (deuropeningen) vrij', 3), -- 475
    (243, 'Respecteert veiligheidspictogrammen', 3),
    (244, 'Leest de handleiding/etiket', 3),
    (244, 'Leest de H- en P-zinnen per product', 3),
    (244, 'Voert de verwerking van producten uit volgens de voorschriften', 3),
    (245, 'Past de gedragsregels toe', 3), -- 480
    (245, 'Volgt de afgesproken procedures', 3),
    (245, 'Past de voorschriften met betrekking tot netheid en hygiëne op de werkplek toe', 3),
    (246, 'Gebruikt de veiligheidsinstructiekaarten vor aanvang van de werkzaamheden', 3),
    (246, 'Volgt de op te nemen acties van de VIK correct op', 3), 
    (246, 'Anticipeert op mogelijk gevaarlijke situaties (preventief)', 3), -- 485
    (247, 'Sorteert afval zoals pmd, papier, karton, restafval, ... correct', 3),
    (247, 'Sorteert restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct', 3),
    (247, 'Vraagt om informatie in geval van twijfel', 3),
    (248, 'Respecteert de milieuvoorschriften', 3),
    (248, 'Slaat restproducten zoals cement, kleurstof, detergent, reinigingsproducten, ... correct op', 3), -- 490
    (248, 'Slaat afval zoals pmd, papier, karton, restafval, ... correct op', 3),
    (249, 'Controleert de gereedschappen voor gebruik', 3),
    (249, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3),
    (249, 'Wendt de gereedschappen correct en vakkundig aan', 3),
    (250, 'Controleert de machines voor gebruik', 3), -- 495
    (250, 'Heeft oog voor de veiligheid (gebruik PBM\'s, CBM\'s, veiligheidsvoorschriften, ...)', 3),
    (250, 'Wendt de machines correct en vakkundig aan', 3),
    (251, 'Reinigt persoonlijke handgereedschappen zorgvuldig (zoals truweel, voegijzers, pleisterspaan, ...)', 3),
    (251, 'Reinigt gemeenschappelijke gereedschappen zorgvuldig (zoals kruiwagens, mortelkuipen, mortelemmers, ...)', 3),
    (251, 'Slaat persoonlijke gereedschappen na de werkzaamheden correct op', 3), -- 500
    (251, 'Slaat gemeenschappelijke gereedschappen na de werkzaamheden correct op', 3),
    (252, 'Reinigt gemeenschappelijke machines na gebruik correct (zoals de betonmolen, boormachine met mixer, boorhamer, ...)', 3),
    (252, 'Slaat de bouwmachines volgens de voorgeschreven regels op', 3),
    (253, 'Heeft oog voor een ordelijke werkomgeving', 3),
    (253, 'Heeft de wil om kwaliteitsvol werk te leveren', 3), -- 505
    (253, 'Werkt nauwkeurig tijdens het uitvoeren van het werk (opmetingen, berekeningen, materiaal klaarmaken, afwerking, ...', 3),
    (254, 'Neemt raad aan van collega\'s en medeleerlingen', 3),
    (254, 'Helpt iemand spontaan', 3),
    (254, 'Werkt gericht en positief samen', 3),
    (255, 'Neemt een leergierige houding aan', 3), -- 510
    (255, 'Zoekt mee naar oplossingen bij problemen', 3),
    (255, 'Geeft de moed niet op, ook bij minder goede resultaten', 3),
    (256, 'Meet de lengtematen op', 3),
    (256, 'Meet de breedtematen op', 3),
    (256, 'Meet de hoogtematen op', 3), -- 515
    (257, 'Berekent de totale oppervlakte', 3),
    (257, 'Berekent de hoeveelheid noodzakelijk materiaal', 3),
    (257, 'Bepaalt de hoeveelheid grondstoffen in functie van de mengverhouding', 3),
    (258, 'Selecteert de juiste meetgereedschappen', 3),
    (258, 'Gebruikt de meetgereedschappen op correcte wijze', 3), -- 520
    (258, 'Reinigt en bergt de meetgereedschappen op correcte wijze op', 3),
    (259, 'Plaatst de waterpas op correcte wijze in functie van een horizontale controle', 3),
    (259, 'Plaatst de waterpas op correcte wijze in functie van een verticale controle', 3),
    (259, 'Leest de resultaten op corecte wijze af', 3),
    (260, 'Herkent materialen via de tekening (soorten stenen)', 3), -- 525
    (260, 'Herkent de steenformaten (halve steen, drieklezoor, klezoor)', 3),
    (260, 'Kan eenvoudige metselverbanden afleiden van de tekening', 3),
    (260, 'Kan eenvoudige afmetingen terugvinden via de tekening', 3),
    (261, 'Kan het aantal stenen bepalen', 3),
    (261, 'Kan de noodzakelijke hoeveelheid mortel inschatten', 3), -- 530
    (262, 'Kan de noodzakelijke handgereedschappen selecteren in functie van de opdracht (truweel, voegijzer, ...)', 3),
    (262, 'Kan de noodzakelijke controlegereedschappen bepalen (waterpas, regel, ...)', 3),
    (262, 'Kan de noodzakelijke hulpmiddelen bepalen (mortelkuip, kruiwagen, ...)', 3),
    (263, 'Kan de noodzakelijke machine kiezen in functie van mortel maken', 3),
    (263, 'Kan de noodzakelijke machine kiezen voor het op maat maken van de stenen', 3), -- 535
    (264, 'Kan een stappenplan volgen', 3),
    (264, 'Kan in grote lijnen de volgorde van de stappen weergeven', 3),
    (264, 'Houdt rekening met de opmerkingen / aandachtspunten in een stappenplan', 3),
    (264, 'Kan een eenvoudig stappenplan opstellen', 3),
    (265, 'Controleert of de producten en materialen gebruiksklaar zijn', 3), -- 540
    (265, 'Beoordeelt of de gereedschappen gebruiksklaar zijn', 3),
    (265, 'Voert een tussentijdse controle uit van zijn werk', 3),
    (266, 'Controleert zijn werk op afmetingen', 3),
    (266, 'Controleert zijn werk op kwaliteit (gestelde eisen)', 3),
    (267, 'Bij problemen hulp vragen', 3), -- 545
    (267, 'Fouten toegeven', 3),
    (267, 'Gemaakte fouten corrigeren', 3),
    (268, 'Uit gemaakte fouten verbeterpunten aanduiden naar de toekomst', 3),
    (269, 'Plakt af tot waar gekit moet worden', 3),
    (269, 'Beschermt de delen die niet gekit moeten worden', 3), -- 550
    (269, 'Beschermt de omgeving tegen restproducten', 3),
    (269, 'Plaatst signalisatie om geleverd kitwerk te beschermen', 3),
    (270, 'Maakt alles stofvrij en ontvet alles', 3),
    (270, 'Plast de juiste techniek toe voor het verwijderen van het oude elastisch voegwerk', 3),
    (270, 'Verwijdert zoveel mogelijk oud elastisch voegwerk', 3), -- 555
    (271, 'Selecteert de noodzakelijke gereedschappen', 3),
    (271, 'Plast de juiste techniek toe voor het uitkrabben van de voegen', 3),
    (271, 'Waar nodig vroegere oude specie verwijderen', 3),
    (272, 'De mate van verontreiniging beoordelen', 3),
    (272, 'De op te voegen delen zo stofvrij mogelijk maken met handveger', 3), -- 560
    (272, 'Verwijdert het vuil op de grond voordat hij verder gaat', 3),
    (273, 'De oorzaken va nmuuruitslag verwoorden', 3),
    (273, 'Goede voorstellen doen om te behandelen', 3),
    (273, 'Een behandeling tegen muuruitslag op correcte wijze uitvoeren', 3),
    (274, 'Herstellingsmogelijkheden voor metselwerk voorstellen en melden', 3), -- 565
    (274, 'De juiste materialen kiezen (reparatiemortel) in functie van de situatie', 3),
    (274, 'Reparatiewerken aan de scheuren op correcte wijze uitvoeren', 3),
    (274, 'De oorzaak van de scheuren opsporen (vocht, het werken van de gevel, ...)', 3),
    (274, 'Het bestaande voegsel perfect kunnen benaderen op kleur', 3),
    (275, 'Producten selecteren om voegen voor te vullen', 3), -- 570
    (275, 'Gereedschappen selecteren om voegen voor te vullen', 3),
    (275, 'Past de juiste techniek toe om voegen voor te vullen', 3),
    (276, 'Maakt producten aan volgens de richtlijnen van de fabrikant', 3),
    (276, 'Waakt over de elasticiteit', 3),
    (276, 'Waakt over de verwerkbaarheid', 3), -- 575
    (277, 'Een aanwezige of te herstellen voegkleur kunnen benaderen', 3),
    (277, 'Een bijpassende kleur combineren', 3),
    (278, 'Goed gebruik van het opspuitpistool', 3),
    (278, 'Goed gebruik van de silliconenpomp', 3),
    (278, 'Naadloze overgangen kunnen spuiten', 3), -- 580
    (278, 'Goed snijden van de spuitmond in functie van de oefening', 3),
    (278, 'Proper houden van de spuitmond', 3),
    (279, 'Vlakke naden kunnen opspuiten', 3),
    (279, 'Hoeknaden kunnen opspuiten', 3),
    (279, 'Naden tussen verschillende materialen of bouwstoffen kunnen opspuiten (vb. Steen-hout)', 3), -- 585
    (280, 'Vlakke naden kunnen opspuiten', 3),
    (280, 'Hoeknaden kunnen opspuiten', 3),
    (280, 'Naden tussen verschillende materialen of bouwstoffen kunnen opspuiten (vb. Steen, hout, beton, architectonisch beton)', 3),
    (281, 'Beschadigde stukken verwijderen', 3),
    (281, 'Voegen stofvrij maken', 3), -- 590
    (281, 'Voegen ontvetten', 3),
    (282, 'Kan de nieuwe voeg aanbrengen', 3),
    (282, 'Kan de nieuwe voeg op de juiste manier afwerken', 3),
    (282, 'Kan de juiste producten gebruiken om de voeg af te werken', 3);

INSERT INTO studenten_modules(studentId, moduleId, opleidingId) VALUES
	-- REAL DATA
    (6,1,null),
    (6,3,1),
    (6,4,1),
    (7,4,2),
    (7,5,2),
    (7,6,null),
    
    -- RANDOM DATA: student 3 (id 8) volgt kapper, 4 (id 9) volgt kok en 5 (id 10) tegelzetter. 6 (id 13) is voeger
	(9, 1, null),
    (10, 7, null),
    (9, 3, 1),
    (10, 3, 3),
    (8, 3, 2),
    (13, 11, 6),
    (13, 12, 6),
    (13, 13, 6);


INSERT INTO evaluaties(name, studentId, moduleId) VALUES
	('opdracht les 1', 10, 7),
	('opdracht les 2', 10, 7);
    
/*INSERT INTO evaluaties_criteria(evaluatieId, criteriumId, criteriumBeoordeling) VALUES
	();*/
    
INSERT INTO evaluaties_aspecten(evaluatieId, aspectId, aspectBeoordeling) VALUES
	(1, 1, TRUE),
    (1, 2, TRUE),
    (1, 3, TRUE),
    (1, 4, TRUE),
    (1, 5, FALSE),
    (1, 6, TRUE),
    (1, 7, TRUE),
    (1, 8, TRUE),
    (1, 9, FALSE),
    (1, 10, TRUE),
    (1, 11, TRUE),
    (1, 12, TRUE),
    (1, 13, TRUE),
    (1, 14, FALSE),
    (1, 15, FALSE),
    (1, 16, FALSE),
    (1, 17, TRUE),
    (1, 18, TRUE),
    (1, 19, TRUE),
    (1, 20, TRUE),
    (1, 21, TRUE),
    (1, 22, TRUE),
    (1, 23, TRUE),
    (1, 24, TRUE),
    (1, 25, FALSE),
    (1, 26, TRUE),
    (1, 27, TRUE),
    (1, 28, TRUE),
    (1, 29, TRUE),
    (1, 30, TRUE),
    (1, 31, TRUE),
    (1, 32, TRUE),
    (1, 33, TRUE),
    (1, 34, FALSE),
    (1, 35, TRUE),
    (1, 36, TRUE),
    (1, 37, TRUE),
    (1, 38, TRUE),
    (1, 39, TRUE),
    (1, 40, TRUE),
    (1, 41, TRUE),
    (1, 42, TRUE),
    (1, 43, TRUE),
    (1, 44, FALSE),
    (1, 45, TRUE),
    (1, 46, TRUE),
    (1, 47, TRUE),
    (1, 48, TRUE),
    (1, 49, TRUE),
    (1, 50, TRUE),
    (1, 51, TRUE),
    (1, 52, TRUE),
    (2, 1, FALSE),
    (2, 2, TRUE),
    (2, 3, TRUE),
    (2, 4, TRUE),
    (2, 5, TRUE),
    (2, 6, TRUE),
    (2, 7, TRUE),
    (2, 8, TRUE),
    (2, 9, TRUE),
    (2, 10, TRUE),
    (2, 11, FALSE),
    (2, 12, TRUE),
    (2, 13, TRUE),
    (2, 14, TRUE),
    (2, 15, FALSE),
    (2, 16, FALSE),
    (2, 17, TRUE),
    (2, 18, TRUE),
    (2, 19, TRUE),
    (2, 20, FALSE),
    (2, 21, TRUE),
    (2, 22, TRUE),
    (2, 23, TRUE),
    (2, 24, TRUE),
    (2, 25, TRUE),
    (2, 26, TRUE),
    (2, 27, TRUE),
    (2, 28, TRUE),
    (2, 29, TRUE),
    (2, 30, TRUE),
    (2, 31, TRUE),
    (2, 32, FALSE),
    (2, 33, FALSE),
    (2, 34, FALSE),
    (2, 35, TRUE),
    (2, 36, TRUE),
    (2, 37, TRUE),
    (2, 38, TRUE),
    (2, 39, TRUE),
    (2, 40, TRUE),
    (2, 41, TRUE),
    (2, 42, TRUE),
    (2, 43, TRUE),
    (2, 44, TRUE),
    (2, 45, TRUE),
    (2, 46, FALSE),
    (2, 47, FALSE),
    (2, 48, TRUE),
    (2, 49, TRUE),
    (2, 50, TRUE),
    (2, 51, TRUE),
    (2, 52, TRUE);

INSERT INTO rapporten(studentId, name, class, commentaarAlgemeen, commentaarKlassenraad) VALUES
	(6, '2016-2017 TRIMESTER 3', 'Klas 2', 'Faisal voldoet aan de voorwaarden van het voltijds engagement door bijkomende lessen Nederlands te volgen.',
		'Je bent een aangename leerling met een grote inzet. \n\n Proficiat! Prettige vakantie!'),
    (7, '2016-2017 TRIMESTER 3', 'Klas 2', null, 'Geen evaluatie mogelijk wegens afwezigheden.');

INSERT INTO rapporten_modules(rapportId, moduleId, commentaar) VALUES -- ? TODO ? merge table with studenten_modules ?
	(1, 3, null),
    (1, 4, "Jij bent een echte doorzetter! Je kennis van de Nederlandse taal gaat erop vooruit. Het is leuk om jou in de klas te hebben. Fijne vakantie, Faisal!"),
    (1, 1, "Zeer goede inzet, je hebt jouw eerste module behaald. \n Proficiat!");

INSERT INTO rapporten_scores(rapportId, doelstellingId, score, opmerking) VALUES
	(1, 45, 'G', 'NT2 niv1 breakthrough (Alfa)'),
	(1, 46, 'G', null),
	(1, 47, 'V', null),
	(1, 48, 'V', null),
	(1, 49, 'OV', null),
	(1, 50, 'V', null),
	(1, 51, 'OV', null),
	(1, 52, 'V', null),
	(1, 53, 'V', null),
	(1, 54, 'ZG', null),
	(1, 55, 'G', null),
	(1, 56, 'V', null),
	(1, 61, 'NVT', "niet van toepassing"),
	(1, 62, 'NVT', "niet van toepassing"),
	(1, 63, 'NVT', "niet van toepassing"),
	(1, 64, 'NVT', "niet van toepassing"),
	(1, 65, 'NVT', "niet van toepassing"),
	(1, 66, 'V', "biljetten/munten"),
	(1, 67, 'NVT', "niet van toepassing"),
	(1, 68, 'NVT', "niet van toepassing"),
	(1, 69, 'G', null),
	(1, 70, 'V', null),
	(1, 71, 'V', null),
	(1, 72, 'G', null),
	(1, 73, 'G', null),
	(1, 74, 'G', null),
	(1, 75, 'G', null),
	(1, 76, 'G', null),
	(1, 77, 'NVT', "niet van toepassing"),
	(1, 78, 'NVT', "niet van toepassing"),
	(1, 79, 'ZG', null),
	(1, 80, 'ZG', null),
	(1, 81, 'ZG', null),
	(1, 82, 'V', null),
	(1, 83, 'G', null),
	(1, 84, 'ZG', null),
	(1, 85, 'G', null);
    
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
