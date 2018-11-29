<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/student_helper.php";

$not_found = false;

if (!isset($_GET['id'])) {
    redirect("student");
}

$id = $_GET['id'];
$ref = isset($_GET['ref']) ? $_GET['ref'] : "student";

$stmt = $conn->prepare("SELECT * FROM `students` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found = true;
} else {

    $student = $result->fetch_assoc();

    $query = "SELECT 
                `logs`.`id`, 
                `books`.`title`, 
                `books`.`author`,
                `logs`.`book_id`,
                `logs`.`borrowed_date`
              FROM `logs` 
              JOIN `books`
              ON `logs`.`book_id`=`books`.`id` 
              WHERE 
                 `logs`.`returned_date` IS NULL
                 AND `logs`.`student_id`=$id";
    $borrowed_books = $conn->query($query);

    $query = "SELECT
                `books`.`title`,
                `books`.`author`,
                `books`.`id`,
                `logs`.`borrowed_date`,
                `logs`.`returned_date`
              FROM `logs`
              JOIN `books`
              ON `logs`.`book_id`=`books`.`id`
              WHERE
                 `logs`.`returned_date` IS NOT NULL
                 AND `logs`.`student_id`=$id";
    $returned_books = $conn->query($query);


    function duration ($from, $to)
    {
        $from = date_create($from);
        $to = date_create($to);

        $diff = date_diff($from, $to);

        switch ($diff->days) {
            case 0:
                return "Same day";
                break;
            
            case 1:
                return "After 1 day";

            default:
                return "After {$diff->days} days";
                break;
        }
    }

    function getBackLink () {
        global $student, $id, $ref;
        if ($ref == "grade" || $ref == "section") {
            $section_id = $student['section_id'];
            return _public("pages/section/students.php?ref=$ref&id=$section_id#student-$id");
        } else {
            return _public("pages/student#student-$id");
        }
    }
}

