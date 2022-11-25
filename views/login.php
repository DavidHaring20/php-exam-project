<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <nav>
        <a href="./">Starting page</a>
        <a href="./signup">Signup</a>
    </nav>

    <main>
        <form action="login" method="POST">
            <div>
                <label for="email">Email Address:</label>
                <input id="email" type="text" name="email" placeholder="Email Address">
            </div>
            
            <div>
                <label for="password">Password:</label>
                <input id="password" type="text" name="password" placeholder="Password">
            </div>

            <button type="submit">Log In</button>
        </form>
    </main>
</body>
</html>