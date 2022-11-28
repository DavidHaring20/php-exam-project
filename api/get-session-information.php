<?php

session_start();

echo json_encode([
    'id' => $_SESSION['id'],
    'first_name' => $_SESSION['first_name'],
    'email' => $_SESSION['email']
])

?>