<?php require __DIR__."/../../scripts/student/index.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Manage Students</h1>
    <hr/>

    <div class="card">

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
                                <a class="btn btn-primary text-white" href="<?= _public("pages/student/update.php?id={$student['id']}") ?>">Update info</a>
                                <a class="btn btn-success text-white" href="<?= _public("pages/student/logs.php?id=".$student['id']); ?>">View Logs</a>
                                <a class="btn btn-danger text-white" href="<?= _public("pages/student/delete.php?id={$student['id']}") ?>">Delete Student</a>
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
    setActiveLink('#managestudents');
</script>
</body>
</html>
