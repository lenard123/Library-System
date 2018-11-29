<!-- Include Scsript -->
<?php require __DIR__."/../../scripts/grade/delete.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Delete Grade</h1>
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

                    <div class="alert alert-info">
                        <strong>Note : </strong>
                        You can't delete a grade level if there is 
                        a section or students belongs to it.
                    </div>

                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <h4>Are you sure to delete "<?= $grade['name']; ?>"?</h4>

                    <div class="form-group">

                        <?php if (!isSuccess()) : ?>
                            <button type="submit" name="submit" class="btn btn-danger text-white">Delete</button>
                        <?php endif; ?>

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