<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/student_helper.php";
require_once __DIR__."/../../Config.php";

$students = $conn->query("SELECT * FROM `students` ORDER BY `name`");
