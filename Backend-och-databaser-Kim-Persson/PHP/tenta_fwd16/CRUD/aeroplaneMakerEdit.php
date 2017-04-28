<?php 
// including the database connection file 
include_once("config.php");
// Create protection by confirming a logged in user is in, if not send user to index page
session_start();
            if(empty($_SESSION['email']))
            {
             header("location:index.php");
            }
            echo "Welcome ".$_SESSION['name'];
// retrieve the correct id from planemaker and select the correct planemaker info based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM plane_maker WHERE planeMakerID=:planeMakerID"; 
$query = $pdo->prepare($sql); 
$query->execute(array(':planeMakerID' => $id)); 
// loop trough DB info and put each row in to a variable
while($row = $query->fetch()) 
{ 
$aeroplanemakername = $row['cplaneMakerName'];
$planemakerid = $row['planeMakerID'];
}
// prepares info retrieval from plane_maker
$planemakerSql = "SELECT * FROM plane_maker"; 
$planemakerQuery = $pdo->prepare($planemakerSql); 
$planemakerQuery->execute();

?> 
<?php 

// checks for empty fields and sends back error message if one is empty, else use info to edit db-info
// if successful update info in DB
if(isset($_POST['update'])) 
{ 
$id = $_POST['id']; 

$aeroplanemakername = $_POST['aeroplanemakername'];

if(empty($aeroplanemakername)) { 
echo "<font color='red'>Name field is empty.</font><br/>"; 
} else { 
$sql = "UPDATE plane_maker SET planeMakerName =:planeMakerName WHERE planeMakerID=:planeMakerID";

$query = $pdo->prepare($sql); 

$query->bindparam(':planeMakerName', $aeroplanemakername);
$query->bindparam(':planeMakerID', $id);

$query->execute(); 

header("Location: aeroplaneMaker.php"); 
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
<a href="aeroplaneMaker.php">Home</a> 
<br/><br/> 

<form name="form1" method="post" action="aeroplaneMakerEdit.php"> 
<table border="0"> 
<tr> 
<td>Maker Name</td> 
<td><input type="text" name="aeroplanemakername" value="<?php echo $aeroplanemakername;?>"/></td>
</tr> 
<tr>  
<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?></td>
<td><input type="submit" name="update" value="Update"></td> 
</tr> 
</table> 
</form>
<a href="logout.php">Logout</a>
    </body>
</html>
