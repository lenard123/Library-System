<?php require __DIR__."/../../scripts/student/delete.php" ?>
<?php require __DIR__."/../../templates/header.php" ?>

<div class="content">

<h1>Delete Student</h1>
<hr/>

    <?php if ($notfound) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student") ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>
        <div class="card col-md-6">
            <div class="card-body">
                <h3>Are you sure to delete "<?= $student['name'] ?>"?</h3>
                <form method="POST" action="">
                    <div class="alert alert-warning">
                        <b>Warning!!!</b> Deleting a student will also delete all of its recording, including the borrowed and returned books.
                    </div>

                    <?= showErrors() ?>
                    <?= showSuccess() ?>
                    
                    <div class="form-group">
                        <label>Type "CONFIRM"</label>
                        <input type="text" class="form-control" autocomplete="off" required="" name="confirm" />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-danger text-white" value="Submit"/>
                        <a class="btn btn-outline-secondary" href="<?= getBackLink() ?>">Back</a>
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