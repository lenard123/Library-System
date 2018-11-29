<?php require __DIR__."/../../scripts/student/logs.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student/index.php"); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <h1>"<?= $student['name']; ?>"</h1>
        <hr/>

        <div class="form-group">
            <a class="btn btn-outline-secondary" href="<?= getBackLink(); ?>">Back</a>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="jumbotron pt-5 pb-5">
                    <h5>
                        <div><b>#ID : </b> <?= $student['id']; ?></div>
                        <div><b>Grade : </b> <?= getGradeNameBySectionId($student['section_id']); ?></div>
                        <div><b>Section : </b> <?= getSectionName($student['section_id']); ?></div>
                        <div><b>Contact No. : </b><?= optional($student['number'], "No number"); ?></div>
                        <div><b>Status : </b><?= getStatus($student['status']); ?></div>
                    </h5>
                    <div class="pt-2">
                        <a class="btn btn-info text-white" href="<?= _public("pages/student/borrow.php?ref=$ref&id=".$student['id']); ?>">Borrow Books</a>
                        <a class="btn btn-danger text-white" href="<?= _public("pages/student/ban.php?ref=$ref&id=".$student['id']); ?>">Ban Student</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="card-title"><h4>Borrowed Books</h4></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Borrowed Date</th>
                                    <th scope="col">Return</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($borrowed_books->num_rows < 1) : ?>
                                    <tr>
                                        <th scope="row" colspan="5">No borrowed books</th>
                                    </tr>
                                <?php endif; ?>
                                <?php while ($borrowed_book = $borrowed_books->fetch_assoc()) : ?>
                                    <tr>
                                        <th scope="row"><?= $borrowed_book['book_id']; ?></th>
                                        <td><?= $borrowed_book['title']; ?></td>
                                        <td><?= $borrowed_book['author']; ?></td>
                                        <td><?= getDays($borrowed_book['borrowed_date']); ?></td>
                                        <td>
                                            <a class="btn btn-success text-white" href="<?= _public("pages/student/return.php?id=".$borrowed_book['id']); ?>">Return</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="card-title"><h4>Returned Books</h4></div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#ID</th>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">AUTHOR</th>
                                    <th scope="col">Borrowed Date</th>
                                    <th scope="col">Returned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($returned_books->num_rows < 1) : ?>
                                    <tr>
                                        <th scope="row" colspan="5">No returned books yet.</th>
                                    </tr>
                                <?php endif; ?>
                                <?php while ($book = $returned_books->fetch_assoc()) : ?>
                                    <tr>
                                        <th scope="row"><?= $book['id']; ?></th>
                                        <td><?= $book['title']; ?></td>
                                        <td><?= $book['author']; ?></td>
                                        <td><?= getDays($book['borrowed_date']); ?></td>
                                        <td><?= duration($book['borrowed_date'], $book['returned_date']); ?></td>
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
