<?php require __DIR__."/../../scripts/book/add.php"; ?>
<!-- Include Header -->
<?php require __DIR__."/../../templates/header.php"; ?>

<div class="content">

    <h1>Add Book</h1>
    <hr/>

    <form class="col-md-6" method="POST" action="">

        <?= showErrors(); ?>
        <?= showSuccess(); ?>

        <div class="form-group">
            <label>Title : </label>
            <input type="text" class="form-control" required="" name="title">
        </div>

        <div class="form-group">
            <label>Author : </label>
            <input type="text" class="form-control" placeholder="Optional" name="author">
        </div>

        <div class="form-group">
            <label>Short Description : </label>
            <textarea class="form-control" name="description" placeholder="Optional"></textarea>
        </div>

        <div class="form-group">
            <label>Quantity : </label>
            <input type="number" name="quantity" class="form-control" maxlength="3">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-info">Submit</button>
            <button type="reset" class="btn btn-outline-secondary">Reset</button>
        </div>

    </form>


</div>

<script src="<?= _public('js/jquery.min.js'); ?>"></script>
<script src="<?= _public('js/bootstrap.min.js'); ?>"></script>
<script src="<?= _public('js/app.js'); ?>"></script>
<script>
    setActiveLink('#addbook');
</script>
</body>
</html>
