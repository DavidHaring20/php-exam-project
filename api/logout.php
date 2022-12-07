<?php
    session_start();
    require_once(__DIR__.'/../models/User.php');
    require_once(__DIR__.'/../services/database-connector.php');
    require_once(__DIR__.'/../api/get-user-by-email.php');

    $user->delete_session();
    header('Location: ./')
?>