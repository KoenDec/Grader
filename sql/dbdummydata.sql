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
    ('Winkelbediende', 3),
    ('Klantencontact', 3);

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
    ('Plaatsen van wandtegels', 3, 12, 3); -- 10

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
    ('Wandtegels plaatsen',10, 3);
    
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
    (39, 'Kan geplaatste wandtegels afwerken', 3); -- 165
    
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
    (165, 'Opkitten hoeken en overgangen', 3);
    
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
    (124, 'Controleert de haaksheid van de hoeken', 3),
    (125, 'Controleert of er geen vochtige plekken aanwezig zijn', 3),
    (125, 'Controleert of het pleisterwerk voldoende droog is', 3),
    (125, 'Controleert de luchtvochtigheidsgraad in de ruimte', 3),
    (126, 'Controleert of de te betegelen oppervlakte geen losse delen bevat', 3),
    (126, 'Controleert of de hoeken zuiver afgewerkt zijn (geen resten van pleisterwerk)', 3),
    (126, 'Controleert of er geen scheuren of barsten aanwezig zijn', 3),
    (126, 'Controleert of er geen brokken aan de te betegelen gedeelten zijn (hoeken zuiver)', 3),
    (127, 'Bepaalt of het uitbreken manueel of machinaal kan gebeuren', 3),
    (127, 'Beschermt de vloer en de elementen tegen beschadigingen', 3),
    (127, 'Bepaalt de beginplaats voor de uitbreekwerkzaamheden', 3),
    (127, 'Breekt op een gecontroleerde wijze de tegels uit', 3),
    (127, 'Voert een eindcontrole uit op de uitbreekwerkzaamheden', 3),
    (128, 'Bepaalt de meest geschikte afvoermethode', 3),
    (128, 'Voert op een gecontroleerde manier de werkzaamheden uit', 3),
    (128, 'Voorkomt beschadigingen aan andere oppervlakten of elementen', 3),
    (129, 'Beoordeelt de scheur', 3),
    (129, 'Verwijdert losse delen (bezetsel)', 3),
    (129, 'Maakt de scheur stofvrij', 3),
    (129, 'Kiest de juiste producten om de scheuren op te vullen', 3),
    (129, 'Maakt de vulmortel aan volgens de voorschriften van de producent', 3),
    (129, 'Vult de scheuren op de juiste manier op', 3),
    (129, 'Vlakt het oppervlak nadien uit (afschuren)', 3),
    (130, 'Bepaalt het te gebruiken materiaal voor het onderkader', 3),
    (130, 'Bepaalt de grootte van het onderkader', 3),
    (130, 'Zet de omtrekslijnen van het onderkader uit', 3),
    (130, 'Stelt het houten onderkader samen', 3),
    (130, 'Plaatst het onderkader en verankert het op correcte wijze', 3),
    (130, 'Bouwt het onderkader op in gipsblokken', 3),
    (130, 'Maakt het onderkader klaar om te betegelen (hechtingslaag aanbrengen)', 3),
    (131, 'Bepaalt het te gebruiken materiaal voor de wand', 3),
    (131, 'Zet de omtrekslijnen van de wand uit', 3),
    (131, 'Stelt de houten wand samen', 3),
    (131, 'Plaatst de wand en verankert hem op correcte wijze', 3),
    (131, 'Bouwt de wand op in gipsblokken', 3),
    (131, 'Maakt de wand klaar om te betegelen (hechtingslaag aanbrengen)', 3),
    (132, 'Bepaalt de plaats van de rei', 3),
    (132, 'Bepaalt de bevestigingsmethode', 3),
    (132, 'Bepaalt de plaats van de muurhaken', 3),
    (132, 'Bevestigt de rei op de muur volgens de hoogtelijn', 3),
    (133, 'Schat de noodakelijk aan te maken hoeveelheid lijm in', 3),
    (133, 'Juiste verhouding kunnen bepalen', 3),
    (133, 'Lijm aanmaken volgens de voorschriften van de producent', 3),
    (133, 'Mengtijden respecteren', 3),
    (134, 'Bepaalt de juiste lijmkan in functie van het uit te voeren werk', 3),
    (134, 'Bepaalt de grootte van de in te lijmen oppervlakken', 3),
    (134, 'Brengt de lijm gelijkmatig aan op het volledige tegeloppervlak', 3),
    (134, 'Verwijdert overtollige lijmresten', 3),
    (135, 'Bepaalt de plaats van het profiel', 3),
    (135, 'Maakt het profiel op de juiste lengte', 3),
    (135, 'Plaatst het profiel in de lijm en drukt het op de juiste plaats', 3),
    (135, 'Plaatst het tegelwerk over het profiel', 3),
    (135, 'Controleert de aansluitingen tussen profiel en tegelwerk', 3),
    (135, 'Werkt de overgang correct af (overtollige lijm verwijderen, afwassen, ...)', 3),
    (136, 'Tekent de tegel juist af', 3),
    (136, 'Plaatst de tegel correct en vlak onder de tegelsnijder', 3),
    (136, 'Snijdt de tegels op een correcte manier (één vloeiende beweging)', 3),
    (136, 'Breekt de tegel op de juiste manier', 3),
    (137, 'Tekent de tegel juist af', 3),
    (137, 'Knipt in kleine stapjes', 3),
    (137, 'Zorgt voor voldoende steunvlak van de tegel tijdens het knippen', 3),
    (138, 'Tekent de tegel juist af', 3),
    (138, 'Kiest het juiste zaagblad in functie van de tegel', 3),
    (138, 'Zaagt op een gecontroleerde en juiste manier', 3),
    (138, 'Heeft oog voor de veiligheid', 3),
    (139, 'Bepaalt en tekent de sttartlijn af op de tegelwand', 3),
    (139, 'Bepaalt de passtukken aan de zijkanten (breedte uitzetten van het tegelwerk', 3),
    (139, 'Plaatst de loodlijnen op de wand', 3),
    (139, 'Brengt de lijm aan volgens de grootte van de tegel en rij', 3),
    (139, 'Plaatst de tegel op de loodlijn', 3),
    (139, 'Plaatst de touw of kruisjes', 3),
    (139, 'Plaatst de volgende rij tegels', 3),
    (139, 'Controleert de voegafstanden', 3),
    (139, 'Drukt de tegel voldoende aan', 3),
    (139, 'Controleert de vlakheid van de overgangen tussen de tegels', 3),
    (139, 'Meet de passtukken op', 3),
    (139, 'Plaatst de passtukken', 3),
    (140, 'Schat de noodzakelijk aan te maken hoeveelhied lijm / specie in', 3),
    (140, 'Bepaalt de juiste verhouding', 3),
    (140, 'Maakt voegspecie aan volgens de voorschriften van de producent', 3),
    (140, 'Respecteert de mengtijden', 3),
    (141, 'Wast de muur af zodat tegels vuilvrij zijn', 3),
    (141, 'Maakt de voegen lijmvrij', 3),
    (141, 'Brengt de specie in voldoende mate aan op de muur', 3),
    (141, 'Zorgt dat de voegen volledig gevuld zijn', 3),
    (141, 'Overtollige specie verwijderen en het tegeloppervlak reinigen', 3),
    (141, 'Kuist de muur af met een vochtige spons', 3),
    (141, 'Wrijft de muur na met een droge doek', 3),
    (142, 'Tegels nakuisen met vochtige / droge doek', 3),
    (142, 'Kleine gaatjes in het voegwerk herstellen', 3),
    (143, 'Houdt het pistool onder de juiste hoek', 3),
    (143, 'Brengt voegsel gelijkmatig aan', 3),
    (143, 'Brengt voegsel in een vloeiende beweging aan', 3),
    (143, 'Zorgt voor naadloze overgangen', 3),
    (143, 'Haalt de spanning van het pistool af als het pistool wordt verwijderd van de voeg', 3),
    (143, 'Houdt de spuitmond proper tijdens en na afloop van de werkzaamheden', 3),
    (143, 'Sluit de spuitmond op correcte wijze af na de werkzaamheden', 3);

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
