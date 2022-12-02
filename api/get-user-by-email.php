<?php 

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/database-connector.php');

try {
    $query = $database->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $query->bindValue('email', $_SESSION['email']);
    $query->execute();

    $data = $query->fetch();
    if (!$data) {
        http_response_code(204);
        echo json_encode(['information' => 'user with email: '.$_SESSION['email'].' could not be found']);
    }

    $user = new User($data['first_name'], $data['last_name'], $data['email'], $data['username'], $data['password']);
    $user->set_image($data['image']);
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'error on line: '.__LINE__]);
}


?>