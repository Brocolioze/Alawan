DROP TABLE IF EXISTS Alert ;
DROP TABLE IF EXISTS AnimalColor ;
DROP TABLE IF EXISTS Animal ;
DROP TABLE IF EXISTS Person ;
DROP TABLE IF EXISTS Address ;
DROP TABLE IF EXISTS necklace ;
DROP TABLE IF EXISTS Color ;
DROP TABLE IF EXISTS Race ;

CREATE TABLE Race (
	id int AUTO_INCREMENT,
	race varchar(20), 
	PRIMARY KEY (id)
);

CREATE TABLE Color (
	id int AUTO_INCREMENT,
	color varchar(16), 
	PRIMARY KEY (id)
);

CREATE TABLE Necklace(
	id int AUTO_INCREMENT,
	idNecklace varchar(255),
	position varchar(255),
	PRIMARY KEY(id)
);

CREATE TABLE Address (
	id int AUTO_INCREMENT,
	city varchar(24),
	street varchar(64),
	doorNumber int,
	postalCode varchar(10),
	PRIMARY KEY (id)
);

CREATE TABLE Person (
	id int AUTO_INCREMENT,
	idAddress int,
	name varchar(40), 
	lastName varchar(40),
	email varchar(63),
	password varchar(127),
	phone varchar(17),
	invite boolean,
	admin boolean,
	creationDate DATE,
	PRIMARY KEY (id),
	FOREIGN KEY (idAddress) REFERENCES Address(id)
);

CREATE TABLE Animal (
	id int AUTO_INCREMENT,
	idPerson int,
	idRace int,
	idNecklace int,
	name varchar(63),
	picture varchar(255),
	birth date,
	research boolean ,
	PRIMARY KEY (id),
	FOREIGN KEY (idPerson) REFERENCES Person(id),
	FOREIGN KEY (idRace) REFERENCES Race(id),
	FOREIGN KEY (idNecklace) REFERENCES Necklace(id)
	
);

CREATE TABLE AnimalColor (
	id int AUTO_INCREMENT,
	idAnimal int,
	idColor int,
	PRIMARY KEY (id),
	FOREIGN KEY (idAnimal) REFERENCES Animal(id),
	FOREIGN KEY (idColor) REFERENCES Color(id)
	
);

CREATE TABLE Alert (
	id int AUTO_INCREMENT,
	idAnimal int,
	dateLost date,
	dateFind date,
	place varchar(64) ,
	description varchar(255),
	alerteFound boolean,
	PRIMARY KEY (id),
	FOREIGN KEY (idAnimal) REFERENCES Animal(id)
);

INSERT INTO Address(city,street,doorNumber,postalCode)
VALUES("Trois-rivières","courteau",1000,"G6x0x1"),
      ("Pointe du lac", "meu-meu", 2000,"G4j3a1");
 
INSERT INTO Color(color)
VALUES 	("Blanc"),
		("Beige"),
		("Crème"),
		("Doré"),
		("Feu"),
		("Gris"),
		("Marron"),
		("Noir"),
		("Roux"),
		("Sable"),
		("Autre");
 
INSERT INTO Race(race)
VALUES ("Beagle"),
       ("Berger allemand (German Shepherd)"),
       ("Bichon frisé"),
	   ("Bouledogue français (French Bulldog)"),
	   ("Boxer"),
	   ("Caniche (Poodle)"),
	   ("Cavalier King Charles Spaniel"),
	   ("Chihuahua"),
	   ("Cocker Spaniel (American Cocker Spaniel ou English Cocker Spaniel)"),
	   ("Dalmatien"),
	   ("Doberman"),
	   ("Golden Retriever"),
	   ("Husky Sibérien (Siberian Husky)"),
	   ("Labrador Retriever"),
	   ("Malinois (Malinois Shepherd)"),
	   ("Maltipoo"),
	   ("Papillon"),
	   ("Pitbull Terrier"),
	   ("Pomeranian"),
	   ("Pug (Carlin)"),
	   ("Rottweiler"),
	   ("Saint-Bernard (Saint Bernard)"),
	   ("Samoyède (Samoyed)"),
	   ("Schnauzer"),
	   ("Setter Irlandais (Irish Setter)"),
	   ("Shiba Inu"),
	   ("Shih Tzu"),
	   ("Teckel (Dachshund)"),
	   ("Terrier Jack Russell (Jack Russell Terrier)"),
	   ("Yorkshire Terrier"),
	   ("Autre");
 
INSERT INTO Necklace(idNecklace)
VALUES 	("ABC123"),
       	("CBA321"),
	 	("XXX000");
 
INSERT INTO Person(idAddress, name, lastName, email, password, phone, admin, invite)
VALUES  (1, "Antoine", "Lefebvre", "antoinelefebvre@hotmail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-999-9999", false, false),
        (2, "Zak", "El Bahodi", "zakelbahodi@homtail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-999-9999",true, false),
		(1, "Alexandre", "Carle", "alex.carle@hotmail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-668-7152", false, false);
		

		
INSERT INTO Person(name, lastName, invite)
VALUES  ("Invité", "Alawan", 1);

INSERT INTO Person(name, lastName, email, password, phone, admin, invite)
VALUES  ("Christos", "Tostitos", "christoslatostitos@hotmail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-999-9999", false, false),
        ("tartaros", "El Doritos", "tartaroseldoritos@homtail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-999-9999",false, false),
		("Jacob", "Lorbe", "jacoblorbe@hotmail.com", "$2y$12$P1spiC5wcubjcVE3pKOnQuSkDEuCZTU5tGX.7bylRXBlctSmrku2G", "819-668-7152", false, false);

 
INSERT INTO Animal(idPerson, idRace, idNecklace, name, picture, birth, research)
VALUES  	(1,1,1,"dogo1","image",'2024-01-01',false),
        	(2,2,2,"dogo2","image",'2024-02-02',false),
	   		(3,3,3,"dogo3","image",'2000-01-01',false),
			(1,4,null,"dogo4",'image','2022-06-20',false),
			(1,5,null,"dogo5",'image','2024-03-25',false),
			(1,6,null,"dogo6",'image','2023-01-10',false),
			(2,7,null,'dogo7','image','2020-02-20',false),
			(3,5,null,'dogo8','image','2018-04-14',false),
			(5,2,null,'dogo9','image','2024-01-30',false),
			(6,6,null,'dogo10','image','2024-02-27',false),
			(7,3,null,'dogo11','image','2023-12-31',false),
			(7,10,null,'dogo12','image','2024-03-25',false),
			(5,11,null,'dogo13','image','2024-05-20',false);
 
INSERT INTO AnimalColor(idColor,idAnimal)
VALUES  (1,1),
        (2,2),
        (3,3),
		(4,3),
		(5,1),
		(6,7),
		(7,7),
		(8,5),
		(9,1),
		(9)

INSERT INTO Alert(idAnimal,dateLost,description,alerteFound)
VALUES (1,'2024-01-01',"mon chien que j'adore est perdu j'ai besoin d'aide vite!",false),
	   (5,'2023-12-01',"C'est l'amour de ma vie. J'ai besoin d'aide le plus vite possible",false),
	   (8,'2024-03-20',"Comment je peux vivre sans mon super cgien dogo8.");