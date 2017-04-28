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
        // call stored procedure to retrieve joined tables
        $result = $pdo->query("call sp_aeroplane");
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aeroplanes</title>
    </head>
    <body>
        
        <a href="aeroplaneAdd.php">Add Aeroplane</a><br/><br/>
        <a href="aeroplaneMaker.php">Makers</a><br/><br/>
 
    <table width='100%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>Plane Name</td>
        <td>Aeroplane Topspeed (KM/h)</td>
        <td>Aeroplane Range (M)</td>
        <td>Plane Maker</td>
        <td>Update</td>
    </tr>
    <?php  
    // Loop trough sp to retrieve info and put in html elements
    while($row = $result->fetch()) {         
        echo "<tr>";
        echo "<td>".$row['aeroplaneName']."</td>";
        echo "<td>".$row['aeroplaneTopSpeed']."</td>";
        echo "<td>".$row['aeroplaneRange']."</td>";
        echo "<td>".$row['planeMakerName']."</td>";
        echo "<td><a href=\"aeroplaneEdit.php?id=$row[planeMakerID]\">Edit</a> | <a href=\"aeroplaneDelete.php?id=$row[planeMakerID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
    }
    ?>
    <a href="logout.php">Logout</a>
    </table>
    </body>
</html>


