<?php

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

//Initialize variables
$not_found = false;
$error = false;

/***************************
 * CHECK IF THERE'S AN ID
 ***************************/
if(!isset($_GET['id'])) {
    redirect("section");
}

$id = trim($_GET['id']);



/***************************
 * CHECK IF THE ID IS VALID
 ***************************/
$stmt = $conn->prepare("SELECT * FROM `sections` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows >= 1) {
    $section = $result->fetch_assoc();

    function getBackLink() {
        global $section;
        if (isset($_GET['ref']) && $_GET['ref']=="grade")
            return _public("pages/grade/sections.php?id=".$section['grade_id']."#section-".$section['id']);
        else
            return _public("pages/section#section-".$section['id']);
    }

} else {
    $not_found = TRUE;
}


/***************************
 * GET ALL GRADES
 ***************************/
$grades = $conn->query("SELECT * FROM `grades`");





/*************************
 * UPDATE SECTIONS
 *************************/
if (!$not_found && isset($_POST['name'])) {

    $name = trim($_POST['name']);

    if (empty($name)) {
        addError("Name is required.");
    }

    $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `grade_id`=? AND `name`=? AND `id`<>?");
    $stmt->bind_param("isi", $section['grade_id'], $name, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >= 1) {
        addError("Name already exists.");
    }


    if (!hasError()) {
        $stmt = $conn->prepare("UPDATE `sections` SET `name`=? WHERE `id`=?");
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute() === TRUE) {
            addSuccess("Section updated successfully.");
            $section['name'] = $name;
        } else {
            addError("An error occured while updating section.");
        }
    }

}
