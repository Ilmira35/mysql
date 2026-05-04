<?php
include "../config/db.php";

$id = $_POST['id'];
$class_name= $_POST['class_name'];
$teachers_id = $_POST['teachers_id'];


$sql = "UPDATE students
SET class_name = ?, teachers_name = ?
where id = ?";
$data = $conn->prepare($sql);
$data->execute([$class_name, $teachers_id, $id]);

header("location: index.php");
exit;