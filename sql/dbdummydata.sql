use graderDB;

INSERT INTO users(email, firstname, lastname, password, language, status) VALUES
	('kenny.depecker@student.howest.be', 'Kenny', 'Depecker', 'Student', 'NL', 'ACTIVE'), -- 1
	('koen.declerck@student.howest.be', 'Koen', 'Declerck', 'Student', 'NL', 'ACTIVE'), -- 2
	('riwan.carpentier@student.howest.be', 'Riwan', 'Carpentier', 'Student', 'NL', 'ACTIVE'), -- 3
	('teacher1@hotmail.com', 'Teacher', 'Dummy', 'Teacher', 'NL', 'ACTIVE'), -- 4
	('teacher2@hotmail.com', 'Teacher', 'Dummy', 'Teacher', 'NL', 'ACTIVE'), -- 5
	('student1@hotmail.com', 'Faisal', 'Nizami', 'Student', 'NL', 'ACTIVE'), -- 6
	('student2@hotmail.com', 'Tatjana', 'Eekchout', 'Student', 'NL', 'ACTIVE'), -- 7
	('student3@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'), -- 8
	('student4@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'), -- 9
	('student5@hotmail.com', 'Student', 'Dummy', 'Student', 'NL', 'ACTIVE'), -- 10
	('thomas.de.nil@student.howest.be', 'Thomas', 'De Nil', 'Student', 'NL', 'ACTIVE'); -- 11
    ('studentbouw@hotmail.com', 'Student', 'Student', 'Dummy bouw', 'NL', 'ACTIVE'); -- 12
    
INSERT INTO admins(adminId) VALUES (1),(2),(3), (11);

INSERT INTO teachers(teacherId) VALUES(4), (5);

INSERT INTO studenten(studentId) VALUES(6), (7), (8), (9), (10);

INSERT INTO opleidingen(name, creatorId) VALUES
	('Keukenmedewerker', 3),
    ('Kapper', 3),
    ('Tegelzetter', 3);

INSERT INTO modules(name, opleidingId, creatorId) VALUES
    ('Initiatie keuken', 1, 3),
    ('Keukentechnieken', 1, 3),
	('Taalgebonden vaardigheden', null, 3),
    ('Algemene vorming', null, 3),
    ('Vak Engels', null, 3),
    ('Haarverzorging', 2, 3),
    ('Basistechnieken tegelzetten',3, 3);

INSERT INTO doelstellingscategories(name, moduleId, teacherId, creatorId) VALUES
	('Veiligheid, hygiëne en milieubewustzijn', 1, 4, 3),
	('Houdingen noodzakelijk voor de uitoefening van het beroep', 1, 4, 3),
   	('Functionele vaardigheden voor de uitoefening van het beroep', 1, 4, 3),
   	('Eigen werkzaamheden organiseren', 1, 5, 3),
   	('Voorbereidende werkzaamheden', 1, 5, 3),
   	('Elementaire technieken', 1, 4, 3),
   	('Vaat volgens procedures uitvoeren', 1, 5, 3),
    ('Functionele taalvaardigheid / NT2', 3, 4, 3),
    ('Vaardigheden (specifiek taalgebonden)', 3, 4, 3),
    ('ATTITUDES (specifiek taalgebonden)', 3, 4, 3),
    ('FUNCTIONELE TAALVAARDIGHEID', 4, 4, 3),
    ('FUNCTIONELE REKENVAARDIGHEID', 4, 4, 3),
    ('FUNCTIONELE INFORMATIEVERWERVING EN -VERWERKING', 4, 4, 3),
    ('ORGANISATIEBEKWAAMHEID', 4, 4, 3),
    ('TIJD- EN RUIMTEBEWUSTZIJN', 4, 4, 3),
    ('FUNCTIONELE WETENSCHAPPELIJKE VAARDIGHEID', 4, 4, 3),
    ('ATTITUDE', 4, 4, 3),
    ('VAKONDERDELEN', 5, 4, 3),
    ('ATTITUDES', 5, 4, 3),
    ('Neemt deel aan de organisatie van het kapsalon', 6, 4, 3),
    ('Bereidt zich voor op de toe te passen haarverzorging', 6, 4, 3),
    ('Bereidt de werkpost i.f.v. een haarverzorging voor', 6, 4, 3),
    ('Past shampoos en specifieke haarverzorging toe', 6, 4, 3),
    ('Ruimt de werpost na een haarverzorging op en maakt deze schoon', 6, 4, 3),
    ('Te integreren kennis', 6, 4, 3),
    ('Basistechnieken van tegelzetten uitvoeren', 7, 4, 3);
    
INSERT INTO doelstellingen(doelstellingscategorieId,name,creatorId) VALUES
	(1,'Kan ergonomisch werken',3),
	(1,'Kan economisch werken',3),
	(1,'Kan handelen volgens de regels van de voedselveiligheid',3),
	(1,'Kan voorschriften en instructies inzake veiligheid, hygiëne of milieu toepassen',3),
	(1,'Kan persoonlijke beschermingsmiddelen gebruiken',3),
	(1,'Kan de werkplek en directe omgeving onderhouden/schoonhouden',3),
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
    (11, 'Kijk- en luistervaardigheid',3),
    (11, 'Leesvaardigheid', 3),
    (11, 'Schrijfvaardigheid', 3),
    (11, 'Spreekvaardigheid', 3),
    (12, 'Grootheden', 3),
    (12, 'Percent', 3),
    (12, 'Regel van drie', 3),
    (12, 'Schaal', 3),
    (12, 'Schematische voorstellingen', 3),
    (12, '(Basisbewerkingen: +,-,:,x)', 3),
    (13, 'ICT', 3),
    (13, 'Informatie vinden en selecteren', 3),
    (14, 'Groepsopdrachten', 3),
    (14, 'Individuele opdrachten', 3),
    (14, 'Omgaan met geld', 3),
    (14, 'Organisatie eigen leven', 3),
    (15, 'Actualiteit en dagelijks leven', 3),
    (15, 'Eigen regio', 3),
    (15, 'Situeren, oriënteren en verplaatsen', 3),
    (15, 'Wereldproblemen', 3),
    (16, 'Duurzame leefomgeving', 3),
    (16, 'Natuurwetenschappelijke verschijnselen', 3),
    (17, 'Houding t.o.v. de groep', 3),
    (17, 'Houding t.o.v. de leerkracht', 3),
    (17, 'Inzet/Interesse', 3),
    (17, 'Kritische zin', 3),
    (17, 'Respect voor leefmilieu en historisch - cultureel erfgoed', 3),
    (17, 'Samenwerking', 3),
    (17, 'Inleving in socioculturele diversiteit', 3),
    (26, 'Ondergrond evalueren', 3),
    (26, 'Niet te betegelen elementen beschermen', 3),
    (26, 'Oppervlakte schoonmaken', 3),
    (26, 'Oppervlakte voorbehandelen', 3),
    (26, 'Tegels selecteren', 3),
    (26, 'Species aanmaken', 3),
    (26, 'Tegels plaatsen', 3);
    
INSERT INTO evaluatiecriteria(doelstellingId, name, creatorId) VALUES
	(1, 'correcte werkhouding toepassen bij het bij het reinigen van groenten en fruit', 3),
    (1, 'de juiste hef-en tiltechnieken toepassen bij het verplaatsen van (kratten met) groenten en fruit', 3),
    (1, 'een correcte werkhouding toepassen bij het uitvoeren van de vaat', 3),
    (1, 'de juiste hef- en til technieken gebruiken bij uitvoeren van de vaat', 3),
    (2, 'een minimum aan afval creëren bij het reinigen van groenten en fruit', 3),
    (2, 'zorgzaam omgaan met materieel zoals servies, glaswerk e.d. bij het uitvoeren van de vaat', 3),
    (2, 'ingrediënten volgens instructies correct verpakken om verlies door middel van verontreiniging en/of bederf te voorkomen', 3),
    (2, 'zuinig omgaan met het gebruik van water en detergent', 3),
    (3, 'ingrediënten volgens instructies op een correcte manier verpakken om kruisbesmetting te voorkomen', 3),
    (3, 'vaat en reinigen van voedingsmiddelen gescheiden houden', 3),
    (3, 'juiste snijplanken gebruiken', 3),
    (3, 'ingrediënten volgens instructies op de juiste plaats in de koeling plaatsen', 3),
    (4, 'kent de richtlijnen voor persoonlijke hygiëne', 3),
    (4, 'de richtlijnen van een persoonlijke hygiëne op zichzelf toepassen', 3),
    (4, 'messen op een correcte manier verplaatsen en opbergen', 3),
    (4, 'de instructies in het reinigingsplan voor het reinigen van de vaatwasruimte toepassen', 3),
    (4, 'de richtlijnen van werkplaatsreglement in de keuken toepassen', 3),
    (5, 'schone werkkledij dragen', 3),
    (5, 'geschikte (veiligheids)schoenen dragen (gesloten, afwasbaar, voorzien van anti-slipzool, enkel voor gebruik in de keuken)', 3),
    (5, 'gebruikt steeds een droge handdoek bij het hanteren van warme voorwerpen', 3),
    (5, 'een hoofddeksel dragen om te voorkomen dat er haar of huidschilfers in de voedingswaren terecht komen (baardnetje indien nodig)', 3),
    (5, 'wegwerphandschoenen gebruiken bij wonden', 3),
    (6, 'de vaatwasruimte op hygiëne controleren voor het aanvangen van activiteiten', 3),
    (6, 'de vaatwasruimte reinigen na gebruik', 3),
    (6, 'de vaatwasruimte ordelijk houden met het oog op de veiligheid', 3),
    (6, 'een vervuilde vaatwasruimte reinigen voor het aanvangen van activiteiten', 3),
    (7, 'de veiligheidsinstructiefiche van de vaatwasmachine gebruiken', 3),
    (7, 'de vaatwasmachine volgens de voorschriften gebruiken', 3),
    (7, 'veiligheidsinstructiekaarten van detergenten en vaatwasproducten raadplegen voor gebruik', 3),
    (7, 'het juiste mes kiezen in functie van het gebruik', 3),
    (8, 'reinigingsmiddelen in een correcte verhouding gebruiken', 3),
    (8, 'messen op een veilige manier reinigen', 3),
    (8, 'de vaatwasmachine  reinigen volgens de voorschriften op de  de veiligheidsinstructiekaart', 3),
    (9, 'afval zoals PMD, papier, karton, glas, GFT, restafval, gebroken servies,  … correct sorteren', 3),
    (10, 'storingen of afwijkingen aan toestellen in de vaatwasruimte melden', 3),
    (86, 'vlakheid van de muur', 3), 
    (86, 'vlakheid van de vloer', 3),
    (87, 'vloer beschermen', 3),
    (87, 'aansluiting met plafond of andere muur beschermen', 3),
    (87, 'aansluiting ramen en deuren beschermen', 3),
    (88, 'verwijderen van restvuil', 3),
    (88, 'ondergrond stofvrij maken', 3),
    (89, 'Primer of hechtingslaag kunnen aanbrengen', 3),
    (90, 'Juiste type tegels (wand of vloertegels) bepalen', 3),
    (90, 'Fouten kunnen opmerken (breuken, productiefouten', 3),
    (91, 'Tegellijm voor vloertegels', 3),
    (91, 'Tegellijm voor wandtegels', 3),
    (92, 'Noodzakelijke lijnen aftekenen (loodlijnen en aanzetlijnen) voor wandtegels', 3),
    (92, 'Noodzakelijke lijnen aftekenen (loodlijnen en aanzetlijnen) voor vloertegels', 3);
    
INSERT INTO aspecten(evaluatiecriteriumId, name, creatorId) VALUES
    (36, 'controleert en beoordeelt de vlakheid van de muur', 3), 
    (36, 'controleert en beoordeelt de loodrechtheid van de muur', 3), 
    (36, 'controleert en beoordeelt de staat van de muur (gebreken, beschadigingen, vochtplekken, ...)', 3), 
    (37, 'controleert en beoordeelt de vlakheid va nde vloer', 3), 
    (37, 'controleert en beoordeelt de loodrechtheid van de vloer', 3), 
    (37, 'controleert en beoordeelt de staat van de vloer (gebreken, beschadigingen, vochtplekken, ...)', 3),
    (38, 'beschermt de vloer waar nodig met karton of papier', 3),
    (38, 'beschermen van bad of douchebak', 3),
    (39, 'plakt overgangen (muur-plafond of vloer-muur- af met plakband', 3),
    (39, 'plaatst waar nodig beschermfolie', 3),
    (40, 'plakt overgangen (ramen en deuren) af met plakband', 3),
    (40, 'plaatst waar nodig beschermfolie', 3),
    (41, 'verwijdert alle afval uit de ruimte', 3),
    (41, 'verwijdert rest- of overtollig materiaal van het te betegelen oppervlakte (bezetsel-, chaperesten)', 3),
    (42, 'veegt het te betegelen vloeroppervlakte schoon', 3),
    (42, 'veegt het te betegelen wandoppervlakte schoon', 3),
    (42, 'stofzuigt indien nodig de te betegelen oppervlakte', 3),
    (43, 'leest de productinfo', 3),
    (43, 'maakt het product gebruiksklaar volgens voorschrift van de producent', 3),
    (43, 'brengt het product op de voorgeschreven wijze aan', 3),
    (43, 'respecteert de juiste wachttijd', 3),
    (44, 'herkent het doel van de tegel (wand- of vloertegel)', 3),
    (45, 'controleert de tegels op producteigenschap (serienummer, kleur, ...)', 3),
    (45, 'productiefouten in tegels kunnen opmerken (spatten, haarscheurtjes, ...)', 3),
    (45, 'kleurverschillen tussen tegels kunnen vaststellen', 3),
    (46, 'schat de noodzakelijke hoeveelheid aan te maken lijm/specie in', 3),
    (46, 'juiste verhouding kunnen bepalen', 3),
    (46, 'lijm aanmaken volgens de voorschriften van de producent', 3),
    (46, 'mengtijden respecteren', 3),
    (47, 'schat de noodzakelijk aan te maken hoeveelheid lijm in', 3),
    (47, 'juiste verhouding kunnen bepalen', 3),
    (47, 'lijm aanmaken volgens de voorschriften van de producent', 3),
    (47, 'mengtijden respecteren', 3),
    (48, 'bepaalt en tekent de startlijn af op de wand', 3),
    (48, 'bepaalt de passtukken aan de zijkanten (breedte uitzetten van het tegelwerk', 3),
    (48, 'plaatst de loodlijnen op de wand', 3),
    (48, 'brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (48, 'plaatst de tegel op de loodlijn', 3),
    (48, 'drukt de tegel voldoende aan', 3),
    (48, 'plaatst de kruisjes (voegafstandhouders)', 3),
    (48, 'controleert de vlakheid van de overgangen tussen de tegels', 3),
    (48, 'meet de passtukken op', 3),
    (48, 'plaatst de passtukken', 3),
    (49, 'verdeelt de te betegelen ruimte (lengte- en breedteverdeling', 3),
    (49, 'tekent de eerste lijn af op de vloer', 3),
    (49, 'brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (49, 'plaatst de tegel op de verdeellijn', 3),
    (49, 'drukt de tegel voldoende aan', 3),
    (49, 'plaatst de kruisjes (voegafstandhouders)', 3),
    (49, 'controleert de vlakheid van de overgangen tussen de tegels', 3),
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
    (10,3,1),
    (8,3,2);
    

INSERT INTO rapporten(studentId, commentaarAlgemeen, commentaarKlassenraad) VALUES
	(6, 'Faisal voldoet aan de voorwaarden van het voltijds engagement door bijkomende lessen Nederlands te volgen.',
		'Je bent een aangename leerling met een grote inzet. \n\n Proficiat! Prettige vakantie!'),
    (7, null, 'Geen evaluatie mogelijk wegens afwezigheden.');

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