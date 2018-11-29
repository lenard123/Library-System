<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

$grades = $conn->query("SELECT * FROM `grades`");

$isvalid = false;

if (isset($_GET['grade_id'])) {

    $grade_id = $_GET['grade_id'];

    //Validate Grade id
    $stmt = $conn->prepare("SELECT * FROM `grades` WHERE `id`=?");
    $stmt->bind_param("i", $grade_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows >= 1) {
        $isvalid = TRUE;
        $grade = $result->fetch_assoc();
    }

    if ($isvalid) {

        /******************
         * GET SECTIONS
         ******************/
        $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `grade_id`=?");
        $stmt->bind_param("i", $grade_id);
        $stmt->execute();
        $sections = $stmt->get_result();


        if (isset($_POST['name']) && isset($_POST['section_id']) && isset($_POST['number'])) {

            $name = trim($_POST['name']);
            $section_id = trim($_POST['section_id']);
            $number = trim($_POST['number']);

            //Validate Name
            if (empty($name)) {
                addError("Name is required");
            }

            //Check if there's already with the same name
            $stmt = $conn->prepare("SELECT * FROM `students` WHERE `name`=?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                addError("Name already exists.");
            }

            //Validate number
            if (!empty($number) && strlen($number) != 11) {
                addError("Number must be 11 digit.");
            }

            //Validate Section ID
            $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `grade_id`=? AND `id`=?");
            $stmt->bind_param("ii", $grade_id, $section_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows < 1) {
                addError("Invalid Section");
            }


            //Register Student if no error
            if (!hasError()) {

                $stmt = $conn->prepare("INSERT INTO `students` (`name`, `number`, `section_id`) VALUES (?, ?, ?) ");
                $stmt->bind_param("ssi", $name, $number, $section_id);
                if ($stmt->execute()) {
                    addSuccess("Student Registered Successfully.");
                } else {
                    addError("An error occured, while registering the students.");
                }

            }

        }
    }
}