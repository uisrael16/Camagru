<?php 
require_once '../Controllers/register.php';
     $_SESSION['id'] = 1;
    // SESSION_START();
    $error = NULL;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camagru | Register</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <body>
        <div class="header">
        <h2>Camagru Register</h2>
        </div>

        <form method="post" action="../Views/register.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username..."required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email..."required>
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password_1" placeholder="Enter Password..." required>
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2" placeholder="Enter Password..."  required>
                <p style='color: red'>
                    
                    
                
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="btn">Register</a></button>
                <p style='color: red'>
                <?php 
                    if (!empty($_SESSION['error'])){
                        echo $_SESSION['error'];
                        $_SESSION['error'] = '';
                    }
                ?>
                </p>
            </div>
            <p>
                Already a member? <a href="Login.php">Login</a>
            </p>
        </form>
        <center>
            <?php
                echo $error;
            ?>
        </center>
    </body>
</html>