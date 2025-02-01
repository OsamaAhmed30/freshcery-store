<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");
  $getOrders = $conn->query("SELECT * FROM orders");
  $getOrders->execute();
  $orders = $getOrders->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container-fluid">

    <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Orders</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tax</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">discount</th>
                    <th scope="col">Shipping</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Created At</th>
                    <th scope="col">update</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($orders as $order) :?>
                  <tr>
                    <th scope="row"><?php echo $order->id ?></th>
                    <td><?php echo $order->status ?></td>
                    <td><?php echo $order->tax ?></td>
                    <td><?php echo $order->total ?></td>
                    <td><?php echo $order->discount ?></td>
                    <td><?php echo $order->shipping ?></td>
                    <td><?php echo $order->payment_status ?></td>
                    <td><?php echo $order->created_at ?></td>                   
                    <td><a  href="./order-details.php?id=<?php echo $order->id?>" class="btn btn-success text-white text-center ">Show Order</a>
                    <a  href="./update-order.php?id=<?php echo $order->id?>" class="btn btn-warning text-white text-center ">Update</a></td>
                  </tr>
                <?php endforeach ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php require_once("../admin-includes/footer.php"); ?>
<script>
$(".btn-delete").on('click', function(e) {                        
                        var id = $(this).val();
                        var this_e = $(this)                        
                      $.ajax({
                        type: "POST",
                        url: "delete-order.php",
                        data: {
                          delete: "delete",
                          id: id,

                        },

                        success: function() {                            
                            $(this_e).parent().parent().remove();
                                
                        }
                      })                    
               
      });
</script>