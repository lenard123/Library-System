<?php require_once __DIR__."/../Helper.php"; ?>
<!Doctype html>
<html>
<head>
    <title>COSGA Library System</title>
    <link rel="stylesheet" type="text/css" href="<?= _public('css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= _public('css/app.css'); ?>">
    <link rel="icon" href="<?= _public('images/cosga_logo.png') ?>">
</head>
<body>

<header class="navbar navbar-dark bg-dark text-white">
    <a class="navbar-brand" href="<?= _public("pages/about.php"); ?>">
        <img class="d-inline-block align-top rounded-circle" height="60" width="60" src="<?= _public('images/cosga_logo.png'); ?>">
        <h3 class="d-inline-block align-middle header-title">COSGA LIBRARY SYSTEM</h3>
    </a>

    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search student or books">
        <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>
    </form>
</header>

<nav class="nav nav-tabs flex-column bg-light">
    <div class="nav-item" id="home">
        <a class="nav-link" href="<?= _public('pages/index.php'); ?>">HOME</a>
    </div>

    <div class="nav-item" id="addgrade">
        <a class="nav-link" href="<?= _public('pages/grade/add.php'); ?>">ADD GRADE LEVEL</a>
    </div>

    <div class="nav-item" id="managegrade">
        <a class="nav-link" href="<?= _public('pages/grade/index.php'); ?>">MANAGE GRADES</a>
    </div>

    <div class="nav-item" id="addsection">
        <a class="nav-link" href="<?= _public('pages/section/add.php'); ?>">ADD SECTION</a>
    </div>

    <div class="nav-item" id="managesection">
        <a class="nav-link" href="<?= _public('pages/section/index.php'); ?>">MANAGE SECTIONS</a>
    </div>

    <div class="nav-item" id="addstudent">
        <a class="nav-link" href="<?= _public('pages/student/register.php'); ?>">REGISTER STUDENT</a>
    </div>

    <div class="nav-item" id="managestudents">
        <a class="nav-link" href="<?= _public('pages/student/index.php'); ?>">MANAGE STUDENTS</a>
    </div>

    <div class="nav-item" id="bannedstudents">
        <a class="nav-link" href="<?= _public('pages/banned/index.php'); ?>">BANNED STUDENTS</a>
    </div>

    <div class="nav-item" id="addbook">
        <a class="nav-link" href="<?= _public('pages/book/add.php'); ?>">ADD BOOKS</a>
    </div>

    <div class="nav-item" id="managebooks">
        <a class="nav-link" href="<?= _public('pages/book/index.php'); ?>">MANAGE BOOKS</a>
    </div>

    <div class="nav-item" id="help">
        <a class="nav-link" href="<?= _public('pages/help.php'); ?>">HELP?</a>
    </div>
</nav>
