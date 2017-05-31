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
INSERT INTO person VALUES (0, 'Moors', 'Martin', 'Schlossallee', '14', '37246', 'Köln', '022137246', 'moors@privat.de');

INSERT INTO kunde VALUES ((SELECT person_id FROM person WHERE person.person_name = 'Horstmann'), (46.99));
INSERT INTO kunde VALUES ((SELECT person_id FROM person WHERE person.person_name = 'Moors'), (290.76));

INSERT INTO angestellte VALUES ((SELECT person_id FROM person WHERE person.person_name = 'Tahta'), 450.00, 2, 'pwdTahta');
INSERT INTO angestellte VALUES ((SELECT person_id FROM person WHERE person.person_name = 'Derksen'), 2500.00, 2, 'pwdDerksen');

INSERT INTO art_kategorie VALUES ('Getränke');
INSERT INTO art_kategorie VALUES ('Lebensmittel');
INSERT INTO art_kategorie VALUES ('Tabak');
INSERT INTO art_kategorie VALUES ('Drogerie');
INSERT INTO art_kategorie VALUES ('Technik');

INSERT INTO artikel VALUES (0, 'Cola', 'Getränke', 30, 0.99);
INSERT INTO artikel VALUES (0, 'Mineralwasser','Getränke', 23, 0.69);
INSERT INTO artikel VALUES (0, 'Marlboro','Tabak', 50, 6.30);
INSERT INTO artikel VALUES (0, 'Käse', 'Lebensmittel', 12, 2.99);
INSERT INTO artikel VALUES (0, 'Brot', 'Lebensmittel', 8, 1.29);
INSERT INTO artikel VALUES (0, 'Batterie', 'Technik', 32, 1.59);
INSERT INTO artikel VALUES (0, 'Deodorant', 'Drogerie', 50, 1.99);
INSERT INTO artikel VALUES (0, 'Creme', 'Drogerie', 23, 1.69);
INSERT INTO artikel VALUES (0, 'Tiefkühlpizza', 'Lebensmittel', 18, 2.99);
INSERT INTO artikel VALUES (0, 'Muesli', 'Lebensmittel', 25, 1.89);

INSERT INTO bestellung VALUES (0, (SELECT person_id FROM person WHERE person.person_name = 'Horstmann'), 
								(SELECT person_id FROM person WHERE person.person_name = 'Tahta'),
                                (CURDATE()),
                                (CURTIME())
								);

INSERT INTO bestellung VALUES (0, (SELECT person_id FROM person WHERE person.person_name = 'Horstmann'),
								( SELECT person_id FROM person WHERE person.person_name = 'Tahta'),
                                (CURDATE()),
                                (CURTIME())
								);