DROP DATABASE IF EXISTS tanteEmma;
create database tanteEmma;
use tanteEmma;

DROP TABLE IF EXISTS person;
DROP TABLE IF EXISTS kunde;
DROP TABLE IF EXISTS angestellte;
DROP TABLE IF EXISTS artikel;
DROP TABLE IF EXISTS bestellung;


CREATE TABLE person (
	person_id int not null primary key auto_increment,
    person_name varchar(40) not null,
    person_vname varchar(40) not null,
    person_strasse varchar(40) not null,
    person_hausnr numeric(38) not null,
    person_plz numeric(38) not null,
    person_ort varchar(40) not null,
    person_tel numeric(38) not null,
    person_email varchar(50) not null
) ENGINE=INNODB;
    
CREATE TABLE angestellte (
	ang_id int,
	ang_gehalt numeric(9,2) DEFAULT 0,
    ang_rechte int default 0,
    ang_passwort varchar(40)
) ENGINE=INNODB;

CREATE TABLE kunde (
	kunde_id int,
    kunde_umsatz numeric(9,2) DEFAULT 0
) ENGINE=INNODB;

CREATE TABLE artikel (
	art_id int not null primary key auto_increment ,
    art_name varchar (100) not null,
    art_kategorie varchar(50) not null,
    art_bestand int default 0,
    art_preis numeric(9,2) not null
) ENGINE=INNODB;

CREATE TABLE art_kategorie (
	art_kat_name varchar(40) not null primary key
) ENGINE=INNODB;
    
CREATE TABLE bestellung (
	bestell_id	int not null primary key auto_increment,
    kunde_id int not null,
    ang_id int not null,
    datum date not null,
    zeit timestamp not null
    )ENGINE=INNODB;

CREATE TABLE bestellpositionen (
	bp_id int not null primary key auto_increment,
    bp_bestell_id int,
    bp_artikel_id int,
    bp_menge int
)ENGINE=INNODB;
    	
ALTER TABLE angestellte
	ADD CONSTRAINT ang_id_fk FOREIGN KEY(ang_id)
    REFERENCES person(person_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE kunde
	ADD CONSTRAINT kunde_id_fk FOREIGN KEY(kunde_id)
    REFERENCES person(person_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE artikel 
	ADD CONSTRAINT art_kat_fk FOREIGN KEY(art_kategorie)
	REFERENCES art_kategorie(art_kat_name)
    ON DELETE RESTRICT
    ON UPDATE CASCADE;
    
ALTER TABLE bestellpositionen 
	ADD CONSTRAINT bp_bestellung_fk FOREIGN KEY (bp_bestell_id)
    REFERENCES bestellung(bestell_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT;

ALTER TABLE bestellpositionen
	ADD CONSTRAINT bp_art_fk FOREIGN KEY (bp_artikel_id)
    REFERENCES artikel(art_id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE;
    
ALTER TABLE bestellung
	ADD CONSTRAINT best_kunde_fk FOREIGN KEY (kunde_id)
    REFERENCES kunde(kunde_id)
	ON UPDATE CASCADE
    ON DELETE RESTRICT;
    
ALTER TABLE bestellung
	ADD CONSTRAINT best_ang_fk FOREIGN KEY (ang_id)
    REFERENCES angestellte(ang_id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT;
    

    
    



