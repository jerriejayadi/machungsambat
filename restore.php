<?php 
include 'functions1.php';
function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath){
    // Connect & select the database
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 

    // Temporary variable, used to store current query
    $templine = '';
    
    // Read in entire file
    $lines = file($filePath);
    
    $error = '';
    
    // Loop through each line
    foreach ($lines as $line){
        // Skip it if it's a comment
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        
        // Add this line to the current segment
        $templine .= $line;
        
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';'){
            // Perform the query
            if(!$db->query($templine)){
                $error .= 'Error performing query "<b>' . $templine . '</b>": ' . $db->error . '<br /><br />';
            }
            
            // Reset temp variable to empty
            $templine = '';
        }
    }
    return !empty($error)?$error:true;
}
if(isset($_POST['restore'])){
$nama_file=$_FILES['datafile']['name'];
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = '';
$filePath   = 'myphp-backup-files/'.$nama_file.'';

restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);
}
$notif2 = count(query("SELECT * FROM contact WHERE notif=1"));
$notif1 = count(query("SELECT * FROM user WHERE notif=1"));
$notif = count(query("SELECT * FROM nota WHERE notifikasi=2"));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link rel="stylesheet" href="style1.css" />
    <title>ADMIN</title>
  </head>
  <body id="body">
    <div class="container1">
      <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a class="link" href="backup.php">Backup</a>
        </div>
        <div class="navbar__left">
          <a class="active_link" href="#">Restore</a>
        </div>
        <div class="navbar__right">
         
            <!-- <i class="fa fa-user-circle-o" aria-hidden="true"></i> -->
          </a>
        </div>
      </nav>

      <main>
        <div class="main__container">
          <!-- MAIN TITLE STARTS HERE -->

          <div class="main__title">
            <img src="assets/hello.svg" alt="" />
            <div class="main__greeting">
            </div>
          </div>

          <!-- MAIN TITLE ENDS HERE -->

          <!-- MAIN CARDS STARTS HERE -->
          
            <div class="row justify-content-center">
            <form enctype="multipart/form-data" method="post" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">File Database (*.sql)</label>
                <div class="col-sm-7">
                    <input type="text" name="nip" class="form-control" maxlength="12">
                    <input type="file" name="datafile" size="30" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-7">
                    <button type="submit" name="restore" class="btn btn-danger">Restore Database</button>
                </div>
            </div>
            </div>
           
          </div>
          <!-- MAIN CARDS ENDS HERE -->


        
      </main>

      <div id="sidebar">
        <div class="sidebar__title">
            <h1>MAC AUTOWASH</h1>
        </div>

        <div class="sidebar__menu">
          <div class="sidebar__link">
            <i class="fa fa-home"></i>
            <a href="indexadmin.php">Dashboard</a>
          </div>
          <h2>MANAJEMEN</h2>
          <div class="sidebar__link">
            <i class="fa fa-user-circle"></i>
            <a href="index.php">Index User</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-commenting"></i>
            <a href="contact.php">Contact<span class="badge badge-light"><?= $notif2 ?></a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <a href="akunuser.php">Akun User<span class="badge badge-light"><?= $notif1 ?></a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-building-o"></i>
            <a href="penjualan.php">Penjualan<span class="badge badge-light"><?= $notif ?></a>
          </div>
          <div class="sidebar__link ">
            <i class="fa fa-wrench"></i>
            <a href="editproduk.php">Edit Produk</a>
          </div>
          <div class="sidebar__link active_menu_link ">
            <i class="fa fa-cloud-upload"></i>
            <a href="backup.php">Backup/restore</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-user-circle"></i>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
</form>
</body>
</html>