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
  	('teacher4@hotmail.com', 'Ann', 'Bert', 'Teacher', 'NL', 'ACTIVE'); -- 13
    
INSERT INTO admins(adminId) VALUES (1),(2),(3), (11);

INSERT INTO teachers(teacherId) VALUES(4), (5), (12), (13);

INSERT INTO studenten(studentId) VALUES(6), (7), (8), (9), (10);

INSERT INTO opleidingen(name, creatorId) VALUES
	('Keukenmedewerker', 3),
    ('Kapper', 3),
    ('Tegelzetter', 3),
    ('Winnkelbediende', 3),
    ('Klantencontact', 3);

INSERT INTO modules(name, opleidingId, teacherId, creatorId) VALUES
    ('Initiatie keuken', 1, 4, 3),
    ('Keukentechnieken', 1, 4, 3),
	('Taalgebonden vaardigheden', null, 5, 3),
    ('Algemene vorming', null, 5, 3),
    ('Vak Engels', null, 5, 3),
    ('Haarverzorging', 2, 5, 3),
    ('Basistechnieken tegelzetten', 3, 12, 3),
    ('Verkoop', 4, 13, 3), -- TODO not teacher 13
    ('Klantencontact', 4, 13, 3);

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
    ('Diefstalpreventie volgens bedrijfseigen procedures toepassen', 9, 3);
    
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
	(6,'##########################',3),
	(5,'##########################',3), -- 40
	(5,'##########################',3),
	(7,'##########################',3),
	(6,'##########################',3),
	(6,'##########################',3),
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
    (38, 'Richtlijnen bij verdacht gedrag naleven', 3);
    
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
    (8, 'de vaatwasmachine  reinigen volgens de voorschriften op de  de veiligheidsinstructiekaart', 3),
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
    (92, 'Noodzakelijke lijnen aftekenen (loodlijnen en aanzetlijnen) voor vloertegels', 3);
    
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
    (49, 'plaatst de passtukken', 3);

INSERT INTO studenten_modules(studentId, moduleId, opleidingId) VALUES
	-- REAL DATA
    (6,1,null),
    (6,3,1),
    (6,4,1),
    (7,4,2),
    (7,5,2),
    (7,6,null),
    
    -- RANDOM DATA: student 3 (id 8) volgt kapper, 4 (id 9) volgt kok en 5 (id 10) tegelzetter.
	(9,1,null),
    (10,7,null),
    (9,3,1),
    (10,3,3),
    (8,3,2);
    

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
