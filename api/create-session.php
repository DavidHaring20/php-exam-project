<?php

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../services/database-connector.php');

$email = validate_email();
$password = validate_password();


try {
    $query = $database->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $query->bindValue(':email', $email);
    $query->execute();
    
    $data = $query->fetch();
    if (!$data) {
        http_response_code(204);
        header('Location: ./login');
        // echo json_encode(['information' => 'user with email: '.$email.' could not be found']);
        exit();
    }
    
    $user = new User($data['first_name'], $data['last_name'], $data['email'], $data['username'], $data['password']);
    if (password_verify($password, $user->get_password())) {
        header('Location: ./home');
    } else {
        header('Location: ./login');
        // echo json_encode(['information' => 'password is wrong']);
    }
    exit();
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['information' => 'error on line: '.__LINE__]);
    exit();
}


?>