<?php
    require("connect.php");
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    // $_SESSION['word'] = md5($_POST['password_1']);

if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    $sql = "SELECT * FROM `users` WHERE `username` = ? OR `email` = ?";
    $stmt= $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->execute();
    
    if (count($stmt->fetchAll()) > 0){
        $_SESSION['error'] = "$username is already taken";
        // echo "sql/database error";
    }
    else if (empty($username) || empty($email) || empty($password_1) || empty($password_2))
    {
        echo "missing information";
    }
    else if ($password_1 != $password_2)
    {
        echo "password doesn't match";
    }
    else
    {
        $sql = "INSERT INTO users (username, email, pass) VALUES (?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password_1);
        if($stmt->execute())
        {
            echo md5($_POST['password_1']);
        }
        else
        {
            echo "sql/database error";
        }
        $stmt = null;
        $conn = null;
    }
}

?>  