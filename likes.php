<?php
	session_start();
    include "koneksi.php";
    $active = $_POST["email"];
	$active2 = $_SESSION["email"];
	if(isset($_POST['liked'])){
		$postid= $_POST['postid'];
		$result2= mysqli_query($conn,"SELECT * FROM detailpost WHERE postID=$postid");
		$row = mysqli_fetch_assoc($result2);
		$n = $row['likes'];

		mysqli_query($conn,"UPDATE detailpost SET likes=$n+1 WHERE postID=$postid");
		mysqli_query($conn,"INSERT INTO userlike VALUES('','$active','$postid') ");
		mysqli_query($conn,"INSERT INTO usernotif VALUES('$postid','$active',0,1,now(),now())");
	}

	if(isset($_POST['unliked'])){
		$postid= $_POST['postid'];
		$result2= mysqli_query($conn,"SELECT * FROM detailpost WHERE postID=$postid");
		$row = mysqli_fetch_assoc($result2);
		$n = $row['likes'];

		mysqli_query($conn,"UPDATE detailpost SET likes=$n-1 WHERE postID=$postid");
		mysqli_query($conn,"DELETE FROM userlike WHERE postID=$postid AND email='$active'");
		mysqli_query($conn,"DELETE FROM usernotif WHERE postID=$postid AND email='$active'");
	}
?>

