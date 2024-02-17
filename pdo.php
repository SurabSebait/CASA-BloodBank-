<?php
    $pdo = new PDO('mysql:host=127.0.0.1; port=3306; dbname=bloodbank','root','Nisha@12345');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
?>