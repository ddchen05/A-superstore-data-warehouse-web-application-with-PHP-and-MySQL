-- CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
CREATE USER IF NOT EXISTS gatechUser@localhost IDENTIFIED BY 'gatech123';

DROP DATABASE IF EXISTS `cs6400_Spr19_team051`; 
SET default_storage_engine=InnoDB;
SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE DATABASE IF NOT EXISTS cs6400_Spr19_team051 
    DEFAULT CHARACTER SET utf8mb4 
    DEFAULT COLLATE utf8mb4_unicode_ci;
USE cs6400_Spr19_team051;

GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'gatechUser'@'localhost';
GRANT ALL PRIVILEGES ON `gatechuser`.* TO 'gatechUser'@'localhost';
GRANT ALL PRIVILEGES ON `cs6400_Spr19_team051`.* TO 'gatechUser'@'localhost';
FLUSH PRIVILEGES;

-- Tables 


CREATE TABLE City(
  City_name varchar(100) NOT NULL,
  State varchar(10) NOT NULL,
  Population int(32) NOT NULL,
  PRIMARY KEY (City_name,State)
);

CREATE TABLE Store (
  Store_number int NOT NULL,
  Phone varchar(20) NOT NULL,
  Address varchar(200) NOT NULL,
  City_name varchar(100) NOT NULL,
  State varchar(10) NOT NULL,
  PRIMARY KEY (Store_number),
  FOREIGN KEY (City_name,State) REFERENCES City(City_name,State)
);

CREATE TABLE Manager(
  Email varchar(200) NOT NULL,
  first_name varchar(100) NOT NULL,
  last_name varchar(100) NOT NULL,
  If_active varchar(5) NULL, 
  PRIMARY KEY (Email)
);

CREATE TABLE AssignedManager(
  Store_number int NOT NULL,
  Email varchar(200) NOT NULL,
  PRIMARY KEY (Store_number,Email),
  FOREIGN KEY (Store_number) REFERENCES Store(Store_number),
  FOREIGN KEY (Email) REFERENCES Manager(Email)
);

CREATE TABLE Manufacturer(
  Manuf_name varchar(200) NOT NULL,
  Max_discount float NOT NULL,      
  PRIMARY KEY (Manuf_name)
);

CREATE TABLE Product(
  PID int NOT NULL,
  pname varchar(200) NOT NULL,
  Retail_price float NOT NULL,
  Manuf_name varchar(200) NOT NULL,      
  PRIMARY KEY (PID),
  FOREIGN KEY (Manuf_name) REFERENCES Manufacturer(Manuf_name)
);

CREATE TABLE Category(
  Category_name varchar(100) NOT NULL,   
  PRIMARY KEY (Category_name)
);

CREATE TABLE ProductCategory(
  PID int NOT NULL,  
  Category_name varchar(100) NOT NULL,   
  PRIMARY KEY (PID, Category_name),
  FOREIGN KEY (PID) REFERENCES Product(PID),
  FOREIGN KEY (Category_name) REFERENCES Category(Category_name)
);

CREATE TABLE Sold(
  PID int NOT NULL,  
  Store_number int NOT NULL,
  Sold_date date NOT NULL,
  Sold_quantity int NOT NULL, 
  PRIMARY KEY (PID, Store_number, Sold_date),
  FOREIGN KEY (PID) REFERENCES Product(PID),
  FOREIGN KEY (Store_number) REFERENCES Store(Store_number)
);


CREATE TABLE SalePrice(
  PID int NOT NULL,  
  Sale_date date NOT NULL,
  Sale_price float NOT NULL,
  PRIMARY KEY (PID, Sale_date),
  FOREIGN KEY (PID) REFERENCES Product(PID)   
);

CREATE TABLE Holiday(
  Holiday_date date NOT NULL,
  Holiday_name varchar(100) NOT NULL, 
  PRIMARY KEY (Holiday_date)  
);
