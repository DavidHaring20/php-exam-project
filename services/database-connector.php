<?php

try {
    $databaseUserName = 'root';
    $databasePassword = '';
    $databaseConnection = 'mysql:host=localhost; dbname=php-exam; charset=utf8mb4;';
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    $database = new PDO($databaseConnection, $databaseUserName, $databasePassword, $options);
} catch (PDOException $exception) {
    echo $exception;
    exit();
} 

?>