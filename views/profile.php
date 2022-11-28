<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: ./login');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Profile</h1>

    <div class="user-information">
        <?php
            require_once(__DIR__.'/../api/get-user-by-email.php');

            echo '<p>'.$user->get_first_name().' '.$user->get_last_name().'</p>';
            echo '<p>'.$user->get_username().'</p>';
            echo '<p>'.$user->get_email().'</p>';
        ?>
    </div>
</body>
</html>