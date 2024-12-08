<?php


$host= "localhost:3307";

$user= "root";

$password = "";

$db_name = "sql_project";

$conn = new mysqli($host, $user, $password, $db_name);

 if($conn->connect_error) { 
        die("Connect Error: ". $conn -> connect_error);
    }  

    ?>