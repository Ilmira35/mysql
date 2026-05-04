<?php
include "../config/db.php";

$id = $_GET['id'];

$sql = "DELETE FROM classes WHERE id = ?";

$data = $conn->prepare($sql);

$data->execute([$id]);

header("Location: index.php");
exit;