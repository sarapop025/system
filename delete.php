<?php

require_once "condb.php";

$id = $_GET['id'] ?? 0;

$sql = "DELETE FROM students
        WHERE student_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: index.php");
exit;