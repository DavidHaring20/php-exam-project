<?php

session_start();

require_once(__DIR__.'/../services/database-connector.php');
require_once(__DIR__.'/../services/validator.php');

$email = validate_email();
$password = validate_password();
$password_retype = validate_password_retype();

if ($password !== $password_retype) {
    respond("Passwords do not match", 400);
}

# Hash password 
$password = password_hash($password, PASSWORD_DEFAULT);

try {
    $query = $database->prepare('UPDATE users SET password = :password WHERE email = :email');
    $query->bindValue('password', $password);
    $query->bindValue('email', $email);

    $query->execute();
    if ($query->rowCount() == 0) {
        // echo json_encode(['information' => 'User cannot be updated']);
        $_SESSION['error'] = 'Failed to change password';
        header('Location: ./update-password');
        exit();
    }

    // echo json_encode(['information' => 'User updated successfully']);
    $_SESSION['notification'] = 'Password changed.';
    header('Location: ./profile');
    exit();
} catch (PDOException $exception) {
    echo $exception;
}


?>