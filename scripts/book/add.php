<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Result.php";

if (isset($_POST['title']) && isset($_POST['quantity'])) {

    $title = trim($_POST['title']);
    sscanf($_POST['quantity'], "%d", $quantity);
    $author = trim($_POST['author']);
    $description = trim($_POST['description']);

    if (empty($title)) {
        addError("Title is required.");
    }

    if (empty($quantity)) {
        addError("Quantity is required");
    }

    $stmt = $conn->prepare("SELECT * FROM `books` WHERE `title`=? AND `author`=?");
    $stmt->bind_param("ss", $title, $author);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        addError("A book with the same title and author already exists!");
    }

    if (!hasError()) {

        $stmt = $conn->prepare("INSERT INTO `books` (`title`, `quantity`, `author`, `description`) VALUES (?,?,?,?) ");
        $stmt->bind_param("siss", $title, $quantity, $author, $description);

        if ($stmt->execute() === TRUE) {
            addSuccess("Book added successfully.");
        } else {
            addError("An error occured while adding the book.");
        }
    }




}
