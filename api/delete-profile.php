<?php

session_start();

require_once(__DIR__.'/../services/database-connector.php');
require_once(__DIR__.'/../api/get-user-by-id.php');

$id = $_SESSION['id'];

$user->delete_profile($id);
$user->delete_session();

?>