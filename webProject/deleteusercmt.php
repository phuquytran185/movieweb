<?php
	require_once('conn.php');
    $id = $_GET['id'];
    $id1 = $_GET['id1'];
	$sql1 = "DELETE FROM binhluan WHERE IDCOMMENT = $id";
	mysqli_query($conn, $sql1);
	mysqli_close($conn);
	header("Location: infor.php?id=$id1");
?>