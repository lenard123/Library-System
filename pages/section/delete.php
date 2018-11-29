<?php require __DIR__."/../../scripts/section/delete.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Delete Section</h1>
    <hr/>

    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Section not found</h1>
            <h3>Click <a href="<?= _public('pages/section/index.php'); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="card col-md-6">
            <div class="card-body">

                <form method="POST" action="" >

                    <div class="alert alert-info">
                        <strong>Note : </strong>
                        You can't delete a section if there's a students belongs to it
                    </div>

                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <h4> Are you sure to delete "<?= $section['name']; ?>"?</h4>
                    <div class="form-group">
                        <?php if (!isSuccess()) : ?>
                            <button type="submit" name="submit" class="btn btn-danger text-white">Delete</button>
                        <?php endif; ?>
                        <a href="<?= getBackLink(); ?>" class="btn btn-outline-secondary">Back</a>
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
    setActiveLink('#managesection');
</script>
</body>
</html>
