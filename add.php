<?php

include 'connect.php';

if(isset($_POST['save']))
{
    $Fullname = $_POST['Fullname'];
    $SumClass = $_POST['SumClass'];

    $Image = $_FILES['Image']['name'];

    move_uploaded_file(
        $_FILES['Image']['tmp_name'],
        "images/".$Image
    );

    $sql = "
        INSERT INTO GiangVien
        (Fullname, Image, SumClass)

        VALUES

        ('$Fullname', '$Image', '$SumClass')
    ";

    if(mysqli_query($conn, $sql))
    {
        header("Location:index.php");
        exit();
    }
    else
    {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Thêm Giảng Viên</title>

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

.title{
    text-align:center;
    color:#6f42c1;
    font-weight:bold;
    margin-bottom:30px;
}

.preview{
    width:180px;
    height:180px;
    object-fit:cover;
    border-radius:15px;
    border:4px dashed #ccc;
    display:block;
    margin:auto;
}

.form-label{
    font-weight:bold;
    color:#555;
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

</style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card-box">

                <h2 class="title">
                    🎓 THÊM GIẢNG VIÊN
                </h2>

                <form method="POST" enctype="multipart/form-data">

                    <div class="text-center mb-4">

                        <img
                        id="preview"
                        src="https://via.placeholder.com/180"
                        class="preview">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Fullname
                        </label>

                        <input
                        type="text"
                        name="Fullname"
                        class="form-control"
                        required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            SumClass
                        </label>

                        <input
                        type="number"
                        name="SumClass"
                        class="form-control"
                        required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Chọn ảnh
                        </label>

                        <input
                        type="file"
                        name="Image"
                        id="Image"
                        class="form-control"
                        accept="image/*"
                        required>

                    </div>

                    <div class="d-flex gap-3">

                        <button
                        type="submit"
                        name="save"
                        class="btn btn-success">
                            💾 Lưu
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

<script>

document.getElementById("Image").addEventListener("change", function(){

    const file = this.files[0];

    if(file)
    {
        document.getElementById("preview").src =
        URL.createObjectURL(file);
    }

});

</script>

</body>

</html>