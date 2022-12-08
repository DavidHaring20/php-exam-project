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
    <title>Change Password</title>
</head>
<body>
    <nav>
        <a href="./profile">Profile</a>  
        <a href="./logout">Logout</a>  
    </nav>

    <h1>Change Password</h1>

    <main>
        <div>
            <p>Here you can create your new password. Rules for password are:</p>
            <ol>
                <li>
                    Must be minimum 8 characters long
                </li>
                <li>
                    Must be maximum 16 characters long
                </li>
                <li>
                    Must not contain other symbols than # ! $ and _
                </li>
                <li>
                    Can contain any numerical or alphabetical character
                </li>
            </ol>
        </div>

        <div class="change-password">
            <?php 
                require_once(__DIR__.'/../api/get-user-by-email.php');

                echo '<form action="update-password" method="POST">';
                echo '<input type="text" name="password" placeholder="Password">';
                echo '<input type="text" name="passwordRetype" placeholder="Retype Password">';
                echo '<button>Submit</button>';
                echo '</form>';
            ?>
        </div>
    </main>
</body>
</html>