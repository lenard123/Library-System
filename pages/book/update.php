<?php require_once __DIR__."/../../scripts/book/update.php" ?>
<?php require_once __DIR__."/../../templates/header.php" ?>

<div class="content">

    <h1>Update Books</h1>
    <hr/>

    <?php if ($notfound) : ?>
        <div class="jumbotron">
            <h1>Book no found</h1>
            <h3>Click <a href="<?= _public("pages/book") ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="card col-md-6">
            <div class="card-body">
                <form method="POST" action="">

                    <?= showSuccess() ?>
                    <?= showErrors() ?>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="<?= $book["title"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" name="author" class="form-control" value="<?= $book["author"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Stocks in Library</label>
                        <input type="number" name="quantity" class="form-control" value="<?= $book["quantity"] ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Short Description</label>
                        <textarea class="form-control" name="description"><?= $book["description"] ?></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success">
                        <a href="<?= _public("pages/book#book-$id") ?>" class="btn btn-outline-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>

    <?php endif ?>    


</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#managebooks');
</script>
</body>
</html>
