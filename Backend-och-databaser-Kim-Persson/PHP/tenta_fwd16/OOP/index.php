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
        require_once 'subclasses.php';
        echo airplane::refuelstring."<br>";
        echo airplane::$warningstring;
        $bFiveTwo = new bomber("B52",1037,13000,4500, 24);
        $lockheed = new interceptor("Lockheed YF-12",3350, 4800, 1000, 3);
        echo "<pre>".print_r($bFiveTwo, TRUE);
        $bFiveTwo->refuel();
        echo "<pre>".print_r($lockheed, TRUE);
        $lockheed->refuel();
        
                
        ?>
    </body>
</html>
