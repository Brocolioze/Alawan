CREATE DATABASE BDAlawan;

DROP TABLE Research IF EXISTS;
DROP TABLE Alert IF EXISTS;
DROP TABLE AnimalColour IF EXISTS;
DROP TABLE Animal IF EXISTS;
DROP TABLE Person IF EXISTS;
DROP TABLE Address IF EXISTS;
DROP TABLE Colour IF EXISTS;
DROP TABLE Race IF EXISTS;

CREATE TABLE Race (
	id int NOT NULL,
	race varchar(20) NOT NULL, 
	PRIMARY KEY (id)
);

CREATE TABLE Colour (
	id int NOT NULL,
	colour varchar(16) NOT NULL, 
	PRIMARY KEY (id)
);

CREATE TABLE Address (
	id int NOT NULL,
	city varchar(24) NOT NULL,
	street varchar(64) NOT NULL,
	number int NOT NULL,
	postalCode varchar(10) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE Person (
	id int NOT NULL,
	idAddress int,
	name varchar(40), 
	lastName varchar(40),
	email varchar(63),
	password varchar(127),
	phone varchar(17),
	PRIMARY KEY (id),
	FOREIGN KEY idAddress REFERENCES Address(id)
);

CREATE TABLE Animal (
	id int NOT NULL,
	idPerson int NOT NULL,
	idRace int NOT NULL,
	name varchar(63),
	picture varchar(255),
	birth date,
	research boolean not null,
	PRIMARY KEY (id),
	FOREIGN KEY idPerson REFERENCES Person(id),
	FOREIGN KEY idRace REFERENCES Race(id)
);

CREATE TABLE AnimalColour (
	id int NOT NULL,
	idAnimal NOT NULL,
	idColour NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY idAnimal REFERENCES Animal(id),
	FOREIGN KEY idColour REFERENCES Colour(id)
);

CREATE TABLE Alert (
	id int NOT NULL,
	idAnimal int NOT NULL,
	idRace int NOT NULL,
	dateLost date NOT NULL,
	dateFind date NOT NULL,
	place varchar(64) NOT NULL,
	description varchar(255),
	invite boolean NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY idPAnimal REFERENCES Animal(id)
);

CREATE TABLE Research (
	id int NOT NULL,
	idAnimal int NOT NULL,
	idRace int NOT NULL,
	dateLost date NOT NULL,
	dateFind date NOT NULL,
	place varchar(64) NOT NULL,
	description varchar(255),
	PRIMARY KEY (id),
	FOREIGN KEY idPAnimal REFERENCES Animal(id)
);