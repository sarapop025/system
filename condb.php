<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "student_system",

);

if ($conn->connect_error){
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $conn->connect_error);
}

$conn->set_charset("utf8mv4");
?>