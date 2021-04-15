<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:../qlfilm/login.php");
    }

    $mysqli = require_once('conn.php');
    $id = $_GET['id'];

    $sql = "SELECT * FROM film WHERE IDFILM=$id";
    $result = $conn->query($sql);
    $row1 = $result->fetch_assoc();
   
    if (isset($_POST['submit'])){
        require_once('conn.php');
        $name = $_POST['name'];

        $year = $_POST['year'];
        
        $type = $_POST['type'];

        $country = $_POST['country'];

        $directors = $_POST['directors'];
        
        $actor = $_POST['actor'];
        
        $time = $_POST['time'];

        $rate = $_POST['rate'];

        $description = $_POST['description'];

        $link = $_POST['link'];

        $trailer = $_POST['trailer'];

        

        if ($_FILES['fileUpload']['name'] != ""){
            $target = "img/" . $_FILES['fileUpload']['name'];
            move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target);
            if ($time != $row1['THOILUONG']){
                $sql = "UPDATE `film` SET `TENFILM`=?,`HINH`=?,`DIENVIEN`=?,`THONGTIN`=?,`THOILUONG`=?,`NAMSX`=?,`SORATING`=?,`QUOCGIA`=?,`DAODIEN`=?,`LINKFILM`=?,`LINKTRAILER`=? WHERE `IDFILM`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssddddsssd", $name,$target,$actor,$description,$time,$year,$rate,$country,$directors,$link,$trailer,$id);
                
                $isOK = $stmt->execute();
                
                $stmt->close();
            }
            else {
                $sql = "UPDATE `film` SET `TENFILM`=?,`HINH`=?,`DIENVIEN`=?,`THONGTIN`=?,`NAMSX`=?,`SORATING`=?,`QUOCGIA`=?,`DAODIEN`=?,`LINKFILM`=?,`LINKTRAILER`=? WHERE `IDFILM`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssdddsssd", $name,$target,$actor,$description,$year,$rate,$country,$directors,$link,$trailer,$id);
                
                $isOK = $stmt->execute();
                
                $stmt->close();
            }
        }
        else{
            if ($time != $row1['THOILUONG']){
                $sql = "UPDATE `film` SET `TENFILM`=?,`DIENVIEN`=?,`THONGTIN`=?,`THOILUONG`=?,`NAMSX`=?,`SORATING`=?,`QUOCGIA`=?,`DAODIEN`=?,`LINKFILM`=?,`LINKTRAILER`=? WHERE `IDFILM`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssddddsssd", $name,$actor,$description,$time,$year,$rate,$country,$directors,$link,$trailer,$id);
                
                $isOK = $stmt->execute();
                
                $stmt->close();
            }
            else {
                $sql = "UPDATE `film` SET `TENFILM`=?,`DIENVIEN`=?,`THONGTIN`=?,`NAMSX`=?,`SORATING`=?,`QUOCGIA`=?,`DAODIEN`=?,`LINKFILM`=?,`LINKTRAILER`=? WHERE `IDFILM`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssdddsssd", $name,$actor,$description,$year,$rate,$country,$directors,$link,$trailer,$id);
                
                $isOK = $stmt->execute();
                
                $stmt->close();
            }
        }
        $sql2 = "DELETE FROM chitietfilm WHERE idfilm = $id";
        mysqli_query($conn, $sql2);
        if($type){
            foreach($type as $value) {
                $mysqli = require_once('conn.php');
          
                $sql3 = "INSERT INTO `chitietfilm`(`idfilm`, `idtheloai`) VALUES (?,?)";
                $stmt = $conn->prepare($sql3);
                $stmt->bind_param("dd", $id,$value);
                
                $isOK = $stmt->execute();
            }
        }
        header("Location: admin.php");
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
    <h2>Sửa Phim</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên phim:</label>
            <input type="text" class="form-control" id="name" value="<?= $row1['tenfilm']?>" name="name" required>
        </div>
		<div class="form-group">
			<label for="sel1">Thể loại: </label>
			<br/>
            <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `theloai` WHERE 1 ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                <input type="checkbox" name="type[]" value="<?= $row['idtheloai']?> " id="<?= $row['idtheloai']?>">
                <label><?= $row['tentheloai']?></label><br/>
            <?php
                $sql2 = "SELECT * FROM `chitietfilm` WHERE idfilm = $id ";
                //echo $sql2;
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while ($row2 = $result2->fetch_assoc()) {
                        if($row['idtheloai']==$row2['idtheloai']){
                            
            ?>
                <script>
                    document.getElementById("<?= $row['idtheloai']?>").checked = true;
                </script>
            <?php
                        
                        }
                    }
                }
            ?>
                
            <?php 
                  }
                }
            ?>
		
		<div class="form-group">
			<label for="sel1">Quốc gia: </label>
			<select class="form-control" id="country" name = "country" required>
                <?php 
                    require_once('conn.php');
                    $sql = "SELECT * FROM `quocgia` WHERE idquocgia = ".$row1['quocgia'];
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                ?>
				<option value="<?= $row['idquocgia']?>"> <?= $row['tenquocgia']?> </option>
                <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `quocgia` WHERE idquocgia != ".$row1['quocgia'];
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                ?>
				<option value="<?= $row['idquocgia']?>" name="country"><?= $row['tenquocgia']?></option>
                <?php 
                  }
                }
                ?>
			</select>
			
		</div>
		<div class="form-group">
            <label for="name">Đạo diễn:</label>
            <input type="text" class="form-control" id="directors" value="<?= $row1['daodien']?>" name="directors" required>
        </div>
		<div class="form-group">
            <label for="name">Diễn viên:</label>
            <input type="text" class="form-control" id="actor" value="<?= $row1['dienvien']?>" name="actor" required>
        </div>
		<div class="form-group">
            <label for="name">Thời lượng:</label>
            <input type="text" class="form-control" maxlength="6" id="time" value="<?= $row1['thoiluong']?>" name="time" required>
        </div>
		<div class="form-group">
            <label for="name">Số rating:</label>
            <input type="text" class="form-control" maxlength="1" id="rate" value="<?= $row1['sorating']?>" name="rate" required>
        </div>
        <div class="form-group">
            <label for="price">Năm sản xuất:</label>
            <input type="text" class="form-control" maxlength="4" id="year" value="<?= $row1['namsx']?>" name="year" required>
        </div>
		<div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" name="description" required><?= $row1['thongtin']?></textarea>
        </div>
		<div class="form-group">
            <label for="name">Link phim:</label>
            <input type="text" class="form-control" id="link" value="<?= $row1['linkfilm']?>" name="link" required>
        </div>
		<div class="form-group">
            <label for="name">ID link trailer:</label>
            <input type="text" class="form-control" id="trailer" value= "<?= $row1['linktrailer']?>" name="trailer" required>
        </div>
		<div class="form-group">
            <label for="fileUpload">Hình:</label>
            <input type="file" class="form-control" id="fileUpload" name="fileUpload"></textarea>
        </div>
		
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Sửa</button>
    </form>

    <br>
	<a href="logout.php"<button  type="button" class="btn btn-primary btn-lg btn-block">Đăng xuất </a></button>

</div>



</body>
</html>