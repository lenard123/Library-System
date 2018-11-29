<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Config.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET['id'])) {
    redirect("banned");
}

$isnotbanned = false;
$notfound = false;

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM `students` WHERE `id`=?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $notfound = true;
} else {
    $student = $result->fetch_assoc();
    if ($student['status'] != $config["banned"]) {
        $isnotbanned = true;
    } else if (isset($_POST["confirm"])) {

        $confirm = trim($_POST["confirm"]);

        if ($confirm !== "CONFIRM") {
            addError("Type \"CONFIRM\" correctly to unban this student.");
        }

        if (!hasError()) {
            $update = $conn->query("UPDATE `students` SET `status`={$config['active']} WHERE `id`=$id");
            if ($update) {
                addSuccess("Student unbanned successfully, he can now borrow books again.");
            } else {
                addError("An error occured");
            }
        }

    }

}
