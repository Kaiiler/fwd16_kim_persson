<?php
        // Inloggningsupgifter
        $servername = "83.168.227.23";
        $username = "u1164707_KimPer";
        $password = "gh4&^rW v-";
        $dbname = "db1164707_KimPer";
        
 try {
     // Använder PDO för att ansluta till databas
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 
    // Felhantering
} catch (PDOException $e) {
    
    echo "Connection failed: ".$e->getMessage();
    
    die();
    
}

?>