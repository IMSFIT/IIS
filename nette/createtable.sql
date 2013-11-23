create table jidelnicek(
						id_jidelnicku decimal(7,0) NOT NULL AUTO_INCREMENT,
						primary key(id_jidelnicku),
						datum_vystaveni varchar(20) NOT NULL,
						platnost varchar(20) NOT NULL
					);

					create table jidlo_jidelnicku(
						id_jidelnicku decimal(7,0) NOT NULL AUTO_INCREMENT,
						id_jidla decimal(7,0) NOT NULL
					);

					create table jidlo(
						id_jidla decimal(7,0) NOT NULL AUTO_INCREMENT,
						primary key(id_jidla),
						nazev_jidla varchar(20) NOT NULL
					);



					create table typ_diety(
						id_diety decimal(7,0) NOT NULL AUTO_INCREMENT,
						primary key (id_diety),
						nazev_diety varchar(20) NOT NULL
					);

					create table diety_jidel(
						id_jidla decimal(7,0) NOT NULL AUTO_INCREMENT,
						id_diety decimal(7,0) NOT NULL,
						foreign key (id_diety) references  typ_diety(id_diety)
					);

					create table pacient(
						rodne_cislo decimal(12,0) NOT NULL AUTO_INCREMENT,
						primary key (rodne_cislo),
						jmeno varchar(20) NOT NULL,
						prijmeni varchar(20) NOT NULL,
						jmeno_osetrujiciho_lekare varchar(20) NOT NULL,
						datum_prijeti varchar(20) NOT NULL,
						druh_diety decimal(7,0) NOT NULL,
						zmena_diety varchar(20) NOT NULL,
						cislo_pokoje int(11) NOT NULL,
						jidelnicek decimal(7,0) NOT NULL,
						foreign key (druh_diety) references  typ_diety(id_diety)
					);

					create table objednavka_na_kuchyn(
						id_objednavky decimal(7,0) NOT NULL AUTO_INCREMENT,
						primary key (id_objednavky),
						oddeleni varchar(30) NOT NULL,
						preferovane_jidlo decimal(7,0) NOT NULL,
						stav int(11) NOT NULL,
						rc_pacienta decimal(12,0) NOT NULL
					);

					create table pokoj(
						cislo_pokoje int(11) NOT NULL AUTO_INCREMENT,
						primary key (cislo_pokoje),
						patro int NOT NULL,
						pavilon varchar(20)
					);

					create table jidla_a_suroviny(
						id_jidla decimal(7,0) NOT NULL AUTO_INCREMENT,
						id_surovin decimal(7,0) NOT NULL
					);

					create table suroviny(
						id_suroviny decimal(7,0) NOT NULL AUTO_INCREMENT,
						primary key (id_suroviny),
						nazev_suroviny varchar(20) NOT NULL,
						mnozstvi_surovin int NOT NULL,
						datum_objednavky varchar(20) NOT NULL,
						mnozstvi_objednane_suroviny int NOT NULL)


					;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
);



CREATE TABLE  `roles` (
  
`id_role` int(10) NOT NULL AUTO_INCREMENT,
  
`nazov` varchar(20) NOT NULL,
  
PRIMARY KEY (`id_role`)

);



CREATE TABLE  `aktivita` (
  
`id_aktivita` int(10) NOT NULL AUTO_INCREMENT,
 
 `nazov` varchar(20) ,

  PRIMARY KEY (`id_aktivita`)

);




					ALTER TABLE user ADD FOREIGN KEY ( id_role ) REFERENCES roles( id_role );
					alter table user add foreign key (id_aktivita) references aktivita(id_aktivita);
					alter table jidlo_jidelnicku add foreign key (id_jidelnicku) references jidelnicek(id_jidelnicku);

					alter table jidlo_jidelnicku add foreign key (id_jidla) references jidlo(id_jidla);

					alter table objednavka_na_kuchyn add foreign key (rc_pacienta) references pacient(rodne_cislo);

					alter table pacient add foreign key (jidelnicek) references jidelnicek(id_jidelnicku);

					alter table pacient add foreign key (cislo_pokoje) references pokoj(cislo_pokoje);

					alter table objednavka_na_kuchyn add foreign key (preferovane_jidlo) references jidlo(id_jidla);

					alter table diety_jidel add foreign key (id_jidla) references jidlo(id_jidla);

					alter table jidla_a_suroviny add foreign key (id_jidla) references jidlo(id_jidla);

					alter table jidla_a_suroviny add foreign key (id_surovin) references suroviny(id_suroviny);