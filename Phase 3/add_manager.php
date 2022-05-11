<?php
//Written by sli710

 include('lib/common.php');

 include("lib/header.php");

 include("lib/menu.php");

?>

<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST)) {
          	$Email = mysqli_real_escape_string($db, $_POST['manageremail']);
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$if_active = mysqli_real_escape_string($db, $_POST['if_active']);
		$assigned_store = mysqli_real_escape_string($db, $_POST['assigned_store']); 

//var_dump ($_POST);

	$record_valid="True";

	if (empty($Email)){
		print ("<p>You have to input the Email</p>");
		$record_valid="False";} 
	
	if ($first_name==''){
		print ("<p>You have to input the First Name</p>");
		$record_valid="False";}
	
	if ($last_name==''){
		print ("<p>You have to input the Last Name</p>");
		$record_valid="False";}
	
		
      //check if the manager already exist

	$query = "SELECT Email FROM Manager";

    	$result = mysqli_query($db, $query);
    	include('lib/show_queries.php');


  	While ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		if ($row['Email']==$Email) {
		    print ("<h3>This manager already exists. Please add a new manager.</h3><br>");
		    $record_valid="False";}
 		}

    //insert new record to Manager
   	if($record_valid=="True") {
		$query = "INSERT INTO Manager (Email, first_name, last_name, If_active) VALUES ('$Email', '$first_name', '$last_name', '$if_active')";
			
		$queryID = mysqli_query($db, $query);    

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to add namager");} else {
		print ("<h1>A new manager ".$Email." had been added.</h1><br>"); }

	//insert new record into AssignedManager
	 if (intval($assigned_store)<=1000 || intval($assigned_store)>=1){

		$query = "INSERT INTO AssignedManager (Store_number, Email) VALUES ('$assigned_store', '$Email')";
			
		$queryID = mysqli_query($db, $query);   //assiged store has to be exist in Store, maybe add dropdown later.

            include('lib/show_queries.php');
         if ($queryID  == False) {
                 echo ("fail to add assigned store");}
		}
		
            } //end of if record_value=true   

        } //end of if $_POST

 ?>

<body>

    <div class="main_content">
        
	<div class="title"> Add Manager </div>

            
         <form action="add_manager.php" method="post">
                    
           <table>
 		<tr>
		   <td class="item_label">Email</td>
		   <td>
			<input type="email" name="manageremail"/>   </td>
	 	<tr>
 		<tr>
		   <td class="item_label">First Name</td>
		   <td>
			<input type="text" name="first_name"/>   </td>
	 	<tr>
 		<tr>
		   <td class="item_label">Last Name</td>
		   <td>
			<input type="text" name="last_name"/>   </td>
	 	<tr>
 		<tr>
		   <td class="item_label">If Active</td>
		   <td>
			<select name="if_active"> 
			<option value="Yes" check="checked">Yes</option>
			<option value="No">No</option>
			</select>
		  </td>
	 	<tr>
 		<tr>
		   <td class="item_label">Assigned Store</td>
		   <td>
			<input type="number" name="assigned_store"/>   </td>
	 	<tr>
		
		<tr>
			<td><input type="submit" value="Submit"></td>
	 	<tr>
                    </form>

        <!--        <?php include("lib/error.php"); ?>   -->

         </div>
    </body>
</html>


