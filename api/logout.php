<?php
    session_start();
    unset($_SESSION['first_name']);
    unset($_SESSION['email']); 
    unset($_SESSION['id']); 
    session_destroy();
    header('Location: ./')
?>