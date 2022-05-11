<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<body>

    <div class="main_content">
        
	<div class="title"> Update Manager Information </div>


<?php 
	//delete assigned store

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && $_POST['unassign']=='unassign') {

//var_dump ($_POST);

      	  $Manageremail = mysqli_real_escape_string($db, $_POST['Email']);
	  $unassignedStore= intval($_POST['unassignStore']);

	  $query ="DELETE FROM AssignedManager WHERE Email='$Manageremail' AND Store_number='$unassignedStore'";
			
	  $queryID = mysqli_query($db, $query); 

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to delete store");} 
  
        } //end of if $_POST



	//add assigned store

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && $_POST['newassign']=='submit') {

//var_dump ($_POST);

       	  $Manageremail = mysqli_real_escape_string($db, $_POST['Email']);
	  $newassignedstore = mysqli_real_escape_string($db, $_POST['assignedstore']);

	  $query ="INSERT INTO AssignedManager VALUES ('$newassignedstore', '$Manageremail')";
			
	  $queryID = mysqli_query($db, $query); 

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to add store");}
  
        } //end of if $_POST





    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && $_POST['change_assign']=='Update') {
		$Manageremail = mysqli_real_escape_string($db, $_POST['managerToAssign']);}
         
	//request change assign

//var_dump ($Manageremail);

	$query ="SELECT * FROM Manager Where Email='$Manageremail'";

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Manager Information <br>" . __FILE__ ." line:". __LINE__ );
        	print "Failed to get manager information.";
    			}
	 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	 $Manager_L=mysqli_real_escape_string($db, $row['last_name']);
	 $Manager_F=mysqli_real_escape_string($db, $row['first_name']);
	 $email=mysqli_real_escape_string($db, $row['Email']);
	 $Status=mysqli_real_escape_string($db, $row['If_active']);


	 print ("<h2>First Name:   ".$Manager_F."</h2>");
	 print ("<h2>Last Name:   ".$Manager_L."</h2>");
	 print ("<h2>Email:   ".$email."</h2>");

	 print ("<h2>Assigned Stores:</h2>");
	 
	$query = "SELECT * FROM AssignedManager WHERE Email='$email'";   

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Information <br>" . __FILE__ ." line:". __LINE__ );
        	print "Failed to get manager information";
    			}
	print ("<table style='font-size:18px; margin-left:50px'>");
  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['Store_number']."</td>";
		print ("<td>");
		print ("<form action='update_manager.php' method='post'>");
		print ("<input type='hidden' name='Email' value='".$row['Email']."'>"."\n");
		print ("<input type='hidden' name='unassignStore' value='".$row['Store_number']."'>"."\n");
		print ("<input type='submit' value='unassign' name='unassign'>");
		print ("</form>");
                print ("</td>");
	     	print ("</tr>"); }
		print ("</table>");
	
	print ("<h2>Assign New Store:</h2>");
	print ("<form action='update_manager.php' method='post' style='font-size:18px; margin-left:50px'>");
	print ("<input type='hidden' name='Email' value='".$email."'>"."\n");
	print ("<input type='number' name='assignedstore'>"."\n");
	print ("<input type='submit' value='submit' name='newassign'>");
	print ("</form>");


   

?>



</body>

</html>


