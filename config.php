<?php

    $host = "localhost";
    $user = "root";
    $psw = "";
    $dbname = "api";

    $dsn = "mysql:host=$host; dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    function escape($html)
{
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}