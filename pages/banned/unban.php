<?php require __DIR__."/../../scripts/banned/unban.php" ?>
<?php require __DIR__."/../../templates/header.php" ?>

<div class="content">

    <h1>Un-ban Student</h1>
    <hr/>

    <?php if ($notfound) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/banned") ?>">here</a> to go back.</h3>
        </div>
    <?php elseif ($isnotbanned) : ?>
        <div class="jumbotron">
            <h1>This student, <?= $student['name'] ?> is not banned.</h1>
            <h3>Click <a href="<?= _public("pages/banned") ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>
        <h3> Are you sure to unban "<?= $student['name'] ?>"?</h3>

        <div class="card col-md-6">
            <div class="card-body">
                <form method="POST" action="">
                    <?= showErrors() ?>
                    <?= showSuccess() ?>
                    <?php if (!isSuccess()) : ?>
                    <div class="alert alert-warning">
                        <b>Warning!!!</b> This student is banned because of the following reason : <br/>
                        <p><?= $student['reason'] ?></p>
                    </div>

                    <div class="form-group">
                        <label>Type "CONFIRM"</label>
                        <input type="text" placeholder="To prevent accidental clicking" autocomplete="off" name="confirm" class="form-control" required=""/>
                    </div>

                    <?php endif ?>

                    <div class="form-group">
                        <?php if (!isSuccess()) : ?>
                            <input type="submit" class="btn btn-outline-danger" value="Un-ban"/>
                        <?php endif; ?>
                        <a href="<?= _public("pages/banned/index.php#student-$id") ?>" class="btn btn-outline-secondary">Back</a>
                    </div>

                </form>
            </div>
        </div>

    <?php endif; ?>

</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script type="text/javascript">
    setActiveLink("#bannedstudents");
</script>
</body>
</html>