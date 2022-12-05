<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: ./login');
    }

    function toHTMLentities($string) {
        echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <nav>
        <a href="./logout">Logout</a>
    </nav>

    <main>
        <h1>Welcome Admin</h1>

        <div class="user-list">
            <ul>
                <?php
                    require_once(__DIR__.'/../api/get-users.php');
                    foreach ($users as $user) {
                        echo '<form action="delete-user/'.$user['id'].'" method="GET">';
                        echo '<div><li>';
                        echo '<div>Id: ' . $user['id'] .'</div>';
                        echo '<div>First and last name: ';
                        toHTMLentities($user['first_name'] . " " . $user["last_name"]);
                        echo '</div>';
                        echo '<div>Username: ';
                        toHTMLentities($user['username']);
                        echo '</div>';
                        echo '<div>Email: ';
                        toHTMLentities($user['email']);
                        echo '</div>';
                        echo '<button>Delete User</button>';
                        echo '</div></li><hr>';
                        echo '</form>';
                    } 
                ?>            
            </ul>
        </div>
    </main>
</body>
</html>