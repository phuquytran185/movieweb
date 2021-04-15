<?php
	require_once('conn.php');
	$id = $_GET['id'];
	$sql3 = "DELETE FROM chitietrating WHERE idfilm = $id";
	$sql2 = "DELETE FROM chitietfilm WHERE idfilm = $id";
	$sql1 = "DELETE FROM binhluan WHERE phimcomment = $id";
	$sql = "DELETE FROM film WHERE idfilm = $id";
	mysqli_query($conn, $sql2);
	mysqli_query($conn, $sql1);
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header("Location: admin.php");
?>