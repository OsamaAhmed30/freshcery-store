<?php
   if (isset($_SESSION['admin_id'])) {
     
    
    $id = $_SESSION['admin_id'];
    $getUser = $conn->prepare("SELECT * FROM admins WHERE id='$id'");
    $getUser->execute();
    $user= $getUser->fetch(PDO::FETCH_OBJ);
  
    if(empty($user)){
        session_start();
        session_unset();
        session_destroy();
        echo "<script> window.location.href='".APPURL."/admins/login.php'</script>";

    }
    
  }
  else{
    echo "<script> window.location.href='".APPURL."/admins/login.php'</script>";

  }