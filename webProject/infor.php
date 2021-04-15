<?php
  require "conn.php";
  $filmperpage =10 ;

  if( isset($_GET["trang"]) ){
    $trang = $_GET["trang"];
    settype($trang, "int");
  }else{
    $trang = 1;	
  }
?>
<?php
	session_start();
  require_once("conn.php");
  $id = $_GET['id'];
	if (isset($_POST['submit'])) 
	{
		$username = addslashes($_POST['uname']);
		$password = addslashes($_POST['psw']);
		if (!$username || !$password) {
      echo '<script language="javascript">';
      echo 'alert("Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.")'; 
      echo '</script>';
		}
		else{
			$query = mysqli_query($conn,"SELECT username,tenuser,password FROM user WHERE username='$username'");
			if (mysqli_num_rows($query) == 0) {
        echo '<script language="javascript">';
        echo 'alert("Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.")'; 
        echo '</script>';
			}
			else{
				$row = mysqli_fetch_array($query);
				if ($password != $row['password']) {
          echo '<script language="javascript">';
          echo 'alert("Mật khẩu không đúng. Vui lòng nhập lại.")'; 
          echo '</script>';
				}
				else{
          $query1 = mysqli_query($conn,"SELECT tenuser FROM user WHERE username='$username' and password='$password'");
          $row1 = mysqli_fetch_array($query1);
          $_SESSION['tenuser'] = $row1['tenuser'];
					$_SESSION['uname'] = $username;
          header("location:infor.php?id=$id");
				}
			}
		}
  }
  if (isset($_POST['cancel'])){
    unset($_SESSION['uname']);
  }
  if (isset($_POST['btnRate'])) 
	{
    if(!isset($_SESSION['uname'])){
      echo '<script language="javascript">';
      echo 'alert("Vui lòng đăng nhập")'; 
      echo '</script>';
    }
    else{
      $rate = $_POST["rate"];
      if($_POST["rate"]){
        $id1 = $_GET["id"];
        $user = $_SESSION['uname'];
        $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
        $row = mysqli_fetch_array($query);
        $iduser = $row['iduser'];
        $queryAdd = "INSERT INTO `chitietrating`(`idfilm`, `iduser`, `rating`) VALUES (?,?,?)";
        $stmt = $conn->prepare($queryAdd);
        $stmt->bind_param("ddd", $id1,$iduser,$rate);         
        $isOK = $stmt->execute();
        $sumRating = 0;
        $queryEdit = "SELECT `rating` FROM `chitietrating` WHERE `idfilm` = $id1";
        $result = $conn->query($queryEdit);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $sumRating += $row['rating'];
          }
        }
        $ratingFilm = $sumRating/$result->num_rows;
        $queryEditRating = "UPDATE `film` SET `sorating`= ?  WHERE `idfilm` = ?";
        $stmt = $conn->prepare($queryEditRating);
        $stmt->bind_param("dd",$ratingFilm,$id1);         
        $isOK = $stmt->execute();
        $stmt->close();
      }else{
      
      }
    }
  }
  if (isset($_POST['addComment'])) 
	{
    if(!isset($_SESSION['uname'])){
      echo '<script language="javascript">';
      echo 'alert("Vui lòng đăng nhập")'; 
      echo '</script>';
    }
    else{
      $idphim = $_GET["id"];
      $user = $_SESSION['uname'];
      $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
      $row = mysqli_fetch_array($query);
      $iduser = $row['iduser'];
      $description = $_POST['usercomment'];
      $time = 'now()';
      $sql = "INSERT INTO `binhluan`(`NAME`, `PHIMCOMMENT`, `NOIDUNG`, `TIME`) VALUES (?,?,?,$time)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("dds",  $iduser,$idphim,$description);
        
      $isOK = $stmt->execute();
      $stmt->close();
    }
  }
  if (isset($_POST['like'])){
    if($_POST['like']==0){
      $idphim = $_GET["id"];
      $user = $_SESSION['uname'];
      $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
      $row = mysqli_fetch_array($query);
      $iduser = $row['iduser'];
      $queryAdd = "INSERT INTO `khofilmyeuthich`(`idfilm`, `iduser`) VALUES (?,?)";
      $stmt = $conn->prepare($queryAdd);
      $stmt->bind_param("dd", $idphim,$iduser);         
      $isOK = $stmt->execute();
      $stmt->close();
    }else{
      $idphim = $_GET["id"];
      $user = $_SESSION['uname'];
      $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
      $row = mysqli_fetch_array($query);
      $iduser = $row['iduser'];
      $queryDel = "DELETE FROM `khofilmyeuthich` WHERE idfilm = ? and iduser = ?";
      $stmt = $conn->prepare($queryDel);
      $stmt->bind_param("dd", $idphim,$iduser);         
      $isOK = $stmt->execute();
      $stmt->close();
    }  
  }
  if (isset($_POST['likeAlert'])){
    echo '<script language="javascript">';
    echo 'alert("Vui lòng đăng nhập để thêm vào hộp phim")'; 
    echo '</script>';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="\webproject\css\style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Thông Tin Film</title>
    </head>
    <style>
        
        .checked{
            color: orange;
        }
        .fa-star{
            font-size: 25px;
        }
        .left-content{
            display:flex;
            justify-content: center;
            align-items: center;
        }

    </style>
<body>
            <!--day la navbar-->
            <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
                <a class="navbar-brand" href="index.php" style="font-weight: bold;">P<span>himhay</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav mr-auto">
                      <li class="nav-item active">
                        <a class="nav-link" href="index.php">Trang chủ</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link " href="khofilm.php" role="button"  aria-haspopup="true" aria-expanded="true">
                          Kho phim
                        </a>
                      </li>
                      <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Thể loại
                        </a>
                        
                        <div class="dropdown-menu scrollable-menu" aria-labelledby="navbarDropdown">
                          <?php 
                            require_once('conn.php');
                            $sql = "SELECT * FROM `theloai` ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                          ?>
                          <a class="dropdown-item" href="filmtheloai.php?id=<?= $row['idtheloai']?>"><?= $row['tentheloai']?></a>
                          <?php 
                              }
                            }
                          ?>
                        </div>
                        
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" target="_blank" href="about.php">About</a>
                      </li>
                          </ul>
                          <ul class="navbar-nav ml-auto">
                      <li class="nav-item">

                          <div id="id01" class="modal">
                            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form class="modal-content animate" method="post">
                              <div class="container">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname">

                                <label for="psw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="psw">
                                  
                                <button type="submit" name="submit">Đăng nhập</button>
                                <label>
                                  <input type="checkbox" checked="checked" name="remember"> Remember
                                </label>
                                <a href="signup.php"><h5 style="color: black">Đăng ký</h5></a>
                              </div>           
                            </form>
                          </div>
                        
                        <?php 
                          if(!isset($_SESSION['uname'])){
                        ?>
                          <button id="login" class="loginIn" name="login" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Đăng nhập</button>
                        <?php 
                          }
                          else{
                        ?>
                        <li class="nav-item">
                          <a class="nav-link" target="_blank" href="khophimyeuthich.php">Hộp phim</a>
                        </li>
                        
                        <form method="post" >                  
                          <button id="login" name="cancel" type="submit" style="width:auto;">Đăng xuất</button>
                        </form>
                        <?php 
                          }
                        ?>
                        <script>

                          // Get the modal
                          var modal = document.getElementById('id01'); 
                          // When the user clicks anywhere outside of the modal, close it
                          window.onclick = function(event) {
                              if (event.target == modal) {
                                  modal.style.display = "none";
                              }
                          }
                      </script>                       
                      </li>    
                  </ul>
                </div>  
            </nav> 
    <br>
    <br>
    <div class="container-fluid padding" style="background-color:white">
        <div class="row padding">
            <div class="col-md-1" style="height:auto;"></div>
                <div class="col-md-10">
                    <!--Inside container-->
                    <div class="container padding" >
                        <div class="row padding">
                          <?php 
                            require_once('conn.php');
                            $id = $_GET['id'];
                            $sql = "SELECT *
                            FROM film 
                            wHERE IDFILM=$id";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                          ?>
                            <div class="col-md-5" id="left">
                                <div class="card text-center">
                                    <div class="card-body">
                                        
                                        <form action="" method="post">
                                        
                                        <?php
                                              require_once('conn.php');
                                              $id = $_GET['id'];
                                              if(isset($_SESSION['uname'])){
                                              $user = $_SESSION['uname'];
                                              $query2 = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
                                              $row2 = mysqli_fetch_array($query2);
                                              $iduser = $row2['iduser'];
                                              $sql1 = "SELECT * FROM khofilmyeuthich WHERE idfilm=$id and iduser=$iduser";
                                              $result1 = $conn->query($sql1);
                                              $rownum = $result1->num_rows;
                                              if($rownum==0){
                                            ?>
                                            <button value="0" type="submit" name="like" style="right:46px;position:absolute;border:none"><i id="like" class="fa fa-heart-o" style="font-size:30px;color:red"></i></button>
                                            <?php
                                              }else{
                                            ?>
                                            <button value="1" type="submit" name="like" style="right:46px;position:absolute;border:none"><i id="like" class="fa fa-heart" style="font-size:30px;color:red"></i></button>
                                            <?php
                                              }
                                            }else{
                                            ?>
                                            <button type="submit" name="likeAlert" style="right:46px;position:absolute;border:none"><i id="like" class="fa fa-heart-o" style="font-size:30px;color:red"></i></button>
                                            <?php
                                              }
                                            ?>
                                            <img src="<?= $row['hinh'] ?>" class="card-img-top" style="width:350px;height:400px ; max-height: 500px; max-width: 500px" alt="">
                                        </form>
                                        <form action="" method="post">
                                          
                                            <a href="chitiet.php?id=<?= $row['idfilm']?>"><button type="button" class="btn btn-info mt-2">Xem Phim</button></a>
                                            <button type="button" class="btn btn-danger mt-2">Chi tiết</button>
                                          </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7" id="right">
                                <div class="card pl-2">
                                <h3 class="lead" style="font-size: 25px">Tên Phim: <?= $row['tenfilm']?></h3>
                                <span class="lead" style="font-size: 20px">Thể Loại:
                                <?php 
                                  require_once('conn.php');
                                  $sql = "SELECT TENTHELOAI
                                  FROM theloai 
                                  INNER JOIN chitietfilm ON chitietfilm.idtheloai = theloai.idtheloai
                                  wHERE chitietfilm.IDFILM = $id";
                                  $result = $conn->query($sql);
                                  $i = 0;
                                  if ($result->num_rows > 0) {

                                    while ($row1 = $result->fetch_assoc()) {
                                      if($i != $result->num_rows-1){
                                ?>
                                <?= $row1['TENTHELOAI']?> ,
                                <?php
                                    }else{
                                ?>
                                <?= $row1['TENTHELOAI']?>
                                <?php
                                      }
                                      $i++;
                                    }
                                  }
                                ?>
                                </span>
                                </br>
                                <p class="lead" style="font-size: 20px">Đạo Diễn: <?= $row['daodien']?></p>
                                <p class="lead" style="font-size: 20px">Diễn Viên: <?= $row['dienvien']?></p>
                                <p class="lead" style="font-size: 20px">Năm Sản Xuất: <?= $row['namsx']?></p>
                                <p class="lead" style="font-size: 23px">Tóm Tắt: <?= $row['thongtin']?></p>
                                </div>
                            </div>
                          <?php
                              }
                            }
                          ?>
                        </div>
                    </div>
                    <!--End inside container-->
                    <!--Rating-->
                    <h3 class="text-center">Đánh giá</h3>
                    <?php
                        require_once('conn.php');
                        $idfilm = $_GET['id'];
                        
                        $queryGetRating = mysqli_query($conn,"SELECT sorating FROM film WHERE idfilm=$idfilm");
                        $rowRating = mysqli_fetch_array($queryGetRating);
                        
                        $queryNumRating = mysqli_query($conn,"SELECT count(*) as LuotRating FROM `chitietrating` WHERE idfilm = $idfilm");
                        $rowNumRating = mysqli_fetch_array($queryNumRating);
                    ?>
                    <div class="text-center">Rating: <?= $rowRating['sorating']?>/5 (<?= $rowNumRating['LuotRating']?> lượt rating)</div>
                    <form method="post">
                    <div class="container text-center bg-light padding" id="below-div">
                        <div class="row padding" id="below-row">
                            <div class="col-md-9 bg-light">   
                                <div class="card bg-light" style="border: none">
                                    <div class="card-body">
                                        <div class="p-2" id="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <input id="5start" name="rate" type="radio" value="5" />
                                            
                                        </div>
                                        
                                        <div class="p-2" id="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star "></span>
                                            <input id="4start" name="rate" type="radio" value="4" />
                                        </div>
                                        
                                        <div class="p-2" id="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <input id="3start" name="rate" type="radio" value="3" />
                                        </div>
                                        
                                        <div class="p-2" id="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <input id="2start" name="rate" type="radio" value="2" />
                                        </div>
                                        
                                        <div class="p-2" id="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <input id="1start" name="rate" type="radio" value="1" />
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 bg-light left-content">
                                    <button id="btn" type="submit" name="btnRate" class="btn btn-primary">Đánh giá</button>
                            </div>
                            <?php
                                              require_once('conn.php');
                                              $id = $_GET['id'];
                                              if(isset($_SESSION['uname'])){
                                                $user = $_SESSION['uname'];
                                                $query = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
                                                $row = mysqli_fetch_array($query);
                                                $iduser = $row['iduser'];
                                                $sql = "SELECT rating from chitietrating where iduser =  $iduser and idfilm=$id";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {                                             
                                            ?>
                                                <script>
                                                  document.getElementById("btn").disabled = true;
                                                </script>
                                            <?php
                                                $row1 = $result->fetch_assoc();
                                                if($row1['rating'] == 5){
                                            ?>
                                                <script>
                                                  document.getElementById("5start").checked = true;
                                                </script>
                                            <?php
                                                }elseif($row1['rating'] == 4){
                                            ?>
                                            <script>
                                                  document.getElementById("4start").checked= true;
                                                </script>
                                            <?php
                                                }elseif($row1['rating'] == 3){
                                            ?>
                                            <script>
                                                 document.getElementById("3start").checked= true;
                                                </script>
                                            <?php
                                                }elseif($row1['rating'] == 2){
                                            ?>
                                            <script>
                                                  document.getElementById("2start").checked= true;
                                                </script>
                                            <?php
                                                }elseif($row1['rating'] == 1){
                                            ?>
                                            <script>
                                                  document.getElementById("1start").checked= true;
                                                </script>
                                            <?php
                                                }
                                              }
                                            }
                              ?>
                        </div>
                        </form>
                    </div>
                    <hr>
                        <div class="clear-fix"></div>
                        <!--End rating-->
                        <!--Trailer-->
                        <h3 class="text-center">Trailer</h3>
                        <?php 
                            require_once('conn.php');
                            $id = $_GET['id'];
                            $sql = "SELECT *
                            FROM film 
                            wHERE IDFILM=$id";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="container text-center">
                                <object style="width:100%;height:100%;width: 80%; height: 461.25px; float: none; clear: both; margin: 2px auto;" data="<?= $row['linktrailer'] ?>">
                                </object>
                        </div>
                        <?php
                              }
                            }
                        ?>
                        <div class="container padding" >
      <hr>
        <div class="row padding">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <form method="post">
              <div class="form-group">
                
                <label for="usercomment"><h4>Comment</h4></label>
                <?php 
                      require_once('conn.php');
                      $id = $_GET['id'];
                      $query = mysqli_query($conn,"SELECT count(*) as total from binhluan where phimcomment= $id");
                            $data = mysqli_fetch_array($query);
                      ?>
                <div>
                    <p style="font-size:17px"><?= $data['total']?> Bình Luận</p>
                </div>
                
                <hr>
                <textarea name="usercomment" id="usercomment" placeholder="Cho chúng tôi cảm nhận về bộ phim này của bạn :D" style="width:100%; height:auto;"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="addComment">Comment</button>
            </form>
            <br>
            <!--End comment section-->
            <form action="" method="post">
              <div class="form-group">
                <?php 
                      require_once('conn.php');
                      $from = ($trang -1 ) * $filmperpage;
                      $id = $_GET['id'];
                      $sql = "SELECT * 
                      FROM binhluan
                      where phimcomment = $id
                      LIMIT $from,$filmperpage";   
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            $iduser = $row['name'];
                            $query = mysqli_query($conn,"SELECT * FROM user where iduser = $iduser");
                            $row1 = mysqli_fetch_array($query);
                      ?>
                <ul style="list-style: none">
                  <li>
                  <?php
                    if(isset($_SESSION['uname'])){
                      if($row1['username']==$_SESSION['uname']){
                        

                  ?>
                  <div style="float:right">
                    &nbsp;
                    <a href="deleteusercmt.php?id=<?= $row['idcomment']?> & id1=<?= $row['phimcomment']?>">Xóa</a>
                      </div>
                    
                  <?php
                      }
                    }
                  ?>
                    <img src="http://placekitten.com/45/45" />
                    &ensp;
                    <b><?= $row1['tenuser'] ?></b>
                    </li>
                  
                  </li>
                  <li>
                  &ensp;
                  &ensp;
                  &ensp;
                  &ensp;
                  &nbsp;
                    <?= $row['noidung'] ?>
                  
                </ul>
                <?php
                          }
                        }
                ?>
              </div>
            </form>
            <!--Comment Management-->
          </div><!--End div col-md-8-->
          <div class="col-md-2"></div>
        </div>
    </div>
              
    

<!--End Comment Management-->
    <hr>
        <div class="container-fluid padding">
          <div class="row text-center padding">
            <div class="col-12">Contact us</div>
          </div>
          <div class="col-12 social text-center padding">
            <a target="_blank" href="https://www.facebook.com/oscar.dasilva.58910"><i class="fa fa-facebook-official"></i></a>
            <a target="_blank" href="#"><i class="fa fa-google-plus"></i></a>
            <a target="_blank" href="#"><i class="fa fa-instagram"></i></a>
            <a target="_blank" href="#"><i class="fa fa-linkedin-square"></i></a>
          </div>
        </div>
        <!--end footer-->
    <br>
                </div>
                
                <!--End trailer-->
            <div class="col-md-1" style="height:auto;"></div>
        </div>
    </div>
    <!--Comment section-->
    
    <footer>
      <p class="text-center">Sản phẩm được làm bởi 4 thành viên</p>
      <div class="container-fluid padding">
        <div class="row text-center">
          <div class="col-md-3">
            <p>Phạm Duy Thái</p>
            <p>51702180</p>
            <p>0393460775</p>
          </div>
          <div class="col-md-3">
            <p>Nguyễn Phùng Thanh</p>
            <p>51702183</p>
            <p>#########</p>
          </div>
          <div class="col-md-3">
            <p>Trần Phú Quý</p>
            <p>51702165</p>
            <p>#########</p>
          </div>
          <div class="col-md-3">
            <p>Lê Minh Hiếu</p>
            <p>51702016</p>
            <p>#########</p>
          </div>
        </div>
      </div>
    </footer>
    
</body>
</html>