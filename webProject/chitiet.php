
<!DOCTYPE html>
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
        <title>Xem Phim</title>
        <style>
        .scrollable-menu{
          min-width: 250px;
          max-height: 50vh;
          overflow: auto;
        }
        </style>
        </head>
<body style="width: 100%;">
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
    
    <!--Video Components-->
    <br>
    <br>
    <br>
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
    
    <div class="container-fluid padding bg-light">
        <div class="row text-center padding">
            <!--Left component-->
            <div class="col-md-1">
                
            </div>
            <!--Center component-->
            <div class="col-md-10">
                <h3><?= $row['tenfilm']?></h3>
                <object align="center" style="width:100%;height:100%;width: 80%; height: 461.25px; float: none; clear: both; margin: 2px auto;" data=<?= $row['linkfilm'] ?>>
                </object>
            </div>
                                                                                                                                                 
            <!--Right component-->
            <div class="col-md-1">
                
            </div>
        </div>
    </div>

     
  
    <!--Below Component-->
    <div class="container-fluid padding bg-light">
    <br>
    <hr>
        <div class="row padding">
          <div class="col-md-2"></div>
            <div class="col-md-8" style="height: auto;">
                <p class="lead">Đạo Diễn: <?= $row['daodien']?></p>
                <p class="lead">Diễn Viên: <?= $row['dienvien']?></p>
                <p class="lead">Năm Sản Xuất: <?= $row['namsx']?></p>
                <p class="lead">Tóm Tắt: <?= $row['thongtin']?></p>
            </div>
            <div class="col-md-2 bg-light" style="height: auto; color: black">
            </div>

        </div>
    </div>
    <?php
        }
      }
    ?>


<div class="container padding">
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
                      
                      $id = $_GET['id'];
                      $sql = "SELECT * 
                      FROM binhluan
                      where phimcomment = $id";   
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

    <!--Contact component-->
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
      <hr>
</body>
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
</html>