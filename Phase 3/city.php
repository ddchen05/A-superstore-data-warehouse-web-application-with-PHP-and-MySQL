<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<?php 

	//update input

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && $_POST['require_update']=='Update Population') {
          	
	 print ("<h2>Update City Population</h2>");
	 print ("<h3>City:".$_POST['city']."</h3>");
   	 print ("<h3>State:".$_POST['state']."</h3>");
	 print ("<form action='city.php' method='post'>");
	 print ("<input type='hidden' name='city_change' value='".$_POST['city']."'>"."\n");
	 print ("<input type='hidden' name='state_change' value='".$_POST['state']."'>"."\n");
         print ("<table>");
 	 print ("<tr>");
	 print ('<td class="item_label">New Population</td>');
	 print ("<td>");
	 print ("<input type='number' name='newpopulation'></td>");
	 print ("</tr>");
	 print ("<tr>");
	 print ("<td><input type='submit' value='Submit' name='change_population'></td>");
	 print ("</tr>");
	 print ("</table>");
         print ("</form>"); 

         } 

?>


<?php 

	//update input

//var_dump ($_POST);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && intval($_POST['newpopulation'])>=1) {

         	$Citywithchange = mysqli_real_escape_string($db, $_POST['city_change']);
		$Statewithchange = mysqli_real_escape_string($db, $_POST['state_change']);
		$newpopulation = intval($_POST['newpopulation']);

/*var_dump ($Citywithchange);
var_dump ($Statewithchange);
var_dump ($newpopulation);*/




    //insert new population to city
  
	  $query ="UPDATE City SET Population=('$newpopulation') WHERE City_name='$Citywithchange' AND State='$Statewithchange'";
			
	  $queryID = mysqli_query($db, $query); 

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to change population");
		} else {
	 	 print ("<h2>The population of ".$Citywithchange.",".$Statewithchange." has changed.</h2><br>");} 

           

        } //end of if $_POST



?>



<body>

    <div class="main_content">

 
	<div class="title"> City </div>

	<table class="table">
  	  <tr>
             <th>City</th>
             <th>State</th>
	     <th>Population</th>
	     <th>   </th>
          </tr>

<?php
  //retrive city information

	$query = "SELECT * FROM City";   

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get City <br>" . __FILE__ ." line:". __LINE__ );
        	print "Failed to get City information";
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['City_name']."</td>";
		print "<td>".$row['State']."</td>";
		print "<td>".$row['Population']."</td>";
		print ("<td>");
		print ("<form action='city.php' method='post'>");
		print ("<input type='hidden' name='city' value='".$row['City_name']."'>"."\n");
		print ("<input type='hidden' name='state' value='".$row['State']."'>"."\n");
		print ("<input type='submit' value='Update Population' name='require_update'>");
		print ("</form>");
		print ("</td>");
		print "</tr>";
         		}

// var_dump ($_POST);

       	?>  

     </table>	


<br>
<br>
<br>

  
  
</div>

</body>

</html>