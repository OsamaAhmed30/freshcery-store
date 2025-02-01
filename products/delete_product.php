<?php 
    require("../includes/header.php");
 if (!isset($_SERVER['HTTP_REFERER'])) {
            echo "<script> window.location.href='http://localhost/Freshcery'</script>";
              exit;
            
      
          }
        if(isset($_POST['delete'])){
            $id = $_POST['id'];
             $conn->exec("DELETE FROM carts WHERE id='$id'");
        }
    




?>
   
  

