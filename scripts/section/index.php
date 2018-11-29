<?php

require_once __DIR__."/../../Conn.php";

$sections = $conn->query("SELECT * FROM `sections` ORDER BY `grade_id`,`name`");

function getGradeName ($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT `name` FROM `grades` WHERE `id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $grade = $result->fetch_assoc();
    return $grade["name"];
}
