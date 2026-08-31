<?php

require_once "condb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_code = $_POST['student_code'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $class_level = $_POST['class_level'];
    $classroom = $_POST['classroom'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO students
            (
                student_code,
                firstname,
                lastname,
                class_level,
                classroom,
                phone
            )
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssss",
        $student_code,
        $firstname,
        $lastname,
        $class_level,
        $classroom,
        $phone
    );

    $stmt->execute();

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <title>เพิ่มนักเรียน</title>

</head>

<body>

<h1>เพิ่มข้อมูลนักเรียน</h1>

<form method="post">

    <p>
        <label>รหัสนักเรียน</label><br>

        <input
            type="text"
            name="student_code"
            required
        >
    </p>

    <p>
        <label>ชื่อ</label><br>

        <input
            type="text"
            name="firstname"
            required
        >
    </p>

    <p>
        <label>นามสกุล</label><br>

        <input
            type="text"
            name="lastname"
            required
        >
    </p>

    <p>
        <label>ชั้น</label><br>

        <input
            type="text"
            name="class_level"
            placeholder="เช่น ม.4"
        >
    </p>

    <p>
        <label>ห้อง</label><br>

        <input
            type="text"
            name="classroom"
            placeholder="เช่น 1"
        >
    </p>

    <p>
        <label>เบอร์โทร</label><br>

        <input
            type="text"
            name="phone"
        >
    </p>

    <button type="submit">
        บันทึก
    </button>

    <a href="index.php">
        ยกเลิก
    </a>

</form>

</body>

</html>