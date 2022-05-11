<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {

          	$Newdate = mysqli_real_escape_string($db, $_POST['newdate']);
		$holiday = mysqli_real_escape_string($db, $_POST['holidayname']);

     //check if the input is empty

	$record_valid="True";

	if($Newdate==''){
		print ("<h2>You have to input a holiday date.</p><br>");
		    $record_valid="False";}
		
	if($holiday==''){
		print ("<h2>You have to input a holiday name.</p><br>");
		    $record_valid="False";}

     //check if the holiday already exist

	$query = "SELECT Holiday_date FROM Holiday";

    	$result = mysqli_query($db, $query);
    	include('lib/show_queries.php');


  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		if ($row['Holiday_date']==$Newdate) {
		    print ("<h2>This holiday already exists. Please add a new holiday.</h2><br>");
		    $record_valid="False";
		    break;}
 		}
// var_dump ($record_valid);

      //insert new holiday to Manager
   	if($record_valid=="True") {
		$query = "INSERT INTO Holiday (Holiday_date, Holiday_name) VALUES ('$Newdate', '$holiday')";
			
		$queryID = mysqli_query($db, $query);   

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to add holiday");
		} else {
	 	 print ("<h2>A new holiday record had been added.</h2><br>");} 

            } //end of while

        } //end of if $_POST

 ?>


<body>

    <div class="main_content">

 
	<div class="title"> Holiday </div>

	<table class="table">
  	  <tr>
             <th>Date</th>
             <th>Holiday</th>
          </tr>

<?php
  //retrive manager information

	$query = "SELECT * FROM Holiday";   

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Information <br>" . __FILE__ ." line:". __LINE__ );
        	print "Failed to get holiday information";
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Holiday_date']."</td>";
		print "<td>".$row['Holiday_name']."</td>";
		print "</tr>";
         		}

       	?>  

     </table>	


<br>
<br>
<br>


    <h2>Add New Holiday</h2>
            
         <form action="holiday.php" method="post">
                    
           <table>
 		<tr>
		   <td class="item_label">Date</td>
		   <td>
			<input type="date" name="newdate"/>   </td>
	 	<tr>
 		<tr>
		   <td class="item_label">Holiday Name</td>
		   <td>
			<input type="text" name="holidayname"/>   </td>
	 	<tr>
		<tr>
			<td><input type="submit" value="Submit"></td>
	 	<tr>
	    </table>
          </form>


</div>

</body>

</html>