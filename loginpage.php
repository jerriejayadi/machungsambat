<?php
	session_start();
	include "koneksi.php";
	if (isset($_SESSION["login"]))
	{
		header("Location:index.php");
	}
	if (isset($_POST["login"]))
	{
		$email=$_POST["email"];
		$password=$_POST["password"];
		$_SESSION["email"]=$email;
		$checkuser= mysqli_query($conn, "SELECT * FROM profil WHERE email='$email'" );
		if ( mysqli_num_rows($checkuser)===1)
		{
			$data= mysqli_fetch_assoc($checkuser);
			if($data["statususer"]==1)
			{	
				if(password_verify($password, $data["pswrd"]))
				{
					$_SESSION["login"] = true;
					header("Location: index.php");
					exit;
				}
			}
			else{
				echo (" <script>
							alert('Akun anda di ban!'); 
							location.replace('loginpage.php');
						</script>");
			}
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
				    <label for="exampleInputEmail1">Email address</label>
				    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1" >Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
				  </div>
				  <a href="forgot1.php">Forget Password</a><br><br>
				  <a href="registration.php">Register Now</a><br><br>

				  <!-- <div class="form-group form-check"> 
				    <input type="checkbox" class="form-check-input" id="exampleCheck1">
				    <label class="form-check-label" for="exampleCheck1">Check me out</label>
				  </div> -->
				  <input type=submit name=login class="btn btn-primary">
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

