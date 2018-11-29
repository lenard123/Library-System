<?php

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

//Initialize variables
$not_found = false;
$error = false;


//Check if theres an id
if(!isset($_GET['id'])) {
    redirect("grade");
}

$id = trim($_GET['id']); //Assign the id to variable id


/******************************
 * CHECK IF THE ID IS VALID
 ******************************/

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



/****************************
 * Update Grade Level
 ****************************/
if (!$not_found && !$error && isset($_POST['name'])) {

    $name = trim($_POST['name']); // Assigned the data to variable name

    //Validate name
    if (strlen($name) < 1) {
        addError("Name is required!"); // Add validation error
    }


    if (!hasError()) { // Will only execute if there's no error

        // Create a prepared statement
        $stmt = $conn->prepare("SELECT * FROM `grades` WHERE `name`=? AND `id` <> ?");

        if ($stmt->bind_param('si', $name, $id)) {//Bind parameters

            //Execute query
            $stmt->execute();

            //Store the result to varable result
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {//Check if name already exists

                addError('Name already exists.');//Add error message

            } else {

                // Create a prepared state for update grades
                $query = $conn->prepare("UPDATE `grades` SET `name`=? WHERE `id`=?");

                if ($query->bind_param('si', $name, $id)) {//Bind query


                    if ($query->execute()) { //Execute query

                        addSuccess('Grade updated successfully');
                        $grade['name'] = $name;

                    } else {
        
                        addError('An error occured, while updating the grade!');

                    }

                }

            }

        } else {

            addError('An error occured, while updating the grade!');

        } 
    }

}
