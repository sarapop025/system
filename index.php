
<?php

session_start();

require_once "condb.php";

// ตรวจสอบว่าล็อกอินหรือยัง
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// ดึงข้อมูลนักเรียน
$sql = "SELECT * FROM students ORDER BY student_id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>ระบบจัดการข้อมูลนักเรียน</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .top-menu {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            text-decoration: none;
            border-radius: 5px;
            padding: 8px 12px;
            margin-right: 5px;
        }

        .btn-add {
            background: #198754;
            color: white;
        }

        .btn-add:hover {
            background: #157347;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-edit:hover {
            background: #ffca2c;
            color: black;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #bb2d3b;
            color: white;
        }

        .btn-logout {
            background: #6c757d;
            color: white;
        }

        .btn-logout:hover {
            background: #5c636a;
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

        .user-info {
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<div class="top-menu">

    <h1>ระบบจัดการข้อมูลนักเรียน</h1>

    <a href="logout.php" class="btn btn-logout">
        ออกจากระบบ
    </a>

</div>


<div class="user-info">

    ยินดีต้อนรับ
    <strong>
        <?= htmlspecialchars($_SESSION["fullname"]) ?>
    </strong>

</div>


<a href="create.php" class="btn btn-add">
    + เพิ่มนักเรียน
</a>


<br><br>


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

    <?php if ($result && $result->num_rows > 0): ?>

        <?php while ($row = $result->fetch_assoc()): ?>

            <tr>

                <td>
                    <?= htmlspecialchars($row["student_code"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row["firstname"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row["lastname"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row["class_level"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row["classroom"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($row["phone"]) ?>
                </td>

                <td>

                    <a
                        href="edit.php?id=<?= $row["student_id"] ?>"
                        class="btn btn-edit"
                    >
                        แก้ไข
                    </a>

                    <a
                        href="delete.php?id=<?= $row["student_id"] ?>"
                        class="btn btn-delete"
                        onclick="return confirm('คุณต้องการลบนักเรียนคนนี้หรือไม่?');"
                    >
                        ลบ
                    </a>

                </td>

            </tr>

        <?php endwhile; ?>

    <?php else: ?>

        <tr>

            <td colspan="7" style="text-align:center;">
                ไม่พบข้อมูลนักเรียน
            </td>

        </tr>

    <?php endif; ?>

    </tbody>

</table>


</body>

</html>
