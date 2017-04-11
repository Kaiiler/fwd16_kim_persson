<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Kallar på dokument som behövs för att köra programmet
        require_once ("bank.php");
        require_once ("base.php");
        
        // Kallar på store procedure och matar in en in parameter
        $sql = "CALL account('Sohail')";
        $result = $conn->query($sql);
        // hämtar alla rader med rowCount
        if ($result->rowCount()) {
            $result->setFetchMode(PDO::FETCH_CLASS, "bank");
            // printar ut collector variablen ifrån bank klassen
            while($row = $result->fetch()) {
                echo $row->collector;
            }
        }
        ?>
    </body>
</html>
