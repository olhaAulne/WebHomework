<?php
$host = "127.0.0.1";
$port = 3306;
$username = "root";
$password = "password";
$database = "hotel";

$db = new PDO("mysql:host=$host;port=$port", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->exec("use `$database`");
?>