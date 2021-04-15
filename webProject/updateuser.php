<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:login.php");
    }

    $mysqli = require_once('conn.php');
    $id = $_GET['id'];

    $sql = "SELECT * FROM USER WHERE IDUSER=$id";
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();


    if (isset($_POST['submit'])){
        require_once('conn.php');

        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "UPDATE `user` SET `TENUSER`=?,`USERNAME`=?,`PASSWORD`=? WHERE `IDUSER`=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssd", $name,$username,$password,$id);
        
        $isOK = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        header("Location: qlyuser.php");
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
    <h2>Sửa Người Dùng</h2>
    <form  method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên User:</label>
            <input type="text" class="form-control" id="name" value="<?= $row1['tenuser']?>" name="name" required>
        </div>
        <div class="form-group">
            <label for="name">Username:</label>
            <input type="text" class="form-control" id="username" value="<?= $row1['username']?>" name="username" required>
        </div>
        <div class="form-group">
            <label for="name">Password:</label>
            <input type="text" class="form-control" id="password" value="<?= $row1['password']?>" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Sửa</button>
    </form>

    <br>
</div>



</body>
</html>