<?php
//including the database connection file
include_once("config.php");
 
// Get the ID from url and then perform a delete on the correct row based on ID
$id = $_GET['id'];
 
//deleting the row from table
$sql = "DELETE FROM plane_maker WHERE planeMakerID=:planeMakerID";
$query = $pdo->prepare($sql);
$query->execute(array(':planeMakerID' => $id));
 
//redirecting to the display page
header("Location:aeroplaneMaker.php");

