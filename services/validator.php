<?php

define('NAME_MIN_LEN', 2);
define('NAME_MAX_LEN', 12);
define('NAME_REGEX', '([A-Za-z])+');

define('EMAIL_MIN_LEN', 8);
define('EMAIL_MAX_LEN', 30);
define('EMAIL_REGEX', '^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$');

define('USERNAME_MIN_LEN', 6);
define('USERNAME_MAX_LEN', 16);
define('USERNAME_REGEX', '([A-Za-z0-9])+');

define('PASSWORD_MIN_LEN', 8);
define('PASSWORD_MAX_LEN', 16);
define('PASSWORD_REGEX', '([A-Za-z0-9#!$_])+');

function validate_first_name() {
    $error_message = 'firstName must be longer than ' . NAME_MIN_LEN . ' and shorter than' . NAME_MAX_LEN;
    if (!isset($_POST['firstName'])) {
        respond($error_message, 400);
    }
    $first_name = trim($_POST['firstName']);
    if(strlen($first_name) < NAME_MIN_LEN) {
        respond($error_message);
    }
    if (strlen($first_name) > NAME_MAX_LEN) {
        respond($error_message);
    }
    $error_message = 'firstName can only contain alphabetical characters';
    if (!preg_match('/'.NAME_REGEX.'/', $first_name)) {
        respond($error_message);
    }

    return $first_name;
}

function validate_last_name() {
    $error_message = 'lastName must be longer than ' . NAME_MIN_LEN . ' and shorter than' . NAME_MAX_LEN;
    if (!isset($_POST['lastName'])) {
        respond($error_message, 400);
    }
    $last_name = trim($_POST['lastName']);
    if(strlen($last_name) < NAME_MIN_LEN) {
        respond($error_message);
    }
    if (strlen($last_name) > NAME_MAX_LEN) {
        respond($error_message);
    }
    $error_message = 'lastName can only contain alphabetical characters';
    if (!preg_match('/'.NAME_REGEX.'/', $last_name)) {
        respond($error_message);
    }

    return $last_name;
}

function validate_email() {
    $error_message = 'email must be longer than ' . EMAIL_MIN_LEN . ' and shorter than ' . EMAIL_MAX_LEN;
    if (!isset($_POST['email'])) {
        respond($error_message, 400);
    }
    $email = trim($_POST['email']);
    if (strlen($email) < EMAIL_MIN_LEN) {
        respond($error_message);
    }
    if (strlen($email) > EMAIL_MAX_LEN) {
        respond($error_message);
    }
    $error_message = 'email is not correctly formated';
    if (!preg_match('/'.EMAIL_REGEX.'/', $email)) {
        respond($error_message);
    }

    return $email;
}

function validate_username() {
    $error_message = 'username must be longer than ' . USERNAME_MIN_LEN . ' and shorter than ' . EMAIL_MAX_LEN;
    if (!isset($_POST['username'])) {
        respond($error_message, 400);
    }
    $username = trim($_POST['username']);
    if (strlen($username) < USERNAME_MIN_LEN) {
        respond($error_message);
    }
    if (strlen($username) > USERNAME_MAX_LEN) {
        respond($error_message);
    }
    $error_message = 'username can contain only alphabetical and numerical characters';
    if (!preg_match('/'.USERNAME_REGEX.'/', $username)) {
        respond($error_message);
    }

    return $username;
}

function validate_password() {
    $error_message = 'password must be longer than ' . PASSWORD_MIN_LEN . ' and shorter than ' . EMAIL_MAX_LEN;
    if (!isset($_POST['password'])) {
        respond($error_message, 400);
    } 
    $password = trim($_POST['password']);
    if (strlen($password) < PASSWORD_MIN_LEN) {
        respond($error_message);
    }
    if (strlen($password) > PASSWORD_MAX_LEN) {
        respond($error_message);
    }
    $error_message = 'password can contain only alphabetical, numerical and these characters # ? ! _';
    if (!preg_match('/'.PASSWORD_REGEX.'/', $password)) {
        respond($error_message);
    }
    return $password;
} 

# Finish this function when working on uploading image
function validate_image() {}

function respond($message='', $status=200) {
    http_response_code($status);
    header('Content-Type: Application/json');
    $res = is_array($message) ? $message : ['info' => $message];
    echo json_encode($res);
    exit();
}

?>