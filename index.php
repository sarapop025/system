<?php

require_once "condb.php";

$sql = "SELECT * FROM students ORDER BY student_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ระบบจัดการนักเรียน</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .btn-add {
            background: #198754;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

    </style>

</head>

<body>

<h1>ระบบจัดการข้อมูลนักเรียน</h1>

<a href="create.php" class="btn btn-add">
    + เพิ่มนักเรียน
</a>

<table>

    <thead>

        <tr>

            <th>รหัส</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>ชั้น</th>
            <th>ห้อง</th>
            <th>เบอร์โทร</th>
            <th>จัดการ</th>

        </tr>

    </thead>

    <tbody>

    <?php while ($row = $result->fetch_assoc()): ?>

        <tr>

            <td>
                <?= htmlspecialchars($row['student_code']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['firstname']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['lastname']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['class_level']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['classroom']) ?>
            </td>

            <td>
                <?= htmlspecialchars($row['phone']) ?>
            </td>

            <td>

                <a
                    href="edit.php?id=<?= $row['student_id'] ?>"
                    class="btn btn-edit"
                >
                    แก้ไข
                </a>

                <a
                    href="delete.php?id=<?= $row['student_id'] ?>"
                    class="btn btn-delete"
                    onclick="return confirmDelete();"
                >
                    ลบ
                </a>

            </td>

        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<script src="assets/script.js"></script>

</body>

</html>