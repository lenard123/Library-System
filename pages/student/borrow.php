<?php require __DIR__."/../../scripts/student/borrow.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">
    <h1>Borrow Books</h1>
    <hr/>


    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student/index.php"); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <a href="<?= _public("pages/student/logs.php?ref=$ref&id=$id"); ?>" class="btn btn-outline-secondary mb-2">Go Back</a>
    
        <div class="row">

            <div class="col-md-5">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h3>Borrowed Books</h3></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>TITLE</th>
                                    <th>AUTHOR</th>
                                    <th>BORROWED DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($borrowed_books->num_rows < 1) : ?>
                                    <tr>
                                        <th colspan="4">No borrowed books</th>
                                    </tr>
                                <?php endif; ?>
                                <?php while ($borrowed_book = $borrowed_books->fetch_assoc()) : ?>
                                    <tr>
                                        <th><?= getBook($borrowed_book['book_id'])['id']; ?></th>
                                        <td><?= getBook($borrowed_book['book_id'])['title']; ?></td>
                                        <td><?= optional(getBook($borrowed_book['book_id'])['author'], "???"); ?></td>
                                        <td><?= getDays($borrowed_book['borrowed_date']); ?></td>
                                    </tr>
                                <?php endwhile;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title"><h3>List of Books</h3></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>TITLE</th>
                                    <th>AUTHOR</th>
                                    <th>TOTAL QUANTITY</th>
                                    <th>IN LIBRARY</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php if ($books->num_rows < 1) : ?>
                                    <tr>
                                        <th colspan="5">No books in database</th>
                                    </tr>
                                <?php endif; ?>
                                <?php while ($book = $books->fetch_assoc()) : ?>
                                    <tr>
                                        <td><?= $book['title']; ?></td>
                                        <td><?= optional($book['author'], "???"); ?></td>
                                        <td><?= $book['quantity']; ?></td>
                                        <td><?= stocksInLibrary($book['id']) ?></td>
                                        <td><a class="btn btn-primary text-white" href="<?= _public("pages/student/confirm.php?ref=$ref&id=$id&book_id={$book['id']}"); ?>">Borrow</a></td>
                                    </tr>
                                <?php endwhile; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>                    

        </div>

    <?php endif; ?>

</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#managestudents');
</script>
</body>
</html>
