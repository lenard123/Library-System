<?php

require_once __DIR__."/../../Conn.php";
require_once __DIR__."/../../Config.php";

function getGradeId ($section_id)
{
    global $conn;
    $query = $conn->query("SELECT `grade_id` FROM `sections` WHERE `id`=$section_id");
    $section = $query->fetch_assoc();
    return $section['grade_id'];
}

function getGradeName ($grade_id)
{
    global $conn;
    $query = $conn->query("SELECT `name` FROM `grades` WHERE `id`=$grade_id");
    $grade = $query->fetch_assoc();
    return $grade['name'];
}

function getGradeNameBySectionId ($section_id)
{
    $grade_id = getGradeId($section_id);
    return getGradeName($grade_id);
}

function getSectionName ($section_id)
{
    global $conn;
    $query = $conn->query("SELECT `name` FROM `sections` WHERE `id`=$section_id");
    $section = $query->fetch_assoc();
    return $section['name'];
}

function getStatus ($status)
{
    global $config;
    switch ($status) {
        case $config['banned']:
            $badge = "badge-danger";
            $status = "banned";
            break;
        
        default:
            $badge = "badge-success";
            $status = "active";
            break;
    }
    return "<span class='badge $badge'>$status</span>";
}