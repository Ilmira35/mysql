<?php
include "../config/db.php";

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$age = $_POST['age'];
$class_name = $_POST['class_id'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE students
SET first_name = ?, last_name = ?, age = ?, class_id= ?, phone = ?, address  = ?
where id = ?";
$data = $conn->prepare($sql);
$data->execute([$first_name, $last_name, $age, $class_id, $phone, $address, $id]);

header("location: index.php");
exit;