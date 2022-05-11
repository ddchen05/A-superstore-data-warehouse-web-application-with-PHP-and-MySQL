<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<body>

    <div class="main_content">

<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
          	$manufacturer = $_POST['manuf_name'];} 

	$query = "SELECT Max_discount From Manufacturer WHERE Manuf_name='$manufacturer'";	

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');

	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Failed to get manufacturer Information <br>";}

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	print ("<h1>".$manufacturer."</h1>");
	print ("<h3>Max Discount: ".$row['Max_discount']."</h3>");

	$query = "SELECT COUNT(PID) AS Total_Product, AVG(Retail_price) AS Average_retail_price, MAX(Retail_price) AS Max_price, MIN(Retail_price) AS Min_price FROM Product WHERE Manuf_name='$manufacturer'";	

	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');

	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Failed to get product Information <br>";}

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	print ("<h3>Total Product: ".$row['Total_Product']."</h3>");
	print ("<h3>Average Price: ".round($row['Average_retail_price'],2)."</h3>");
	print ("<h3>Maximum Price: ".round($row['Max_price'],2)."</h3>");
	print ("<h3>Minimum Price: ".round($row['Min_price'],2)."</h3>");

	print ("<h3>Product</h3>");

        print "<table class='table'>";
  	print "<tr>";
        print "<th>Product ID</th>";
        print "<th>Product Name</th>";
        print "<th>Retail Price</th>";
	print "<th>Category</th>";
	print "</tr>";

	$query = "SELECT * From Product WHERE Manuf_name='$manufacturer'";	

	$result = mysqli_query($db, $query);
    	include('lib/show_queries.php');

	if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Failed to get product Information <br>";}

	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['PID']."</td>";
		print "<td>".$row['pname']."</td>";
		print "<td>".$row['Retail_price']."</td>";
		print "<td>";
			$product=$row['PID'];
			$query = "SELECT * From ProductCategory WHERE PID='$product'";
			$category_result = mysqli_query($db, $query);
  			While ($category_row = mysqli_fetch_array($category_result, MYSQLI_ASSOC)){
		 		print ($category_row['Category_name'].",     ");}
		print "</td>";

		print "</tr>";
         		}

	print "</table>";

?>


</div>

</body>
</html>