<?php require __DIR__."/../../scripts/student/register.php"; ?>
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Register Students</h1>
    <hr/>

    <?php if (isset($_GET['grade_id']) && $isvalid) : ?>

        <div class="card col-md-6">

            <div class="card-body">
                <form method="POST" action="">

                    <?= showErrors(); ?>
                    <?= showSuccess(); ?>

                    <div class="form-group">
                        <label>Grade : </label>
                        <input type="text" disabled="" class="form-control" value="<?= $grade['name']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Section : </label>
                        <select class="form-control" name="section_id" required="">
                            <option selected="" disabled=""> -- SELECT SECTION -- </option>
                            <?php while ($section = $sections->fetch_assoc()) : ?>
                                <option value="<?= $section['id']; ?>"><?= $section['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="name" class="form-control" required="" placeholder="name of student" />
                    </div>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="number" class="form-control" placeholder="09XXXXXXXXX" maxlength="11">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= _public("pages/student/register.php"); ?>" class="btn btn-outline-secondary">Back</a>
                    </div>
                </form>
            </div>

        </div>

    <?php elseif(isset($_GET['grade_id']) && !$isvalid) : ?>
        <div class="jumbotron">
            <h1>Grade not found</h1>
            <h3>Click <a href="<?= _public("pages/student/register.php"); ?>">here</a> to go back</h3>
        </div>
    <?php else: ?>
        <div class="card col-md-6">
            <div class="card-body">
                <div class="card-title">Choose the grade of the students</div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">NAME</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if ($grades->num_rows < 1) : ?>
                        <tr>
                            <th scope="row" colspan="2">No Grade in Database</th>
                        </tr>
                        <?php endif; ?>

                        <?php while ($grade = $grades->fetch_assoc()) : ?>
                        <tr>
                            <th scope="row"><?= $grade['id']; ?></th>
                            <td><?= $grade['name']; ?></td>
                            <td>
                                <a href="<?= _public("pages/student/register.php?grade_id=".$grade['id']); ?>">Register</a>
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
    setActiveLink('#addstudent');
</script>
</body>
</html>
