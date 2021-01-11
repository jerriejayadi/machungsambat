
<?php
    session_start();
    include "koneksi.php";
    $_SESSION["loginadmin"] = false;

    if (isset($_POST['reset'])) {
        $email = $_SESSION["email"];
        $password = $_POST["password"];
        $password2= $_POST["password2"];
        if($password==$password2){
            $password = password_hash($password, PASSWORD_DEFAULT);
            $reset = "UPDATE profil set pswrd='$password' WHERE email='$email'";
            mysqli_query($conn, $reset);
            echo (" <script>
                        alert('Reset Password Berhasil!'); 
                        location.replace('loginpage.php');
                    </script>");  
        }
        $error=true;
    }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>

  <!-- boostrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">  
  <!-- font -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="styleloginpage.css">

</head>
<body>

<h1 class="text-center mt-5 header">Machung Sambat</h1>
 <div class="modal-dialog text-center">
	<div class="row justify-content-center">
		<div class="col-sm-9 main-section">
			<div class="modal-content">
				 <form action="" method="post">
					<?php if(isset($error)) : ?>
						<p class="text-danger"> Username/Password Incorrect!</p>
					<?php endif; ?>
				  
                    <div class="form-group">
				    <label for="exampleInputPassword1">Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
          </div>
                  <div class="form-group" style="margin-top:25px">
				    <label for="konfirmasi">Konfirmasi Password</label>
				    <input type="password" class="form-control" id="konfirmasi" name=password2 required>
          </div>
				  <input type=submit name=reset class="btn btn-primary">
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

