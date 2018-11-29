<!-- Include Script -->
<?php require __DIR__."/../../scripts/section/index.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">
    <h1>Manage Sections</h1>
    <hr/>

    <div class="card col-md-9">
        <div class="card-body">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">GRADE</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($sections->num_rows < 1) : ?>
                        <tr>
                            <td colspan="4">No sections found in database.</td>
                        </tr>
                    <?php endif; ?>

                    <?php while ($section = $sections->fetch_assoc()) : ?>
                        <tr id="section-<?= $section['id']; ?>">
                            <th scope="row"><?= $section['id']; ?></th>
                            <td><?= $section['name']; ?></td>
                            <td><?= getGradeName($section['grade_id']); ?></td>
                            <td>
                                <a class="btn btn-primary text-white" href="<?= _public("pages/section/update.php?id=".$section['id']); ?>">Update</a>
                                <a class="btn btn-success text-white" href="<?= _public("pages/section/students.php?ref=section&id=".$section['id']); ?>">View Students</a>
                                <a class="btn btn-danger text-white" href="<?= _public("pages/section/delete.php?id=".$section['id']); ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#managesection');
</script>
</body>
</html>