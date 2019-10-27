<?php include('server.php'); ?>
<!DOCTYPE html>
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
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email...">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1" placeholder="Enter Password...">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2" placeholder="Enter Password...">
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="btn">Register</button>
            </div>
            <p>
                Already a member? <a href="Login.php">Login</a>
            </p>
        </form>
    </body>
</html>