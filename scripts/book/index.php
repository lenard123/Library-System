<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../student/book.php";

$books = $conn->query("SELECT * FROM `books` ORDER BY `title`");

