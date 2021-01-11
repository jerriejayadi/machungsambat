<?php
	session_start();
    include "koneksi.php";

	if (isset($_POST["login"]))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		if ($username=="admin" && $password=="admin")
		{
			$_SESSION["loginadmin"] = true;
			header("Location: dashboard.php");
			exit;
		}
		$error=true;
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
  <!-- font -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
  <!-- css -->
  <link rel="stylesheet" type="text/css" href="styleloginpage.css">

  </head>

  <body class="text-center">
  <div class="modal-dialog text-center">
	<div class="row justify-content-center">
		<div class="col-sm-9 main-section">
			<div class="modal-content">
				 <form action="" method="post">
					<?php if(isset($error)) : ?>
						<p class="text-danger"> Username/Password Incorrect!</p>
					<?php endif; ?>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Username</label>
				    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1" >Password</label>
				    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
				  </div>
				  <input type=submit name=login class="btn btn-primary">
				</form>
			</div>	
		</div>
	</div>
 </div>
  </body>
</html>
