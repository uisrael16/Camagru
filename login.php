<?php

    session_start();

  if (isset($_POST['login']))
  {
     require 'server.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    $password = md5($password);

     $error = NULL;
  
        if (empty($_POST["username"]) || empty($_POST["password"]))
        {
            $message = '<label>ALL fields are required</label>';
        }
        else {
            $sql = "SELECT * FROM users WHERE username = :uname AND pass = :pass AND verified = 1";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(':uname', $username);
            $stmt->bindParam(':pass', $password);
            $stmt->execute();
            echo "<br> ";
            
            $rot = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            $count = $stmt->fetchAll();
        
             if(!empty($rot))
            {
                $_SESSION["username"] = $_POST["username"];
                header("location:home.php");
            }
            else {
                 $message = '<label>Wrong Data</label>';
             }
        }
        $conn = null;
    }


?>
<html>
    <head>
        <title>Camagru | Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
        <h2>Camagru Login</h2>
        </div>

        <div class = "form">
        <form method="post" action="login.php">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter Username..."required>
            </div>
            
            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Password..."required>
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