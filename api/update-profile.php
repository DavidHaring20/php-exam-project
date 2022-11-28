<?php

session_start();

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../services/database-connector.php');


$first_name = validate_first_name();
$last_name = validate_last_name();
$username = validate_username();
$email = validate_email();

try {
    $query = $database->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, username = :username, email = :email WHERE id = :id');
    $query->bindValue('first_name', $first_name);
    $query->bindValue('last_name', $last_name);
    $query->bindValue('username', $username);
    $query->bindValue('email', $email);
    $query->bindValue('id', $_SESSION['id']);

    $query->execute();
    if ($query->rowCount() == 0) {
        echo json_encode(['information' => 'User could not be updated']);
        exit();
    }

    $_SESSION['notification'] = 'Password changed.';
    header('Location: ./profile');
    exit();
} catch (PDOException $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'error on line: '.__LINE__]);
    exit();
}

?>