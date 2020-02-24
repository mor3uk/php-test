<?php

$host = "localhost";
$name = "root";
$password = "";
$dbname = "test";

$db = mysqli_connect($host, $name, $password, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
