<?php require_once __DIR__."/../../scripts/book/delete.php" ?>
<?php require_once __DIR__."/../../templates/header.php" ?>

<div class="content">

    <h1>Delete Books</h1>
    <hr/>

    <?php if ($notfound) : ?>
        <div class="jumbotron">
            <h1>Book no found</h1>
            <h3>Click <a href="<?= _public("pages/book") ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Are you sure to delete "<?= $book["title"] ?>"?</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="alert alert-warning">
                            <b>Warning!!!</b> Deleting this book will also delete the logs of students who returned and borrowed this book.
                        </div>

                        <div class="form-group">
                            <label>Type "CONFIRM"</label>
                            <input type="text" name="confirm" class="form-control" placeholder="To avoid accidental click." autocomplete="off">
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Submit" class="btn btn-danger">
                            <a href="<?= _public("pages/book#book-$id") ?>" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>

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
