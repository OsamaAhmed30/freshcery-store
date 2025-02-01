<?php 
    session_start();
    define("APPURL",'http://localhost/Freshcery/admin-panel');
    define("ROOTURL",'http://localhost/Freshcery');
    require($_SERVER['DOCUMENT_ROOT']."/Freshcery/config/config.php");

 
    function active($page){
      $currentPage=explode("/",$_SERVER['SCRIPT_NAME']);
      $active = $currentPage[count($currentPage)- 1];
      if ($active == $page) {
        echo 'text-white';
      }
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Admin Panel</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOTURL?>/assets/fonts/font-awesome/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="<?php echo APPURL?>/assets/fonts/sb-bistro/sb-bistro.css" rel="stylesheet" type="text/css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href=<?php echo APPURL."/styles/style.css"?> rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-danger">
      <a href="<?php echo APPURL?>/index.php" class="navbar-brand">
            <img src=<?php echo ROOTURL."/assets/img/logo/logo-white.png"?> alt="">
      </a>
      <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav side-nav navbar-dark bg-danger" >
          <?php if (isset($_SESSION['admin_id'])): ?>
          <li class="nav-item">
            <a class="nav-link <?php active('index.php') ?>" style="margin-left: 20px;" href="<?php echo APPURL?>/index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php active('admins.php') ?>" href="<?php echo APPURL?>/admins/admins.php" style="margin-left: 20px;">Admins</a>
            <span class="sr-only">(current)</span>

          </li>
          <li class="nav-item">
            <a class="nav-link <?php active('show-categories.php') ?>" href=<?php echo APPURL."/categories-admins/show-categories.php"?> style="margin-left: 20px">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php active('show-products.php') ?>" href="<?php echo APPURL?>/products-admins/show-products.php" style="margin-left: 20px;">Products</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php active('show-orders.php') ?>" href="<?php echo APPURL?>/orders-admins/show-orders.php" style="margin-left: 20px;">Orders</a>
          </li>
          <?php else: ?>
            <li class="nav-item">
            <a class="nav-link <?php active('login.php') ?>" href="<?php echo APPURL?>/admins/login.php" style="margin-left: 20px;">Login</a>
          </li>
          <?php endif ?>
        </ul>
        <ul class="navbar-nav ml-md-auto d-md-flex">
          <?php if (!isset($_SESSION['name-admin']) ):?>
            <li class="nav-item">
            <a class="nav-link text-white" href="<?php echo APPURL?>/admins/login.php">login
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php else:?>
            <li class="nav-item dropdown">
            <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
              <?php echo $_SESSION['name-admin']?>
             
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo APPURL."/admins/logout.php"?>">Logout</a>
              
          </li>
            <?php endif ?>
         
         
                          
          
        </ul>
      </div>
    </div>
    </nav>