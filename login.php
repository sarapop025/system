
<?php

session_start();

require_once "condb.php";

$error = "";

// ตรวจสอบว่ามีการกด Login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // ตรวจสอบข้อมูลผู้ใช้
    $sql = "SELECT * FROM users WHERE username = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    // พบ Username
    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        // สำหรับระบบฝึกสอบ ใช้ password ธรรมดา
        if ($password == $user["password"]) {

            // เก็บข้อมูลลง Session
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["fullname"] = $user["fullname"];
            $_SESSION["role"] = $user["role"];

            // เข้าสู่ระบบ
            header("Location: index.php");
            exit;

        } else {

            $error = "รหัสผ่านไม่ถูกต้อง";

        }

    } else {

        $error = "ไม่พบ Username นี้";

    }
}

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>เข้าสู่ระบบ</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f3f5;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;
        }

        .login-box {
            width: 380px;
            background: white;

            padding: 30px;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .login-box p {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;

            padding: 11px;

            border: 1px solid #ccc;

            border-radius: 6px;

            margin-bottom: 15px;
        }

        input:focus {
            outline: none;
            border-color: #198754;
        }

        button {
            width: 100%;

            padding: 11px;

            border: none;

            border-radius: 6px;

            background: #198754;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }

        button:hover {
            background: #157347;
        }

        .error {
            background: #f8d7da;

            color: #842029;

            padding: 10px;

            border-radius: 6px;

            margin-bottom: 15px;

            text-align: center;
        }

        .demo {
            margin-top: 20px;

            padding: 12px;

            background: #f8f9fa;

            border-radius: 6px;

            font-size: 14px;
        }

        .demo strong {
            color: #198754;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h2>ระบบจัดการนักเรียน</h2>

    <p>กรุณาเข้าสู่ระบบ</p>


    <?php if ($error != ""): ?>

        <div class="error">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>


    <form method="POST">


        <label>
            Username
        </label>

        <input
            type="text"
            name="username"
            placeholder="กรอก Username"
            required
        >


        <label>
            Password
        </label>

        <input
            type="password"
            name="password"
            placeholder="กรอก Password"
            required
        >


        <button type="submit">

            เข้าสู่ระบบ

        </button>


    </form>


    <!-- ข้อมูลสำหรับทดสอบ -->

    <div class="demo">

        <strong>บัญชีทดสอบ</strong>

        <br><br>

        Admin:
        admin / 1234

        <br>

        Teacher:
        teacher / 1234

        <br>

        Viewer:
        viewer / 1234

    </div>

</div>

</body>

</html>
