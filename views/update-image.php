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
    <title>Update image</title>
</head>
<body>
    <nav>
        <a href="./profile">Profile</a>  
        <a href="./logout">Logout</a>  
    </nav>

    <h1>Update image</h1>

    <main>
        <form action="update-image" method="POST" enctype="multipart/form-data">
            <label>File image:</label>
            <input type="file" name="image">

            <button>Submit</button>
        </form>
    </main>
</body>
</html>