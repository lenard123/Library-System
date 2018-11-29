<!-- Include Header -->
<?php require __DIR__."/../../scripts/banned/index.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">
    <h1>BANNED STUDENT</h1>
    <hr/>

    
    <div class="card">
        <div class="card-body">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>NAME</th>
                        <th>GRADE</th>
                        <th>SECTION</th>
                        <th>CONTACT NUMBER</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php if ($students->num_rows < 1) : ?>
                        <tr>
                            <th colspan="6">No banned student yet.</th>
                        </tr>
                    <?php endif; ?>
                    <?php while ($student = $students->fetch_assoc()) : ?>
                        <tr id="student-<?= $student['id'] ?>">
                            <th><?= $student['id'] ?></th>
                            <td><?= $student['name'] ?></td>
                            <td><?= $student['grade'] ?></td>
                            <td><?= $student['section'] ?></td>
                            <td><?= $student['number'] ?></td>
                            <td><a class="btn btn-outline-danger" href="<?= _public("pages/banned/unban.php?id={$student['id']}") ?>">UN-BAN</a></td>
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
<script type="text/javascript">
    setActiveLink("#bannedstudents");
</script>
</body>
</html>
