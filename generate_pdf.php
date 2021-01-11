<?php
    include "Koneksi.php" ;
    $active=$_GET['email']
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
 
 
    <br/>
     <?php $dataprofil = mysqli_query($conn,"SELECT * FROM detailpost INNER JOIN profil ON detailpost.email = profil.email WHERE profil.email='$active'");?>
     <?php while($profil = mysqli_fetch_assoc($dataprofil)): ?>
    <?=$profil['nama']?><br>
    <?=$profil['waktupost']?><br>
    <p>---Isi Posting---</p>  
    <?=$profil['isi']?><br> 
    <p>------</p>      
    <p>likes <?=$profil['likes']?></p>
    <p>comment <?=$profil['Comment']?></p>
    <p>Categories <?=$profil['categories']?></p>
   

  
    </p>
    <?php endwhile;?>
 
    <script>
        window.print();
    </script>

</body>
</html>