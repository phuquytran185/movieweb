<?php
  require "conn.php";
  $filmperpage = 12 ;

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
            header("location:index.php");
          }
        }
      }
    }
  if (isset($_POST['cancel'])){
    unset($_SESSION['uname']);
  }
?>

<?php
  function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
  }
?>


<!doctype html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href=".\css\style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>Kho Film</title>
    <style>
    .scrollable-menu{
          min-width: 250px;
          max-height: 50vh;
          overflow: auto;
        }
    </style>
    </head>
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
            <br>
            <br>
            <h5 class="text-center">Kho Phim</h5>
            <hr>
            <div class="container-fluid padding ">
              <div class="row padding">
                <!--Card-->
                <?php 
                  require_once('conn.php');
                  $from = ($trang -1 ) * $filmperpage;
                  $sql = "SELECT *
                    FROM film 
                    ORDER BY idfilm DESC
                    LIMIT $from,$filmperpage";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-3">
                  <div class="card">
                  <a href="chitiet.php?id=<?= $row['idfilm']?>" class="hvr-sweep-to-bottom"></a>
                  <img src="<?= $row['hinh'] ?>" title="Click để xem phim" class="card-img-top" style="height:300px;max-height: 500px; max-width: 80%" alt=" ">
                    <div class="card-body">
                        <a href="infor.php?id=<?= $row['idfilm']?>"><p class="card-title" style="font-size: 25px"><?= limit_text($row['tenfilm'],6) ?></p></a>
                        <p class="card-text" style="font-size: 17px"><?= limit_text($row['dienvien'],4) ?></p>
                        <p><?= $row['namsx'] ?></p>
                        <a href="infor.php?id=<?= $row['idfilm']?>" class="btn btn-outline-secondary">Xem Phim</a>
                    </div>
                  </div>
                  <br>
                </div>
                <?php 
                  }
                }
                ?>
              <!--End card-->
            </div>
          </div>
        </div>
        <?php 
          require_once('conn.php');
          $qr = "SELECT * FROM film";
          $result = $conn->query($qr);
          $tongsotin = $result->num_rows;
          $pageNumber = ceil($tongsotin/$filmperpage);
        ?>
        <div class ="text-center">
          <?php
            for($t =1;$t<=$pageNumber;$t++){
              echo "<a href='khofilm.php?trang=$t' class='phantrang btn btn-outline-secondary'>".$t."</a>";
            }
          ?>
        </div>

        <!--footer-->
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