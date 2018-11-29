<?php require __DIR__."/../../scripts/student/confirm.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Borrow this book?</h1>
    <hr/>

    <?php if ($not_found['student']) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student/index.php"); ?>">here</a> to go back.</h3>
        </div>
    <?php elseif ($not_found['book']) : ?>
        <div class="jumbotron">
            <h1>Book not found</h1>
            <h3>Click <a href="<?= _public("pages/student/borrow.php?ref=$ref&id=$id"); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <h3>Are you sure to let "<?= $student['name']; ?>" borrow the book titled "<?= $book['title']; ?>"?</h3>
        <form action="" method="POST">

            <?php if (stocksInLibrary($book['id']) < 3) : ?>
            <div class="alert alert-warning">
                <b>Warning : </b> There's only less than 3 copy left of this book in library.
            </div>
            <?php endif; ?>

            <?= showErrors(); ?>
            <?= showSuccess(); ?>

            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-success text-white">Confirm</button>
                <a href="<?= _public("pages/student/borrow.php?ref=$ref&id=$id"); ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>

        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">Book Information</h3>
                <div class="row">

                    <div class="col-md-4">
                        <div class="jumbotron pt-4 pb-4">
                            <h5>
                                <div><b>#ID : </b> <?= $book['id']; ?></div>
                                <div><b>TITLE : </b> <?= $book['title']; ?></div>
                                <div><b>AUTHOR : </b> <?= optional($book['author'], "???"); ?></div>
                                <div><b>TOTAL QUANTITY : </b> <?= $book['quantity']; ?></div>
                                <div><b>IN LIBRARY : </b><?= stocksInLibrary($book['id']); ?></div>
                                <div><b>DESCRIPTION :</b><p><?= optional($book['description'], "No description"); ?></p></div>
                            </h5>
                        </div>                        
                    </div>

                    <div class="col-md-8">
                        <h3>Student who borrowed this books</h3>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>NAME</th>
                                    <th>GRADE</th>
                                    <th>SECTION</th>
                                    <th>STATUS</th>
                                    <th>BORROWED DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($borrowers->num_rows < 1) : ?>
                                    <tr>
                                        <th colspan="6">There's no borrower of this book</th>
                                    </tr>
                                <?php endif;?>
                                <?php while ($borrower = $borrowers->fetch_assoc()) : ?>
                                    <tr>
                                        <th><?= getStudent($borrower['student_id'])['id']; ?></th>
                                        <td><?= getStudent($borrower['student_id'])['name']; ?></td>
                                        <td><?= getGradeNameBySectionId(getStudent($borrower['student_id'])['section_id']); ?></td>
                                        <td><?= getSectionName(getStudent($borrower['student_id'])['section_id']); ?></td>
                                        <td><?= getStatus(getStudent($borrower['student_id'])['status']); ?></td>
                                        <td><?= getDays($borrower['borrowed_date']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">Student Information</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="jumbotron pt-4 pb-4">
                            <h5>
                                <div><b>#ID : </b> <?= $student['id']; ?></div>
                                <div><b>NAME : </b> <?= $student['name']; ?></div>
                                <div><b>Grade : </b> <?= getGradeNameBySectionId($student['section_id']); ?></div>
                                <div><b>Section : </b> <?= getSectionName($student['section_id']); ?></div>
                                <div><b>Contact No. : </b><?= optional($student['number'], "No number"); ?></div>
                                <div><b>Status : </b><?= getStatus($student['status']); ?></div>
                            </h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h3>Borrowed books</h3>
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
                                        <th><?= $borrowed_book['id']; ?></th>
                                        <td><?= getTitle($borrowed_book['id']); ?></td>
                                        <td><?= getAuthor($borrowed_book['id']); ?></td>
                                        <td><?= getDays($borrowed_book['borrowed_date']); ?></td>
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
