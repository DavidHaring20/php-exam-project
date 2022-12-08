<?php

session_start();

require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../services/database-connector.php');
require_once(__DIR__.'/../api/get-user-by-id.php');

$password = validate_password();
$password_retype = validate_password_retype();

if ($password !== $password_retype) {
    respond("Passwords do not match", 400);
}

# Hash password 
$password = password_hash($password, PASSWORD_DEFAULT);
$id = $_SESSION['id'];

$user->change_password($id, $password);

?>