<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:login.php");
    }

    $mysqli = require_once('conn.php');
    $id = $_GET['id'];

    $sql = "SELECT * FROM THELOAI WHERE IDTHELOAI=$id";
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();

    if (isset($_POST['submit'])){
        require_once('conn.php');

        $name = $_POST['name'];

        $sql = "UPDATE `THELOAI` SET `TENTHELOAI`=? WHERE `IDTHELOAI`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sd", $name,$id);
        
        $isOK = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        header("Location: qlytheloai.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
</head>
<body>

<style>
    body{
        padding-top: 50px;
    }
    table{

        text-align: center;
    }
    tr.item{
        border-top: 1px solid #5e5e5e;
        border-bottom: 1px solid #5e5e5e;
    }

    tr.item:hover{
        background-color: #d9edf7;
    }

    tr.item td{
        min-width: 150px;
    }

    tr.header{
        font-weight: bold;
    }

    a{
        text-decoration: none;
    }
    a:hover{
        color: deeppink;
        font-weight: bold;
    }
</style>


<div class="container" style="width: 600px">
    <h2>Sửa Thể Loại</h2>
    <form  method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên thể loại:</label>
            <input type="text" class="form-control" id="name" value="<?= $row1['tentheloai']?>" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Sửa</button>
    </form>

    <br>
</div>



</body>
</html>