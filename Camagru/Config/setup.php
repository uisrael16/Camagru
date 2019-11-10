<?php
   require 'database.php';
     $conn = new PDO("$db_driver:host=$db_server;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS registration";
    $conn->exec($sql);

    $sql = "USE registration";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `email` tinytext NOT NULL,
    `pass` longtext NOT NULL,
    `vkey` varchar(255) NOT NULL,
    `verified` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '0',
    `createdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS`comments` (
    `id` int(11) NOT NULL,
    `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `image_id` int(11) NOT NULL,
    `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    $conn->exec($sql);  
    $sql = "CREATE TABLE IF NOT EXISTS`likes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image_id` int(11) NOT NULL
    )";
    $conn->exec($sql);
    $sql = "CREATE TABLE  IF NOT EXISTS`images` (
    `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `username` varchar(255) NOT NULL,
    `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `picture` varchar(100) NOT NULL
    )";
    $conn->exec($sql);
    header("Location: ../index.php");
    
?>
