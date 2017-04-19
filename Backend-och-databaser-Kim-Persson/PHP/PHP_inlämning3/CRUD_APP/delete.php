<?php
//including the database connection file
include_once("config.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$sql = "DELETE FROM Cars WHERE car_id=:car_id";
$query = $conn->prepare($sql);
$query->execute(array(':car_id' => $id));
 
//redirecting to the display page (index.php in our case)
header("Location:index.php");
