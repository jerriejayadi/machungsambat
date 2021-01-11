<?php
	session_start();
	include "koneksi.php";
	if (!isset($_SESSION["login"]))
	{
		header("Location: loginpage.php");
		exit;
	}
	$active = $_SESSION["email"];

	if(isset($_POST['post']))
	{
		$image = $_FILES['image']['name'];
		$size = $_FILES['image']['size'];
		$target = "content/".basename($image);
	
		$ekstensiGambarValid =['jpg','jpeg','png'];
		$ekstensiGambar = explode('.',$image);
		$ekstensiGambar = strtolower(end($ekstensiGambar));

		if (tambahpost($_POST,$active,$image)>0)
		{
			move_uploaded_file($_FILES['image']['tmp_name'], $target);
			header("Location: index.php");
		}
		else
		{
			
		}
	}
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- My css -->
	<link rel="stylesheet" href="style.css">
    <!-- font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
	<title>Beranda</title>
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
							$summon = "SELECT * FROM usernotif INNER JOIN detailpost ON usernotif.postID = detailpost.postID INNER JOIN profil ON usernotif.email = profil.email WHERE detailpost.email='$active' ORDER BY waktunotif DESC";
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
		<h1 class="text-center mt-5 mb-5">Sorry! The page you are looking for does not exist! :(</h1>
	</div>
	<!-- footer -->
    <footer>
		<h5 class="text-center mb-4">Copyright&#169; 2020 </h5>
    </footer>
</body>
</html>
<script src="load.js"></script>
