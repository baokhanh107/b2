<?php
// 1. Tạo mảng $students gồm 3 sinh viên với name, midterm, final
$students = [
    [
        "name" => "Nguyễn Ngọc Anh Thư",
        "midterm" => 8.0,
        "final" => 8.5
    ],
    [
        "name" => "Lê Nguyễn Tuệ Nhi",
        "midterm" => 7.0,
        "final" => 6.5
    ],
    [
        "name" => "Nguyễn Thị Bảo Ngọc",
        "midterm" => 3.0,
        "final" => 6.0
    ]
];

// 2. Viết hàm calculateAverage() tính điểm trung bình (40% giữa kỳ + 60% cuối kỳ)
function calculateAverage(float $midterm, float $final): float {
    return ($midterm * 0.4) + ($final * 0.6);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 7: Bảng điểm 3 sinh viên</title>

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
            max-width: 750px;
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

        /* Bảng hiển thị danh sách */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dce7f2;
            padding: 12px 14px;
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

        .text-center {
            text-align: center;
        }

        /* Badge trạng thái Đạt / Không đạt */
        .badge-dat {
            color: #28664f;
            background: #d8eee5;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
        }

        .badge-truot {
            color: #9b2c2c;
            background: #fde8e8;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: bold;
            font-size: 14px;
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
        <h1>Bài 7: Bảng điểm 3 sinh viên</h1>

        <!-- 3. Dùng foreach để in bảng HTML -->
        <table>
            <tr>
                <th class="text-center" style="width: 60px;">STT</th>
                <th>Họ và tên</th>
                <th class="text-center">Giữa kỳ</th>
                <th class="text-center">Cuối kỳ</th>
                <th class="text-center">Điểm TB</th>
                <th class="text-center">Kết quả</th>
            </tr>

            <?php foreach ($students as $index => $student): ?>
                <?php 
                    // Tính điểm trung bình bằng hàm đã định nghĩa
                    $avg = calculateAverage($student["midterm"], $student["final"]);
                    // 4. Kiểm tra điều kiện: Đạt nếu điểm trung bình >= 5
                    $isPassed = $avg >= 5;
                ?>
                <tr>
                    <td class="text-center"><?= $index + 1 ?></td>
                    <!-- 5. Mã hóa tên sinh viên bằng htmlspecialchars() trước khi in -->
                    <td><?= htmlspecialchars($student["name"]) ?></td>
                    <td class="text-center"><?= number_format($student["midterm"], 1) ?></td>
                    <td class="text-center"><?= number_format($student["final"], 1) ?></td>
                    <td class="text-center" style="font-weight: bold; color: #1768ba;"><?= number_format($avg, 2) ?></td>
                    <td class="text-center">
                        <?php if ($isPassed): ?>
                            <span class="badge-dat">Đạt</span>
                        <?php else: ?>
                            <span class="badge-truot">Không đạt</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="back">
            Bài thực hành PHP: Mảng kết hợp, hàm tính toán và hiển thị bảng dữ liệu
        </div>
    </main>

</body>
</html>