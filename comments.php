<?php
	session_start();
    include "koneksi.php";
    $active = $_SESSION["email"];
    $comment = $_POST["komentar"];
	if(isset($_POST['komen'])){
		$postid= $_POST['postid'];
		$result2= mysqli_query($conn,"SELECT * FROM detailpost WHERE postID=$postid");
		$row = mysqli_fetch_assoc($result2);
		$n = $row['Comments'];

		mysqli_query($conn,"UPDATE detailpost SET Comment=$n+1 WHERE postID=$postid");
		mysqli_query($conn,"INSERT INTO usercomment VALUES('','$active','$postid','$comment',now()) ");
        mysqli_query($conn,"INSERT INTO usernotif VALUES('$postid','$active',0,2,now(),now())");
	}
?>

