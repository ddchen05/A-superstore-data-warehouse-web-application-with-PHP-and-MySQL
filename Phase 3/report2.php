<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> Category </div>

	<table class="table">
  	  <tr>
             <th>Category Name</th>
	     <th>Total Product</th>
             <th>Average Retail Price</th>
             <th>Total Manufacturer</th>
         </tr>

<?php
  //retrive category information
   
	$query = "SELECT Category.Category_name, COUNT(Product.PID) AS Total_product, COUNT(DISTINCT Product.Manuf_name) AS Total_manufacturer, AVG(Retail_price) AS Average_price FROM Product, Category, ProductCategory, Manufacturer WHERE Product.PID=ProductCategory.PID AND Category.Category_name=ProductCategory.Category_name AND Product.Manuf_name=Manufacturer.Manuf_name GROUP BY Category_name ORDER BY Category_name";

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Category Information <br>" . __FILE__ ." line:". __LINE__ );
        	print "Query ERROR: Failed to get Category Information <br>";
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Category_name']."</td>";
		print "<td>".$row['Total_product']."</td>";
		print "<td>".round($row['Average_price'],2)."</td>";
		print "<td>".$row['Total_manufacturer']."</td>";
		print "</tr>";

//var_dump ($row);
		
         		}


       	?>  


    </table>


</body>

</html>