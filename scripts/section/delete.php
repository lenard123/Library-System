<?php

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

$not_found = false;

/**************************
 * CHECK IF THERES AN ID
 **************************/
if (!isset($_GET['id'])) {
    redirect("section");
}

$id = trim($_GET['id']);

/*********************************
 * CHECK IF THE GIVEN ID IS VALID
 *********************************/
$stmt = $conn->prepare("SELECT * FROM `sections` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows >= 1) {
    $section = $result->fetch_assoc();

    function getBackLink () {
        global $section;
        if (isset($_GET['ref']) && $_GET['ref']=="grade") 
            return _public("pages/grade/sections.php?id=".$section['grade_id']."#section-".$section['id']);
        else
            return _public("pages/section#section-".$section['id']);
    }

} else {
    $not_found = true;
}


/*******************************
 * DELETE A SECTION
 *******************************/
if (!$not_found && isset($_POST['submit'])) {

    /************************
     * CHECK IF THERES A STUDENT
     * BELONG TO THIS SECTION
     *************************/
    $stmt = $conn->prepare("SELECT * FROM `students` WHERE `section_id`=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        addError("Failed to delete, there's a student belong to this grade.");
    }

    if (!hasError()) {

        $stmt = $conn->prepare("DELETE FROM `sections` WHERE `id`=?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute() === TRUE) {
            addSuccess("Section deleted successfully.");
        } else {
            addError("An error occured while deleting section.");
        }

    }
}
