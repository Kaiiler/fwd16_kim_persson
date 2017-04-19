<!DOCTYPE html>
 <?php
        include_once("config.php");
        
        $result = $conn->query("call sp_show_all_cars");
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Car Ownership APP</title>
    </head>
    <body>
<!-- Länk till lägga till nya skämt -->        
        <a href="add_form.php">Add Car ownerships</a><br/><br/>
 
    <table width='100%' border=0>
 
    <tr bgcolor='#CCCCCC'>
        <td>Car</td>
        <td>Owner</td>
        <td></td>
        <td>Update</td>
    </tr>
    <?php  
    while($row = $result->fetch()) {         
        echo "<tr>";
        echo "<td>".$row['carname']."</td>";
        echo "<td>".$row['fname']."</td>";
        echo "<td>".$row['lname']."</td>";
        echo "<td><a href=\"edit.php?id=$row[car_id]\">Edit</a> | <a href=\"delete.php?id=$row[car_id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";        
    }
    ?>
    </table>
    </body>
</html>
