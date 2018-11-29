<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET["id"])) {
    redirect("student");
}

$id = $_GET["id"];
$notfound = false;


$stmt = $conn->prepare("SELECT * FROM `students` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $notfound = TRUE;
} else {
    $student = $result->fetch_assoc();

    function getBackLink ()
    {
        global $student;
        
        if (isset($_GET['ref']) && ($_GET['ref']=='section' || $_GET['ref']=='grade')) {
            return _public("pages/section/students.php?id={$student['section_id']}#student-{$student['id']}");
        } else {
            return _public("pages/student/#student-{$student['id']}");
        }
    }

    if (isset($_POST['confirm'])) {

        $confirm = trim($_POST['confirm']);
        if ($confirm !== "CONFIRM") {
            addError("Type the \"CONFIRM\" correctly to delete");
        }

        if (!hasError()) {

            $conn->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            $logs = $conn->query("SELECT * FROM `logs` WHERE `student_id`=$id AND `returned_date` IS NULL");
            while ($log = $logs->fetch_assoc()) {
                $book = $conn->query("SELECT * FROM `books` WHERE `id`={$log['book_id']}")->fetch_assoc();
                $book_quantity = $book['quantity'] - 1;
                if (!$conn->query("UPDATE `books` SET `quantity`=$book_quantity WHERE `id`={$book['id']}")) {
                    $conn->rollback();
                    addError("An error occured");
                    break;
                }
            }

            if (!hasError()) {

                $delete_logs = $conn->query("DELETE FROM `logs` WHERE `student_id`=$id");
                $delete_student = $conn->query("DELETE FROM `students` WHERE `id`=$id");

                if ($delete_logs && $delete_student) {
                    addSuccess("Student deleted successfully");
                    $conn->commit();
                } else {
                    $conn->rollback();
                    addError("An error occured");
                }

            }

        }

    }

}