<?php
// including the database connection file
include_once("config.php");
// Get the ID and then perform a delete on the correct row based on ID
$id = $_GET['id'];
 //deleting the row from table
$sql = "DELETE FROM aeroplane WHERE aeroplaneID=:aeroplaneID";
$query = $pdo->prepare($sql);
$query->execute(array(':aeroplaneID' => $id));
//redirecting to the display page
header("Location:aeroplane.php");

