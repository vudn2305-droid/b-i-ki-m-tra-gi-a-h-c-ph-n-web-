<?php

include 'connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM GiangVien WHERE IDGV='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update']))
{
    $Fullname = $_POST['Fullname'];
    $SumClass = $_POST['SumClass'];

    $Image = $row['Image'];

    if($_FILES['Image']['name'] != "")
    {
        $Image = $_FILES['Image']['name'];

        move_uploaded_file(
            $_FILES['Image']['tmp_name'],
            "images/".$Image
        );
    }

    $sqlUpdate = "
        UPDATE GiangVien
        SET
            Fullname='$Fullname',
            SumClass='$SumClass',
            Image='$Image'
        WHERE IDGV='$id'
    ";

    mysqli_query($conn,$sqlUpdate);

    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Sửa Giảng Viên</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background: linear-gradient(135deg,#667eea,#764ba2);
    min-height:100vh;
}

.card-box{
    background:white;
    border-radius:25px;
    padding:40px;
    margin-top:40px;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.avatar{
    width:220px;
    height:220px;
    object-fit:cover;
    border-radius:20px;
    border:5px solid #ddd;
}

.title{
    color:#6f42c1;
    font-weight:bold;
}

.form-label{
    font-weight:bold;
    color:#555;
    margin-bottom:8px;
}

.form-control{
    padding:12px;
    border-radius:10px;
}

.btn{
    padding:10px 25px;
    border-radius:10px;
    font-weight:bold;
}

.btn-warning{
    color:white;
}

</style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card-box">

                <h2 class="title text-center mb-4">
                    ✏️ SỬA GIẢNG VIÊN
                </h2>

                <form method="POST" enctype="multipart/form-data">

                    <div class="text-center mb-5">

                        <?php
                        $img = "images/".$row['Image'];

                        if(file_exists($img))
                        {
                        ?>
                            <img src="<?php echo $img; ?>" class="avatar">
                        <?php
                        }
                        ?>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Fullname
                        </label>

                        <input
                        type="text"
                        name="Fullname"
                        value="<?php echo $row['Fullname']; ?>"
                        class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            SumClass
                        </label>

                        <input
                        type="number"
                        name="SumClass"
                        value="<?php echo $row['SumClass']; ?>"
                        class="form-control">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Đổi ảnh mới
                        </label>

                        <input
                        type="file"
                        name="Image"
                        class="form-control">

                    </div>

                    <div class="d-flex gap-3 mt-4">

                        <button
                        type="submit"
                        name="update"
                        class="btn btn-warning">
                            💾 Cập nhật
                        </button>

                        <a
                        href="index.php"
                        class="btn btn-secondary">
                            ⬅ Quay lại
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>

</html>