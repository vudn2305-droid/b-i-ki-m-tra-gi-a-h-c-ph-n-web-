<?php
include 'connect.php';

$sql = "SELECT * FROM GiangVien";
$result = mysqli_query($conn, $sql);

$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Danh sách giảng viên</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        body{
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;
            padding:30px;
        }

        .card-box{
            background:white;
            border-radius:20px;
            padding:25px;
            box-shadow:0px 10px 30px rgba(0,0,0,0.25);
        }

        h2{
            color:#6f42c1;
            font-weight:bold;
        }

        .table thead{
            background:#6f42c1;
            color:white;
        }

        .table tbody tr:hover{
            background:#f5edff;
            transition:0.3s;
        }

        .avatar{
            width:100px;
            height:100px;
            object-fit:cover;
            border-radius:12px;
            border:3px solid #ddd;
        }

        .header-area{
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            margin-bottom:20px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="card-box">

        <h2 class="text-center mb-4">
            🎓 DANH SÁCH GIẢNG VIÊN
        </h2>

        <div class="header-area">

            <a href="add.php" class="btn btn-success">
                ➕ Thêm giảng viên
            </a>

            <span class="badge bg-primary p-2">
                Tổng giảng viên: <?php echo $count; ?>
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover text-center align-middle">

                <thead>
                    <tr>
                        <th>IDGV</th>
                        <th>Fullname</th>
                        <th>Image</th>
                        <th>SumClass</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                while($row = mysqli_fetch_assoc($result))
                {
                ?>

                    <tr>

                        <td>
                            <?php echo $row['IDGV']; ?>
                        </td>

                        <td>
                            <strong>
                                <?php echo $row['Fullname']; ?>
                            </strong>
                        </td>

                        <td>

                            <?php
                            $img = "images/".$row['Image'];

                            if(file_exists($img))
                            {
                            ?>
                                <img src="<?php echo $img; ?>" class="avatar">
                            <?php
                            }
                            else
                            {
                                echo "<span class='text-danger'>Không có ảnh</span>";
                            }
                            ?>

                        </td>

                        <td>
                            <span class="badge bg-info">
                                <?php echo $row['SumClass']; ?>
                            </span>
                        </td>

                        <td>

                            <a
                                href="edit.php?id=<?php echo $row['IDGV']; ?>"
                                class="btn btn-warning btn-sm">
                                ✏️ Sửa
                            </a>

                            <a
                                href="delete.php?id=<?php echo $row['IDGV']; ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                🗑 Xóa
                            </a>

                        </td>

                    </tr>

                <?php
                }
                ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>