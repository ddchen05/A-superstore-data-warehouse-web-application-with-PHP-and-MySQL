<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>


<body>

    <div class="main_content">
        
	<div class="title"> State with Highest Volume for Each Category </div>

	  <h2>Please Select Year and Month</h2>

         <form action="report6.php" method="post" style="margin-left:50px">
	 <select name="selectyear">
<?php
  	$query = "SELECT DISTINCT year(Sold_date) AS year FROM Sold ORDER BY year";
   	$result = mysqli_query($db, $query);
    	include('lib/show_queries.php');
	
	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	   $selectyear = mysqli_real_escape_string($db, $row['year']);
	   print ("<option value='".$selectyear."'>".$selectyear."</option>");}
?>
	</select>

	 <select name="selectmonth">
<?php
  	$query = "SELECT DISTINCT month(Sold_date) AS month FROM Sold ORDER BY month";
   	$result = mysqli_query($db, $query);
    	include('lib/show_queries.php');
	
	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	   $selectmonth = mysqli_real_escape_string($db, $row['month']);
	   print ("<option value='".$selectmonth."'>".$selectmonth."</option>");}
?>
	</select>
	<input type="submit" value="Submit">
	</form>
<br><br>


<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
          	$MONTH = $_POST['selectmonth'];
		$YEAR = $_POST['selectyear'];
	
	print ("<h3>Highest Sale Volume for ".$YEAR.".".$MONTH."</h3>");

	print ("<table class='table'>");
  	print ("<tr>");
        print ("<th>Category</th>");
	print ("<th>State</th>");
        print ("<th>Highest Sold Volume</th>");
	print ("<th>  </th>");
        print ("</tr>");

//var_dump ($MONTH);
//var_dump ($YEAR);

      $query = "
SELECT c1.Category_name, c1.State, c1.total AS Highest_volumn
FROM 
(SELECT Category_name, State, SUM(Sold_quantity) AS total
FROM Sold 
INNER JOIN ProductCategory ON Sold.PID=ProductCategory.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
WHERE year(Sold.Sold_date)='$YEAR' AND month(Sold.Sold_date)='$MONTH'
GROUP BY Category_name, State) AS c1 INNER JOIN 
(SELECT Category_name, MAX(totalsold) AS Highest
FROM
(SELECT Category_name, State, SUM(Sold_quantity) AS totalsold
FROM Sold 
INNER JOIN ProductCategory ON Sold.PID=ProductCategory.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number
WHERE year(Sold.Sold_date)='$YEAR' AND month(Sold.Sold_date)='$MONTH'
GROUP BY Category_name, State) AS c2
GROUP BY Category_name) AS c3 ON c1.Category_name=c3.Category_name AND c1.total=c3.Highest"; 

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');

	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        print "Failed to get Information <br>";}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Category_name']."</td>";
		print "<td>".$row['State']."</td>";
		print "<td>".$row['Highest_volumn']."</td>";
		print ("<td>");
		print ("<form action='report6_detail.php' method='post' target='_blank'>");
		print ("<input type='hidden' name='selectedmonth' value='".$MONTH."'>"."\n");
		print ("<input type='hidden' name='selectedyear' value='".$YEAR."'>"."\n");
		print ("<input type='hidden' name='category' value='".$row['Category_name']."'>"."\n");
		print ("<input type='hidden' name='thestate' value='".$row['State']."'>"."\n");
		print ("<input type='submit' value='View Stores' name='view_Stores'>");
		print ("</form>");
		print ("</td>");
		print "</tr>";
			}

	print ("</table><br>");



} //end of if $_post


?>

         </div>
    </body>
</html>



