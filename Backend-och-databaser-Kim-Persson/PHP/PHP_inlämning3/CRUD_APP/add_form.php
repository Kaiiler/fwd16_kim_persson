<?php

include_once("config.php");

if(isset($_POST['Submit'])) {    
    $carname = $_POST['carname'];
    $ownerid = $_POST['ownerid'];
       
    if(empty($carname) || empty($ownerid)) {
                
        if(empty($carname)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($ownerid)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {        
        $sql = "INSERT INTO Cars(carName, owner_id) VALUES(:carName, :ownerid)";
        $query = $conn->prepare($sql);
                
        $query->bindparam(':carName', $carname);
        $query->bindparam(':ownerid', $ownerid);
        $query->execute();

        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}

$ownerSql = "SELECT * FROM Owner"; 
$ownerQuery = $conn->prepare($ownerSql); 
$ownerQuery->execute(); 
        
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Cars</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="index.php">Home</a>
    <br/><br/>

    <form action="add_form.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Car</td>             
                <td><td><textarea name="carname" rows="6" cols="40" ></textarea></td>
            </tr>
            
            <tr> 
<td>Owner</td> 
<td>

<!-- Vi skapar en dropdown som laddas med författare från databasen, så att inte
användare inte lägger till författare som inte existerar-->    
<select name="ownerid"> 
<?php

$ownerid="";
while($owner = $ownerQuery->fetch()) { 
if ($owner['owner_id'] == $ownerid) { 
echo "<option value=\"{$owner['owner_id']}\" selected>{$owner['firstName']}</option>"; 
} else { 
echo "<option value=\"{$owner['owner_id']}\">{$owner['firstName']} {$owner['lastName']}</option>"; 
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
    </body>
</html>

