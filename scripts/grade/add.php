<?php 

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

//Only executed if the data is submitted
if (isset($_POST["name"])) {

    $name = trim($_POST["name"]); //Assigned the data to the variable $name


    //Check if valid name
    if (strlen($name) <= 0) {
        addError("Name is required!");
    }

    //Will only execute if there is no error
    if (!hasError()) {

        //Check if name already exists in database
        $query = $conn->prepare("SELECT * FROM `grades` WHERE `name`=?");
        $query->bind_param("s", $name);
        $query->execute();
        $res = $query->get_result();

        if ($res->num_rows > 0) { //Executed when there's already the same name

            addError("Grade already exists!"); //Add Error

        } else {//Insert Grade to database

            //Create a prepared statement to prevent hacking
            $query = $conn->prepare("INSERT INTO `grades` (`name`) VALUES (?)");

            //Bind parameters
            $query->bind_param("s", $name);

            if ($query->execute() === TRUE) { //Executed if success
            
                addSuccess("Grade successfully added!"); //Add Success message

            } else {

                addError("An error occured while adding grade!"); //Add Error message

            }

        }
    }

}