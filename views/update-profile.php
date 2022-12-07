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
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>

    <main>
        <div class="user-information-edit">
            <?php 
                require_once(__DIR__.'/../api/get-user-by-id.php');
            ?>
            
            <form action="update-profile" method="POST">
                <input hidden type="text" name="id" <?php echo 'value="'.$_SESSION['id'].'"'?>>

                <div>
                    <label for="first_name">First Name: </label>
                    <input type="text" name="firstName" <?php echo 'value="'.$user->get_first_name().'"'?>>
                </div>

                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="lastName" <?php echo 'value="'.$user->get_last_name().'"'?>>
                </div>

                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" <?php echo 'value="'.$user->get_username().'"'?>>
                </div>

                <div>
                    <label for="email">Email:</label>
                    <input type="text" name="email" <?php echo 'value="'.$user->get_email().'"'?>>
                </div>

                <button>Apply changes</button>
            </form>
        </div>
    </main>
</body>
</html>