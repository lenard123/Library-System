<?php

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

//Initialize variable
$not_found = false;
$error = false;
$grade = array();
$has_section = false;

//Check if there's an id
if (!isset($_GET['id'])) {
    redirect("grade");
}

$id = trim($_GET['id']); //Assign the id to variable id

/*******************************
 * CHECK IF THE ID IS VALID
 *******************************/

//Create a prepared statement
$stmt = $conn->prepare("SELECT * FROM `grades` WHERE `id`=?");

//Bind parameters
if ($stmt->bind_param("i", $id)) {

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $grade = $result->fetch_assoc();

    } else {

        $not_found = true;

    }


} else {
    $error = true;
}


/***********************
 * DELETE GRADE LEVEL
 ***********************/
if (!$error && !$not_found && isset($_POST['submit'])) {


    /***************************************************
     * Check if there's a section belong to this grade
     ***************************************************/

    //create a prepared statement
    $stmt = $conn->prepare("SELECT * FROM `sections` WHERE `grade_id`=?");

    //Bind parameters
    $stmt->bind_param("i", $id);

    //Execute query
    $stmt->execute();

    //Get the result and assign it to the variable result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $has_section = TRUE;
        addError("Failed to delete, there's a section belongs to this grade.");
    }

 
    if (!$has_section) { //Will only delete if there's no section

        //Create a prepared statement
        $stmt = $conn->prepare("DELETE FROM `grades` WHERE `id`=?");

        if ($stmt->bind_param("i", $id)) { //Bind Params

            if ($stmt->execute()) { //Execute query

                addSuccess('Deleted Successfully!');

            } else {

                addError('An error occured while deleting the grade.');

            }

        }

    }

}
