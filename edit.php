<?php

require_once "condb.php";

$id = $_GET['id'] ?? 0;

$sql = "SELECT * FROM students
        WHERE student_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$student = $result->fetch_assoc();

if (!$student) {
    die("ไม่พบข้อมูลนักเรียน");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_code = $_POST['student_code'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $class_level = $_POST['class_level'];
    $classroom = $_POST['classroom'];
    $phone = $_POST['phone'];

    $sql = "UPDATE students SET
                student_code = ?,
                firstname = ?,
                lastname = ?,
                class_level = ?,
                classroom = ?,
                phone = ?
            WHERE student_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssi",
        $student_code,
        $firstname,
        $lastname,
        $class_level,
        $classroom,
        $phone,
        $id
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

    <title>แก้ไขนักเรียน</title>

</head>

<body>

<h1>แก้ไขข้อมูลนักเรียน</h1>

<form method="post">

    <p>
        <label>รหัสนักเรียน</label><br>

        <input
            type="text"
            name="student_code"
            value="<?= htmlspecialchars($student['student_code']) ?>"
            required
        >
    </p>

    <p>
        <label>ชื่อ</label><br>

        <input
            type="text"
            name="firstname"
            value="<?= htmlspecialchars($student['firstname']) ?>"
            required
        >
    </p>

    <p>
        <label>นามสกุล</label><br>

        <input
            type="text"
            name="lastname"
            value="<?= htmlspecialchars($student['lastname']) ?>"
            required
        >
    </p>

    <p>
        <label>ชั้น</label><br>

        <input
            type="text"
            name="class_level"
            value="<?= htmlspecialchars($student['class_level']) ?>"
        >
    </p>

    <p>
        <label>ห้อง</label><br>

        <input
            type="text"
            name="classroom"
            value="<?= htmlspecialchars($student['classroom']) ?>"
        >
    </p>

    <p>
        <label>เบอร์โทร</label><br>

        <input
            type="text"
            name="phone"
            value="<?= htmlspecialchars($student['phone']) ?>"
        >
    </p>

    <button type="submit">
        บันทึกการแก้ไข
    </button>

    <a href="index.php">
        ยกเลิก
    </a>

</form>

</body>

</html>