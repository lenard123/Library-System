<?php require __DIR__."/../../scripts/student/update.php" ?>
<?php require __DIR__."/../../templates/header.php" ?>

<div class="content">
    <h1>Update Student</h1>
    <hr/>

    <?php if ($notfound) : ?>
        <div class="jumbotron">
            <h1>Student not found</h1>
            <h3>Click <a href="<?= _public("pages/student") ?>">here</a> to go back.</h3>
        </div>
    <?php elseif (isset($_GET["update"]) && $_GET["update"]=="grade") : ?>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Choose Grade Level
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>NAME</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($grades->num_rows < 1) : ?>
                                <tr>
                                    <th colspan="3">No grades in database</th>
                                </tr>
                            <?php endif; ?>
                            <?php while ($grade = $grades->fetch_assoc()) : ?>
                                <tr>
                                    <th><?= $grade["id"] ?></th>
                                    <td><?= $grade["name"] ?></td>
                                    <td><a href="<?= _public("pages/student/update.php?id=$id&ref=$ref&grade_id={$grade["id"]}&update=section") ?>">Choose section</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?= _public("pages/student/update.php?id=$id&ref=$ref") ?>" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    <?php elseif (isset($_GET["update"]) && $_GET["update"] == "section"  && isset($_GET["grade_id"])) : ?>
        <?php if (!$valid_grade) : ?>
            <div class="jumbotron">
                <h1>Invalid Grade level</h1>
                <h3>Click <a href="<?= _public("pages/student/update.php?id=$id&ref=$ref&update=grade") ?>">here</a> to go back.</h3>
            </div>
        <?php else : ?>
            <div class="card col-md-6">
                <div class="card-body">
                    <form method="POST" action="">
                        <?= showErrors() ?>
                        <?= showSuccess() ?>

                        <div class="form-group">
                            <label>Grade : </label>
                            <input type="text" value="<?= $grade['name'] ?>" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label>Section : </label>
                            <select class="form-control" name="section_id" required="">
                                <option selected="" disabled="">CHOOSE SECTION</option>
                                <?php while ($section = $sections->fetch_assoc()) : ?>
                                    <option value="<?= $section["id"] ?>"><?= $section["name"] ?></option>
                                <?php endwhile ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <a href="<?= _public("pages/student/update.php?id=$id&ref=$ref&update=grade") ?>" class="btn btn-primary">Change Grade</a>
                            <a href="<?= _public("pages/student/update.php?id=$id&ref=$ref") ?>" class="btn btn-outline-secondary">Back</a>
                        </div>

                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="card col-md-6">
            <div class="card-body">
                <form method="POST" action="">
                    
                    <?= showSuccess() ?>
                    <?= showErrors() ?>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required="" value="<?= $student['name'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Section</label>
                        <select class="form-control" name="section_id">
                            <option disabled="">-- SELECT SECTION --</option>
                            <?php while ($section = $sections->fetch_assoc()) : ?>
                                <option value="<?= $section['id'] ?>" <?= $section['id']==$student['section_id'] ? "selected": "" ?>><?= $section['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="number" class="form-control" maxlength="11" placeholder="09XXXXXXXXX" value="<?= $student['number'] ?>"/>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success">
                        <a class="btn btn-info text-white" href="<?= _public("pages/student/update.php?id=$id&ref=$ref&update=grade") ?>">Update Grade & Section</a>
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