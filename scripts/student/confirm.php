<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/student_helper.php";
require_once __DIR__."/book.php";
require_once __DIR__."/../../Config.php";
require_once __DIR__."/../../Result.php";

$not_found = array(
    "student" => FALSE, 
    "book" => FALSE,
);

if (!isset($_GET['id'])) {
    redirect("student");
}


$id = $_GET['id'];
$ref = isset($_GET['ref']) ? $_GET['ref'] : "student";

if (!isset($_GET['book_id'])) {
    header("Location: "._public("pages/student/borrow.php?id=$id"));
}

$book_id = $_GET['book_id'];

$stmt = $conn->prepare("SELECT * FROM `students` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found['student'] = TRUE;
} else {
    $student = $result->fetch_assoc();
}

$stmt = $conn->prepare("SELECT * FROM `books` WHERE `id`=?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found['book'] = TRUE;
} else {
    $book = $result->fetch_assoc();
}


if (!$not_found['book'] && !$not_found['student']) {

    function getBook ($book_id) {
        global $conn;
        $book = $conn->query("SELECT * FROM `books` WHERE `id`=$book_id");
        return $book->fetch_assoc();
    }

    function getAuthor ($book_id) {
        return optional(getBook($book_id)['author'], "???");
    }

    function getTitle ($book_id) {
        return getBook($book_id)['title'];
    }

    function getStudent ($student_id) {
        global $conn;
        $student = $conn->query("SELECT * FROM `students` WHERE `id`=$student_id");
        return $student->fetch_assoc();
    }


    if (isset($_POST['submit'])) {

        if ($student['status'] == $config['banned']) {
            addError("<b>Banned</b> This student cant borrow a book.");
        }

        if (stocksInLibrary($book['id']) <= 1) {
            addError("There's only 1 copy of this book left in the library.");
        }

        $stmt = $conn->query("SELECT * FROM `logs` WHERE `student_id`=$id AND `book_id`=$book_id AND `returned_date` IS NULL");
        if ($stmt->num_rows >= 1) {
            addError("This student already borrowed a copy of this book.");
        }

        if (!hasError()) {

            $date = date("Y-m-d");
            $stmt = $conn->query("INSERT INTO `logs`(`student_id`, `book_id`, `borrowed_date`) VALUES ($id, $book_id, '$date')");
            if ($stmt) {

                addSuccess("Book borrowed successfully.");

            } else {

                addError("An error occured while borrowing a book.");

            }
        }

    }

    $borrowed_books = $conn->query("SELECT * FROM `logs` WHERE `student_id`=$id AND `returned_date` IS NULL");
    $borrowers = $conn->query("SELECT * FROM `logs` WHERE `book_id`=$book_id AND `returned_date` IS NULL");

}

