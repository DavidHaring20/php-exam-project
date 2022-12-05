<?php

require_once(__DIR__.'/../services/database-connector.php');

try {
    $query = $database->prepare('SELECT * FROM users');
    $query->execute();
    $users = $query->fetchAll();
    // header('Content-Type: application/json');
    // echo json_encode($users);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['error on line: '.__LINE__]);
    exit();
}

?>