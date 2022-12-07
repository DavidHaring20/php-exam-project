<?php 

require_once(__DIR__.'/../models/User.php');

function user_from_data($data) {
    $user = new User($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['username'], $data['password']);
    return $user;
}

?>