use tanteemma;

-- Artikel suchen
select art_name, art_preis from artikel where artikel.art_name = 'variable: sucheingabe';

-- Artikel in Warenkorb speichern
insert into bestellpositionen Values (0, 'variable: bp_bestell_id', bp_id, 'variable: bp_artikel_id', 'variable: bp_menge');

-- Person speichern
insert into person values (0, ('variable: person_name'), 
							('variable: person_vname'), 
                            ('variable: person_strasse'), 
							('variable: person_hausnr'), 
							('variable: person_plz'),
                            ('variable: person_ort'),
                            ('variable: person_tel'),
                            ('variable: person_email')
);

-- Angestellten hinzufügen
insert into angestellten values (select person_id from person where person_name = 'variable: sucheingabe', ('variable: gehalt');

-- Kunden hinzufügen
insert into kunde values ((select person_id from person where person.person_name = 'variable: sucheingabe'));




