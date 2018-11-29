<!-- Inlcude Scripts -->
<?php require __DIR__."/../../scripts/grade/add.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">
    <h1>ADD GRADE LEVEL</h1>
    <hr/>

    <div class="card col-md-6">
        <div class="card-body">

            <form method="POST" action="">

                <?= showErrors(); ?>

                <?= showSuccess(); ?>

                <div class="form-group">
                    <label>Grade : </label>
                    <input type="text" name="name" class="form-control" required="" placeholder="(e.g. Grade 11)" />
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </div>

            </form>

        </div>
    </div>


</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#addgrade');
</script>
</body>
</html>
