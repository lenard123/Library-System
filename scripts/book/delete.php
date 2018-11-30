<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";

if (!isset($_GET["id"])) {
    redirect("book");
}

$id = trim($_GET["id"]);
$notfound = false;

$stmt = $conn->prepare("SELECT * FROM `books` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $notfound = true;
} else {
    $book = $result->fetch_assoc();
    
}
