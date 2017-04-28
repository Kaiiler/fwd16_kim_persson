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
// retrieve the correct id from aeroplane and select the correct aeroplane info based on ID
$id = $_GET['id'];
$sql = "SELECT * FROM aeroplane WHERE aeroplaneID=:aeroplaneID"; 
$query = $pdo->prepare($sql); 
$query->execute(array(':aeroplaneID' => $id)); 
// loop trough DB info and put each row in to a variable
while($row = $query->fetch()) 
{ 
$aeroplanename = $row['aeroplaneName'];
$aeroplanetopspeed = $row['aeroplaneTopSpeed'];
$aeroplanerange = $row['aeroplaneRange'];
$planemakerid = $row['planeMakerID']; 
}
// prepares info retrieval from plane_maker
$planemakerSql = "SELECT * FROM plane_maker"; 
$planemakerQuery = $pdo->prepare($planemakerSql); 
$planemakerQuery->execute();


?> 
<?php 

// checks for empty fields and sends back error message if one is empty, else use info to edit db-info
if(isset($_POST['update'])) 
{ 
$id = $_POST['id']; 

$aeroplanename = $_POST['aeroplanename'];
$aeroplanetopspeed = $_POST['aeroplanetopspeed'];
$aeroplanerange = $_POST['aeroplanerange'];
$planemakerid = $_POST['planemakerid'];



if(empty($aeroplanename) || empty($planemakerid) || empty($aeroplanetopspeed) || empty($aeroplanerange)) {
                
        if(empty($aeroplanename)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($planemakerid)) {
            echo "<font color='red'>Maker field is empty.</font><br/>";
        }
        
        if(empty($aeroplanetopspeed)) {
            echo "<font color='red'>Topspeed field is empty.</font><br/>";
        }
        
        if(empty($aeroplanerange)) {
            echo "<font color='red'>Range field is empty.</font><br/>";
        }
} else { 
    
    // if all fields have valid values update database
$sql = "UPDATE aeroplane SET aeroplaneName=:aeroplaneName, aeroplaneTopSpeed =:aeroplaneTopSpeed, aeroplaneRange =:aeroplaneRange, planeMakerID =:planeMakerID WHERE aeroplaneID=:id";

$query = $pdo->prepare($sql); 

$query->bindparam(':aeroplaneName', $aeroplanename);
$query->bindparam(':aeroplaneTopSpeed', $aeroplanetopspeed);
$query->bindparam(':aeroplaneRange', $aeroplanerange);
$query->bindparam(':planeMakerID', $planemakerid);
$query->bindparam(':id', $id);
$query->execute(); 

header("Location: aeroplane.php"); 
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
<a href="aeroplane.php">Home</a> 
<br/><br/> 

<form name="form1" method="post" action="aeroplaneEdit.php"> 
<table border="0"> 
<tr> 
<td>Aeroplane Name</td> 
<td><input type="text" name="aeroplanename" value="<?php echo $aeroplanename;?>"/></td>
<td>Aeroplane Topspeed</td> 
<td><input type="text" name="aeroplanetopspeed" value="<?php echo $aeroplanetopspeed;?>"/></td>
<td>Aeroplane Range</td> 
<td><input type="text" name="aeroplanerange" value="<?php echo $aeroplanerange;?>"/></td>
</tr> 
<tr> 
<td>Plane Maker</td> 
<td>
 
<select name="planemakerid"> 
<?php 
//dropdown to select plane maker based on ID, only the name connected to the ID is displayed in the dropdown
while($planemaker = $planemakerQuery->fetch()) { 
if ($planemaker['planeMakerID'] == $planemakerid) { 

echo "<option value=\"{$planemaker['planeMakerID']}\" selected>{$planemaker['planeMakerName']}</option>"; 
} else { 

echo "<option value=\"{$planemaker['planeMakerID']}\">{$planemaker['planeMakerName']}</option>"; 
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
<a href="logout.php">Logout</a>
    </body>
</html>

