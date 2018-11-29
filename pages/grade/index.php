<!--Include Script -->
<?php require __DIR__."/../../scripts/grade/index.php"; ?>

<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Manage Grade Levels</h1>
    <hr/>

    <div class="card col-md-8">
        <div class="card-body">

            <table class="table table-hover">
                
                <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">ACTION</th>
                    </tr>
                </thead>

                <tbody>
                    
                    <?php if($grades->num_rows <= 0): ?>
                    <tr>
                        <td colspan="3">No Grades</td>
                    </tr>
                    <?php endif; ?>

                    <?php while($grade = $grades->fetch_assoc()) :?>
                    <tr id="grade-<?=$grade['id']; ?>">
                        <th scope="row"><?= $grade["id"]; ?></th>
                        <td><?= $grade["name"]; ?></td>
                        <td>
                            <a class="btn btn-primary text-white" href="<?= _public('pages/grade/update.php?id='.$grade['id']); ?>">Update</a>
                            <a class="btn btn-success text-white" href="<?= _public('pages/grade/sections.php?id='.$grade['id']); ?>">View Sections</a>                    
                            <a class="btn btn-danger text-white" href="<?= _public('pages/grade/delete.php?id='.$grade['id']); ?>">Delete</a>
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
    setActiveLink('#managegrade');
</script>
</body>
</html>