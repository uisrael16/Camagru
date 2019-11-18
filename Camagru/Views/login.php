<?php

//require '../Controllers/login.php';
session_start();
if (isset($_POST['login']))
{
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    if (empty($user) || empty($pass))
    {
        echo "missing inputs";
    }
    else
    {
        $pass = md5($pass);
        require("../Config/database.php");
        $sql = "SELECT * FROM users WHERE username = ? AND pass = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $pass);
        $stmt->execute();
        if ($stmt->rowCount() > 0)
        {
            unset($_SESSION['login']);
            $user = $stmt->fetch();
            if ($user['verified'] == 0)
            {
                echo "user not verified";
            }
            else
            {
                $_SESSION["login"]["id"] = $user["id"];
                $_SESSION["login"]["email"] = $user["email"];
                $_SESSION["login"]["username"] = $user["username"];
                $_SESSION["username"] = $user["username"];
                echo "you are loged in";
                header("Location: ../Views/fileUpload.php");
            }
        }
        else
        {
            echo "invalid password/username";
        }
    }
}

?>
<html>
    <head>
        <title>Camagru | Login</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <body>
        <div class="header">
        <h2>Camagru Login</h2>
        <center><a href="publicgallery.php">Gallery</a></center>
        </div>
        <div class = "form">
        <form method="post">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username..." required>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password..." required>
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <div>
                <p>
                Not yet a member? <a href="register.php">Register</a>
            </p>
            <br>
            <center><a href="forgotPassword.php"><p>forgot your password?</p></a></center>
            </div>
        </form>
          
    <div>
    </body>
</html>