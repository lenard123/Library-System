<?php

require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Conn.php";
require_once __DIR__."/book.php";

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
}

if (!$not_found) {

    $books = $conn->query("SELECT * FROM `books` ORDER BY `title`");


    $borrowed_books = $conn->query("SELECT * FROM `logs` WHERE `student_id`=$id AND `returned_date` IS NULL");

    function getBook ($book_id) 
    {
        global $conn;
        $book = $conn->query("SELECT * FROM `books` WHERE `id`=$book_id");
        return $book->fetch_assoc();
    }

}