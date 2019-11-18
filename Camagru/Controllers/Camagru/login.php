<html>
    <head>
        <title>Camagru | Register</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
        <h2>Camagru Register</h2>
        </div>

        <form method="post" action="register.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username...">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password...">
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <p>
                Not yet a member? <a href="register.php">Register</a>
            </p>
        </form>
    </body>
</html>