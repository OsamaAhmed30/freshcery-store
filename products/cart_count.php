<?php
    session_start();
    define("APPURL","http://localhost/Freshcery");
require("../config/config.php");
    $user_id=$_SESSION['user_id'];
     $get_cart_items = $conn->query("SELECT * FROM carts WHERE user_id = '$user_id'");
     $get_cart_items->execute();
     $carts_items= $get_cart_items->fetchAll(PDO::FETCH_OBJ);
     echo count($carts_items);
?>