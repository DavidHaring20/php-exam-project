<?php 

session_start();

require_once(__DIR__.'/../services/validator.php');
require_once(__DIR__.'/../api/get-user-by-email.php');

$id = $_SESSION['id'];
$image_data = validate_image();

$user->upload_image($id, $image_data);

?>