<?php
	require_once('conn.php');
    $id = $_GET['id'];


        $sql1 = "DELETE FROM chitietfilm WHERE idtheloai = $id";
        $sql2 = "DELETE FROM theloai WHERE idtheloai = $id";
        mysqli_query($conn, $sql1);
        mysqli_query($conn, $sql2);
        mysqli_close($conn);

	header("Location: qlytheloai.php");
?>

