<?php
include "../config/db.php";
$id = $_POST['id'];
$class_name = $_POST['class_name'];
$teachers_id = $_POST['teachers_id'];

$sql = "INSERT INTO students (id, class_name, teachers_id)
VALUES(?,?,?)";

$data = $conn->prepare($sql);
$data->execute([$id, $class_name, $teachers_id]);

header("location: index.php");