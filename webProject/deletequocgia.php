<?php
	require_once('conn.php');
    $id = $_GET['id'];

    $sql = "SELECT * FROM film WHERE QUOCGIA =$id";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $query = "DELETE FROM binhluan WHERE PHIMCOMMENT = ".$row['idfilm'];
            mysqli_query($conn, $query);
        }
        $sql1 = "DELETE FROM film WHERE QUOCGIA = $id";
        $sql2 = "DELETE FROM quocgia WHERE IDQUOCGIA = $id";
        mysqli_query($conn, $sql1);
        mysqli_query($conn, $sql2);
        mysqli_close($conn);
    }
    else{
        require_once('conn.php');
        $sql2 = "DELETE FROM quocgia WHERE IDQUOCGIA = $id";
        mysqli_query($conn, $sql2);
        mysqli_close($conn);
    }
	header("Location: qlyquocgia.php");
?>

