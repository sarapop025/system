
<?php

session_start();

require_once "condb.php";

// ========================================
// ตรวจสอบว่าล็อกอินแล้วหรือยัง
// ========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit;

}

// เก็บ Role ของผู้ใช้งาน
$role = $_SESSION["role"];

// ========================================
// ดึงข้อมูลนักเรียน
// ========================================

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

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f5f5;
        }

        .container {
            margin-top: 40px;
        }

        .header-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .table-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- ========================================
         Header
    ========================================= -->

    <div class="header-box">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h2>
                    ระบบจัดการข้อมูลนักเรียน
                </h2>

                <p class="mb-0">

                    ยินดีต้อนรับ
                    <strong>
                        <?= htmlspecialchars($_SESSION["fullname"]) ?>
                    </strong>

                    |

                    สิทธิ์:

                    <strong>
                        <?= htmlspecialchars($role) ?>
                    </strong>

                </p>

            </div>

            <div>

                <a href="logout.php"
                   class="btn btn-danger">

                    ออกจากระบบ

                </a>

            </div>

        </div>

    </div>


    <!-- ========================================
         ตารางข้อมูล
    ========================================= -->

    <div class="table-box">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>
                รายชื่อนักเรียน
            </h4>


            <!-- Admin และ Teacher เพิ่มข้อมูลได้ -->

            <?php if ($role == "admin" || $role == "teacher"): ?>

                <a href="create.php"
                   class="btn btn-success">

                    + เพิ่มนักเรียน

                </a>

            <?php endif; ?>

        </div>


        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>

                        <th width="50">
                            #
                        </th>

                        <th>
                            รหัสนักเรียน
                        </th>

                        <th>
                            ชื่อ
                        </th>

                        <th>
                            นามสกุล
                        </th>

                        <th>
                            ชั้น
                        </th>

                        <th>
                            ห้อง
                        </th>

                        <th>
                            เบอร์โทร
                        </th>

                        <th width="180">
                            จัดการ
                        </th>

                    </tr>

                </thead>


                <tbody>

                <?php if ($result && $result->num_rows > 0): ?>

                    <?php $i = 1; ?>

                    <?php while ($row = $result->fetch_assoc()): ?>

                        <tr>

                            <td>
                                <?= $i++ ?>
                            </td>

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

                                <!--
                                Admin และ Teacher
                                สามารถแก้ไขข้อมูล
                                -->

                                <?php if ($role == "admin" || $role == "teacher"): ?>

                                    <a
                                        href="edit.php?id=<?= $row["student_id"] ?>"
                                        class="btn btn-warning btn-sm"
                                    >
                                        แก้ไข
                                    </a>

                                <?php endif; ?>


                                <!--
                                เฉพาะ Admin
                                สามารถลบข้อมูล
                                -->

                                <?php if ($role == "admin"): ?>

                                    <a
                                        href="delete.php?id=<?= $row["student_id"] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('คุณต้องการลบข้อมูลนักเรียนคนนี้หรือไม่?');"
                                    >
                                        ลบ
                                    </a>

                                <?php endif; ?>


                                <!--
                                Viewer จะไม่มีปุ่มจัดการ
                                -->

                                <?php if ($role == "viewer"): ?>

                                    <span class="text-muted">
                                        ดูข้อมูล
                                    </span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="8"
                            class="text-center">

                            ไม่พบข้อมูลนักเรียน

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>

</html>
