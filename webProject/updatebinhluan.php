<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:../qlfilm/login.php");
    }
    $mysqli = require_once('conn.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM BINHLUAN WHERE IDCOMMENT=$id";
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();

    if (isset($_POST['submit'])){
        require_once('conn.php');

        $iduser = $_POST['iduser'];
        $idphim = $_POST['name'];
        $description = $_POST['description'];


        $sql = "UPDATE `binhluan` SET `NAME`=?,`PHIMCOMMENT`=?,`NOIDUNG`=? WHERE `IDCOMMENT`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddsd",  $iduser,$idphim,$description,$id);
        
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
            <?php 
                    require_once('conn.php');
                    $sql = "SELECT * FROM `FILM` WHERE IDFILM = ".$row1['phimcomment'];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
            ?>
            <option value="<?= $row1['phimcomment']?>"><?= $row['tenfilm']?> </option>
            <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `film` WHERE IDFILM != ".$row1['phimcomment'];
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
        <div class="form-group">Id User: </label>
			<select class="form-control" id="iduser" name = "iduser" required> 
            <?php 
                    require_once('conn.php');
                    $sql = "SELECT * FROM `USER` WHERE IDUSER = ".$row1['name'];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
            ?>
            <option value="<?= $row1['name']?>"><?= $row['username']?> </option>
            <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `USER` WHERE IDUSER != ".$row1['name'];
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
            <textarea class="form-control" id="description"  name="description" required><?= $row1['noidung']?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Sửa</button>
    </form>

    <br>
</div>



</body>
</html>