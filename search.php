<?php
	session_start();
	include "koneksi.php";
	if (!isset($_SESSION["login"]))
	{
		header("Location: loginpage.php");
		exit;
  	}
  

  $active = $_SESSION["email"];
  $search = $_GET["search"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--  boostrap calls-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	    <!-- My css -->
	<link rel="stylesheet" href="style.css">
	<script src="up.js"></script>
    <!-- font -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
	<style>
    .tinggi{
        min-height: 420px;
    }
    /*.jumbotron{
      background-image: linear-gradient(190deg, rgba(161, 227, 260,0), rgba(161, 227, 260,1));
    } */
    .jumbotron-fluid{
      background-color: #4CC9F0;
      border-radius: 20px;
      height: 380px;

    }
    .rounded-circle{
      width:200px;
      height:200px;

    }

    /*    .ftprofil{
      width: 37.65px;
      border-radius: 20px;
    }*/
    
   /* .display-4{
      margin-left: -400px;
      margin-top: -195px;
    }
    .bio{
      margin-left: 120px;
      text-align: left;
    } 
    .navbar{
      /* margin-top: -48px; */
    }
    .deskripsi{
      margin-top: -80px;
    }
    .choosefile{
      margin-left: 710px;
      margin-top: 7px;
    }
	.tombolup{ 
		margin-top:-25px;
	} 
    
  </style>
	<title>Search </title>
	<link rel="icon" type="image/png" sizes="283x49" href="plugins/images/logo.png">
</head>
<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container">
			<a class="navbar-brand" href="#"><h1>MaChung Sambat</h1></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto">
				<a class="nav-link active" href="index.php">Beranda <span class="sr-only">(current)</span></a>
				<a class="nav-link" href="categories.php">Categories</a>
				<div class="btn-group">
					<button type="button" class="btn tombol dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php	$result=mysqli_query($conn,"SELECT * FROM profil WHERE email='$active'"); ?>
						<?php while($data=mysqli_fetch_assoc($result)): ?>
							<img src="<?= $data['fotoprofil']; ?>" class="fotoprofil"> <!-- foto profil kecil -->
							<?=$data["nama"];?>
						<?php endwhile; ?>
					</button>
					<div class="dropdown-menu dropdown-menu-right">
						<a href=myprofile.php class="dropdown-item" type="button">Profil</a>
						<div class="dropdown-divider"></div>
						<a href=logout.php class="dropdown-item">Logout</a>
		     		 </div>
			  	</div>
				  <div class="dropdown">
						<?php 
							$summon = "SELECT * FROM usernotif INNER JOIN detailpost ON usernotif.postID = detailpost.postID INNER JOIN profil ON usernotif.email = profil.email WHERE detailpost.email='$active' ORDER BY waktupost DESC";
							$notifikasi = mysqli_query($conn,$summon);
							$summonuntukhitung = "SELECT * FROM usernotif INNER JOIN detailpost ON usernotif.postID = detailpost.postID INNER JOIN profil ON usernotif.email = profil.email WHERE detailpost.email='$active' AND statuspost=0 ORDER BY waktupost DESC";
							$count = mysqli_query($conn, $summonuntukhitung);
							$count2=0;
							if(mysqli_num_rows($count)==0)
							{
								$count2=0;
							}
							else{
								$count2=mysqli_num_rows($count);
							}
						?>
						<button type="button" class="btn dropdown" data-toggle="dropdown">
							<?php if($count2>0):?>
								<img src="res/notification 1.png">
								<span class="badge badge-danger"><?=$count2?></span>
							<?php else:?>
								<img src="res/no norification.png">
							<?php endif;?>
						</button>
							<div class="dropdown-menu dropdown-menu-right notif">
								<?php
									while ($data=mysqli_fetch_assoc($notifikasi)):
								?>
								<a class="dropdown-item" href="updatenotif.php?postid=<?=$data['postID']?>" >
									<?php if($data['statuspost']==0):?>
										<small><i>                
											<?php
											$date=strtotime($data['waktupost']);
											echo(date('d M Y h:m:s',$date));
											?>
										</i></small><br/>
										<?php if($data['jenisnotif']==1):?>
											<b><?=$data['nama']?> liked your post</b>
										<?php else:?>
											<b><?=$data['nama']?> commented your post</b>
										<?php endif;?>
									<?php else:?>
										<small><i>                
											<?php
											$date=strtotime($data['waktupost']);
											echo(date('d M Y h:m:s',$date));
											?>
										</i></small></b><br/>
										<?php if($data['jenisnotif']==1):?>
											<?=$data['nama']?> liked your post
										<?php else:?>
											<?=$data['nama']?> commented your post
										<?php endif;?>
									<?php endif;?>
								</a>
								<div class="dropdown-divider"></div>
								<?php endwhile;?>
							</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</nav>

	<!-- end navbar -->
	<div class="jumbotron">
		<!-- Jumbotron Slidebar -->

		<!-- end of Jumbotron Slidebar -->


		<!-- searchbar -->
		<div class="container searchbar mb-5">
			<div class="row justify-content-end">
				<div class="col-5" >
					<div class="input-group input-group-lg">
						<div class="input-group-prepend">
							<form method=GET action=search.php>
							  <button type=submit class="input-group-text" id="basic-addon1"><img width=35 src="res/search.png"></a>
						</div>
							<input type="text" class="form-control" placeholder="Search user..." aria-label="Username" aria-describedby="basic-addon1" name=search>
							</form>
					</div>
				</div>
			</div>
		</div>
		<!-- end of searchbar -->
		<h1 class="text-center mt-5 mb-5">Searching for <?=$search;?></h1>
		<!-- end searchbar -->
		<?php $result = mysqli_query($conn,"SELECT * FROM profil WHERE nama LIKE '%$search%' ORDER BY nama ASC");?>
		<?php if(mysqli_affected_rows($conn)>0):?>
			<?php while($data=mysqli_fetch_assoc($result)): ?>
			<div class="row justify-content-center">
				<div class="col-8">
					<div class="jumbotron jumbotron-fluid">
						<div class="container text-center">
							<div class="row">
								<div class="col">
									<a href="profil.php?email=<?=$data['email']?>"><h1 class="display-4"><?=$data['nama']?></h1></a>
									<div class="bio">
										<h4>NIM  : <?=$data['nim']?> </h4>
										<h4>Tanggal Lahir  : <?=$data['tanggallahir']?></h4>
										<h4>Jurusan  : <?=$data['jurusan']?></h4>
									</div>
								</div>
								<div class="col">
									<img src="<?= $data['fotoprofil']; ?>" class="rounded-circle img-thumbnail"> <!-- Foto Profil Besar -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endwhile; ?>
		<?php else: ?>
			<h1 class="text-center">Oops! User tidak ditemukan!</h1>
		<?php endif;?>
  	</div>
		
	<!-- footer -->
    <footer>
		<h5 class="text-center mb-4">Copyright&#169; 2020 </h5>

    </footer>
</body>
</html>
<script>
	
</script>
