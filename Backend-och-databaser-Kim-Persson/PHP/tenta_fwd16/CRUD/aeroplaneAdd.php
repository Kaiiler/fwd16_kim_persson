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


// When submit button is pressed retrieve values from html fields, if empty send error msg
if(isset($_POST['Submit'])) {    
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
        // if the info is retrieved successfully put info into DB table
        $sql = "INSERT INTO aeroplane(aeroplaneName, aeroplaneTopSpeed, aeroplaneRange, planeMakerID) VALUES(:aeroplaneName, :aeroplaneTopSpeed, :aeroplaneRange, :planeMakerID)";
        $query = $pdo->prepare($sql);
                
        $query->bindparam(':aeroplaneName', $aeroplanename);
        $query->bindparam(':aeroplaneTopSpeed', $aeroplanetopspeed);
        $query->bindparam(':aeroplaneRange', $aeroplanerange);
        $query->bindparam(':planeMakerID', $planemakerid);
        $query->execute();


        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='aeroplane.php'>View Result</a>";
    }
}
// prepare the retrieval of plane_maker info
$planemakerSql = "SELECT * FROM plane_maker"; 
$planemakerQuery = $pdo->prepare($planemakerSql); 
$planemakerQuery->execute(); 
        
?>
<!DOCTYPE html>

<html>
    <head>
        <title>aeroplanes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="aeroplane.php">Home</a>
    <br/><br/>

    <form action="aeroplaneAdd.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Aeroplane Name</td>             
                <td><td><input type="text" name="aeroplanename"  /></td>
                <td>Topspeed</td>             
                <td><td><input type="text" name="aeroplanetopspeed" /></td>
                <td>Range</td>             
                <td><td><input type="text" name="aeroplanerange" /></td>
            </tr>
            
            <tr> 
<td>Maker</td> 
<td>
    
<select name="planemakerid"> 
<?php
// dropdown to retrieve plane_makers info regarding ID and Name
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
        <td></td>
            <td><input type="submit" name="Submit" value="Add"></td>
            </tr>
        </table>
    </form>
    <a href="logout.php">Logout</a>
    </body>
</html>


