<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";


if (!isset($_GET['id'])) {
    header("Location: "._public("pages/grade/index.php"));
}

$id = $_GET['id'];
$not_found = false;


$stmt = $conn->prepare("SELECT * FROM `grades` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found = TRUE;
} else {
    $sections = $conn->query("SELECT * FROM `sections` WHERE `grade_id`=$id ORDER BY `name`");
    $grade = $result->fetch_assoc();

    function getGradeName ($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT `name` FROM `grades` WHERE `id`=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $grade = $result->fetch_assoc();
        return $grade["name"];
    }
}