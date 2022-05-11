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
          	$Year = $_POST['selectedyear'];
          	$Month = $_POST['selectedmonth'];
          	$Category = $_POST['category'];
          	$State = $_POST['thestate'];

	print ("<h3>Stores with Highest Sold Valumes:</h3>");
	print ("<h3>State: ".$State."</h3>");
	print ("<h3>Category: ".$Category."</h3>");
	print ("<h3>Peroid :".$Year.".".$Month."</h3><br>"); 

        print "<table class='table'>";
  	print "<tr>";
        print "<th>City</th>";
        print "<th>Store Number</th>";
        print "<th>Address</th>";
	print "<th>Manager First Name</th>";
	print "<th>Manager Last Name</th>";
	print "<th>Manager Email</th>";
	print "</tr>";

	$query = "
SELECT City_name, Store.Store_number, Address, first_name, last_name, Email  
FROM Store NATURAL JOIN City 
LEFT JOIN AssignedManager ON Store.Store_number=AssignedManager.Store_number 
NATURAL JOIN Manager
WHERE City.State='$State'
ORDER BY Store.Store_number";

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');

	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Failed to get Information <br>";}

	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['City_name']."</td>";
		print "<td>".$row['Store_number']."</td>";
		print "<td>".$row['Address']."</td>";
		print "<td>".$row['first_name']."</td>";
		print "<td>".$row['last_name']."</td>";
		print "<td>".$row['Email']."</td>";
		print "</tr>";
         		}

	print "</table>";


} //end of if POST


?>
<br><br>

         </div>
    </body>
</html>





