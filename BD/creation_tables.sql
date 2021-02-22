


DROP TABLE IF EXISTS Reservation, Destination, User, Categorie;


CREATE TABLE User(
id 			INTEGER 	NOT NULL 	AUTO_INCREMENT,
nom 		VARCHAR(25) NOT NULL,
prenom 		VARCHAR(25) NOT NULL,
mail 		VARCHAR(30) NOT NULL,
mdp 		VARCHAR(64) NOT NULL,
role 		VARCHAR(10) NOT NULL DEFAULT 'CLIENT',
PRIMARY KEY PK_Client (id),
CHECK (role = 'CLIENT' OR role = 'ADMIN'),
CONSTRAINT UK_User UNIQUE (mail));

CREATE TABLE Category(
id 			 INTEGER 	 NOT NULL,
nom 		 VARCHAR(20) NOT NULL,
PRIMARY KEY PK_Categorie (id));

CREATE TABLE Destination(
id 			 	INTEGER 		NOT NULL 	AUTO_INCREMENT,
categorie 		INTEGER 		NOT NULL,
designation 	VARCHAR(30) 	NOT NULL,
description 	VARCHAR(512) 	NOT NULL,
img_dest 		VARCHAR(30) 	NOT NULL,
prix_journee 	DECIMAL(7,2) 	NOT NULL,
prix_billet 	DECIMAL(7,2) 	NOT NULL,
PRIMARY KEY PK_Destination (id));

CREATE TABLE Reservation(
id 			 	INTEGER 	 NOT NULL 	AUTO_INCREMENT,
client 			INTEGER 	 NOT NULL,
destination 	INTEGER 	 NOT NULL,
prix_total 		DECIMAL(7,2) NOT NULL,
dateDepart 		DATE 		 NOT NULL,
dateFin 		DATE 		 NOT NULL,
estPaye 		BOOLEAN		 NOT NULL DEFAULT FALSE,
PRIMARY KEY PK_Reservation (id));

ALTER TABLE Destination
ADD CONSTRAINT FK_Dest_Cat FOREIGN KEY (categorie) REFERENCES Category (id);

ALTER TABLE Reservation
ADD CONSTRAINT FK_Reserv_User FOREIGN KEY (client) REFERENCES User (id);

ALTER TABLE Reservation
ADD CONSTRAINT FK_Reserv_Dest FOREIGN KEY (destination) REFERENCES Destination (id);