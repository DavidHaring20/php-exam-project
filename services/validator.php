<?php

define('ID_REGEX', '\d');

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

function validate_id() {
    $error_message = 'id is missing';
    if (!isset($_POST['id'])) {
        respond($error_message, 400);
    }
    $id = $_POST['id'];
    $error_message = 'id must be longer a number';
    if (!preg_match('/'.ID_REGEX.'/', $id)) {
        respond($error_message);
    }

    return $id;
}

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

function validate_password_retype() {
    $error_message = 'password must be longer than ' . PASSWORD_MIN_LEN . ' and shorter than ' . EMAIL_MAX_LEN;
    if (!isset($_POST['passwordRetype'])) {
        respond($error_message, 400);
    } 
    $password = trim($_POST['passwordRetype']);
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
function validate_image() {
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    
    // Check if file is image
    $size = getimagesize($image_tmp);
    if ($size === false) {
        respond('file is not image');
    }

    // Check file type
    $image_file_extension = strtolower(pathinfo(basename($image),PATHINFO_EXTENSION));
    $allowed_file_extensions = ['jpeg', 'png'];
    if (!in_array($image_file_extension, $allowed_file_extensions)) {
        respond('file type not allowed');
    }

    // Check file size
    if ($image_size > 2000000) {
        respond('file type is too big');
    }

    // Randomize image name
    $image_name = bin2hex(random_bytes(16));
    switch($image_file_extension) {
        case 'jpeg':
            $image_name .= '.jpeg';
            break;
        case 'png':
            $image_name .= '.png';
            break;
    }

    // Check if there is already file with same name
    $upload_dir = __DIR__."/../images/";
    $upload_file = $upload_dir . basename($image_name);
    if (file_exists($upload_file)) {
        respond('file already exists');
    }

    $data = [
        'image_name'    => $image_name,
        'image_tmp'     => $image_tmp
    ];

    return $data;
}

function respond($message='', $status=200) {
    http_response_code($status);
    header('Content-Type: Application/json');
    $res = is_array($message) ? $message : ['info' => $message];
    echo json_encode($res);
    exit();
}

?>