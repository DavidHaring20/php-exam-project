<?php

session_start();
require_once(__DIR__.'/../services/database-connector.php');

try {
    $query = $database->prepare('DELETE FROM users WHERE id = :id');
    $query->bindValue('id', $_SESSION['id']);
    $query->execute();
    if ($query->rowCount() == 0) {
        echo json_encode(['error' => 'User could not be deleted']);
        exit();
    }
    echo json_encode(['information' => 'User deleted with ID: '.$_SESSION['id']]);
    require_once(__DIR__.'/logout.php');
    exit();

} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['information' => 'error on line: '.__LINE__]);
    exit();
}

?>