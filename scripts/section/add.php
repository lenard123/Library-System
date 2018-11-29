<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

$grades = $conn->query("SELECT * FROM `grades`");

if (isset($_POST['grade_id']) && isset($_POST['name'])) {

    $grade_id = trim($_POST['grade_id']); 
    $name = trim($_POST['name']);

    /******************
     * VALIDATE DATA
     ******************/
    if (strlen($name) < 1) {
        addError("Name is required.");
    }

    /***************************
     * CHECK IF GRADE EXISTS
     ***************************/
    $stmt = $conn->prepare("SELECT * FROM `grades` WHERE `id`=?");
    $stmt->bind_param("i", $grade_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
        addError("Invalid Grade id");
    }
    $stmt->close();

    /*****************************************
     * CHECK IF NAME EXISTS IN THE SAME GRADE
     *****************************************/
    $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `name`=? AND `grade_id`=?");
    $stmt->bind_param("si", $name, $grade_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        addError("Name already Exists!");
    }
    $stmt->close();

    /***********************
     * ADD GRADE
     ***********************/
    if (!hasError()) { //will only execute if there's no error

        $stmt = $conn->prepare("INSERT INTO `sections` (`name`, `grade_id`) VALUES (?,?)");
        $stmt->bind_param("si", $name, $grade_id);

        if ($stmt->execute() === TRUE) {
            addSuccess("Section add successfully.");
        } else {
            addError("An error occured while adding section");
        }


    }    

}

