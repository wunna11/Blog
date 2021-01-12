<?php
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    $pdo = new PDO("mysql:dbname=blogapp;host=localhost",'root','');
?>