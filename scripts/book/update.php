<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET["id"])) {
    redirect("book");
}

$id = trim($_GET["id"]);
$notfound = false;

$stmt = $conn->prepare("SELECT * FROM `books` WHERE `id`=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $notfound = TRUE;
} else {
    $book = $result->fetch_assoc();
    $borrowed = $conn->query("SELECT * FROM `logs` WHERE `book_id`=$id AND `returned_date` IS NULL")
                     ->num_rows;
    $book["quantity"] = $book["quantity"] - $borrowed;

    if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["quantity"]) && isset($_POST["description"])) {

        $title = trim($_POST["title"]);
        $author = trim($_POST["author"]);
        $quantity = trim($_POST["quantity"]) + $borrowed;
        $description = trim($_POST["description"]);

        if (empty($title)) {
            addError("Title is required");
        } 

        if (empty($quantity)) {
            addError("Quantity is required");
        }

        if (!empty($quantity) && !is_int($quantity)) {
            addError("Quantity must be a number");
        }

        $stmt = $conn->prepare("SELECT * FROM `books` WHERE `title`=? AND `author`=? AND `id`<>$id");
        $stmt->bind_param("ss", $title, $author);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            addError("A book with the same title and author already exists");
        }

        if (!hasError()) {
            $stmt = $conn->prepare("UPDATE `books` SET `title`=?, `author`=?, `quantity`=?, `description`=? WHERE `id`=$id");
            $stmt->bind_param("ssis", $title, $author, $quantity, $description);
            if ($stmt->execute()) {
                addSuccess("Book updated successfully");
                $book["title"] = $title;
                $book["author"] = $author;
                $book["quantity"] = $quantity-$borrowed;
                $book["description"] = $description;
            } else {
                addError("An error occured while updating the book");
            }
        }

    }

}

