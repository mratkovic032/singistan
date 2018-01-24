CREATE TABLE opstina (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naziv VARCHAR(50) NULL
);

CREATE TABLE tip_nekretnine (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tip VARCHAR(50) NULL
);

CREATE TABLE nekretnina (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adresa VARCHAR(150) NOT NULL,
    latitude VARCHAR(20) NULL,
    longitude VARCHAR(20) NULL,
    povrsina INT NOT NULL,
    struktura ENUM('Garsonjera', 'Jednosobna', 'Dvosobna', 'Trosobna', 'Cetvorosobna', 'Petosobna') NULL,
    parking ENUM('Slobodna zona', 'Zona III', 'Zona II', 'Zona I') NULL,
    grejanje VARCHAR(150) NULL,
    namestenost ENUM('Namestena', 'Polunamestena', 'Nenamestena') NULL,
    sprat INT NULL,
    spratnost INT NULL,
    cena INT NOT NULL,
    status INT NOT NULL DEFAULT 0,
    id_opstina INT NOT NULL,
    id_tip_nekretnine INT NOT NULL,
    CONSTRAINT fk_nekretnina_opstina FOREIGN KEY (id_opstina) REFERENCES opstina (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_nekretnina_tip_nekretnine FOREIGN KEY (id_tip_nekretnine) REFERENCES tip_nekretnine (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE agent (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    jmbg VARCHAR(13) NOT NULL,
    adresa VARCHAR(150) NOT NULL,
    telefon VARCHAR(15) NOT NULL,
    korisnicko_ime VARCHAR(20) NOT NULL,
    sifra VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    putanja_slike VARCHAR(255) NULL,
    notifikacija INT NOT NULL DEFAULT 0
);

CREATE TABLE kupac (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    jmbg VARCHAR(13) NOT NULL,
    adresa VARCHAR(150) NOT NULL,
    telefon VARCHAR(15)NOT NULL,
    korisnicko_ime VARCHAR(20) NOT NULL,
    sifra VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    putanja_slike VARCHAR(255) NULL
);

CREATE TABLE gledanje_nekretnine (
    id INT NOT NULL AUTO_INCREMENT,
    vreme DATETIME NOT NULL,
    id_kupac INT NOT NULL,
    id_nekretnina INT NOT NULL,
    CONSTRAINT fk_gledanje_nekretnine_kupac FOREIGN KEY (id_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_geldanje_nekretnine_nekretnina FOREIGN KEY (id_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    PRIMARY KEY (id, id_kupac, id_nekretnina)
);

CREATE TABLE ugovor (
    id INT NOT NULL AUTO_INCREMENT,
    datum DATE NOT NULL,
    putanja_ugovora VARCHAR(255) NULL,
    id_agent INT NOT NULL,
    id_kupac INT NOT NULL,
    id_nekretnina INT NOT NULL,
    CONSTRAINT fk_ugovor_agent FOREIGN KEY (id_agent) REFERENCES agent (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_ugovor_kupac FOREIGN KEY (id_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_ugovor_nekretnina FOREIGN KEY (id_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    PRIMARY KEY (id, id_agent, id_kupac, id_nekretnina)
);

CREATE TABLE lista_zelja (
    id INT NOT NULL AUTO_INCREMENT,
    id_kupac INT NOT NULL,
    id_nekretnina INT NOT NULL,
    CONSTRAINT fk_lista_zelja_kupac FOREIGN KEY (id_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_lista_zelja_nekretnina FOREIGN KEY (id_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    PRIMARY KEY (id, id_kupac, id_nekretnina)
);

CREATE TABLE slika (
    id INT NOT NULL AUTO_INCREMENT,
    id_nekretnina INT NOT NULL,
    ime_slike VARCHAR(255) NOT NULL,
    putanja_slike VARCHAR(255) NOT NULL,
    tip_slike VARCHAR(255) NOT NULL,
    PRIMARY KEY (id, id_nekretnina)
);
