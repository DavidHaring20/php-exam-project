<?php

session_start();

require_once(__DIR__.'/../models/User.php');
require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../api/get-user-by-id.php');

$first_name = validate_first_name();
$last_name = validate_last_name();
$username = validate_username();
$email = validate_email();
$id = $_SESSION['id'];

$user->update_profile($id, $first_name, $last_name, $username, $email);

?>