<?php
$errors = [];
$data = [
    'name' => '',
    'email' => '',
    'subject' => '',
    'message' => ''
];
$successMessage = "";
$uploadedFileUrl = "";

// Hàm mã hóa an toàn output
function e($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

// Xử lý khi gửi form bằng POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data['name'] = trim($_POST['name'] ?? '');
    $data['email'] = trim($_POST['email'] ?? '');
    $data['subject'] = trim($_POST['subject'] ?? '');
    $data['message'] = trim($_POST['message'] ?? '');

    // 2. Kiểm tra họ tên không rỗng
    if ($data['name'] === '') {
        $errors['name'] = 'Vui lòng nhập họ và tên!';
    }

    // 3. Kiểm tra email đúng định dạng
    if ($data['email'] === '') {
        $errors['email'] = 'Vui lòng nhập email!';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ!';
    }

    // Kiểm tra chủ đề không rỗng
    if ($data['subject'] === '') {
        $errors['subject'] = 'Vui lòng nhập chủ đề!';
    }

    // 2. Kiểm tra nội dung không rỗng
    if ($data['message'] === '') {
        $errors['message'] = 'Vui lòng nhập nội dung liên hệ!';
    }

    // 1. Kiểm tra và xử lý Upload ảnh đại diện đính kèm (với 3 kiểm tra bắt buộc)
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $fileSize = $_FILES['avatar']['size'];
            
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Kiểm tra 1: Định dạng/Phần mở rộng cho phép
            if (!in_array($fileExtension, $allowedExtensions)) {
                $errors['avatar'] = 'Chỉ cho phép upload các định dạng ảnh (jpg, jpeg, png, gif)!';
            } 
            // Kiểm tra 2: Kích thước tối đa (Tối đa 2MB = 2 * 1024 * 1024 bytes)
            elseif ($fileSize > 2 * 1024 * 1024) {
                $errors['avatar'] = 'Kích thước ảnh quá lớn! Dung lượng tối đa là 2MB.';
            } else {
                // Kiểm tra 3: Đổi tên file mới an toàn để tránh ghi đè
                $uploadFileDir = './uploads/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $uploadedFileUrl = $dest_path;
                } else {
                    $errors['avatar'] = 'Không thể lưu file tải lên.';
                }
            }
        } else {
            $errors['avatar'] = 'Có lỗi xảy ra trong quá trình upload file.';
        }
    }

    // 5. Nếu không có lỗi nào -> Hiển thị thông báo thành công
    if (!$errors) {
        $successMessage = "Gửi thông tin liên hệ thành công!";
        // Reset dữ liệu form nếu muốn, hoặc giữ lại tùy ý
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 10: Form liên hệ</title>

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
            max-width: 700px;
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
            margin: 14px 0 6px;
            font-weight: bold;
            font-size: 14px;
            color: #243b53;
        }

        input, textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="file"] {
            background: #f8fafc;
            padding: 8px;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #1768ba;
            box-shadow: 0 0 0 3px rgba(23, 104, 186, 0.15);
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            margin-top: 20px;
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

        /* Thông báo lỗi */
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

        .preview-box {
            margin-top: 15px;
            text-align: center;
        }

        .preview-box img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
        <h1>Bài 10: Form Liên Hệ</h1>

        <!-- 5. Hiển thị thông báo thành công nếu hợp lệ -->
        <?php if ($successMessage !== ""): ?>
            <div class="thongbao-success">
                <?= e($successMessage) ?>
            </div>
            <?php if ($uploadedFileUrl !== ""): ?>
                <div class="preview-box">
                    <p style="margin: 0 0 5px; font-weight: bold; color: #28664f;">Ảnh đại diện đính kèm:</p>
                    <img src="<?= e($uploadedFileUrl) ?>" alt="Uploaded Avatar">
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Form nhập liệu (có enctype để hỗ trợ upload file và giữ lại dữ liệu khi lỗi) -->
        <form method="post" action="" enctype="multipart/form-data">
            <label>Họ và tên:</label>
            <input type="text" name="name" placeholder="Nhập họ và tên" value="<?= e($data['name']) ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error-text"><?= e($errors['name']) ?></div>
            <?php endif; ?>

            <label>Email:</label>
            <input type="text" name="email" placeholder="Ví dụ: email@gmail.com" value="<?= e($data['email']) ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error-text"><?= e($errors['email']) ?></div>
            <?php endif; ?>

            <label>Chủ đề:</label>
            <input type="text" name="subject" placeholder="Nhập chủ đề liên hệ" value="<?= e($data['subject']) ?>">
            <?php if (isset($errors['subject'])): ?>
                <div class="error-text"><?= e($errors['subject']) ?></div>
            <?php endif; ?>

            <label>Nội dung:</label>
            <textarea name="message" placeholder="Nhập nội dung liên hệ"><?= e($data['message']) ?></textarea>
            <?php if (isset($errors['message'])): ?>
                <div class="error-text"><?= e($errors['message']) ?></div>
            <?php endif; ?>

            <label>Ảnh đại diện đính kèm (Tối đa 2MB, định dạng JPG/PNG/GIF):</label>
            <input type="file" name="avatar">
            <?php if (isset($errors['avatar'])): ?>
                <div class="error-text"><?= e($errors['avatar']) ?></div>
            <?php endif; ?>

            <button type="submit">Gửi liên hệ</button>
        </form>

        <div class="back">
            Bài thực hành PHP: Form liên hệ tổng hợp, xác thực dữ liệu và upload file an toàn
        </div>
    </main>

</body>
</html>