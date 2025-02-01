<?php

require_once("../admin-includes/header.php");
require_once("../admin-includes/checkLogin.php");
if (!isset($_GET['id'])) {
    echo "<script>window.location.href='show-orders.php'</script>";

}

    $order_id=$_GET['id'];
    $getorder = $conn->query("SELECT * FROM orders WHERE id = $order_id");
    $getorder->execute();
    $order = $getorder->fetch(PDO::FETCH_OBJ);
    if(empty($order)){
        echo "<script>window.location.href='show-orders.php'</script>";

    }
    $get_order_Items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
    $get_order_Items->execute();
    $order_items = $get_order_Items->fetchAll(PDO::FETCH_OBJ);

    $get_order_details = $conn->query("SELECT * FROM order_details WHERE order_id = $order_id");
    $get_order_details->execute();
    $order_details = $get_order_details->fetch(PDO::FETCH_OBJ);

    $getProduct=function($product_id) use ($conn){
        $Product = $conn->query("SELECT * FROM products WHERE id = '$product_id'");
        $Product->execute();
        $getProduct = $Product->fetch(PDO::FETCH_OBJ);
        return $getProduct;
    
    };

?>
    <div id="page-content" class="page-content">
        <div class="banner">

        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <h5 class="mb-3">BILLING DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <table class="table">
 
  <tbody>
    <tr>
      <th scope="row">Full Name</th>
      <td><?php echo $order_details->first_name ." " .  $order_details->last_name  ?></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td><?php echo $order_details->email ?></td>
    </tr>
    <tr>
      <th scope="row">Phone number</th>
      <td><?php echo $order_details->phone_number ?></td>
    </tr>
    <tr>
      <th scope="row">Address</th>
      <td><?php echo $order_details->address ?></td>
    </tr>
    
    <tr>
      <th scope="row">Street</th>
      <td><?php echo $order_details->street ?></td>
    </tr>
    <tr>
      <th scope="row">City</th>
      <td><?php echo $order_details->city ?></td>
    </tr>
    <tr>
      <th scope="row">Country</th>
      <td><?php echo $order_details->country ?></td>
    </tr>
    <tr>
      <th scope="row">Postal Code</th>
      <td><?php echo $order_details->postal_code ?></td>
    </tr>
    <tr>
      <th scope="row">Notes</th>
      <td><?php echo $order_details->notes ?></td>
    </tr>
    <tr>
      <th scope="row">Created at</th>
      <td><?php echo $order_details->created_at ?></td>
    </tr>

  </tbody>
</table>
                        <!-- Bill Detail of the Page end -->
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <div class="holder">
                            <h5 class="mb-3">YOUR ORDER</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Products</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($order_items as $order_item) :?>
                                        <tr >
                                            <td class="text-left">
                                                <?php echo $getProduct($order_item->product_id)->name ?>
                                            </td>
                                            <td class="text-center">
                                            <?php echo $order_item->quantity ?>
                                            </td>
                                            <td class="text-right">
                                            <?php echo $order_item->subtotal ?>
                                            </td>
                                        </tr>
                                     <?php endforeach ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td>
                                                <strong>Subtotal</strong>
                                            </td>
                                            <td class="text-right">
                                                 <?php echo $order->total-$order->shipping?> EGP
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Shipping</strong>
                                            </td>
                                            <td class="text-right">
                                                20.00 EGP
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>ORDER TOTAL</strong>
                                            </td>
                                            <td class="text-right">
                                                <strong><?php echo $order->total ?></strong>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>

                         
                        </div>
                       
                    </div>
                </div>
            </div>
        </section>
    </div>
   
    <?php require_once("../admin-includes/footer.php"); ?>
