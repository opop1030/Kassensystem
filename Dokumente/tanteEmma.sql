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
);
    
CREATE TABLE angestellte (
	ang_id int,
	ang_gehalt numeric(9,2) DEFAULT 0
);

CREATE TABLE kunde (
	kunde_id int,
    kunde_umsatz numeric(9,2) DEFAULT 0
);

CREATE TABLE artikel (
	art_id int not null auto_increment,
    art_name varchar (100) not null,
    art_kategorie varchar(50) not null,
    art_bestand int default 0,
    art_preis numeric(9,2) not null
);

CREATE TABLE art_kategorie (
	art_kat_name varchar(40) not null primary key
);
    
CREATE TABLE bestellung (
	bestell_id	int not null primary key auto_increment,
    kunde_id int not null,
    ang_id int not null,
    datum date not null,
    zeit timestamp not null
);

CREATE TABLE warenkorb (
	wk_id int not null primary key auto_increment,
    wk_bestell_id int,
    wk_artikel_name varchar(100)
);
    	
ALTER TABLE angestellte
	ADD CONSTRAINT ang_id_fk FOREIGN KEY(ang_id)
    REFERENCES person(person_id);

ALTER TABLE kunde
	ADD CONSTRAINT kunde_id_fk FOREIGN KEY(kunde_id)
    REFERENCES person(person_id);

ALTER TABLE artikel 
	ADD CONSTRAINT art_kat_fk FOREIGN KEY(art_kategorie)
	REFERENCES art_kategorie(art_kat_name)
    
ALTER TABLE warenkorb (
	ADD CONSTRAINT wk_




