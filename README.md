# A superstore data warehouse web application with PHP and MySQL
### Project Overview
The purpose of this project is to analyze, specify, design, and implement a data warehouse for 
an up-and-coming computer and electronics store called S&E’s Technology Superstore. The 
project will proceed in three phases as outlined in the Classical Methodology for Database 
Development: Analysis & Specification, Design, and Implementation & Testing. The system 
will be implemented using a Database Management System (DBMS) that supports standard 
SQL queries. 
### Repository layout
This project is delivered in 3 phases.

Phase 1:

The Extended Entity Relationship (EER) map for the S&E Store

The Information Flow Diagram

A detailed Report with data types, task decomposition, and abstract code.

Phase 2:

The updated EER map

The EER to Relational Database table mapping

Full schema of the Relational Database with all tables and constraints

A report which has translated Phase1 abstract code into SQL queries

Phase 3: 

All the implementation code for this project.
### UI interface
The local database is hosted on the WAMP server.
#### Dashboard
The main menu screen  can be used to access all functionality of the system that has been described in this specification. On this main menu, the following
statistics should be displayed along with any buttons/links to reports or functionalities: the count of stores, manufacturers, products, and managers in the data warehouse.
![1](https://user-images.githubusercontent.com/50339450/168499085-b44c35c5-09cb-4b77-bd67-d9ea76af3ac6.png)

#### Manager
Managers’ information can be added, removed, and assigned/unassigned to stores, as this information may not be available from the source system or outdated.
![2](https://user-images.githubusercontent.com/50339450/168499179-2d5b01d9-b2e9-403f-b6fc-891c7e0eefb0.png)

#### City
The UI allows for updating the population of any cities in the data warehouse, should a city’s population change.
![3](https://user-images.githubusercontent.com/50339450/168499388-5a39c10c-9d2e-4561-bbe1-a6d9fdf62913.png)

#### Holiday
This interface allows for viewing and adding holiday information directly within the user interface.
![4](https://user-images.githubusercontent.com/50339450/168499466-0661da39-cf10-4342-be69-28cca9f2c88b.png)

#### Reports
7 reports can be accessed with the user interface, including:

Report 1 – Manufacturer’s Product Report:For each manufacturer, return the manufacturer’s name, total number of products offered by the manufacturer, average retail price of all the manufacturer’s products, minimum retail price, and maximum retail price.

Report 2 – Category Report:For each category, return the category name, total number of products in that category, total number of unique manufacturers offering products in that category, and the average retail price (not including sale days) of all the products in that category, sorted by category name ascending.

Report 3 – Actual versus Predicted Revenue:This report compares how much revenue was actually generated from a product’s sales to a predicted revenue if the product were never offered on sale.

Report 4 –Store Revenue by Year by State:This report shows the revenue collected by stores per state grouped by year.

Report 5 – Air Conditioners on Groundhog Day:For each year, return the year, the total number of items sold that year in the air conditioning category, the average number of units sold per day (assume a year is exactly 365 days), and the total number of units sold on Groundhog Day (February 2) of that year. Sort the report on
the year in ascending order.

Report 6 – State with Highest Volume for each Category:The report will return for each category: the category name, the state that sold the highest number of units in that category (i.e., include items sold by all stores in the state), and the number of units that were sold by stores in that state. This output shall be sorted by
category name ascending.

Report 7 – Revenue by Population:the average revenue is for specific population categories.

Here I used Report 1 as an example.
![5](https://user-images.githubusercontent.com/50339450/168500004-af0b46df-2ee0-4f5d-82df-ae5f62716954.png)

When the "View Detail" button is clicked, a UI will show the manufacturer’s details (name and maximum discount), the summary information from the parent report, and lists for each of the manufacturer’s products’ its product ID, name, category (or categories), and price, ordered by price descending (high to low). If a product has multiple categories it must not show up as multiple rows on the report, but as a single row with multiple categories concatenated together.

![6](https://user-images.githubusercontent.com/50339450/168500225-027d5b98-0ece-4f95-8a90-9bf8918f16b8.png)




