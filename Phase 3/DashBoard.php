<?php
//Written by sli710

 include('lib/common.php');


 //retrive total store number
   $query = "SELECT COUNT(Store_number) AS Total_Store FROM Store";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');

    if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        array_push($error_msg,  "Query ERROR: Failed to get User profile...<br>" . __FILE__ ." line:". __LINE__ );
    }

    $StoreCount=$row['Total_Store'];

 //retrive total manufacture number
   $query = "SELECT COUNT(Manuf_name) AS Total_Manuf FROM Manufacturer";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');

    if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        array_push($error_msg,  "Query ERROR: Failed to get User profile...<br>" . __FILE__ ." line:". __LINE__ );
    }

    $ManufactureCount=$row['Total_Manuf'];


 //retrive total product number
   $query = "SELECT COUNT(PID) AS Total_Product FROM Product";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');

    if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        array_push($error_msg,  "Query ERROR: Failed to get User profile...<br>" . __FILE__ ." line:". __LINE__ );
    }

    $ProductCount=$row['Total_Product'];

 //retrive total manager number
   $query = "SELECT COUNT(Email) AS Total_Manager FROM Manager";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');

    if ( !is_bool($result) && (mysqli_num_rows($result) > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else {
        array_push($error_msg,  "Query ERROR: Failed to get User profile...<br>" . __FILE__ ." line:". __LINE__ );
    }

    $ManagerCount=$row['Total_Manager'];


/*  $StoreCount=5;     
    $ManufactureCount=20;
    $ProductCount=100;
    $ManagerCount=5;   */



?>  


<?php
 include("lib/header.php");
?> 


<body>

    <?php include("lib/menu.php"); ?>

    <div class="main_content">
        
	<div class="title"> Statistics Imformaton Summary </div>


	<table class="table">
  	  <tr>
             <th>Total Stores</th>
             <th>Total Manufacturers</th> 
             <th>Total Products</th>
	     <th>Total Managers</th>
           </tr>
         <tr>
           <td><?php print $StoreCount; ?></td>
           <td><?php print $ManufactureCount; ?></td> 
           <td><?php print $ProductCount; ?></td>
 	   <td><?php print $ManagerCount; ?></td>
         </tr>
  
         </table>

<!-- 
  <div> <?php var_dump($row); ?> </div>
-->

            </div>          


</body>

</html>