<?php 

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/database-connector.php');

try {
    $query = $database->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
    $query->bindValue('id', $_SESSION['id']);
    $query->execute();

    $data = $query->fetch();
    if (!$data) {
        http_response_code(204);
        echo json_encode(['information' => 'user with id: '.$_SESSION['id'].' could not be found']);
    }

    $user = new User($data['first_name'], $data['last_name'], $data['email'], $data['username'], $data['password']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'error on line: '.__LINE__]);
}


?>