<?php
//Written by hxu392

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> Actual versus Predicted Revenue for GPS units </div>

	<table class="table">
  	  <tr>
             <th>PID</th>
             <th>Product Name</th>
             <th>Retail Price</th>
             <th>Total Sold</th>
             <th>Total Sale Sold</th>
             <th>Total Retail Sold</th>
             <th>Actual Revenue</th>
             <th>Predicted Revenue</th>
             <th>Difference</th>
	   
         </tr>

<?php
  //retrive manufacturer information
   
	$query = "SELECT gpsretail.PID AS PID, gpsretail.pname AS ProductName, gpssale.Retail_price AS RetailPrice, (gpsretail.TotalRetailQuantity + gpssale.TotalSaleQuantity) AS TotalSoldQuantity, gpssale.TotalSaleQuantity AS TotalSaleQuantity, gpsretail.TotalRetailQuantity AS TotalRetailQuantity, (gpsretail.TotalRetailRevenue + gpssale.TotalSaleRevenue) AS TotalRevenue,  (gpsretail.TotalRetailRevenue + gpssale.TotalPredictRevenue) AS TotalPredictRevenue, gpssale.RevenueDifference AS Difference
    FROM (SELECT PID, pname, Retail_price, SUM(Sold_quantity) AS TotalRetailQuantity, Retail_price * SUM(Sold_quantity) AS TotalRetailRevenue
    FROM
    (SELECT DISTINCT sold.PID, product.pname, product.Retail_price, sold.Sold_quantity, sold.Sold_date
    FROM sold NATURAL JOIN saleprice NATURAL JOIN product NATURAL JOIN productcategory
    WHERE sold.Sold_date NOT IN
    (SELECT saleprice.Sale_date FROM saleprice WHERE sold.PID = saleprice.PID)
    AND productcategory.Category_name='GPS'
    ) AS g
    GROUP BY g.PID) AS gpsretail, 
    (SELECT saleprice.PID, product.pname, SUM(saleprice.Sale_price*sold.Sold_quantity) AS TotalSaleRevenue, SUM(sold.Sold_quantity) AS TotalSaleQuantity, product.Retail_price, SUM(product.Retail_price*sold.Sold_quantity*0.75) AS TotalPredictRevenue, SUM(sold.sold_quantity*0.75) AS TotalPredictQuantity, SUM(saleprice.Sale_price*sold.Sold_quantity)- SUM(product.Retail_price*sold.Sold_quantity*0.75) AS RevenueDifference
    FROM productcategory, product, sold, saleprice
    WHERE productcategory.PID=product.PID AND product.PID=sold.PID AND sold.PID=saleprice.PID AND productcategory.Category_name='GPS' AND saleprice.Sale_date=sold.Sold_date
    GROUP BY saleprice.PID) AS gpssale
    WHERE gpsretail.PID= gpssale.PID AND ABS(gpssale.RevenueDifference) > 5000
    ORDER BY gpssale.RevenueDifference DESC";

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get GPS Information <br>" . __FILE__ ." line:". __LINE__ );
        	print $error_msg;
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['PID']."</td>";
		print "<td>".$row['ProductName']."</td>";
		print "<td>".$row['RetailPrice']."</td>";
		print "<td>".$row['TotalSoldQuantity']."</td>";
		print "<td>".$row['TotalSaleQuantity']."</td>";
        print "<td>".$row['TotalRetailQuantity']."</td>";
        print "<td>".number_format($row['TotalRevenue'],2)."</td>";
        print "<td>".number_format($row['TotalPredictRevenue'],2)."</td>";
        print "<td>".number_format($row['Difference'],2)."</td>";
		print "</tr>";
		
         		}


       	?>  


    </table>


</body>

</html>