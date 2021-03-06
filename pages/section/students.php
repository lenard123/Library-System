<?php require __DIR__."/../../scripts/section/students.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Manage Students <?= !$not_found ? "of ".getGradeNameBySectionId($id). " ".$section['name'] : ""; ?> </h1>
    <hr/>

    <?php if ($not_found) : ?>
        <div class="jumbotron">
            <h1>Section not found</h1>
            <h3>Click <a href="<?= getBackLink(); ?>">here</a> to go back.</h3>
        </div>
    <?php else : ?>

        <div class="card">

            <div class="card-header">
                <a href="<?= getBackLink(); ?>" class="btn btn-outline-secondary">Back</a>
            </div>

            <div class="card-body">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col">GRADE</th>
                            <th scope="col">SECTION</th>
                            <th scope="col">CONTACT NUMBER</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php if ($students->num_rows < 1) : ?>
                            <tr>
                                <th scope="row" colspan="6">No Students in this section</th>
                            </tr>
                        <?php endif; ?>
                        <?php while($student = $students->fetch_assoc()) : ?>
                            <tr id="student-<?= $student['id']; ?>">
                                <th scope="row"><?= $student['id']; ?></th>
                                <td><?= $student['name']; ?></td>
                                <td><?= getGradeNameBySectionId($student['section_id']); ?></td>
                                <td><?= getSectionName($student['section_id']); ?></td>
                                <td><?= optional($student['number'], "No number"); ?></td>
                                <td>
                                    <a class="btn btn-primary text-white" href="<?= _public("pages/student/update.php?ref=$ref&id={$student['id']}") ?>">Update info</a>
                                    <a class="btn btn-success text-white" href="<?= _public("pages/student/logs.php?ref=$ref&id={$student['id']}") ?>">View Logs</a>
                                    <a class="btn btn-danger text-white" href="<?= _public("pages/student/delete.php?ref=$ref&id={$student['id']}") ?>">Delete Student</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

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
