<?php 
require("../includes/header.php");

        if (isset($_POST['submit']))
         {
            echo $_POST['id'];
           
               if (isset($_SESSION['name'])) {
                $product_id=$_POST['id'];
                $getProductSelect= $conn->query("SELECT * FROM products WHERE id = '$product_id'");
                $getProductSelect->execute();
                $productSelect = $getProductSelect->fetch(PDO::FETCH_OBJ);
                   $user_id=$_SESSION['user_id'];
                   $quantity = $_POST['quantity'];
                   $price= $productSelect->new_price * $quantity;
                   $image= $productSelect->image;
                   $getCartItems = $conn->query("SELECT *  FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'" );
                   $getCartItems->execute();
                   $cart_items = $getCartItems->fetch(PDO::FETCH_OBJ);
                 
              if (!Empty($cart_items)) {
               $quantity=$cart_items->quantity + $_POST['quantity'];
               $price= $productSelect->new_price * $quantity;
               $update = $conn->prepare("UPDATE carts SET quantity = '$quantity', price='$price' WHERE product_id='$product_id' AND user_id = '$user_id'");
                $update->execute();
                //echo "<script>window.location.href='".APPURL."/shop.php'</script>";
              }
              else {
              $insert = $conn->prepare("INSERT INTO carts(product_id,user_id,price,quantity ,image ) VALUES (:product_id , :user_id , :price , :quantity,:image)");
              $insert->execute([
                ":product_id"=>$product_id,
                ":user_id"=>$user_id,
                ":quantity"=>$quantity,
                ":price"=>$price,
                ":image"=>$image,
               ]);
              }
            }
            else
            { 
               echo "<script>window.location.href='".APPURL."/auth/login.php'</script>";
               
            }
           }
  
               
    
    