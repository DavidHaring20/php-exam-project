<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <nav>
        <a href="./">Starting page</a>
        <a href="./login">Login</a>
    </nav>

    <main>
        <form action="/signup" method="POST">
            <div>
                <label for="first-name">First Name:</label>
                <input id="first-name" type="text" name="firstName" placeholder="First Name">
            </div>

            <div>
                <label for="last-name">Last Name:</label>
                <input id="last-name" type="text" name="lastName" placeholder="Last Name">
            </div>
                <label for="email">Email Address:</label>
                <input id="email" type="text" name="email" placeholder="Email Address">
            <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" placeholder="Username">
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" placeholder="Password">
            </div>

            <div>
                <label for="retype-password">Retype Password:</label>
                <input id="retype-password" type="password" name="retypePassword" placeholder="Retype Password">
            </div>

            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>