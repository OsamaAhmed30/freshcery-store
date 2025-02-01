<?php 
    require("../includes/header.php");
 if (!isset($_SERVER['HTTP_REFERER'])) {
            echo "<script> window.location.href='http://localhost/Freshcery'</script>";
              exit;
            
      
          }
        if(isset($_POST['update'])){
            $id = $_POST['id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $update = $conn->prepare("UPDATE carts SET quantity = '$quantity', price='$price' WHERE id='$id'");
            $update->execute();
        }
    




?>
   
  

