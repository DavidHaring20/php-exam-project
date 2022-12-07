<?php

require_once __DIR__.'/../services/validator.php';
require_once __DIR__.'/../models/User.php';

$first_name = validate_first_name();
$last_name = validate_last_name();
$email = validate_email();
$username = validate_username();
$password = validate_password();
$password_retype = $_POST['passwordRetype'];

if ($password !== $password_retype) {
    echo json_encode(['passwordRetype' => $password_retype]);
    respond("Passwords do not match", 400);
}

# Hash password 
$password = password_hash($password, PASSWORD_DEFAULT);
$user = new User(0, $first_name, $last_name, $email, $username, $password);
$user->create_user();

header('Location: ./login');

?>