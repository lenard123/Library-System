<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../student/student_helper.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET['id'])) {
    redirect("grade");
}

$id = $_GET['id'];
$not_found = FALSE;

$stmt = $conn->prepare("SELECT * FROM `sections` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found = TRUE;

    function getBackLink() {

        if (isset($_GET['ref']) && $_GET['ref']=="grade")
            return _public("pages/grade");
        else
            return _public("pages/section");

    }

} else {

    $students = $conn->query("SELECT * FROM `students` WHERE `section_id`=$id ORDER BY `name`");
    $section = $result->fetch_assoc();
    $ref = isset($_GET["ref"]) ? $_GET["ref"] : "section";

    function getBackLink() {
        global $section;
        if (isset($_GET['ref']) && $_GET['ref']=="grade")
            return _public("pages/grade/sections.php?id=".$section['grade_id']."#section-".$section['id']);
        else
            return _public("pages/section#section-".$section['id']);

    }

}