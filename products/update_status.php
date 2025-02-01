<?php 
    $update = $conn->prepare("Update orders SET payment_status= paid WHERE id = $order_id");
    $update->execute();
?>





<script>
        
            $.ajax({
            type: "POST",
            url: "update_status.php",
            data: {
              
            },
        
}   )
     
    </script>