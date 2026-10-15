<?php

$dbStatus = "";

try{
    $host = "127.0.0.1";
    $dbName = "wp_newUser";
    $user = "nico";
    $password = "";

    $pdo = new PDO("mysql:host=$host;dbname=$dbName",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $dbStatus = "Good DB Connection";
}
catch (PDOException $e){
    $dbStatus = "Bad DB Connection: ".$e->getMessage();
}

session_start();