<?php

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../services/database-connector.php');

$email = validate_email();
$password = validate_password();


try {
    if ($email == 'admin@gmail.com' && $password == 'adminpass123') {
        session_start();
        $_SESSION['id'] = 0;
        $_SESSION['first_name'] = 'admin';
        $_SESSION['email'] = 'admin@gmail.com';
        header('Location: ./admin');
        exit();
    }

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
        session_start();
        $_SESSION['id'] = $data['id'];
        $_SESSION['first_name'] = $user->get_first_name();
        $_SESSION['email'] = $user->get_email();
        header('Location: ./home');
        exit();
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