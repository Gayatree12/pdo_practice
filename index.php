<?php

$my_server = 'mysql:host=sql2.njit.edu';
$username = 'gt86';
$password = '0rNBRXnf3';
$dbname= 'gt86'; //database
//create php connection to mysql 
try {
    $conn = new PDO($my_server, $dbname, $username, $password);
    echo <p>"Connected successfully"</p> . '<br>'; 
    }
catch(PDOException $e)
    {
    $error_message = $e -> getMessage();
    echo <p>"An error occurred while connecting to the database: $error_message" </p> . '<br>';
    }
?>