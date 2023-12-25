<?php

    $host = "localhost";
    $username = "root";
    // $password = "UCC@Meet2022**";
    $password = "";
    $db = "job_requirement";
    $dsn ="mysql:host=$host;dbname=$db";
    
    try{
        $pdo = new PDO($dsn,$username,$password);
        // echo "success";
        
    }catch(PDOException $e){
        $e->getMessage();
    }

    require_once "controller.php";

    $controller = new Controller($pdo);

?>

