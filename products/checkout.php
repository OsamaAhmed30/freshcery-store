<?php

require("../includes/header.php");
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script>window.location.href='".APPURL."/not-found.php'</script>";
    exit;
    

  }
$getProduct=function($product_id) use ($conn){
    $Product = $conn->query("SELECT * FROM products WHERE id = '$product_id'");
    $Product->execute();
    $getProduct = $Product->fetch(PDO::FETCH_OBJ);
    return $getProduct;

};


$getTotal = $conn->query("SELECT SUM(price) FROM carts WHERE user_id = '$_SESSION[user_id]'");
$getTotal->execute();
$total_needed = $getTotal->fetchColumn();
if (!isset($_SESSION['name'])) {
    echo "<script>window.location.href='".APPURL."/auth/login.php'</script>";
}
if (count($carts_items)>0) {
    if (isset($_POST['submit'])) {
        if (isset($_POST['first_name'])&& isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number'])&& isset($_POST['address'])&& isset($_POST['street'])&& isset($_POST['city'])&& isset($_POST['country'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $postal_code = $_POST['postal_code'];
            $notes = $_POST['notes'];
      
    
        try {
            $conn->beginTransaction();
    
        /* Change the database schema and data */
        //add order
        $insertOrder = $conn->prepare("INSERT INTO orders (user_id,shipping,status,tax,total,discount,payment_status) VALUES (:user_id,:shipping,:status,:tax,:total,:discount,:payment_status)");
            $insertOrder->execute([
                "user_id"=>$_SESSION['user_id'],
                "shipping"=>20,
                "status"=>"finished"
                ,"tax"=>0,
                "total"=>$total_needed + 20,
                "discount"=>0,
                "payment_status"=>"not paid"
            ]);
            $order_id=$conn->lastInsertId();
    
        $postDetails= $conn->prepare("INSERT INTO order_details (first_name,last_name,email,phone_number,address,street,city,country,postal_code,notes,order_id) VALUES (:first_name,:last_name,:email,:phone_number,:address,:street,:city,:country,:postal_code,:notes,:order_id)");
            $postDetails->execute([
                ":first_name"=>$first_name,
                ":last_name"=>$last_name,
                ":email"=>$email,
                ":phone_number"=>$phone_number,
                ":address"=>$address,
                ":street"=>$street,
                ":city"=>$city,
                ":country"=>$country,
                ":postal_code"=>$postal_code,
                ":notes"=>$notes,
                ":order_id"=>$order_id,
            ]);
            foreach($carts_items as $carts_item){
        $postItems= $conn->prepare("INSERT INTO order_items (product_id,quantity,price,subtotal,name,order_id) VALUES (:product_id,:quantity,:price,:subtotal,:name,:order_id)");
        $postItems->execute([
                ":product_id"=>$carts_item->product_id,
                ":quantity"=>$carts_item->quantity,
                ":price"=>$getProduct($carts_item->product_id)->new_price,
                ":subtotal"=>$carts_item->price,
                ":name"=>$getProduct($carts_item->product_id)->name,
                ":order_id"=>$order_id,
                
            ]);
    
        }
    
        $emptyCart = $conn->exec("DELETE FROM carts WHERE user_id='$_SESSION[user_id]'");
    
            $conn->commit();
            echo "<script>window.location.href='".APPURL."/products/charge.php'</script>";
    
        } 
        catch (\Throwable $th) {
            /* Recognize mistake and roll back changes */
            $conn->rollBack();
        }
    }
    }
}
else{
    echo "<script>window.location.href='".APPURL."/products/shop.php'</script>";

    }
    


?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url(<?php echo APPURL?>/assets/img/bg-header.jpg);">
                <div class="container">
                    <h1 class="pt-5">
                        Checkout
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <h5 class="mb-3">BILLING DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="" id="myform"  method="post" class="bill-detail">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col">
                                        <input name="first_name" class="form-control" placeholder="Name" type="text">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="last_name" placeholder="Last Name" type="text">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="Address"></textarea>
                                </div>
                                <div class="form-group">
                                    <input name="city" class="form-control" placeholder="Town / City" type="text">
                                </div>
                              
                                <div class="form-group">
                                    <input name="street" class="form-control" placeholder="street" type="text">
                                </div>
                                <div class="form-group">
                                    <input name="country" class="form-control" placeholder="Country" type="text">
                                </div>
                                <div class="form-group">
                                    <input name="postal_code" class="form-control" placeholder="Postcode / Zip" type="text">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input name="email" class="form-control" placeholder="Email Address" type="email">
                                    </div>
                                    <div class="col">
                                        <input name="phone_number" class="form-control" placeholder="Phone Number" type="tel">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <textarea name="notes" class="form-control" placeholder="Order Notes"></textarea>
                                </div>
                                <input type="hidden" value="submit" name="submit" >
                            </fieldset>

                        </form>
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
                                        <?php foreach($carts_items as $carts_item) :?>
                                        <tr >
                                            <td class="text-left">
                                                <?php echo $getProduct($carts_item->product_id)->name ?>
                                            </td>
                                            <td class="text-center">
                                            <?php echo $carts_item->quantity ?>
                                            </td>
                                            <td class="text-right">
                                            <?php echo $carts_item->price ?>
                                            </td>
                                        </tr>
                                     <?php endforeach ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td>
                                                <strong>Cart Subtotal</strong>
                                            </td>
                                            <td class="text-right">
                                                 <?php echo $total_needed?> EGP
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
                                                <strong><?php echo $total_needed + 20 ?></strong>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>

                         
                        </div>
                        <p class="text-right mt-3">
                            <input checked="" type="checkbox"> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                        </p>
                        <button form="myform" type="submit" class="btn-check btn btn-primary float-right">PROCEED TO CHECKOUT <i class="fa fa-check"></i></button>
                        <div class="clearfix">
                    </div>
                </div>
            </div>
        </section>
    </div>
   

  <?php require("../includes/footer.php"); ?>
  <script>
  $(".btn-check").on('click', function(e) { 
   
  $(".subm").submit(function(){
  alert("Submitted");
    });
});
    </script>