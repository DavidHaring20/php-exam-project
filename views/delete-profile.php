<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete profile</title>
</head>
<body>
    <h1>Delete profile</h1>

    <main>
        <p>Are you sure you want to delete profile ?</p>
        <form action="delete-profile" method="POST">
            <button>Yes</button>
        </form>
        <form action="profile" method="GET">
            <button>No</button>
        </form>
    </main>
</body>
</html>