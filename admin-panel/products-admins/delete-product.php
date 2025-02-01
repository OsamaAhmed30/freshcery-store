<?php 
  require_once("../admin-includes/header.php");
  if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script> window.location.href='http://localhost/Freshcery'</script>";
      exit;
    

  }
        if(isset($_POST['delete'])){
            if (isset($_POST['id'])) {
                $id = $_POST['id'];   
             $conn->exec("DELETE FROM products WHERE id='$id'");
            }
        }
    




?>
   
  

