<?php
	include "Koneksi.php" ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Akun</title>
	<link rel="icon" type="image/png" sizes="16x16" href="plugins/images/upclicked.png">
</head>
<body>
 
	<center>
		<h2>Laporan</h2>
	</center>
 
	<br/>
 	<?php $dataprofil = mysqli_query($conn,"SELECT sum(likes) AS totallikes, sum(Comment) AS totalcomment, nama, jurusan, profil.email, nim,tanggallahir FROM detailpost RIGHT JOIN profil ON detailpost.email=profil.email GROUP BY detailpost.email ORDER BY totallikes DESC");?>
 	<?php $x = 1;?>
 	<?php while($profil = mysqli_fetch_assoc($dataprofil)): ?>
	
	<br/>
 		<p><b>Nomer:</b><?=$x?></p>
		<p>Nama Lengkap:<?=$profil['nama']?></p>
		<p>NIM:<?=$profil['nim']?></p>
		<p>Tanggal Lahir:<?=$profil['tanggallahir']?></p>
		<p>email:<?=$profil['email']?></p>
		<p>Jurusan:<?=$profil['jurusan']?></p>
		<p>Jumlah Like:<?=$profil['totallikes']?></p>
		<p>Jumlah Comment:<?=$profil['totalcomment']?></p>

	<?php $x++;?>
    <?php endwhile;?>


 
		<br/>
		<b>Klik di botton Printer dan pilih " Save to PDF "</b>
	</p>

 
	<script>
		window.print();
	</script>
	
</body>
</html>