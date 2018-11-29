<?php require __DIR__."/../../scripts/student/return.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Return Book</h1>
    <hr/>

    <?php if ($not_found) : ?>

        <div class="jumbotron">
            <h1>Log not found</h1>
            <h3>Click <a href="<?= _public("pages/student/index.php"); ?>">here</a> to go back.</h3>
        </div>

    <?php elseif ($is_returned) : ?>

        <div class="jumbotron">
            <h1>This book is already returned</h1>
            <h3>Click <a href="<?= _public("pages/student/logs.php?id={$student['id']}"); ?>">here</a> to go back.</h3>
        </div>

    <?php else : ?>

        <h3>Are you sure that this book titled "<?= $book['title'] ?>" is returned by student <?= $student['name']; ?>?</h3>
        <form action="" method="POST">

            <?= showErrors(); ?>
            <?= showSuccess(); ?>

            <div class="form-group">
                <?php if (!isSuccess()) : ?>
                    <button name="submit" type="submit" class="btn btn-success text-white">Confirm</button>
                <?php endif; ?>
                <a href="<?= _public("pages/student/logs.php?id={$student['id']}"); ?>" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>

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
