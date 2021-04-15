<?php
    ob_start();
    session_start();
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:../webProject/login.php");
    }

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
        

        $target = "img/" . $_FILES['fileUpload']['name'];
        move_uploaded_file($_FILES['fileUpload']['tmp_name'], $target);
        
        $sql = "INSERT INTO film(TENFILM,HINH,DIENVIEN,THONGTIN,THOILUONG,NAMSX,SORATING,QUOCGIA,DAODIEN,LINKFILM,LINKTRAILER) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssddddsss", $name, $target,$actor,$description,$time,$year,$rate,$country,$directors,$link,$trailer);
        
        $isOK = $stmt->execute();
        
        if($type){
            foreach($type as $value) {
                $mysqli = require_once('conn.php');
                $sql1 = "select * from film where TENFILM = '$name'";
                $result1 = $conn->query($sql1);
                $row1 = $result1->fetch_assoc();
                $id = $row1['idfilm'];
                
                $sql = "INSERT INTO `chitietfilm`(`idfilm`, `idtheloai`) VALUES (?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("dd", $id,$value);
                
                $isOK = $stmt->execute();
            }
        }
        $stmt->close();
        $conn->close();
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
    <h2>Thêm Phim</h2>
    <form  method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Tên phim:</label>
            <input type="text" class="form-control" id="name" placeholder="Nhập tên phim" name="name" required>
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
            <input type="checkbox" name="type[]" value="<?= $row['idtheloai']?>">
            <label><?= $row['tentheloai']?></label><br/>
            <?php 
                  }
                }
            ?>
		</div>
		
		<div class="form-group">
			<label for="sel1">Quốc gia: </label>
			<select class="form-control" id="country" name = "country" required>
				<option> </option>
                <?php 
                require_once('conn.php');
                $sql = "SELECT * FROM `quocgia` WHERE 1 ";
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
            <input type="text" class="form-control" id="directors" placeholder="Nhập tên đạo diễn" name="directors" required>
        </div>
		<div class="form-group">
            <label for="name">Diễn viên:</label>
            <input type="text" class="form-control" id="actor" placeholder="Nhập tên diễn viên" name="actor" required>
        </div>
		<div class="form-group">
            <label for="name">Thời lượng:</label>
            <input type="text" class="form-control" maxlength="6" id="time" placeholder="Nhập thời lượng (vd 2h30p = 23000)" name="time" required>
        </div>
		<div class="form-group">
            <label for="name">Số rating:</label>
            <input type="text" class="form-control" maxlength="1" id="rate" placeholder="Nhập số rating tối đa là 5" name="rate" required>
        </div>
        <div class="form-group">
            <label for="price">Năm sản xuất:</label>
            <input type="text" class="form-control" maxlength="4" id="year" placeholder="Nhập năm" name="year" required>
        </div>
		<div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea class="form-control" id="description" placeholder="Nhập mô tả" name="description" required></textarea>
        </div>
		<div class="form-group">
            <label for="name">Link phim:</label>
            <input type="text" class="form-control" id="link" placeholder="Nhập link phim" name="link" required>
        </div>
		<div class="form-group">
            <label for="name">ID link trailer:</label>
            <input type="text" class="form-control" id="trailer" value= "https://www.youtube.com/embed/" name="trailer" required>
        </div>
		<div class="form-group">
            <label for="fileUpload">Hình:</label>
            <input type="file" class="form-control" name="fileUpload" required>
        </div>
		
        <button type="submit" class="btn btn-primary btn-lg btn-block" name="submit">Thêm</button>
    </form>

    <br>

</div>



</body>
</html>