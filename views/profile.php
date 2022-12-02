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

    <div class="user-notification">
        <?php
            if (isset($_SESSION['notification'])) {
                echo '<p>'.$_SESSION['notification'].'</p>';
            }
        ?>
    </div>

    <div class="user-information">
        <?php
            require_once(__DIR__.'/../api/get-user-by-email.php');
        ?>  

        <p>
            <?php 
                echo $user->get_first_name(); 
                echo " ";            
                echo $user->get_last_name()
            ?>
        </p>
        <p><?php echo $user->get_username()?></p>
        <p><?php echo $user->get_email()?></p>
        <img <?php echo 'src="'.$user->get_image().'"';?> alt="User image">
    </div>

    <div class="user-options">
        <form action="update-password" method="GET">
            <button>Change Password</button>
        </form>
        <form action="update-profile" method="GET">
            <button>Edit Profile</button>
        </form>
        <form action="delete-profile" method="GET">
            <button>Delete user</button>
        </form>
        <form action="update-image" method="GET">
            <button>Update Image</button>
        </form>
    </div>
</body>
</html>