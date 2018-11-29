<?php require __DIR__."/../../scripts/student/ban.php"; ?>
<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">
    <h1>Ban Student</h1>
    <hr/>

    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student/index.php"); ?>">here</a> to go back.</h3>
        </div>
    <?php elseif ($banned) : ?>
        <div class="jumbotron">
            <h1>This student is already banned.</h1>
            <h3>Click <a href="<?= _public("pages/student/logs.php?ref=$ref&id=$id"); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="card col-md-6">

            <div class="card-body">

                <form method="POST" action="">

                    <div class="alert alert-warning">
                        <b>Warning!</b> Banned student, will be restricted from borrowing a books
                    </div>

                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <h3>Are you sure to ban <?= $student['name']; ?>?</h3>
                    <div class="form-group">
                        <label>Reason : </label>
                        <textarea name="reason" required="" class="form-control" placeholder="Enter the reason (required)"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Submit</button>
                        <a href="<?= _public("pages/student/logs.php?ref=$ref&id=$id"); ?>" class="btn btn-outline-secondary">Cancel</a>
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
    setActiveLink('#managestudents');
</script>
</body>
</html>
