<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> Air Conditioner Sold on Groundhog Day </div>

	<table class="table">
  	  <tr>
             <th>Year</th>
	     <th>Total Sold Number</th>
             <th>Average Sold Number</th>
             <th>Sold Number on Groundhog Day</th>
         </tr>

<?php
	$query = "
SELECT s1.Year, Total_number, Average_number, SoldGD 
FROM
(SELECT year(Sold.Sold_date) AS Year, SUM(Sold_quantity) AS Total_number, SUM(Sold_quantity)/365 AS Average_number
FROM Sold INNER JOIN ProductCategory ON Sold.PID=ProductCategory.PID
WHERE ProductCategory.Category_name='Air Conditioner'
GROUP BY Year) AS s1
INNER JOIN
(SELECT year(Sold.Sold_date) AS Year, SUM(Sold_quantity) AS SoldGD 
FROM Sold INNER JOIN ProductCategory ON Sold.PID=ProductCategory.PID
WHERE ProductCategory.Category_name='Air Conditioner' AND month(Sold_date)='02' AND day(Sold_date)='02'
GROUP BY Year) AS s2 ON s1.Year=s2.Year";

	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Query ERROR: Failed to get Information <br>";
    			}
	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Year']."</td>";
		print "<td>".$row['Total_number']."</td>";
		print "<td>".round($row['Average_number'],0)."</td>";
		print "<td>".$row['SoldGD']."</td>";
		print "</tr>";

//var_dump ($row);
		
         		}
?>  


    </table>


</body>

</html>




