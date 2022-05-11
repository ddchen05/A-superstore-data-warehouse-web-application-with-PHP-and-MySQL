<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");



	//delete manager

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST) && $_POST['delete']=='Delete') {

// var_dump ($_POST);

      	  $Manageremail = mysqli_real_escape_string($db, $_POST['managerTodelete']);

	//check if has assigned stores
	  $query = "SELECT * FROM AssignedManager WHERE Email='$Manageremail'";
	  $result = mysqli_query($db, $query); 

            include('lib/show_queries.php');
          if ($result  == False) {
                 echo ("fail to get manager information");} 

$a=mysqli_num_rows($result);			 
var_dump ($a);

	  if (mysqli_num_rows($result) !== 0) {
		print "The manager ".$Manageremail." should be unassigned all stores before Delete";
		} else {
		  $query ="DELETE FROM Manager WHERE Email='$Manageremail'";
		  $queryID = mysqli_query($db, $query); 
	          include('lib/show_queries.php');
 	         if ($queryID  == False) {
  	              echo ("fail to delete manager ".$Manageremail."/n");} else {
			print ("Manager ".$Manageremail." has been deleted.");}
			}
  
        } //end of if $_POST

?>


<body>

    <div class="main_content">
        
	<div class="title"> Manager </div>

	<table class="table">
  	  <tr>
             <th>First Name</th>
             <th>Last Name</th>
             <th>Email</th>
             <th>If_active</th>
	     <th>Assigned Store</th>
	     <th>    </th>
	     <th>    </th>   
           </tr>

<?php
  //retrive manager information
   
    	$query = "SELECT * FROM Manager";   

/*	$query = "SELECT first_name, last_name, Manager.Email, If_active, Store_number FROM Manager LEFT OUTER JOIN AssignedManager ON Manager.Email=AssignedManager.Email ORDER By Manager.Email"; */

   	 $result = mysqli_query($db, $query);
    	 include('lib/show_queries.php');
	
	 if (is_bool($result) && (mysqli_num_rows($result) == 0) ) {
	        array_push($error_msg, "Query ERROR: Failed to get Manager Information <br>" . __FILE__ ." line:". __LINE__ );
        	print "Failed to get manager information.";
    			}

  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		print "<tr>";
		print "<td>".$row['first_name']."</td>";
		print "<td>".$row['last_name']."</td>";
		print "<td>".$row['Email']."</td>";
		print "<td>".$row['If_active']."</td>";
		print "<td>";
			$manager_email=$row['Email'];
			$query = "SELECT * From AssignedManager WHERE AssignedManager.Email='$manager_email'";
			$assignedstore_result = mysqli_query($db, $query);
            $rowcount = mysqli_num_rows($assignedstore_result);
  			While ($assigned_row = mysqli_fetch_array($assignedstore_result, MYSQLI_ASSOC)){
		 		$rowcount -= 1;
                if ($rowcount == 0){
                    print ($assigned_row['Store_number']);
                }
                else {
                    print ($assigned_row['Store_number'].",    ");
                }
                }
		print "</td>";
		print ("<td>");
		print ("<form action='update_manager.php' method='post'>");
		print ("<input type='hidden' name='managerToAssign' value='".$row['Email']."'>"."\n");
		print ("<input type='submit' value='Update' name='change_assign'>");
		print ("</form>");
		print ("</td>");
		print ("<td>");
		print ("<form action='manager.php' method='post'>");
		print ("<input type='hidden' name='managerTodelete' value='".$row['Email']."'>"."\n");
		print ("<input type='submit' value='Delete' name='delete'>");
		print ("</form>");
		print ("</td>");
		print "</tr>";
         		}


       	?>  


    </table>

	<div>
	    <table style="width:50%; margin-top:40px; font-size:16px">
	 	<tr>
             	  <th><a class="fancy_button" href="add_manager.php">Add Manager</a></th>
                </tr>

           </div>          



</body>

</html>