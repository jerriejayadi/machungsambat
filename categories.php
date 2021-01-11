<?php
	session_start();
	include "koneksi.php";
	if (!isset($_SESSION["login"]))
	{
		header("Location: loginpage.php");
		exit;
	}
	$active = $_SESSION["email"];

	if (isset($_GET['id']))
	{
		$id=$_GET['id'];
		$display = "SELECT * FROM detailpost INNER JOIN categories ON detailpost.categories = categories.category INNER JOIN profil ON detailpost.email=profil.email WHERE categories.id='$id' AND waktupost<=CURRENT_TIME ORDER BY waktupost DESC";
	}
	else
	{
		$display = "SELECT * FROM detailpost INNER JOIN categories ON detailpost.categories = categories.category INNER JOIN profil ON detailpost.email=profil.email WHERE waktupost<=CURRENT_TIME ORDER BY waktupost DESC";
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
		<link rel="stylesheet" href="categories.css">
		<link rel="stylesheet" href="style.css">
		<!-- My Js -->

    <!-- font -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">

	<title>Categories</title>
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
								<img src="<?= $data['fotoprofil']; ?>" class="fotoprofil">
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
		</div>
	</nav>

	<!-- end navbar -->
	<div class="jumbotron jumbotron-fluid">
	
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
		<!-- categories -->
	
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="container categories">
						<div class="row post-header justify-content-between ml-2 mt-3">
							<div class="col-md-1 text-center">	
								<span class="nama ml-3 align-middle">Categories</span>
							</div>
						</div>
						<div class="row justify-content-around ml-2">
							<div class="col-md-3 ">
								<a class="btn box btn-outline-primary" href="categories.php?id=c01">
									Administrasi
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c02">
									Keuangan
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c03">
									Student Center
								</a>
							</div>
						</div>
						<div class="row justify-content-around ml-2">
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c04">
									UKM
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c05">
									Akademis
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c06">
									Jadwal
								</a>
							</div>
						</div>
						<div class="row justify-content-around ml-2">
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c07">
									Poin Keaktifan
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c08">
									Sertifikat
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c09">
									Dosen
								</a>
							</div>
						</div>
						<div class="row justify-content-around ml-2">
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c10">
									Mahasiswa
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c11">
									Karyawan
								</a>
							</div>
							<div class="col-md-3">
								<a class="btn box btn-outline-primary" href="categories.php?id=c12">
									Tips & Trick
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Feeds -->


		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<?php
						$jumlahDataPerHalaman = 2;
						$sql = mysqli_query($conn,$display);
						$jumlahData = mysqli_num_rows($sql);
						$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
						$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"]: 1;
						$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
						
						$tabel = mysqli_query($conn,$display." LIMIT $awalData, $jumlahDataPerHalaman");
						while($data=mysqli_fetch_assoc($tabel)):
					?>
						<div class="container makepost">
							<!-- header post -->
							<div class="row post-header justify-content-between ml-2">
								<div class="col-7">
									<img class="fotoprofil" src="<?=$data['fotoprofil']?>">	
									<span class="nama ml-3 align-middle"><?=$data['nama'];?></span>
								</div>
								<div class="col-3">
									<div class="btn tombol" href="#">
										Categories: <?=$data['categories']?>
									</div>
								</div>
							</div>
							<!-- end of header post -->

							<!-- isi post -->
							<?php
								if($data['gambar']!=null OR $data['gambar']!='')
								{
									echo("	
											<div class='row input-status'>
												<div class='col text-center'>
													<span id='status'><img class='upload-foto' src='{$data['gambar']}'></span>
												</div>
											</div>"
										);
								}
							?>
							<div class="row input-status justify-content-center" style="margin-top:39px">
								<div class="col-md-10">
									<span id="status"><?=$data['isi']?></span>
								</div>
							</div>
							<!-- end of isi post -->
							<div class="row post-menu mt-5 ml-5 justify-content-between">
								<div class="col-4 my-auto">
									<div class="datetime tanggalpost">
										<?php
										$date=strtotime($data['tanggalpost']);
										echo(date('d M Y',$date));
										?>
									</div>
								</div>
								<div class="col-4">
									<div class="row justify-content-center  text-center">
										<div class="col-5 my-auto">
											<button type="button" class="btn dropdown" data-toggle="dropdown"><img src="res/komen.png"></button>
											<div class="dropdown-menu dropdown-menu-right komentar">
												<?php
													$summonKomen= mysqli_query($conn,"SELECT * FROM `usercomment` INNER JOIN profil ON usercomment.email = profil.email WHERE postID=".$data['postID']."");
													while($userkomen = mysqli_fetch_assoc($summonKomen)):
												?>
												<div class="container mb-4 dropdown-item">
													<div class="row justify-content-start ">
														<div class="col-1">
															<img src="<?=$userkomen["fotoprofil"]?>" style="width:37px;">
														</div>
														<div class="col-6">
															<span><?=$userkomen['nama']?></span>
															<span style="margin-left:7%;">
																<?php 
																	$date=strtotime($userkomen['waktucomment']);
																	echo(date('d M Y',$date));
																?>
															</span>
														</div>
													</div>
													<div class="row justify-content-center">
														<div class="col-10">
															<?=$userkomen['comment']?>
														</div>
													</div>
												</div>
												<?php endwhile;?>
												<div class="dropdown-divider"></div>
													<div class="input-group mb-3">
														<textarea style=height:60px; class="form-control" id="komentar" placeholder="Tulis Komentar Anda..." aria-label="Recipient's username" aria-describedby="button-addon2"></textarea>
														<div class="input-group-append">
															<button id=<?=$data['postID']?> class="btn btn-outline-secondary komen" type="submit" name="submitKomen" id="button-addon2" onClick="history.go(0)">Button</button>
														</div>
													</div>
											</div>
											<?=$data['Comment'];?>
										</div>
										<div class="col-7 my-auto">
											<?php
												$likes = mysqli_query($conn,"SELECT * FROM userlike WHERE email='$active' AND postID='{$data['postID']}'");
												if (mysqli_num_rows($likes)==1):
											?>
												<?php
													// var_dump($data['postID']);
													// exit;
												?>
												<button onClick="history.go(0)" class="btn unlike" like-href="..." id="<?=$data['postID']?>" email="<?=$active?>" ><img src="res/up_clicked.png" ></button>
												<span id=numbers style="margin-left:0px;"><?=$data['likes']?></span>
											<?php else:?>
												<button onClick="history.go(0)" class="btn like" like-href="..." id="<?=$data['postID']?>" email="<?=$active?>"><img src="res/up_unclicked.png" style="transform:rotate(180deg);"></button>
												<span id=numbers style="margin-left:0px;"><?=$data['likes']?></span>
											<?php endif;?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile;?>
				</div>
			</div>
			<p id=kolomKomentar></p>
		</div>
		<div class="text-center">
			<?php if($halamanAktif > 1): ?>
					<a class="btn btn-danger" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
				<?php endif; ?>

				<?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) :?>
					<?php if( $i == $halamanAktif) : ?>
						<a class="btn btn-danger" href="?id=<?=$_GET['id'];?>&halaman=<?= $i; ?>" style= "font-weight: bold; color: yellow;"><?= $i; ?></a>
					<?php else :?>
						<a class="btn btn-danger" href="?id=<?=$_GET['id'];?>&halaman=<?= $i; ?>"><?= $i; ?></a>
					<?php endif ?>
				<?php endfor ?>

				<?php if($halamanAktif < $jumlahHalaman): ?>
					<a class="btn btn-danger" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
				<?php endif; ?>
		</div>
	</div>
	

    <footer>
        <h5 class="text-center mb-4">Copyright&#169; 2020 </h5>
    </footer>
    <br>
</body>
</html>
<script src="script.js"></script>