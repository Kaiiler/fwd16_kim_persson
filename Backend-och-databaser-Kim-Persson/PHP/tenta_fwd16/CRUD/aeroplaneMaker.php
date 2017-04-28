<!DOCTYPE html>
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
            // call stored procedure to display DB rows
        $result = $pdo->query("call sp_planemakers");
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aeroplanes</title>
    </head>
    <body>
        
        <a href="aeroplaneMakerAdd.php">Add Maker</a><br/><br/>
        <a href="aeroplane.php">Aeroplanes</a><br/><br/>
 
    <table width='100%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>Maker Name</td>
        <td>Maker ID</td>
        <td>Update</td>
    </tr>
    <?php 
    // loop trough sp and put the table rows in to html documents
    while($row = $result->fetch()) {         
        echo "<tr>";
        echo "<td>".$row['planeMakerName']."</td>";
        echo "<td>".$row['planeMakerID']."</td>";
        echo "<td><a href=\"aeroplaneMakerEdit.php?id=$row[planeMakerID]\">Edit</a> | <a href=\"aeroplaneMakerDelete.php?id=$row[planeMakerID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
    }
    ?>
    <a href="logout.php">Logout</a>
    </table>
    </body>
</html>

