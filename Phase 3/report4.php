<?php
//Written by dchen379

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<body>

    <div class="main_content">
    <div style="text-align:center">
<form action="#" method="post">
<select name="state">
   <option value="">--Choose a state--</option>
   <option value="AK">AK</option>
   <option value="AL">AL</option>
   <option value="AR">AR</option>
   <option value="AZ">AZ</option>
   <option value="CA">CA</option>
   <option value="CO">CO</option>
   <option value="CT">CT</option>
   <option value="DE">DE</option>
   <option value="FL">FL</option>
   <option value="GA">GA</option>
   <option value="HI">HI</option>
   <option value="IA">IA</option>
   <option value="ID">ID</option>
   <option value="IL">IL</option>
   <option value="IN">IN</option>
   <option value="KS">KS</option>
   <option value="KY">KY</option>
   <option value="LA">LA</option>
   <option value="MA">MA</option>
   <option value="MD">MD</option>
   <option value="ME">ME</option>
   <option value="MI">MI</option>
   <option value="MN">MN</option>
   <option value="MO">MO</option>
    <option value="MS">MS</option>
   <option value="MT">MT</option>
   <option value="NC">NC</option>
   <option value="ND">ND</option>
   <option value="NE">NE</option>
   <option value="NH">NH</option>
   <option value="NJ">NJ</option>
   <option value="NM">NM</option>
   <option value="NV">NV</option>
   <option value="NY">NY</option>
   <option value="OH">OH</option>
   <option value="OK">OK</option>
   <option value="OR">OR</option>
   <option value="PA">PA</option>
   <option value="RI">RI</option>
   <option value="SC">SC</option>
   <option value="SD">SD</option>
   <option value="TN">TN</option>
   <option value="TX">TX</option>
   <option value="UT">UT</option>
   <option value="VA">VA</option>
   <option value="VT">VT</option>
   <option value="WA">WA</option>
   <option value="WI">WI</option>
   <option value="WV">WV</option>
   <option value="WY">WY</option>
  
 </select>
 
 <input type="submit" name="submit" value="Submit" />
</form>
<?php
if(isset($_POST['submit'])){
$selected_state = $_POST['state'];  
echo "The state you have selected is :" .$selected_state; 
}
?>

 </div>
<div style="text-align:center">
  <div class="main_content">
        
	<div class="title"> Store Revenue</div>

	<table class="table">
  	  <tr>
	  <th>Year</th>
             <th>Store_number</th>
	     <th>Address</th>
             <th>City</th>
	    <th>Revenue</th>
         </tr>
	 

<?php 
  //retrive  store Revenue by year by store information
   
	 $query = "SELECT DISTINCT Year(Date) AS Year, Store_number,Address, City, CAST(SUM(sale) AS DECIMAL(10,2)) AS Revenue
FROM 
(SELECT Store.Store_number AS Store_number, Store.Address AS Address, Store.City_name AS City,Store.State AS State, Sold.Sold_date AS Date, Product.Retail_price*Sold_quantity AS sale
FROM SOLD INNER JOIN Product ON Sold.PID=Product.PID
INNER JOIN Store ON Sold.Store_number=Store.Store_number 
AND State='$selected_state'
WHERE (Sold.Sold_date, Sold.PID) IN 
(SELECT Sold_date,Sold.PID FROM Sold LEFT OUTER JOIN SalePrice
 ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date
 WHERE SalePrice.Sale_date IS NULL)
UNION
 (SELECT Store.Store_number AS Store_number, Store.Address AS Address, Store.City_name AS City,Store.State AS State, Sold.Sold_date AS Date, Sale_price*Sold_quantity AS sale 
FROM SOLD INNER JOIN SalePrice ON Sold.PID=SalePrice.PID AND Sold.Sold_date=SalePrice.Sale_date INNER JOIN Store 
ON Sold.Store_number=Store.Store_number AND Store.State='$selected_state'))AS day

 GROUP BY Store_number,Year,Address, City  
ORDER BY Year ASC, Revenue DESC";
   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	 
	  if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get store revenue Information <br>" . __FILE__ ." line:". __LINE__ );
        	print $error_msg;
    			}
	

	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Year']."</td>";
		print "<td>".$row['Store_number']."</td>";
		print "<td>".$row['Address']."</td>";
		print "<td>".$row['City']."</td>";
		print "<td>".$row['Revenue']."</td>";
		print ("</tr>");
         		}
	?> 


    </table>
 </div>

</body>

</html>