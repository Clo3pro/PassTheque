drop table if exists Reservation;
drop table if exists Membre;

CREATE TABLE Reservation(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idMembre INT(11) NOT NULL,
    isbn VARCHAR(15) NOT NULL,
    dateDebut DATETIME,
    dateFin DATETIME,
    retour INT NOT NULL DEFAULT 0,
    jourRetard INT NOT NULL DEFAULT 0
);

CREATE TABLE Membre(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nom VARCHAR(45) NOT NULL,
    prenom VARCHAR(45) NOT NULL,
    motDePasse VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    telephone VARCHAR(10),
    niveauAcces INT NOT NULL DEFAULT 1,
    valider INT NOT NULL DEFAULT 0
);

ALTER TABLE Reservation
ADD CONSTRAINT fk_ReservationMembre FOREIGN KEY (idMembre)
REFERENCES Membre(id);
ALTER TABLE Reservation
ADD CONSTRAINT fk_ReservationLivre FOREIGN KEY (isbn)
REFERENCES Livre(isbn);