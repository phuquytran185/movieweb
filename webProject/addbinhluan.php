<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:login.php");
    }
    if (isset($_POST['submit'])){
        require_once('conn.php');

        $iduser = $_POST['iduser'];
        $idphim = $_POST['name'];
        $description = $_POST['description'];
        $time = 'now()';

        $sql = "INSERT INTO `binhluan`(`NAME`, `PHIMCOMMENT`, `NOIDUNG`, `TIME`) VALUES (?,?,?,$time)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dds",  $iduser,$idphim,$description);
        
        $isOK = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        header("Location: qlybinhluan.php");
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
    <h2>Thêm Bình Luận</h2>
    <form  method="POST" enctype="multipart/form-data">
        <label for="name">Chọn phim</label>
        <hr>
        <div class="form-group">Phim: </label>
			<select class="form-control" id="name" name = "name" required> 
            <option> </option>
            <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `film` WHERE 1 ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
			<option value="<?= $row['idfilm']?>" ><?= $row['tenfilm']?></option>
            <?php 
                  }
                }
            ?>
			</select>
		</div>
        
        <label for="name">User</label>
        <hr>
        <div class="form-group">Username: </label>
			<select class="form-control" id="iduser" name = "iduser" required> 
            <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `user` WHERE 1 ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
			<option value="<?= $row['iduser']?>" ><?= $row['username']?></option>
            <?php 
                  }
                }
            ?>
			</select>
		</div>

        <label for="name">Comment</label>
        <hr>
        <div class="form-group">
            <label for="description">Nội dung:</label>
            <textarea class="form-control" id="description" placeholder="Nhập mô tả" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Thêm</button>
    </form>

    <br>
</div>



</body>
</html>