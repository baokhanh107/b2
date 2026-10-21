<?php
session_start();

$errors = [];
$data = ['name' => '', 'email' => '', 'birthday' => ''];
$successMessage = "";

// Hàm e($v) dùng để mã hóa an toàn dữ liệu output
function e($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

// Xử lý khi gửi form bằng POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['birthday'] = trim($_POST['birthday'] ?? '');

    // 1. Kiểm tra bắt buộc nhập họ tên
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ tên!';
    }

    // 2. Kiểm tra email bắt buộc và đúng định dạng
    if ($data['email'] === '') {
        $errors['email'] = 'Vui lòng nhập email!';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ!';
    }

    // 3. Kiểm tra bắt buộc nhập ngày sinh
    if ($data['birthday'] === '') {
        $errors['birthday'] = 'Vui lòng nhập ngày sinh!';
    }

    // Nếu không có lỗi thì xử lý thành công
    if (!$errors) {
        $successMessage = "Đăng ký thông tin sinh viên thành công!";
        // Reset form sau khi thành công
        $data = ['name' => '', 'email' => '', 'birthday' => ''];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 9: Form đăng ký sinh viên</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #eaf4ff, #dceeff);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 80px 20px 30px;
            color: #263445;
        }

        /* Menu điều hướng cố định góc trên bên trái */
        .menu-bai {
            position: fixed;
            top: 20px;
            left: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            z-index: 1000;
        }

        .menu-bai a {
            color: #1768ba;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
        }

        .menu-bai a:hover {
            text-decoration: underline;
        }

        /* Khung nội dung chính */
        .container {
            width: 100%;
            max-width: 650px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(31, 68, 110, 0.14);
        }

        h1 {
            text-align: center;
            color: #243b53;
            font-size: 26px;
            padding-bottom: 16px;
            margin-top: 0;
            border-bottom: 2px solid #dce7f2;
        }

        label {
            display: block;
            margin: 15px 0 6px;
            font-weight: bold;
            font-size: 14px;
            color: #243b53;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1768ba;
            box-shadow: 0 0 0 3px rgba(23, 104, 186, 0.15);
        }

        button {
            margin-top: 22px;
            width: 100%;
            padding: 12px 20px;
            background: #1768ba;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #125192;
        }

        /* Thông báo lỗi bên dưới mỗi input */
        .error-text {
            color: #d93025;
            font-size: 13px;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Thông báo thành công */
        .thongbao-success {
            margin-bottom: 20px;
            padding: 14px;
            border-radius: 8px;
            background: #d8eee5;
            color: #28664f;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .back {
            margin-top: 25px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- Menu điều hướng -->
    <nav class="menu-bai">
        <a href="index.php">Bài 1</a>
        <a href="Bai_2.php">Bài 2</a>
        <a href="Bai_3.php">Bài 3</a>
        <a href="Bai_4.php">Bài 4</a>
        <a href="Bai_5.php">Bài 5</a>
        <a href="Bai_6.php">Bài 6</a>
        <a href="Bai_7.php">Bài 7</a>
        <a href="Bai_8.php">Bài 8</a>
        <a href="Bai_9.php">Bài 9</a>
        <a href="Bai_10.php">Bài 10</a>
    </nav>

    <main class="container">
        <h1>Bài 9: Form đăng ký sinh viên</h1>

        <!-- Hiển thị thông báo thành công -->
        <?php if ($successMessage !== ""): ?>
            <div class="thongbao-success">
                <?= e($successMessage) ?>
            </div>
        <?php endif; ?>

        <!-- Form nhập dữ liệu -->
        <form method="post" action="">
            <label>Họ và tên:</label>
            <input 
                type="text" 
                name="name" 
                placeholder="Nhập họ và tên" 
                value="<?= e($data['name']) ?>"
            >
            <?php if (isset($errors['name'])): ?>
                <div class="error-text"><?= e($errors['name']) ?></div>
            <?php endif; ?>

            <label>Email sinh viên:</label>
            <input 
                type="text" 
                name="email" 
                placeholder="Ví dụ: sinhvien@gmail.com" 
                value="<?= e($data['email']) ?>"
            >
            <?php if (isset($errors['email'])): ?>
                <div class="error-text"><?= e($errors['email']) ?></div>
            <?php endif; ?>

            <label>Ngày sinh:</label>
            <input 
                type="date" 
                name="birthday" 
                value="<?= e($data['birthday']) ?>"
            >
            <?php if (isset($errors['birthday'])): ?>
                <div class="error-text"><?= e($errors['birthday']) ?></div>
            <?php endif; ?>

            <button type="submit">Đăng ký sinh viên</button>
        </form>

        <div class="back">
            Bài thực hành PHP: Validate Form, kiểm tra email hợp lệ và xử lý dữ liệu POST
        </div>
    </main>

</body>
</html>