-- ========================================
-- Author : Alif Aizat MOHD NOOR
-- Modul  : DevWeb
-- Sujet  : TEA 
-- ========================================


-- ========================================
-- Création des tables
-- ========================================


DROP TABLE IF EXISTS Reservation, Destination, User, Category;


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
img_dest 		VARCHAR(60) 	NOT NULL,
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



-- ========================================
-- Peuplements 
-- ========================================


DELETE FROM Reservation;
DELETE FROM Destination;
DELETE FROM User;
DELETE FROM Category;


-- Categorie

INSERT INTO Category (id, nom)
VALUES
(0, "Amérique du Nord"),
(1, "Amérique du Sud"),
(2, "Antarctique"),
(3, "Afrique"),
(4, "Europe"),
(5, "Asie"),
(6, "Océanie");

-- Destination

INSERT INTO Destination (designation, categorie, description, img_dest, prix_journee, prix_billet)
VALUES
('Egypte', 3, 'L\'Egypte est connue pour ses fameuses pyramides notamment. Un séjour Egypte, c’est visiter l’un des pays les plus riches du monde en histoire. Partez en club de vacances en Egypte à la rencontre du glorieux passé de la terre des Pharaons.','app/img/dest/egypt.jpg',120.25, 200.0),
('Cappadoce,Turquie', 5,'Voyage en Cappadoce pour découvrir l\'histoire de cette région aux paysages uniques, canyons, pics et grottes, qui, au début du christianismes, attira les moines en quête d\'isolement et de méditation. Eglises rupestres peintes, monastères, ermitages émaillent les reliefs tourmentés taillés par l\'érosion.','app/img/dest/cappadocia.jpg', 130.50, 250.50),
('Cinque Terre, Manarola, Italy', 4, 'Les Cinque Terre sont des villages à flanc de montagne sur la Riviera italienne, à quelques heures de route seulement du Sud de la France. Grâce (ou à cause) de son caractère extraordinaire la région est maintenant classée au patrimoine mondial de l’UNESCO. Pourquoi \'\'Cinque Terre \'\', car se sont cinq magnifiques villages reliés entre elles par des sentiers de marche pittoresques.', 'app/img/dest/manarola.jpg', 120.35, 150.70),
('Agra, Inde', 5, 'Agra est connue dans le monde la ville de \'Taj Mahal\'. Agra a ses racines, depuis l\'époque de Mahabharatha. Taj MahalAgra est situé sur le bord d\'ouest de la rivière de Yamuna, à 204 km sud de Delhi.', 'app/img/dest/agra.jpg', 110.25, 300.50),
('Lahbab, Dubai', 5,  'Que visiter à Desert De Lahbab ? Les voyages remontent à l’ Antiquité, où riches Grecs et Romains voyageaient dans leurs maisons d’été et leurs villas d’été dans des villes comme Pompéi et Baïé.', 'app/img/dest/lahbab.jpg',  110.25, 300.50),
("New York, Manhattan", 0, "New York. Ceux qui n’y ont jamais posé les pieds la connaissent déjà, par le cinéma, les séries télé, la musique, la littérature. New York est une machine à rêves.", "app/img/dest/new-york.jpg", 200, 750.50),
("Toronto, Canada", 0, "La ville de Toronto a un statut de pôle économique international où la finance occupe une place très importante mais aussi de pôle culturel. En effet, Toronto n'est pas juste une ville intéressante pour le business, elle l'est aussi pour les touristes avec de nombreux monuments et musées à visiter.", "app/img/dest/toronto.jpg", 220, 760.00),
("Rio de Janerio", 1, "Rio de Janeiro est la ville de tous les clichés brésiliens : écoles de samba, favelas, plages magnifiques, capoeira, Corcovado, appartements de luxes, carnaval, volley-ball à Leblon, embouteillages de folie, bronzette sur Copacabana", "app/img/dest/rio-janerio.jpg", 210, 880.50),
("Sydney, Australie", 6, "Un voyage à Sydney, c’est découvrir la splendide baie de Port Jackson, les quartiers historiques de Darling Harbour et The Rocks jusqu’à l’opéra, les plages dorées de Bondi ou de Manly.", "app/img/dest/sydney.jpg", 300, 1500.00),
("Amsterdam, Pays-Bas", 4,"Amsterdam, c'est d'abord une histoire d'eau. Elle est partout. Elle semble figée, et pourtant elle guide les pas. À Amsterdam, on ne change pas facilement de trottoir : il faut contourner l’eau pour aller chercher un pont plus loin. Et comme 1 281 ponts courbent l’échine pour lui faire allégeance, on se laisse séduire par la grâce qui se dégage du tableau.","app/img/dest/amsterdam.jpg",110.0, 120),
("Désert d'Atacama, Chili", 1,"Voyage dans le Nord-Chili. Les vastes salars de l’Atacama comptent parmi les plus spectaculaires d’Amérique. Univers de silence, ils s’étagent au cœur de la cordillère des Andes jusqu’à plus de 4 500 m d’altitude. Visions magiques des lagunes d’altitude, fumerolles des Geysers del Tatio, églises en bois de cactus et cuir de lama.","app/img/dest/Atacama-Desert-chile.jpg",150.0,800.50),
("Auckland, Nouvelle-Zélande", 6, "On l’apprendra grâce au capitaine Cook, la Nouvelle-Zélande, compte deux îles principales et opposées. Au nord, l’île du Nord (« île Fumante »), avec sa cohorte de volcans et ses forêts subtropicales, et l’île du Sud (« île de Jade »), un peu plus grande, avec son échine de crêtes enneigées vite baptisées « Alpes néo-zélandaises ».", "app/img/dest/auckland.jpg", 180.70, 820.0),
("Californie, États-Unis", 0, "À l’ouest des États-Unis, bordée par l'océan Pacifique, la Californie représente tout l’attrait d’un « bout du monde », à la fois fortement urbanisé et très sauvage. Mer, montagne et désert se trouvent aux portes des villes, elles-mêmes plutôt ouvertes sur la nature.", "app/img/dest/california.jpg",210.0, 750.50),
("Le Cap, Afrique du Sud", 3, "Voyage Afrique du Sud Guide voyage Afrique du Sud (+ Swaziland et Lesotho) 2020 Qui aurait pensé que l’Afrique du Sud parviendrait à chasser ses vieux démons et retrouverait la voie de la paix civile et de la respectabilité ? L’apartheid en vigueur à partir de 1948 a été aboli en 1991. En 1994, les Sud-Africains participèrent aux premières élections démocratiques jamais organisées dans leur pays.", "app/img/dest/cape-town.jpg",100.0, 550.0),
("Colombie", 1, "La Colombie est l’une des plus belles destinations d’Amérique du Sud qui ouvre ses portes au voyageur ! Si les conquistadors espagnols étaient convaincus que le fameux El Dorado se trouvait sur ces terres, ce n’est peut-être pas un hasard… Car la Colombie possède bien des richesses, naturelles et culturelles.", "app/img/dest/colombia.jpg", 105.40, 767.55),
("Kenya, Afrique", 3, "Le Kenya attire surtout pour sa faune sauvage et ses paysages modelés par le Rift, qui se combinent en un unique terme : safari (signifiant « voyage » en swahili). Parcs nationaux, réserves (une quarantaine au total) sont une extraordinaire invitation à la découverte de la nature et de la vie qui s'y donnent en spectacle. Les Big Five (lion, léopard, éléphant, rhinocéros, buffle) sont tous là et bien plus encore.", "app/img/dest/kenya.jpg",105.70, 500.0),
("Londres, Royaume Uni", 4, "Londres a franchi le millénaire en s’offrant une cure de jouvence. Dopée par la croissance économique, elle s’est offert un lifting architectural spectaculaire, affirmant ainsi son rôle de mégalopole multiculturelle. Le cosmopolitisme et la tolérance, l’esprit d’entreprise, les hauts salaires et le (presque) plein emploi ont attiré une nouvelle vague d’immigration sans précédent jusqu'à 2008.","app/img/dest/london.jpg", 230.0, 150.60),
("Marrakech, Maroc", 3, "Marrakech fait partie des destinations qui font rêver les voyageurs... même si ses vieux amoureux jurent ne plus reconnaître aujourd’hui leur « Perle du Sud ». Cette ville en pleine mutation ne laisse pas indifférent. Laissez-vous porter par la vie de Marrakech, l’humour, les couleurs, les odeurs, le charme indéniable de cette ensorceleuse : l’immense place Jemaa-el-Fna et son animation valent à elles seules le déplacement.", "app/img/dest/marrakesh.jpg", 110.80, 330.0),
("Paris, La France", 4, "Voyage Paris Guide voyage Paris 2020 Paris est histoire, d'abord. Paris, où l'on a pris la Bastille. Paris, la ville du baron Haussmann, capitale du « progrès ». Paris des années Charleston, où l’on s’étourdit, comme pour oublier la Grande Boucherie. Et Paris la peur, la délation, les rafles. Et puis, de nouveau, Paris est une fête. Paris swingue. Et le joli mois de mai à Paris : Sorbonne occupée, barricades. Paris étonne. Paris chante. « Il est 5 heures, Paris s’éveille... »", "app/img/dest/paris.jpg", 70.65, 100.0),
("Perth, Australie", 6, "Sur les rives de la Swan River, Perth est une ville moderne et dynamique. Fondée en 1829, située à plus de 4 000 km de Sydney, on dit que c’est la métropole la plus isolée au monde. Les gratte-ciel de la City côtoient les bâtiments anciens de style 1900. Perth est une ville vraiment très agréable, avec son parc immense et la fraîcheur des collines alentours.", "app/img/dest/perth.jpg",150.60, 700.0),
("Pérou", 1, "Fascinés par le mythe de l’Eldorado ? Près de cinq siècles plus tard, ce n’est plus l’or qui fascine les voyageurs au Pérou : c’est la pierre, dressée en montagnes altières, creusée en vallées sacrées, débitée en murs aux pavés parfaitement joints, témoins du savoir-faire des Incas.", "app/img/dest/peru.jpg", 130.60, 715.0),
("Quebec, Canada", 0, "Les mythes du Grand Nord ont de beaux jours devant eux. Forêts, chiens de traîneau, lacs, saumons, baleines, ours, sirop d’érable et hydravions... Cette imagerie fantasmagorique (mais réelle), aussi étroite que la terre canadienne est vaste, reste ancrée dans les esprits européens... Mais il y a aussi les hommes et les femmes du Québec.", "app/img/dest/quebec.jpg",180.90, 710.0),
("Singapour", 5, "Voyage Singapour Guide voyage Malaisie, Singapour 2019/20 Une île, un État, une ville : Singapour, quasi de la taille de New York, ordonnée et propre comme une petite Suisse d’Asie du Sud-Est. Particulièrement dynamique, elle mène une politique d’expansion tous azimuts, avide de gagner du temps et de rester à la pointe de la modernité, mais sans renier son passé.", "app/img/dest/singapore.jpg",180.90, 710.0),
("Wellington, Nouvelle-Zélande", 6, "Située au sud de l’île, Wellington est la capitale du pays. La ville se trouve au cœur d’une baie, entre un port et des collines boisées, d’ailleurs couvertes par de très jolies petites maisons aux toits colorés. En bonne capitale, Wellington accueille le Parlement et les ministères, mais aussi des boutiques luxueuses, des cafés animés et offre une vie nocturne animée.", "app/img/dest/wellington.jpg",150.60, 700.0);


