<!-- Include Script -->
<?php require __DIR__."/../../scripts/grade/update.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Update Grade</h1>
    <hr/>


    <?php if ($error) : ?>

        <div class="jumbotron">
            <h1>An error occured</h1>
        </div>

    <?php elseif ($not_found):?>

        <div class="jumbotron">
            <h1>Grade Not Found</h1>
            <h3>Click <a href="<?= _public('pages/grade/index.php'); ?>">here</a> to go back</h3>
        </div>

    <?php else: ?>

        <div class="card col-md-6">
            <div class="card-body">

                <form method="POST" action="">

                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <div class="form-group">
                        <label>Grade : </label>
                        <input type="text" name="name" value="<?= $grade['name']; ?>" class="form-control" required="" placeholder="(e.g. Grade 11)" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-outline-secondary" href="<?= _public('pages/grade/index.php#grade-'.$grade['id']); ?>">Back</a>
                    </div>

                </form>
            </div>
        </div>

    <?php endif; ?>

</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#managegrade');
</script>
</body>
</html>