<?php 
  require_once("../admin-includes/header.php");
  if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script> window.location.href='http://localhost/Freshcery'</script>";
      exit;
    

  }
        if(isset($_POST['delete'])){
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $getUser = $conn->prepare("SELECT * FROM admins WHERE id='$id'");
                $getUser->execute();
                $user= $getUser->fetch(PDO::FETCH_OBJ);
                if($user->fullname == $_SESSION['name-admin']){
                    session_start();
                    session_unset();
                    session_destroy();
                }
                $getAdmin = $conn->query("SELECT image FROM admins WHERE id = '$id'");
                $getAdmin->execute();
                $admin= $getAdmin->fetch(PDO::FETCH_OBJ);
                unlink($_SERVER['DOCUMENT_ROOT'] ."/Freshcery/assets/img/user/".$admin->image);
            
             $conn->exec("DELETE FROM admins WHERE id='$id'");
            }
        }
    




?>
   
  

