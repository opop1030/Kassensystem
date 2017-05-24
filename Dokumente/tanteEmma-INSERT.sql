USE tanteemma;

DELETE FROM person;
DELETE FROM artikel;
DELETE FROM art_kategorie;
DELETE FROM bestellpositionen;
DELETE FROM kunde;
DELETE FROM bestellung;
DELETE FROM angestellte;

INSERT INTO person VALUES (0, 'Derksen', 'Jannis', 'Haupstraße', '3', '12345', 'Köln', '022112345', 'derksen@tanteemma.de');
INSERT INTO person VALUES (0, 'Tahta', 'Murat', 'Winkelgasse', '5', '23764', 'Koblenz', '37467176' , 'tahta@tanteemma.de' );
INSERT INTO person VALUES (0, 'Horstmann', 'Andreas', 'Baker Street', '221', '327654', 'London', '1298371723', 'horstmann@privat.en');

INSERT INTO art_kategorie VALUES ('Getränke');
INSERT INTO art_kategorie VALUES ('Lebensmittel');
INSERT INTO art_kategorie VALUES ('Tabak');
INSERT INTO art_kategorie VALUES ('Drogerie');
INSERT INTO art_kategorie VALUES ('Technik');

INSERT INTO artikel VALUES (0, 'Cola', 'Getränke', 30, 0.99);