<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Helper.php";
require_once __DIR__."/../../Config.php";
require_once __DIR__."/../../Result.php";

if (!isset($_GET['id'])) {
    redirect("student");
}

$id = $_GET['id'];
$not_found = false;
$banned = false;
$ref = isset($_GET['ref']) ? $_GET['ref'] : "student";

$stmt = $conn->prepare("SELECT * FROM `students` WHERE `id`=?");
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    $not_found = true;
} else {
    $student = $result->fetch_assoc();
}

if (!$not_found) {

    if ($student['status'] == $config['banned']) {
        $banned = TRUE;
    }

    if (!$banned && isset($_POST['reason'])) {

        $reason = trim($_POST['reason']);

        if (empty($reason)) {
            addError("Reason is required");
        }

        if (!hasError()) {
            $stmt = $conn->prepare("UPDATE `students` SET `status`=?, `reason`=? WHERE `id`=? ");
            $stmt->bind_param("ssi",$config['banned'], $reason, $id);
            if ($stmt->execute()) {
                addSuccess("Student banned successfully.");
            } else {
                addError("An error occured while banning the student.");
            }
        }

    }

}
