<?php

require_once __DIR__."/../../Conn.php";

$banned = $config["banned"];
$students = $conn->query("SELECT 
                            `students`.*, 
                            `grades`.`name` as `grade`,
                            `sections`.`name` as `section`  
                          FROM `students` 
                          JOIN `sections` 
                            on `students`.`section_id`=`sections`.`id` 
                          JOIN `grades` 
                            on `sections`.`id`=`grades`.`id` 
                          WHERE `students`.`status`=$banned");

