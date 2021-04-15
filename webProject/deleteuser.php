<?php
	require_once('conn.php');
	$id = $_GET['id'];
	$sql = "DELETE FROM USER WHERE IDUSER = $id";
	$sql1 = "DELETE FROM binhluan WHERE NAME = $id";
	$sql2 = "DELETE FROM chitietrating WHERE iduser = $id";
	mysqli_query($conn, $sql2);
	mysqli_query($conn, $sql1);
	mysqli_query($conn, $sql);
	mysqli_close($conn);
	header("Location: qlyuser.php");
?>