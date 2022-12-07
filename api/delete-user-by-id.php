<?php 

require_once(__DIR__.'/../services/database-connector.php');
require_once(__DIR__.'/../services/validator.php');

try {
    $query = $database->prepare('DELETE FROM users WHERE id = :id');
    $query->bindValue('id', $_GET['id']);
    $query->execute();

    if ($query->rowCount() == 0) {
        echo json_encode(['error' => 'could not delete user']);
        header('Location: ../admin');
        exit();
    }

    echo json_encode(['information' => 'delete user with id: '.$_GET['id']]);
    header('Location: ../admin');
    exit();
} catch (PDOException $excpetion) {
    http_response_code(500);
    echo json_encode(['error' => 'error on line: '.__LINE__]);
    exit();
}

?>