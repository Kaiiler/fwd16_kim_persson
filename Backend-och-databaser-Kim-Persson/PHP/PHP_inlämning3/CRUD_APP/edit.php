<?php 
// including the database connection file 
include_once("config.php");

$id = $_GET['id'];
$sql = "SELECT * FROM Cars WHERE car_id=:car_id"; 
$query = $conn->prepare($sql); 
$query->execute(array(':car_id' => $id)); 

while($row = $query->fetch()) 
{ 
$carname = $row['carName']; 
$ownerid = $row['owner_id']; 
}

$ownerSql = "SELECT * FROM Owner"; 
$ownerQuery = $conn->prepare($ownerSql); 
$ownerQuery->execute();


?> 
<?php 


if(isset($_POST['update'])) 
{ 
$id = $_POST['id']; 

$carname=$_POST['carName']; 
$ownerid=$_POST['ownerid']; 



if(empty($carname)) { 
echo "<font color='red'>Car Name field is empty.</font><br/>"; 
} else { 
$sql = "UPDATE Cars SET carName=:carName, owner_id=:owner_id WHERE car_id=:car_id";

$query = $conn->prepare($sql); 

$query->bindparam(':car_id', $id); 
$query->bindparam(':carName', $carname); 
$query->bindparam(':owner_id', $ownerid);

$query->execute(); 

header("Location: index.php"); 
} 
}  
?> 
<!DOCTYPE html> 

<html> 
<head> 
<meta charset="UTF-8"> 
<title></title> 
</head> 
<body> 
<a href="index.php">Home</a> 
<br/><br/> 

<form name="form1" method="post" action="edit.php"> 
<table border="0"> 
<tr> 
<td>Car</td> 

<td><textarea name="carName" rows="6" cols="40" ><?php echo $carname;?></textarea></td>
</tr> 
<tr> 
<td>Author</td> 
<td>
 
<select name="ownerid"> 
<?php 
while($owner = $ownerQuery->fetch()) { 
if ($owner['owner_id'] == $ownerid) { 

echo "<option value=\"{$owner['owner_id']}\" selected>{$owner['firstName']}</option>"; 
} else { 

echo "<option value=\"{$owner['owner_id']}\">{$owner['firstName']}</option>"; 
} 
} 
?> 
</select> 
</td> 
</tr> 

<tr>  
<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?></td> 
<td><input type="submit" name="update" value="Update"></td> 
</tr> 
</table> 
</form>
    </body>
</html>

