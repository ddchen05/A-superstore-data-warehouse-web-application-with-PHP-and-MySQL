-- CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password';
CREATE USER IF NOT EXISTS gatechUser@localhost IDENTIFIED BY 'gatech123';

DROP DATABASE IF EXISTS 'cs6400_Spr19_team051`; 
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


CREATE TABLE Store (
  Store_number varchar(20) NOT NULL,
  Phone varchar(20) NOT NULL,
  Address varchar(200) NOT NULL,
  City_name varchar(200) NOT NULL,
  State varchar(200) NOT NULL,
  PRIMARY KEY (Store_number)
);

CREATE TABLE City(
  City_name varchar(200) NOT NULL,
  State varchar(200) NOT NULL,
  Population int(32) NOT NULL,
  PRIMARY KEY (City_name,State)
);

CREATE TABLE Manager(
  Email varchar(200) NOT NULL,
  first_name varchar(200) NOT NULL,
  middle_name varchar(200) NOT NULL,
  last_name varchar(200) NOT NULL,
  If_active boolean NULL, 
  PRIMARY KEY (Email)
);

CREATE TABLE AssignedManager(
   Store_number varchar(20) NOT NULL,
  Email varchar(200) NOT NULL,
  PRIMARY KEY (Store_number,Email)
);

CREATE TABLE Manufacturer(
  Manuf_name varchar(200) NOT NULL,
  Max_discount float NOT NULL,      
  PRIMARY KEY (Manuf_name)
);

CREATE TABLE Product(
  PID int(16) NOT NULL,
  pname varchar(200) NOT NULL,
  Retail_price float NOT NULL,
  Manuf_name varchar(200) NOT NULL,      
  PRIMARY KEY (PID)
);

CREATE TABLE ForSale(
   Store_number varchar(20) NOT NULL,
  PID int(16) NOT NULL,     
  PRIMARY KEY ( Store_number,PID)
);

CREATE TABLE Category(
  Category_name varchar(200) NOT NULL,   
  PRIMARY KEY (Category_name)
);

CREATE TABLE ProductCategory(
  PID int(16) NOT NULL,  
  Category_name varchar(200) NOT NULL,   
  PRIMARY KEY (PID, Category_name)
);

CREATE TABLE Date(
  Year varchar(4) NOT NULL,  
  Month varchar(2) NOT NULL,  
  Day varchar(2) NOT NULL,  
  PRIMARY KEY (Year, Month, Day)
);

CREATE TABLE Sold(
  PID int(16) NOT NULL,  
  Store_number varchar(20) NOT NULL,
  Year varchar(4) NOT NULL,  
  Month varchar(2) NOT NULL,  
  Day varchar(2) NOT NULL, 
  Sold_quantity int(16) NOT NULL, 
  PRIMARY KEY (PID,Store_number,Year,Month,Day)
);


CREATE TABLE SalePrice(
  PID int(16) NOT NULL,  
  Year varchar(4) NOT NULL,  
  Month varchar(2) NOT NULL,  
  Day varchar(2) NOT NULL, 
  Sale_price float NOT NULL,  
  PRIMARY KEY (PID,Year,Month,Day) 
);

CREATE TABLE Holiday(
  Holiday_name varchar(100) NOT NULL, 
  Year varchar(4) NOT NULL,  
  Month varchar(2) NOT NULL,  
  Day varchar(2) NOT NULL,   
  PRIMARY KEY (Holiday_name)  
);


-- Constraints   Foreign Keys: FK_ChildTable_childColumn_ParentTable_parentColumn
ALTER TABLE Store 
  ADD CONSTRAINT fk_Store_City_name_City_City_name FOREIGN KEY (City_name) REFERENCES `City` (City_name);

ALTER TABLE AssignedManager
  ADD CONSTRAINT fk_AssignedManager_ Store_number_Store_ Store_number FOREIGN KEY (Store_number) REFERENCES `Store` (Store_number);  

ALTER TABLE AssignedManager
  ADD CONSTRAINT fk_AssignedManager_Email_Manager_Email FOREIGN KEY (Email) REFERENCES `Manager` (Email);  

ALTER TABLE Product
  ADD CONSTRAINT fk_Product_Manuf_name_Manufacturer_Manuf_name FOREIGN KEY (Manuf_name) REFERENCES `Manufacturer` (Manuf_name);  

ALTER TABLE ForSale
  ADD CONSTRAINT fk_ForSale_Store_number_Store_Store_number FOREIGN KEY (Store_number) REFERENCES `Store` (Store_number);  

ALTER TABLE ProductCategory
  ADD CONSTRAINT fk_ProductCategory_PID_Product_PID FOREIGN KEY (PID) REFERENCES `Product` (PID); 

ALTER TABLE ProductCategory
  ADD CONSTRAINT fk_ProductCategory_Category_name_Category_Category_name FOREIGN KEY (Category_name) REFERENCES `Category` (Category_name); 
 
ALTER TABLE Sold
  ADD CONSTRAINT fk_Sold_PID_Product_PID FOREIGN KEY (PID) REFERENCES `Product` (PID); 

ALTER TABLE Sold
  ADD CONSTRAINT fk_Sold_Store_number_Store_ Store_number FOREIGN KEY (Store_number) REFERENCES `Store` (Store_number); 
 
ALTER TABLE Sold
  ADD CONSTRAINT fk_Sold_Year_Date_Year  FOREIGN KEY (Year) REFERENCES `Date` (Year); 

ALTER TABLE Sold
  ADD CONSTRAINT fk_Sold_Month_Date_Month  FOREIGN KEY (Month) REFERENCES `Date` (Month);  
 
ALTER TABLE Sold
  ADD CONSTRAINT fk_Sold_Day_Date_Day  FOREIGN KEY (Day) REFERENCES `Date` (Day);  

ALTER TABLE SalePrice
  ADD CONSTRAINT fk_SalePrice_PID_Product_PID FOREIGN KEY (PID) REFERENCES `Product` (PID); 

ALTER TABLE SalePrice
  ADD CONSTRAINT fk_SalePrice_Year_Date_Year  FOREIGN KEY (Year) REFERENCES `Date` (Year); 

ALTER TABLE SalePrice
  ADD CONSTRAINT fk_SalePrice_Month_Date_Month  FOREIGN KEY (Month) REFERENCES `Date` (Month);  
 
ALTER TABLE SalePrice
  ADD CONSTRAINT fk_SalePrice_Day_Date_Day  FOREIGN KEY (Day) REFERENCES `Date` (Day);  

ALTER TABLE Holiday
  ADD CONSTRAINT fk_Holiday_Year_Date_Year  FOREIGN KEY (Year) REFERENCES `Date` (Year); 

ALTER TABLE Holiday
  ADD CONSTRAINT fk_Holiday_Month_Date_Month  FOREIGN KEY (Month) REFERENCES `Date` (Month);  
 
ALTER TABLE Holiday
  ADD CONSTRAINT fk_Holiday_Day_Date_Day  FOREIGN KEY (Day) REFERENCES `Date` (Day);  
