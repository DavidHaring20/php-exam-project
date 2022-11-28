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
    <title>Home</title>
</head>
<body>
    <nav>
        <a href="./logout">Logout</a>  
        <a href="./profile">Profile</a>  
    </nav>
        
    <h3>Welcome Home !</h3>
    <p>
        <?php
            echo $_SESSION['first_name'];            
        ?>
    </p>

</body>
</html>