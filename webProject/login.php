 <?php
	require "conn.php";
?>
<?php
	session_start();
 
	if (isset($_POST['submit'])) 
	{
		$username = addslashes($_POST['uname']);
		$password = addslashes($_POST['psw']);
		if (!$username || !$password) {
			echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.";
		}
		else{
			$query = mysqli_query($conn,"SELECT username, password FROM admin WHERE username='$username'");
			if (mysqli_num_rows($query) == 0) {
				echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.";
			}
			else{
				$row = mysqli_fetch_array($query);
				if ($password != $row['password']) {
					echo "Mật khẩu không đúng. Vui lòng nhập lại.";
				}
				else{
					$_SESSION['username'] = $username;
					header("location: admin.php");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
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
<h2>Login Form</h2>
<form method="post">
	<div class="container">
		<label for="uname"><b>Username</b></label>
		<input type="text" placeholder="Enter Username" name="uname">

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="psw">

		<button type="submit" name="submit">Login</button>
  	</div>
</form>
</body>
</html>