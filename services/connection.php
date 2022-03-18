<?php 
    $servername = 'localhost';
    $username = 'root';
    $password = '@programming2022';
    $database = 'phone_book';

    $connection = new mysqli($servername, $username, $password, $database);

    if($connection->connect_error){
        die('Connection failed ' . $connection->connect_error);
    }

?>