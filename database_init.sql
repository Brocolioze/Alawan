
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
	idCollier varchar(255),
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
	dateFind boolean,
	place varchar(64) ,
	description varchar(255),
	alerteFound boolean,
	PRIMARY KEY (id),
	FOREIGN KEY (idAnimal) REFERENCES Animal(id)
);
