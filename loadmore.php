<?php
	session_start();
	$active = $_SESSION["email"];
	include "koneksi.php";
	if (isset($_POST["limit"], $_POST["start"])):
?>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<?php
				$sql = "SELECT * FROM detailpost INNER JOIN profil ON detailpost.email = profil.email ORDER BY waktupost DESC LIMIT ".$_POST['start'].", ".$_POST['limit']."";
				$listPost = mysqli_query($conn,$sql); 
				while($data=mysqli_fetch_assoc($listPost)):
			?>
				<div class="container makepost">
					<!-- header post -->
					<div class="row post-header justify-content-between ml-2">
						<div class="col-7">
							<img class="fotoprofil" src="res/<?=$data['fotoprofil']?>">	
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
											<span id='status'><img class='upload-foto' src='content/{$data['gambar']}'></span>
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
									<a onclick=displayKomen()><img src="res/komen.png"></a>
									<span id=numbers>0</span>
								</div>
								<div class="col-7 my-auto">
								<?php
									$likes = mysqli_query($conn,"SELECT * FROM userlike WHERE email='$active' AND postID='{$data['postID']}' ");
									if (mysqli_num_rows($likes)==1):
								?>
									<button class="unlike" id="<?=$data['postID']?>" email="<?=$active?>" onClick="history.go(0)"><img src="res/up_clicked.png" style="transform:rotate(180deg);" ></a>
									<span id=numbers style="margin-left:0px;"><?=$data['likes']?></span>
								<?php else:?>
									<button class="like" id="<?=$data['postID']?>" email="<?=$active?>" onClick="history.go(0)"><img src="res/up_unclicked.png" style="transform:rotate(180deg);"></a>
									<span id=numbers style="margin-left:0px;transform:rotate(180deg);"><?=$data['likes']?></span>
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
<?php endif;?>