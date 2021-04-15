
<?php
    ob_start();
    session_start();
    require_once('conn.php');
    if (isset($_POST["submit"])) {
		$name = $_POST['uname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM user WHERE TENUSER = '$name' OR USERNAME = '$username'";
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) > 0) {
			echo '<script language="javascript">alert("Tên hoặc E-mail đăng ký bị trùng"); window.location="index.php";</script>';
			die ();
		}
		else{
			$sql = "INSERT INTO user(TENUSER,USERNAME,PASSWORD) VALUES(?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sss", $name, $username, $password);
			
			$isOK = $stmt->execute();
			$stmt->close();
			$conn->close();
			echo '<script language="javascript">alert("Đăng ký thành công"); window.location="index.php";</script>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Form Đăng Kí User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
	body {font-family: Arial, Helvetica, sans-serif;}
	form {border: 3px solid #f1f1f1;}
	input[type=text], input[type=password] {
		  width: 100%;
		  padding: 12px 20px;
		  margin: 8px 0;
		  display: inline-block;
		  border: 1px solid #ccc;
		  box-sizing: border-box;
	}
	button {
		  background-color: #4CAF50;
		  color: white;
		  padding: 14px 20px;
		  margin: 8px 0;
		  border: none;
		  cursor: pointer;
		  width: 100%;
	}
	button:hover {
	  opacity: 0.8;
	}
	.container {
	  padding: 16px;
	}	
</style>
</head>
<body>
<h2>Sign Up</h2>
<form method="post">
	<div class="container">
        <label for="uname"><b>Tên</b></label>
		<input type="text" placeholder="Enter Name" name="uname">

		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="username">

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password">

		<button type="submit" name="submit">Sign In</button>
  	</div>
</form>
</body>
</html>