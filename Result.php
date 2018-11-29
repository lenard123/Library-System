<?php 

$errors = array();
$successes = array();

function addError ($error) {
    global $errors;
    array_push($errors, $error);
}

function addSuccess ($success) {
    global $successes;
    array_push($successes, $success);
}

function showErrors () {

    //Include variable errors
    global $errors; 

    //Stop Executing If there is no error
    if (!hasError()) return; 

    //Inititalize error result
    $result = "<div class='alert alert-danger' role='alert'>";
    $result .= '<ul>';

    //Show error messages in an unordered list
    foreach ($errors as $error) {
        $result .= "<li>$error</li>";    
    }

    //Close result
    $result .= "</ul>";
    $result .= "</div>";

    return $result;

}

function showSuccess () {

    //Include variable success
    global $successes;

    //Stop executing if not success
    if (!isSuccess()) return;

    //Inititalize error result
    $result = "<div class='alert alert-success' role='alert'>";
    $result .= '<ul>';

    //Show error messages in an unordered list
    foreach ($successes as $success) {
        $result .= "<li>$success</li>";    
    }

    //Close result
    $result .= "</ul>";
    $result .= "</div>";

    return $result;

}

function isSuccess () {
    global $successes;
    return count($successes) > 0;
}

function hasError () {
    global $errors;
    return count($errors) > 0;
}