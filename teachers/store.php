<?php
include "../config/db.php";
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$subject = $_POST['subject'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$experience = $_POST['experience'];
$sql = "INSERT INTO teachers (first_name, last_name, sebject, phone, address, experience)
 VALUES(?,?,?,?,?,?)";

 $data = $conn->prepare($sql);
 $data->execute([$first_name, $last_name, $subject, $phone, $address, $experience]);

 header("location: index.php");
 ?>