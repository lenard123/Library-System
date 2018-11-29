<!-- Include Script -->
<?php require __DIR__."/../../scripts/section/update.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Update Section</h1>
    <hr/>

    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Section not found</h1>
            <h3>Click <a href="<?= _public('pages/section/index.php'); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="card col-md-6">
            <div class="card-body">

                <form method="POST" action="">


                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <div class="form-group">
                        <label>Grade : </label>
                        <select class="form-control" disabled="">
                            <option disabled="">-- SELECT GRADE --</option>
                            <?php while($grade = $grades->fetch_assoc()) : ?>
                                <option value="<?= $grade['id']; ?>" <?= $grade['id']==$section['grade_id']?'selected':''; ?>><?= $grade['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="name" class="form-control" value="<?= $section['name']; ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-outline-secondary" href="<?= getBackLink(); ?>">Back</a>
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
