<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET['id'])) {
    redirect("student");
}

$id = $_GET['id'];
$is_returned = false;
$not_found = false;

$stmt = $conn->prepare("SELECT * FROM `logs` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found = TRUE;
} else {

    $log = $result->fetch_assoc();
    
    $student = $conn->query("SELECT * FROM `students` WHERE `id`={$log['student_id']}")->fetch_assoc();
    $book = $conn->query("SELECT * FROM `books` WHERE `id`={$log['book_id']}")->fetch_assoc();

    if($log['returned_date']){
    
        $is_returned = true;
    
    } else {

        if (isset($_POST['submit'])) {
            $now = date("Y-m-d");
            $query = "UPDATE `logs` SET `returned_date`='$now' WHERE `id`=$id";
            if ($conn->query($query)) {
                addSuccess("Book return successfully");
            } else {
                addError("An error occured while returning the book.");
            }
        }

    }

}

