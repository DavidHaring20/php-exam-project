<?php
    session_start();
    unset($_SESSION['first_name']);
    unset($_SESSION['email']); 
    session_destroy();
    header('Location: ./')
?>