<?php
//Written by sli710 and dchen379

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> Revenue By Population </div>

	<table class="table">
  	  <tr>
             <th>Year</th>
	     <th>Small_City_Revenue</th>
             <th>Medium_City_Revenue</th>
             <th>Large_City_Revenue</th>
             <th>ExtraLarge_City_Revenue</th>
         </tr>

<?php
    	
	$query = "
SELECT *
FROM
(SELECT year(Sold_date) AS Year, SUM(Sold_value)  AS SM_Rev
FROM
(SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Retail_price) AS Sold_value 
FROM Sold
LEFT JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population<3700000 AND SalePrice.Sale_price IS NULL
UNION
SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Sale_price) AS Sold_value 
FROM Sold
INNER JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population<3700000) AS c1
GROUP BY Year) AS b1 
NATURAL JOIN
(SELECT year(Sold_date) AS Year, SUM(Sold_value) AS MED_Rev
FROM
(SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Retail_price) AS Sold_value 
FROM Sold
LEFT JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population >=3700000 AND  Population<6700000 AND SalePrice.Sale_price IS NULL
UNION
SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Sale_price) AS Sold_value 
FROM Sold
INNER JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population >=3700000 AND  Population<6700000) AS c2
GROUP BY Year) AS b2 
NATURAL JOIN
(SELECT year(Sold_date) AS Year, SUM(Sold_value) AS LAR_Rev
FROM
(SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Retail_price) AS Sold_value 
FROM Sold
LEFT JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population>=6700000 AND Population<9000000 AND SalePrice.Sale_price IS NULL
UNION
SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Sale_price) AS Sold_value 
FROM Sold
INNER JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population>=6700000 AND Population<9000000) AS c3
GROUP BY Year) AS b3  
NATURAL JOIN
(SELECT year(Sold_date) AS Year, SUM(Sold_value) AS EXTRAL_Rev
FROM
(SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Retail_price) AS Sold_value 
FROM Sold
LEFT JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population>=9000000 AND SalePrice.Sale_price IS NULL
UNION
SELECT Sold.PID, Sold.Store_number, City.City_name, City.State, Sold.Sold_Date, (Sold_quantity*Sale_price) AS Sold_value 
FROM Sold
INNER JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
INNER JOIN CIty ON Store.City_name=City.City_name AND Store.State=City.State
WHERE Population>=9000000) AS c4
GROUP BY Year) AS b4";

	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Query ERROR: Failed to get report Information <br>" ;}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Year']."</td>";
		print "<td>".number_format($row['SM_Rev'],2)."</td>";
                print "<td>".number_format($row['MED_Rev'],2)."</td>";
                print "<td>".number_format($row['LAR_Rev'],2)."</td>";
		 print "<td>".number_format($row['EXTRAL_Rev'],2)."</td>";
		print "</tr>";}

       	?>  


    </table>


</body>

</html>



