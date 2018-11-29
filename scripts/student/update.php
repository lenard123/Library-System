<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET['id'])) {
    redirect("student");
}

$id = $_GET['id'];
$notfound = false;
$ref = isset($_GET["ref"]) ? $_GET["ref"] : "student";


$stmt = $conn->prepare("SELECT `students`.*, `sections`.`grade_id` FROM `students` JOIN `sections` ON `students`.`section_id`=`sections`.`id` WHERE `students`.`id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result();

if ($student->num_rows < 1) {
    
    $notfound = TRUE;

} elseif (isset($_GET["update"]) && $_GET["update"]=="grade"){

    $grades = $conn->query("SELECT * FROM `grades`");

} elseif (isset($_GET["update"]) && $_GET["update"] == "section"  && isset($_GET["grade_id"])) {

    $grade_id = trim($_GET["grade_id"]);
    $valid_grade = true;
    $stmt = $conn->prepare("SELECT * FROM `grades` WHERE `id`=?");
    $stmt->bind_param("i", $grade_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows < 1) {
        $valid_grade = false;
    } else {
        $grade = $result->fetch_assoc();
        $sections = $conn->query("SELECT * FROM `sections` WHERE `grade_id`=$grade_id");

        if (isset($_POST["section_id"])) {
            $section_id = trim($_POST["section_id"]);

            $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `id`=?");
            $stmt->bind_param("i", $section_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows < 1) {
                addError("Invalid section");
            }

            if (!hasError()) {
                $stmt = $conn->prepare("UPDATE `students` SET `section_id`=? WHERE `id`=$id");
                $stmt->bind_param("i", $section_id);
                if ($stmt->execute()) {
                    addSuccess("Updated successfully");
                } else {
                    addError("An error occured");
                }
            }

        }

    }

} else {

    $student = $student->fetch_assoc();
    $sections = $conn->query("SELECT * FROM `sections` WHERE `grade_id`={$student['grade_id']}");

    function getBackLink ()
    {
        global $student, $ref;
        if ($ref=="section" || $ref=="grade") {
            return _public("pages/section/students.php?ref=$ref&id={$student["section_id"]}#student-{$student['id']}");
        } else {
            return _public("pages/student/#student-{$student['id']}");
        }
    }

    if (isset($_POST["name"]) && isset($_POST["section_id"]) && isset($_POST["number"])) {
        $name = trim($_POST["name"]);
        $section = trim($_POST["section_id"]);
        $number = trim($_POST["number"]);

        if (empty($name)) {
            addError("Name is required");
        }   

        if (empty($section)) {
            addError("section is required");
        }

        $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `id`=?");
        $stmt->bind_param("i", $section);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows < 1) {
            addError("Invalid section");
        }

        $stmt = $conn->prepare("SELECT * FROM `students` WHERE `name`=? AND `id`<>$id");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            addError("Name already Exist");
        }

        if (!hasError()) {

            $stmt = $conn->prepare("UPDATE `students` SET `name`=?, `section_id`=?, `number`=? WHERE `id`=?");
            $stmt->bind_param("sisi", $name, $section, $number, $id);
            $result = $stmt->execute();
            if ($result) {
                addSuccess("Student updated successfully.");
                $student["name"] = $name;
                $student["section_id"] = $section;
                $student["number"] = $number;
            } else {
                addError("An error occured");
            }

        }

    }

}
