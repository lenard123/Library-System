<?php

require_once __DIR__."/../../Conn.php";

$grades = $conn->query("SELECT * FROM `grades` ORDER BY `name`");

