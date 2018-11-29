<?php require __DIR__."/../../scripts/book/index.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Manage Books</h1>
    <hr/>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">TITLE</th>
                <th scope="col">AUTHOR</th>
                <th scope="col">TOTAL QUANTITY</th>
                <th scope="col">IN LIBRARY</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($books->num_rows < 1) : ?>
                <tr>
                    <th scope="row" colspan="5">No books in database</th>
                </tr>
            <?php endif; ?>
            <?php while ($book = $books->fetch_assoc()) : ?>
                <tr id="book-<?= $book["id"] ?>">
                    <th scope="row"><?= $book['id']; ?></th>
                    <td><?= $book['title']; ?></td>
                    <td><?= optional($book['author'], "???"); ?></td>
                    <td><?= $book['quantity']; ?></td>
                    <td><?= stocksInLibrary($book['id']); ?></td>
                    <td>
                        <a class="btn btn-primary text-white" href="<?= _public("pages/book/update.php?id={$book['id']}") ?>">Update</a>
                        <a class="btn btn-success text-white">View Info</a>
                        <a class="btn btn-danger  text-white">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#managebooks');
</script>
</body>
</html>
