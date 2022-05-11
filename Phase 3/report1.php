<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> Manufacturer </div>

	<table class="table">
  	  <tr>
             <th>Manufacturer</th>
	     <th>Total Product</th>
             <th>Average Product Price</th>
             <th>Maximum Product Price</th>
             <th>Minimum Product Price</th>
	     <th>     </th>
         </tr>

<?php
  //retrive manufacturer information
   
	$query = "SELECT Manufacturer.Manuf_name AS Manufacturer, COUNT(PID) AS Total_Product, AVG(Retail_price) AS Average_retail_price, MAX(Retail_price) AS Max_price, MIN(Retail_price) AS Min_price FROM Manufacturer, Product WHERE Manufacturer.Manuf_name=Product.Manuf_name GROUP BY Manufacturer.Manuf_name ORDER BY AVG (Retail_price) DESC LIMIT 100";

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Manufacturet Information <br>" . __FILE__ ." line:". __LINE__ );
        	print $error_msg;
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Manufacturer']."</td>";
		print "<td>".$row['Total_Product']."</td>";
		print "<td>".round($row['Average_retail_price'],2)."</td>";
		print "<td>".$row['Max_price']."</td>";
		print "<td>".$row['Min_price']."</td>";
		print ("<td>");
		print ("<form action='view_manuf_detail.php' method='post'>");
		print ("<input type='hidden' name='manuf_name' value='".$row['Manufacturer']."'>"."\n");
		print ("<input type='submit' value='View Detail' name='view_detail'>");
		print ("</form>");
		print ("</td>");
		print "</tr>";
		
         		}


       	?>  


    </table>


</body>

</html>