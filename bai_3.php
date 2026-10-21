
<?php
// Mảng kết hợp lồng nhau: mỗi sinh viên có name và score
$students = [
    [
        "name" => "Nguyễn Văn An",
        "score" => 8.5
    ],
    [
        "name" => "Trần Thị Bình",
        "score" => 7.0
    ],
    [
        "name" => "Lê Minh Chi",
        "score" => 4.5
    ]
];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3: Mảng Sinh Viên</title>

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

        .container {
            width: 100%;
            max-width: 750px;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(31, 68, 110, 0.14);
        }

        h1 {
            margin: 0 0 15px;
            padding-bottom: 16px;
            border-bottom: 2px solid #dce7f2;
            text-align: center;
            color: #243b53;
            font-size: 32px;
        }

        .description {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        th {
            background: #287bd1;
            color: white;
            padding: 15px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:nth-child(even) {
            background: #f1f7ff;
        }

        tbody tr:hover {
            background: #e2efff;
        }

        .score {
            font-weight: bold;
            color: #1768ba;
        }

        .back {
            margin-top: 22px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px 15px;
            }

            h1 {
                font-size: 25px;
            }

            th, td {
                padding: 10px 8px;
                font-size: 14px;
            }

            .menu-bai {
                top: 10px;
                left: 10px;
                gap: 10px;
            }

            .menu-bai a {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
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
        <h1>Bài 3: Mảng Sinh Viên</h1>

        <p class="description">
            Danh sách 3 sinh viên được lưu bằng mảng kết hợp
            và hiển thị bằng vòng lặp foreach.
        </p>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ và tên</th>
                    <th>Điểm</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($students as $index => $student): ?>
                    <tr>
                        <td>
                            <?php echo $index + 1; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $student["name"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>
                        </td>

                        <td class="score">
                            <?php echo $student["score"]; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="back">
            Bài thực hành PHP: Mảng chỉ số và mảng kết hợp
        </div>
    </main>
</body>
</html>
