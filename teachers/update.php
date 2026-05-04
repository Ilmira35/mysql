<?php 
include "../config/db.php";

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$subject = $_POST['subject'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$experience = $_POST['experience'];

$sql = "UPDATE teachers
SET first_name = ?, last_name = ?, subject = ?, phone = ?, address = ?, experience = ?
where id = ?";
$data = $conn->prepare($sql);
$data->execute([$first_name, $last_name, $subject, $phone, $address, $experience]);

header("location: index.php");
exit;