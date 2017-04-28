<?php
        // Login info
        $servername = "83.168.227.23";
        $username = "u1164707_KimPer";
        $password = "gh4&^rW v-";
        $dbname = "db1164707_KimPer";
        
 try {
     // Uses PDO to connect to server
    $pdo = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        echo "Connection Success<br>";
    // Errorhandling
} catch (PDOException $e) {
    
    echo "Connection is scuffed: ".$e->getMessage();
    
    die();
    
}

