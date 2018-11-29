<!--- Include Script -->
<?php require __DIR__."/../../scripts/section/add.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>ADD SECTION</h1>
    <hr/>

    <div class="card col-md-6">
        <div class="card-body">

            <form method="POST" action="">

                <?= showErrors(); ?>
                <?= showSuccess(); ?>

                <div class="form-group">

                    <label>Grade:</label>
                    <select class="form-control" required="" name="grade_id">
                        <option disabled="" selected="">--- SELECT GRADE ---</option>
                        <?php while ($grade = $grades->fetch_assoc()) : ?>
                            <option value="<?= $grade['id']; ?>"><?= $grade['name']; ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <div class="form-group">

                    <label>Section:</label>
                    <input type="text" name="name" class="form-control" required="" placeholder="(e.g. ICT-B)">

                </div>

                <div class="form-group">

                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-outline-secondary" value="Reset">

                </div>
            </form>

        </div>
    </div>

</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#addsection');
</script>
</body>
</html>
