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
// if successful put info into DB with INSERT
if(isset($_POST['Submit'])) {    
    $planemakername = $_POST['planemakername'];
       
    if(empty($planemakername)){
            echo "<font color='red'>Name field is empty.</font><br/>";
        } else {        
        $sql = "INSERT INTO plane_maker(planeMakerName) VALUES(:planeMakerName)";
        $query = $pdo->prepare($sql);
                
        $query->bindparam(':planeMakerName', $planemakername);
        $query->execute();


        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='aeroplaneMaker.php'>View Result</a>";
    }
}       
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Categories</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <a href="aeroplaneMaker.php">Home</a>
    <br/><br/>

    <form action="aeroplaneMakerAdd.php" method="post" name="form1">
        <table width="25%" border="0">
            <tr> 
                <td>Maker Name</td>             
                <td><td><input type="text" name="planemakername" /></td>
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

