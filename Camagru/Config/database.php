<?php

$db_driver = "mysql";
$db_server = "localhost";
$db_user = "root";
$db_name = "registration";
$db_password = "123456789";

try
{
    $conn = new PDO("$db_driver:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>
