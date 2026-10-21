<?php
session_start();

// Khởi tạo danh sách học sinh ban đầu
if (!isset($_SESSION["students"])) {
    $_SESSION["students"] = [
        ["name" => "Nguyễn Văn An", "score" => 8.5],
        ["name" => "Trần Thị Bình", "score" => 7.0],
        ["name" => "Lê Minh Chi", "score" => 9.0]
    ];
}

// Lấy thông báo từ lần xử lý trước
$thongBao = $_SESSION["thongBao"] ?? "";
unset($_SESSION["thongBao"]);

// Xử lý thêm học sinh bằng POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $score = trim($_POST["score"] ?? "");

    if (
        $name === "" ||
        $score === "" ||
        !is_numeric($score) ||
        $score < 0 ||
        $score > 10
    ) {
        $_SESSION["thongBao"] = "Vui lòng nhập tên và điểm hợp lệ từ 0 đến 10!";
    } else {
        // Thêm học sinh mới, không làm mất danh sách cũ
        $_SESSION["students"][] = [
            "name" => $name,
            "score" => (float)$score
        ];

        $_SESSION["thongBao"] = "Đã thêm học sinh thành công!";
    }

    // Chuyển hướng để tránh gửi lại form khi tải lại trang
    header("Location: Bai_5.php");
    exit;
}

// Tìm kiếm học sinh bằng GET
$keyword = trim($_GET["keyword"] ?? "");
$filteredStudents = [];

foreach ($_SESSION["students"] as $student) {
    if (
        $keyword === "" ||
        stripos($student["name"], $keyword) !== false
    ) {
        $filteredStudents[] = $student;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 5: GET và POST trong PHP</title>

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

        /* Menu điều hướng cố định góc trên bên trái giống Bài 4 */
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
            padding: 30px;
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

        h2 {
            color: #1768ba;
            font-size: 18px;
            margin-top: 24px;
            margin-bottom: 10px;
        }

        p {
            line-height: 1.6;
            font-size: 15px;
            color: #486581;
        }

        label {
            display: block;
            margin: 12px 0 6px;
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
            margin-top: 15px;
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

        /* Bảng danh sách học sinh */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #dce7f2;
            padding: 11px 14px;
            text-align: left;
            font-size: 15px;
        }

        th {
            background: #1768ba;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background: #f4f8fc;
        }

        td:last-child {
            color: #1768ba;
            font-weight: bold;
        }

        /* Thông báo */
        .thongbao {
            margin-bottom: 20px;
            padding: 14px;
            border-radius: 8px;
            background: #d8eee5;
            color: #28664f;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
        }

        .loi {
            background: #fde8e8;
            color: #9b2c2c;
        }

        .tongso {
            margin-top: 12px;
            font-weight: bold;
            color: #1768ba;
            font-size: 15px;
        }

        .back {
            margin-top: 22px;
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

        <h1>Bài 5: GET và POST trong PHP</h1>

        <!-- Hiển thị thông báo -->
        <?php if ($thongBao !== ""): ?>
            <div class="thongbao <?= strpos($thongBao, "Vui lòng") === 0 ? "loi" : "" ?>">
                <?= htmlspecialchars($thongBao) ?>
            </div>
        <?php endif; ?>

        <!-- Tìm kiếm bằng GET -->
        <h2>1. Tìm kiếm học sinh (GET)</h2>
        <p>Nhập tên học sinh cần tìm trong danh sách.</p>

        <form method="get" action="Bai_5.php">
            <label>Họ và tên học sinh:</label>
            <input
                type="text"
                name="keyword"
                placeholder="Ví dụ: An"
                value="<?= htmlspecialchars($keyword) ?>"
            >
            <button type="submit">Tìm kiếm</button>
        </form>

        <!-- Danh sách học sinh -->
        <h2>Danh sách học sinh</h2>

        <table>
            <tr>
                <th>STT</th>
                <th>Họ và tên</th>
                <th>Điểm</th>
            </tr>

            <?php if (count($filteredStudents) > 0): ?>
                <?php foreach ($filteredStudents as $index => $student): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($student["name"]) ?></td>
                        <td><?= number_format($student["score"], 1) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Không tìm thấy học sinh.</td>
                </tr>
            <?php endif; ?>
        </table>

        <div class="tongso">
            Tổng số học sinh: <?= count($_SESSION["students"]) ?>
        </div>

        <!-- Thêm học sinh bằng POST -->
        <h2>2. Thêm học sinh mới (POST)</h2>

        <form method="post" action="Bai_5.php">
            <label>Họ và tên:</label>
            <input
                type="text"
                name="name"
                placeholder="Nhập họ và tên học sinh"
                required
            >

            <label>Điểm:</label>
            <input
                type="number"
                name="score"
                min="0"
                max="10"
                step="0.1"
                placeholder="Nhập điểm từ 0 đến 10"
                required
            >

            <button type="submit">Thêm học sinh</button>
        </form>

        <div class="back">
            Bài thực hành PHP: Xử lý Form với GET và POST
        </div>

    </main>

</body>
</html>