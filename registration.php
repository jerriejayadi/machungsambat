<?php
    include "koneksi.php";
    if (isset($_POST["register"]))
    {
        if (registrasi($_POST)>0)
        {
            echo (" <script>
                        alert('user baru berhasil ditambahkan!'); 
                        location.replace('loginpage.php');
                    </script>");
        }
        else
        {
            echo (mysqli_error($conn));
        }
    }

?>



<!DOCTYPE html>
<html>
<head>
  <title>Transparent HTML Login Form</title>

  <!-- boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">  
  <!-- font -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="styleloginpage.css">
  <style>
  /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>
<body>

<h1 class="text-center mt-5 header">Machung Sambat</h1>
 <div class="modal-dialog text-center">
	<div class="row justify-content-center">
		<div class="col-sm-9 main-section">
			<div class="modal-content">
				 <form method=post action="">
          <h2>Registrasi</h2><br><br>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
          </div>
                  <div class="form-group" style="margin-top:25px">
				    <label for="konfirmasi">Konfirmasi Password</label>
				    <input type="password" class="form-control" id="konfirmasi" name=password2 required>
          </div>

          <!-- nama -->
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nmdpn">Nama Depan</label>
                <input type="text" class="form-control" id="nmdpn" aria-describedby="emailHelp" name="namadepan">
              </div>
            </div>
            <div class="col">
            <div class="form-group">
				      <label for="nmtgh">Nama Tengah</label>
				      <input type="text" class="form-control" id="nmtgh" aria-describedby="emailHelp" name="namatengah" placeholder="optional">
				    </div>
            </div>
            <div class="col">
            <div class="form-group">
				      <label for="nmblkg">Nama Belakang</label>
				      <input type="text" class="form-control" id="nmblkg" name="namabelakang">
            </div>
            </div>
          </div>  
          <!-- end of nama -->

          <div class="form-group" style="margin-top:25px">
				    <label for="jurusan">Jurusan</label>
				    <input type="text" class="form-control" id="jurusan" name=jurusan>
          </div>
          <div class="form-group">
				    <label for="nim">NIM</label>
				    <input type="number" class="form-control" id="nim" aria-describedby="emailHelp" name="nim">
          </div>
          <div class="form-group">
				    <label for="birthdate">BIRTHDATE</label>
				    <input type="date" class="form-control" id="birthdate" aria-describedby="emailHelp" name="birthdate">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Pertanyaan Keamanan</label>
            <select class="form-control" id="exampleFormControlSelect1" name=question>
              <option>Siapakah artis favorit anda?</option>
              <option>Nama hewan peliharaan anda?</option>
              <option>Apa warna favorit anda?</option>
              <option>Siapa dosen terkece menurut anda?</option>
              <option>Tempat liburan yang anda sukai?</option>
            </select>
          </div>
          <div class="form-group" style="margin-top:25px">
				    <label for="jawaban">Jawaban</label>
				    <input type="text" class="form-control" id="jawaban" name=answer>
          </div>
          <!-- nama -->
          <!-- <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <Select class="custom-select" name=tanggal>
                  <?php
                    /* for ($i=1;$i<=31;$i++)
                    {
                      echo ("<option value=$i>$i");
                    }*/
                  ?>
                </select>
              </div>
            </div>
            <div class="col">
            <div class="form-group">
				      <label for="bulan">Bulan</label>
				      <input type="text" class="form-control" id="bulan" aria-describedby="emailHelp" name="bulan">
				    </div>
            </div>
            <div class="col">
            <div class="form-group">
				      <label for="tahun">Tahun</label>
				      <input type="text" class="form-control" id="tahun" name="tahun">
            </div>
            </div>
          </div>  -->
          <!-- end of nama -->
				  <!-- <div class="form-group form-check"> 
				    <input type="checkbox" class="form-check-input" id="exampleCheck1">
				    <label class="form-check-label" for="exampleCheck1">Check me out</label>
				  </div> -->
				  <input type=submit class="btn btn-primary" name=register value="Register">
				</form>
			</div>	
		</div>
	</div>
</div>
<footer>
	<h5 class="text-center mt-4">Copyright&#169; 2020 </h5>
</footer>


</body>
</html>

