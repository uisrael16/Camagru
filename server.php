<?php

if (isset($_POST['register']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_1'];
    
    if (empty($username) || empty($email) || empty($password_1) || empty($password_2))
    {
        echo "missing information";
    }
    else if ($password_1 != $password_2)
    {
        echo "password match error";
    }
    else
    {
        require("connect.php");
        $sql = "INSERT INTO users (username, email, pass) VALUES (?, ?, ?)";
        $stmt= $conn->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $password_1);
        if($stmt->execute())
        {
            echo "success";
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