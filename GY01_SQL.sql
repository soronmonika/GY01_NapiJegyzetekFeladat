CREATE DATABASE `NapiFeladatok_SoronMonika`
CHARACTER SET utf8mb4
COLLATE utf8mb4_hungarian_ci;

USE NapiFeladatok_SoronMonika;

CREATE TABLE Feladatok(
ID VARCHAR(10) PRIMARY KEY,
Nev VARCHAR(100) NOT NULL,
Kesz BOOLEAN,
Datum date NOT NULL
);