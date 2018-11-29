<?php

require_once __DIR__."/../../Conn.php";

function stocksInLibrary ($book_id)
{
    global $conn;

    $book_query = $conn->query("SELECT * FROM `books` WHERE `id`=$book_id");
    $book = $book_query->fetch_assoc();
    $book_quantity = $book['quantity'];

    $borrowed_books = $conn->query("SELECT * FROM `logs` WHERE `book_id`=$book_id AND `returned_date` IS NULL");
    return $book_quantity - $borrowed_books->num_rows;
}
