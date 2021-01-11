<?php
    include 'koneksi.php';

    $postid= $_GET['postid'];
    mysqli_query($conn,"UPDATE usernotif SET statuspost = 1 WHERE postID='$postid'");
    $call= mysqli_query($conn,"SELECT * FROM detailpost WHERE postID='$postid'");
    while($data=mysqli_fetch_assoc($call))
    {
        header("Location: myprofile.php?#".$postid);
        exit;
    }
?>