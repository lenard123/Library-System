<?php

//Require Configuration Script
require_once __DIR__."/Config.php";
require_once __DIR__."/Environment.php";

//Create a connection
$conn = new mysqli($config["dbHost"], $config["dbUser"], $config["dbPass"], $config["dbName"]);

//Check Connection
if ($conn->connect_error) {
    die($conn->connect_error);
}

