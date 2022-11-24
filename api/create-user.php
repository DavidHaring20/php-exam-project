<?php

require_once '../services/validator.php';
require_once '../models/User.php';

$first_name = validate_first_name();
$last_name = validate_last_name();
$email = validate_email();
$username = validate_username();
$password = validate_password();
$password_retype = $_POST['passwordRetype'];

if ($password !== $password_retype) {
    echo $password;
    echo $password_retype;
    respond("Passwords do not match", 400);
}

$user = new User($first_name, $last_name, $email, $username, $password);
$user->create_user();

# Query for creating user 
# INSERT INTO users(first_name, last_name, email, username, password) VALUES("David", "Haring", "davidharingri@gmail.com", "davidh123", "mysecretpass123");


?>