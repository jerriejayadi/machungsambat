<?php
	session_start();
	include "koneksi.php";
	if (!isset($_SESSION["loginadmin"]))
	{
		header("Location: admin-login.php");
		exit;
    }
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
    $filePath   = "backup_database/".$nama_file;
    
    restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName, $filePath);
    }
    $jan=mysqli_query($conn,"SELECT count(postID) FROM `detailpost` WHERE tanggalpost BETWEEN '2021-01-01' AND '2021-01-31' GROUP BY tanggalpost");
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="graph.js"></script>
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="283x49" href="plugins/images/logo.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <!-- <img src="plugins/images/logo-icon.png" alt="homepage" /> -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="res/logo.jpg" alt="homepage" width=180 />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class=" in">
                            <form role="search" class="app-search d-none d-md-block mr-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                                <button class="btn text-white font-medium dropdown-toggle profile-pic" data-toggle=dropdown>Admin</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href=admin-logout.php class="dropdown-item">Logout</a>
                                </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="listuser.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">List User</span>
                            </a>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Dashboard</h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total User</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto">
                                    <span class="counter text-success">
                                        <?php $jumlahuser=mysqli_query($conn,"SELECT * FROM profil");?>
                                        <?php $jmlh = mysqli_num_rows($jumlahuser); ?>
                                        <?= $jmlh?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Post</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto">
                                    <span class="counter text-purple">
                                    <?php $jumlahpost=mysqli_query($conn,"SELECT * FROM detailpost");?>
                                        <?php $jmlha = mysqli_num_rows($jumlahpost); ?>
                                        <?= $jmlha?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Unique Visitor</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ml-auto"><span class="counter text-info">911</span>
                                </li>
                            </ul>
                        </div> 
                    </div> -->
                </div>
                <!-- ============================================================== -->
                <!-- PRODUCTS YEARLY SALES -->
                <!-- ============== ================================================ -->
                <div class="white-box">
                    <div class="row">
                        <div class="col-md-8 col-lg-8 col-sm-8 col-xs-8">
                            <div class="row">
                                <div class="col-md-3 col-sm-4 col-xs-6 mr-auto">
                                    <select id="pilihan" class="form-control row border-top" >
                                        <option value ="daily">Daily</option>
                                        <option value ="monthly">Monthly</option>
                                    </select>
                                    <!-- <select id="pilihBulan" class="form-control row border-top" >
                                        <option value ="January">January</option>
                                        <option value ="February">February</option>
                                        <option value ="March">March</option>
                                        <option value ="April">April</option>
                                        <option value ="May">May</option>
                                        <option value ="June">June</option>
                                        <option value ="July">July</option>
                                        <option value ="August">August</option>
                                        <option value ="September">September</option>
                                        <option value ="October">October</option>
                                        <option value ="November">November</option>
                                        <option value ="December">December</option>
                                    </select> -->
                                </div>  
                            </div>

                                <!-- <div class="d-md-flex">
                                    <ul class="list-inline d-flex ml-auto">
                                        <li class="pl-3">
                                            <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5>
                                        </li>
                                        <li class="pl-3">
                                            <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5>
                                        </li>
                                    </ul>
                                </div> -->
                            <div id="judultabel"></div>
                            
                            <div id="curve_chart" class="text-center"></div>
                            <div id="piechart"></div>
                            
                        </div>
                            <div class="col-md-3 col-lg-3 col-sm-3 col-xs-3">
                                <h3 class="box-title mb-0">Newest post</h3>
                                    <div class="comment-center">
                                        <?php 
                                            $post = mysqli_query($conn,"SELECT * FROM detailpost INNER JOIN profil ON detailpost.email=profil.email  ORDER BY waktupost DESC LIMIT 5");
                                        ?>
                                        <?php while($toppost=mysqli_fetch_assoc($post)):?>
                                        <div class="comment-body d-flex">
                                            <div class="user-img"> <img src="<?=$toppost['fotoprofil']?>" alt="user"
                                                                    class="img-circle">
                                            </div>
                                            <div class="mail-contnet">
                                                <h5><?=$toppost['nama'];?></h5><span class="time"><?=$toppost['waktupost']?></span>
                                                <br>
                                                <div class="mb-3 mt-3">
                                                    <span class="mail-desc">
                                                        <?=$toppost['isi'];?>
                                                    </span>
                                                </div>
                                                Comment=<?=$toppost['Comment'];?><br>
                                            
                                                Likes=<?=$toppost['likes'];?>
                                            </div>
                                        </div>
                                    <?php endwhile;?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================================== -->
                <!-- RECENT SALES -->
                <!-- ============================================================== -->
                <!-- <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <div class="d-md-flex mb-3">
                                <h3 class="box-title mb-0">Recent sales</h3>
                                <div class="col-md-3 col-sm-4 col-xs-6 ml-auto">
                                    <select class="form-control row border-top">
                                        <option>March 2017</option>
                                        <option>April 2017</option>
                                        <option>May 2017</option>
                                        <option>June 2017</option>
                                        <option>July 2017</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">NAME</th>
                                            <th class="border-top-0">STATUS</th>
                                            <th class="border-top-0">DATE</th>
                                            <th class="border-top-0">PRICE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="txt-oflo">Elite admin</td>
                                            <td>SALE</td>
                                            <td class="txt-oflo">April 18, 2017</td>
                                            <td><span class="text-success">$24</span></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="txt-oflo">Real Homes WP Theme</td>
                                            <td>EXTENDED</td>
                                            <td class="txt-oflo">April 19, 2017</td>
                                            <td><span class="text-info">$1250</span></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td class="txt-oflo">Ample Admin</td>
                                            <td>EXTENDED</td>
                                            <td class="txt-oflo">April 19, 2017</td>
                                            <td><span class="text-info">$1250</span></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td class="txt-oflo">Medical Pro WP Theme</td>
                                            <td>TAX</td>
                                            <td class="txt-oflo">April 20, 2017</td>
                                            <td><span class="text-danger">-$24</span></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td class="txt-oflo">Hosting press html</td>
                                            <td>SALE</td>
                                            <td class="txt-oflo">April 21, 2017</td>
                                            <td><span class="text-success">$24</span></td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td class="txt-oflo">Digital Agency PSD</td>
                                            <td>SALE</td>
                                            <td class="txt-oflo">April 23, 2017</td>
                                            <td><span class="text-danger">-$14</span></td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td class="txt-oflo">Helping Hands WP Theme</td>
                                            <td>MEMBER</td>
                                            <td class="txt-oflo">April 22, 2017</td>
                                            <td><span class="text-success">$64</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- ============================================================== -->
                <!-- TRENDING POST -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- .col -->
                    <div class="col-md-12 col-lg-8 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title mb-0">Trending Post</h3>
                            <div class="comment-center">
                                <?php 
                                    $post = mysqli_query($conn,"SELECT * FROM detailpost INNER JOIN profil ON detailpost.email=profil.email  ORDER BY likes DESC LIMIT 10");
                                ?>
                                <?php while($toppost=mysqli_fetch_assoc($post)):?>
                                <div class="comment-body d-flex">
                                    <div class="user-img"> <img src="<?=$toppost['fotoprofil']?>" alt="user"
                                            class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5><?=$toppost['nama'];?></h5><span class="time"><?=$toppost['waktupost']?></span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">
                                                <?=$toppost['isi'];?>
                                            </span>
                                        </div>
                                        Comment=<?=$toppost['Comment'];?><br>
                    
                                        Likes=<?=$toppost['likes'];?><br>

                                        <a href="generate_pdf.php?email=<?=$toppost['email']?>">Print</a>
                                    </div>
                                </div>
                                <?php endwhile;?>
                                <!-- <div class="comment-body d-flex">
                                    <div class="user-img"> <img src="plugins/images/users/sonu.jpg" alt="user"
                                            class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Sonu Nigam</h5><span class="time">10:20 AM 20 may 2016</span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque
                                                pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui
                                                pellentesque molestie feugiat. Aenean commodo dui </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment-body d-flex border-0">
                                    <div class="user-img"> <img src="plugins/images/users/arijit.jpg" alt="user"
                                            class="img-circle">
                                    </div>
                                    <div class="mail-contnet">
                                        <h5>Arijit singh</h5><span class="time">10:20 AM 20 may 2016</span>
                                        <br>
                                        <div class="mb-3 mt-3">
                                            <span class="mail-desc">Donec ac condimentum massa. Etiam pellentesque
                                                pretium lacus. Phasellus ultricies dictum suscipit. Aenean commodo dui
                                                pellentesque molestie feugiat. Aenean commodo dui </span>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-heading">
                                TOP 10 USERS
                            </div>
                            <div class="card-body">
                                <ul class="chatonline">
                                    <?php 
                                        $likeduser = mysqli_query($conn,"SELECT sum(likes) AS totallikes, nama, fotoprofil FROM detailpost INNER JOIN profil ON detailpost.email=profil.email GROUP BY detailpost.email ORDER BY totallikes DESC");
                                        while($topuser=mysqli_fetch_assoc($likeduser)):
                                    ?>
                                    <li>
                                        <!-- // <div class="call-chat">
                                        //     <button class="btn btn-success text-white btn-circle btn" type="button">
                                        //         <i class="fas fa-phone"></i>
                                        //     </button>
                                        //     <button class="btn btn-info btn-circle btn" type="button">
                                        //         <i class="far fa-comments"></i>
                                        //     </button>
                                        // </div> -->
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="<?=$topuser['fotoprofil'];?>" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted"><?=$topuser['nama'];?> <small
                                                        class="d-block text-success d-block">Total Like Postingan: <?=$topuser['totallikes']?></small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endwhile;?>
                                    <!-- <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/genu.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Genelia
                                                    Deshmukh <small class="d-block text-warning">Away</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Ritesh
                                                    Deshmukh <small class="d-block text-danger">Busy</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/arijit.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Arijit
                                                    Sinh <small class="d-block text-muted">Offline</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/govinda.jpg" alt="user-img"
                                                class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Govinda
                                                    Star <small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/hritik.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">John
                                                    Abraham<small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="call-chat">
                                            <button class="btn btn-success text-white btn-circle btn" type="button">
                                                <i class="fas fa-phone"></i>
                                            </button>
                                            <button class="btn btn-info btn-circle btn" type="button">
                                                <i class="far fa-comments"></i>
                                            </button>
                                        </div>
                                        <a href="javascript:void(0)" class="d-flex align-items-center"><img
                                                src="plugins/images/users/varun.jpg" alt="user-img" class="img-circle">
                                            <div class="ml-2">
                                                <span class="text-dark text-muted">Varun
                                                    Dhavan <small class="d-block text-success">online</small></span>
                                            </div>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                            <form enctype="multipart/form-data" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label">File Database (*.sql)</label>
                                <div class="col-sm-7">
                                    <input type="file" name="datafile" size="30" required/>
                                </div>
                            </div>
                                <a class="btn btn-success" href=backup.php>BackUp Data</a>
                                <button type="submit" name="restore" class="btn btn-danger">Restore Data</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2020 © Machung Sambat Admin
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    $('#pilihan').change(function(){ // when a option is selected
        var a = $("#pilihan").children("option:selected").val();
        if(a=="daily"){
            document.getElementById("judultabel").innerHTML="<h1 class='text-center'>Daily Post</h1>";
            google.charts.setOnLoadCallback(drawChart);
        }
        else{
            document.getElementById("judultabel").innerHTML="<h1 class='text-center'>Monthly Post</h1>";
            google.charts.setOnLoadCallback(drawChartMonthly);
        }
    });
    
    function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Tanggal', 'Jumlah Post'],
            <?php 
                $count=mysqli_query($conn,"SELECT calendar.Tanggalbulantahun AS tanggal, count(postID) AS 'jumlah post' FROM detailpost RIGHT JOIN calendar ON detailpost.tanggalpost = calendar.Tanggalbulantahun WHERE monthname(tanggalbulantahun)='January' GROUP BY tanggalbulantahun");
                if(mysqli_num_rows($count)>0){
                    while ($chart = mysqli_fetch_array($count)){
                        echo("['".$chart["tanggal"]."', ".$chart['jumlah post']."],");
                    }  
                }
            ?>
            ]);

            var options = {
                title: '',
                legend: { position: 'bottom' },
                width:1000,
                height:500
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
    }

    function drawChartMonthly() {
            var data = google.visualization.arrayToDataTable([
            ['Bulan', 'Jumlah Post'],
            <?php 
                $count=mysqli_query($conn,"SELECT monthname(tanggalpost) as month, count(*) AS totalpost FROM detailpost GROUP BY month ORDER BY tanggalpost");
                if(mysqli_num_rows($count)>0){
                    while ($chart = mysqli_fetch_array($count)){
                        echo("['".$chart["month"]."', ".$chart['totalpost']."],");
                    }  
                }
            ?>
            ]);

            var options = {
                title: 'Daily Post',
                legend: { position: 'bottom' },
                width:1000,
                height:500
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
    }


    google.charts.setOnLoadCallback(drawPieChart);

      function drawPieChart() {

        var data = google.visualization.arrayToDataTable([
        ['Categories','Total'],
        <?php
            $count=mysqli_query($conn,"SELECT categories, count(categories) AS total FROM detailpost GROUP BY categories");
            if(mysqli_num_rows($count)>0)
            {
                while($chart=mysqli_fetch_assoc($count)){
                    echo("['".$chart["categories"]."', ".$chart['total']."],");
                }
            }
        ?>
        ]);

        var options = {
          title: 'Post-Per-Category Percentage',
          width: 700,
          height:700
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    
</script>