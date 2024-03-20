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
VALUES ("noir"),
       ("blanc"),
       ("roux");
 
INSERT INTO Race(race)
VALUES ("berger allemand"),
       ("caniche"),
       ("caniche royale");
 
INSERT INTO Necklace(idNecklace)
VALUES 	("ABC123"),
       	("CBA321"),
	 	("XXX000");
 
INSERT INTO Person(idAddress, name, lastName, email, password, phone, admin, invite)
VALUES  (1, "Antoine", "Lefebvre", "antoinelefebvre@hotmail.com", "qwerty123456", "819-999-9999", false, false),
        (2, "Zak", "El Bahodi", "zakelbahodi@homtail.com", "qwerty123456", "819-999-9999",true, false),
		(1, "Alexandre", "Carle", "alex.carle@hotmail.com", "pipopipo6464", "819-668-7152", false, false);
		
INSERT INTO Person(idAddress, name, lastName, invite)
VALUES  (2, "Invite", "Alawan", 1);
 
INSERT INTO Animal(idPerson, idRace, idNecklace, name, picture, birth, research)
VALUES  	(1,1,1,"dogo1","image",'2024-01-01',false),
        	(2,2,2,"dogo2","image",'2024-02-02',false),
	   	(3,3,3,"dogo3","image",'2000-01-01',false);
 
INSERT INTO AnimalColor(idColor,idAnimal)
VALUES  (1,1),
        (2,2),
        (3,3);
 
INSERT INTO Alert(idAnimal,dateLost,description,alerteFound)
VALUES (1,'2024-01-01',"mon chien que j'adore est perdu j'ai besoin d'aide vite!",false);