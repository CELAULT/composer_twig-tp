CREATE TABLE type(
   id_t INT AUTO_INCREMENT,
   libelle_t VARCHAR(50),
   PRIMARY KEY(id_t)
);

CREATE TABLE genre(
   id_g INT,
   libelle_g VARCHAR(50),
   PRIMARY KEY(id_g)
);

CREATE TABLE inscrit(
   id_i INT,
   numero_carte_i VARCHAR(50),
   date_expiration_i DATE,
   nom_i VARCHAR(50),
   prenom_i VARCHAR(50),
   date_naissance_i DATE,
   rue_i VARCHAR(50),
   code_postal_i VARCHAR(50),
   email_i VARCHAR(250),
   telephone_fixe_i INT,
   telephone_portable_i INT,
   ville_i VARCHAR(50),
   PRIMARY KEY(id_i)
);

CREATE TABLE pays(
   id_p INT,
   nom_p VARCHAR(50),
   PRIMARY KEY(id_p)
);

CREATE TABLE editeur(
   id_e INT,
   nom_e VARCHAR(50),
   PRIMARY KEY(id_e)
);

CREATE TABLE livre(
   id_l INT,
   titre_l VARCHAR(50),
   isbn_l VARCHAR(13),
   annee_l INT,
   resume_l TEXT,
   id_t INT,
   PRIMARY KEY(id_l),
   FOREIGN KEY(id_t) REFERENCES type(id_t)
);

CREATE TABLE auteur(
   id_a INT,
   nom_a VARCHAR(50),
   prenom_a VARCHAR(50),
   date_naissance_a DATE,
   id_p INT NOT NULL,
   PRIMARY KEY(id_a),
   FOREIGN KEY(id_p) REFERENCES pays(id_p)
);

CREATE TABLE exemplaire(
   numero_e INT,
   etat_e VARCHAR(50),
   annee_edition_e DATE,
   id_e INT NOT NULL,
   PRIMARY KEY(numero_e),
   FOREIGN KEY(id_e) REFERENCES editeur(id_e)
);

CREATE TABLE rediger(
   id_l INT,
   id_a INT,
   PRIMARY KEY(id_l, id_a),
   FOREIGN KEY(id_l) REFERENCES livre(id_l),
   FOREIGN KEY(id_a) REFERENCES auteur(id_a)
);

CREATE TABLE appartenir_genre(
   id_l INT,
   id_g INT,
   PRIMARY KEY(id_l, id_g),
   FOREIGN KEY(id_l) REFERENCES livre(id_l),
   FOREIGN KEY(id_g) REFERENCES genre(id_g)
);

CREATE TABLE correspondre(
   id_l INT,
   numero_e INT,
   PRIMARY KEY(id_l, numero_e),
   FOREIGN KEY(id_l) REFERENCES livre(id_l),
   FOREIGN KEY(numero_e) REFERENCES exemplaire(numero_e)
);

CREATE TABLE emprunter(
   numero_e INT,
   id_i INT,
   date_emprunt_e DATE,
   duree_emprunt_e INT,
   PRIMARY KEY(numero_e, id_i),
   FOREIGN KEY(numero_e) REFERENCES exemplaire(numero_e),
   FOREIGN KEY(id_i) REFERENCES inscrit(id_i)
);

CREATE TABLE etre_marier(
   id_i_1 INT,
   date_mariage DATE,
   id_i INT NOT NULL,
   PRIMARY KEY(id_i_1),
   UNIQUE(id_i),
   FOREIGN KEY(id_i_1) REFERENCES inscrit(id_i),
   FOREIGN KEY(id_i) REFERENCES inscrit(id_i)
);