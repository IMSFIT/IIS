INSERT INTO jidlo(id_jidla,nazev_jidla) VALUES ('2222221','Vepøový øízek');

							INSERT INTO jidlo(id_jidla,nazev_jidla) VALUES ('2222222','Zapékané brambory');

							INSERT INTO jidlo(id_jidla,nazev_jidla) VALUES ('2222223','Špagety');

							INSERT INTO  typ_diety(id_diety,nazev_diety) VALUES ('1111111',  'Bezlepková dieta');

							INSERT INTO  typ_diety(id_diety,nazev_diety) VALUES ('1111112',  'Bezmléèná dieta');

							INSERT INTO  typ_diety(id_diety,nazev_diety) VALUES ('1111113',  'Bezvajeèná dieta');

							INSERT INTO  pokoj (cislo_pokoje,patro,pavilon) VALUES ('123',  '1',  'B');

							INSERT INTO  pokoj (cislo_pokoje,patro,pavilon) VALUES ('124',  '1',  'B');

							INSERT INTO  pokoj (cislo_pokoje,patro,pavilon) VALUES ('125',  '1',  'B');

							INSERT INTO  suroviny (id_suroviny,nazev_suroviny,mnozstvi_surovin,datum_objednavky,mnozstvi_objednane_suroviny) VALUES ('3333331',  'Hovìzí maso',  '60',  '12.10.2013',  '30');

							INSERT INTO  suroviny (id_suroviny,nazev_suroviny,mnozstvi_surovin,datum_objednavky,mnozstvi_objednane_suroviny) VALUES ('3333332',  'Kuøecí maso',  '11',  '12.10.2013',  '169');

							INSERT INTO  suroviny (id_suroviny,nazev_suroviny,mnozstvi_surovin,datum_objednavky,mnozstvi_objednane_suroviny) VALUES ('3333333',  'Brambora',  '789',  '12.10.2013',  '1345');

							INSERT INTO jidelnicek(id_jidelnicku,datum_vystaveni,platnost) VALUES ('4444441', '2.11.2013', '3.11.2013');

							INSERT INTO jidelnicek(id_jidelnicku,datum_vystaveni,platnost) VALUES ('4444442', '2.11.2013', '3.11.2013');

							INSERT INTO jidelnicek(id_jidelnicku,datum_vystaveni,platnost) VALUES ('4444443', '3.11.2013', '4.11.2013');

							INSERT INTO  pacient (rodne_cislo,jmeno,prijmeni,jmeno_osetrujiciho_lekare,datum_prijeti,druh_diety,zmena_diety,cislo_pokoje,jidelnicek) VALUES ('9410185784',  'Marek',  'Hort',  'Kobliha',  '12.11.2013',  '1111111',  'none',  '123',  '4444442');

							INSERT INTO  pacient (rodne_cislo,jmeno,prijmeni,jmeno_osetrujiciho_lekare,datum_prijeti,druh_diety,zmena_diety,cislo_pokoje,jidelnicek) VALUES ('9108305123',  'Rudolf',  'Kletr',  'Kobliha',  '8.11.2013',  '1111111',  'none',  '123',  '4444441');

							INSERT INTO  pacient (rodne_cislo,jmeno,prijmeni,jmeno_osetrujiciho_lekare,datum_prijeti,druh_diety,zmena_diety,cislo_pokoje,jidelnicek) VALUES ('7701245678',  'Miloš',  'Jindrák',  'Kobliha',  '9.11.2013',  '1111113',  'none',  '124',  '4444442');

							INSERT INTO  objednavka_na_kuchyn (id_objednavky,oddeleni,preferovane_jidlo,stav,rc_pacienta) VALUES ('5555551',  'Hematologicko-transfúzní',  '2222222',  '0',  '9410185784');

							INSERT INTO  objednavka_na_kuchyn (id_objednavky,oddeleni,preferovane_jidlo,stav,rc_pacienta) VALUES ('5555552',  'Patologicko-anatomické',  '2222223',  '0',  '9108305123');

							INSERT INTO  objednavka_na_kuchyn (id_objednavky,oddeleni,preferovane_jidlo,stav,rc_pacienta) VALUES ('5555553',  'Patologicko-anatomické',  '2222223',  '0',  '7701245678');

							INSERT INTO  jidlo_jidelnicku(id_jidelnicku,id_jidla) VALUES ('4444441',  '2222222');

							INSERT INTO  jidlo_jidelnicku(id_jidelnicku,id_jidla) VALUES ('4444442',  '2222222');

							INSERT INTO  jidlo_jidelnicku(id_jidelnicku,id_jidla) VALUES ('4444443',  '2222222');

							INSERT INTO  jidlo_jidelnicku(id_jidelnicku,id_jidla) VALUES ('4444441',  '2222221');

							INSERT INTO  jidlo_jidelnicku(id_jidelnicku,id_jidla) VALUES ('4444442',  '2222223');

							INSERT INTO  jidla_a_suroviny(id_jidla,id_surovin) VALUES ('2222221',  '3333333');

							INSERT INTO  jidla_a_suroviny(id_jidla,id_surovin) VALUES ('2222222',  '3333333');

							INSERT INTO  jidla_a_suroviny(id_jidla,id_surovin) VALUES ('2222223',  '3333333');

							INSERT INTO  jidla_a_suroviny(id_jidla,id_surovin) VALUES ('2222221',  '3333332');

							INSERT INTO  jidla_a_suroviny(id_jidla,id_surovin) VALUES ('2222223',  '3333331');

							insert into  diety_jidel (id_jidla,id_diety) values ('2222221',  '1111112');

							insert into  diety_jidel (id_jidla,id_diety) values ('2222222',  '1111111');

							insert into  diety_jidel (id_jidla,id_diety) values ('2222223',  '1111113');

							insert into  diety_jidel (id_jidla,id_diety) values ('2222222',  '1111111');

							insert into  diety_jidel (id_jidla,id_diety) values ('2222223',  '1111112');



INSERT INTO `roles` (`id_role`, `nazov`) VALUES
(1, 'admin'),
(2, 'kucharka'),
(3, 'sestra');
INSERT INTO `aktivita` (`id_aktivita`, `nazov`) VALUES
(1, 'neaktivny'),
(2, 'aktivny');

INSERT INTO `user` (`id`, `username`, `password`, `name`, `id_role`, `aktivita_uctu`) VALUES
(1, 'admin', '$2a$07$uz2qk98utlh56c1a9pmdlupKXB.w.lWRrFr80jCdZgEN4vINA5SSa', 'admin', 1, 2),
(2, 'kucharka', '$2a$07$66hix6uzkqqep5ne58qdxewjXcSEBj9QzJvTLV.EGDIKS0TaiBZ42', 'kucharka', 2, 2),
(3, 'sestra', '$2a$07$3y7uw20zmbggpozctrvehuwx4YeUqEUVWa5h329is0aFOq7YpdL3m', 'sestra', 3, 2);



							