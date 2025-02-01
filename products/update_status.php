<?php 
    $update = $conn->prepare("Update orders SET payment_status= paid WHERE id = $order_id");
    $update->execute();
?>
