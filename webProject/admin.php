

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
    ob_start();
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
    if (isset($_POST['cancel'])){
        unset($_SESSION['username']);
        header("location:login.php");
    }
    if (isset($_POST['add'])){
      header("location:add.php");
    }
    if (isset($_POST['qlTheLoai'])){
      header("location:qlytheloai.php");
    }
    if (isset($_POST['qlFilm'])){
      header("location:admin.php");
    }
    if (isset($_POST['qlquocgia'])){
      header("location:qlyquocgia.php");
    }
    if (isset($_POST['qlbinhluan'])){
      header("location:qlybinhluan.php");
    }
    if (isset($_POST['qluser'])){
      header("location:qlyuser.php");
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
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="owlcarousel/owl.carousel.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Trang chủ</title>
    </head>
    <body>
        <div id="table-container" class="text-center" >
            <h5 class="text-center">QUẢN LÝ KHO PHIM<span STYLE="COLOR:RED">(ADMIN RIGHT ONLY)</span></h5>
            <hr>
            <form method="post">
              <button name="add">Thêm</button>
              <button name="qlFilm">Quản lý Phim</button>
              <button name="qlTheLoai">Quản lý thể loại</button>
              <button name="qlquocgia">Quản lý quốc gia</button>
              <button name="qlbinhluan">Quản lý bình luận</button>
              <button name="qluser">Quản lý người dùng</button>
              <button name="cancel">Đăng xuất</button>
            </form>
            <hr>
            <div class="table-responsive">
              <table class="table table-striped table-dark text-center">
                  <thead>
                  <tr>
                      <th scope="col">Tên phim</th>
                      <th scope="col">Hình</th>
                      <th scope="col">Đạo diễn</th>
                      <th scope="col">Diễn viên</th>
                      <th scope="col">Thời lượng</th>
                      <th scope="col">Năm sản xuất</th>
                      <th scope="col">Số rating</th>
                      <th scope="col">Nội dung</th>
                      <th scope="col">Link phim</th>
                      <th scope="col">Link trailer</th>
                      <th scope="col" colspan="2">Thao tác</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                      require_once('conn.php');
                      $from = ($trang -1 ) * $filmperpage;
                      $sql = "SELECT * 
                      FROM film
                      LIMIT $from,$filmperpage";   
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              
                      ?>
                  <tr>
                      <th scope="row"><?= $row['tenfilm'] ?></th>
                      <td><img src="<?= $row['hinh'] ?>" alt="Đây là hình phim" style="max-width: 150px;"></td>
                      <td><?= $row['daodien'] ?></td>
                      <td><textarea class="textA" name="" id="" cols="12" rows="7"><?= $row['dienvien'] ?></textarea></td>
                      <td><?= $row['thoiluong'] ?></td>
                      <td><?= $row['namsx'] ?></td>
                      <td><?= $row['sorating'] ?></td>
                      <td><textarea class="textA" name="" id="" cols="12" rows="7"><?= $row['thongtin'] ?></textarea></td>
                      <td><?= $row['linkfilm'] ?></td>
                      <td><textarea class="textA" name="" id="" cols="12" rows="7"><?= $row['linktrailer'] ?></textarea></td>
                      <td> <a href="deletephim.php?id=<?= $row['idfilm']?>" class="delete">Xóa</a></td>
                      <td> <a href="updateFilm.php?id=<?= $row['idfilm']?>" class="update">Sửa</a></td> 
                  </tr>
                  <?php
                          }
                      }
                  ?>
                  </tbody>
              </table>
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
              echo "<a href='admin.php?trang=$t' class=' phantrang btn btn-outline-secondary'>".$t."</a>";
              echo "   ";
            }
          ?>
        </div>

        <br>
          
    </body>
</html>