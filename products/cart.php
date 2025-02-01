<?php require_once("../includes/header.php");

if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script>window.location.href='".APPURL."/not-found.php'</script>";
      exit;
  }
if (!isset($_SESSION['name'])) {
   
    echo "<script> window.location.href='".APPURL."/auth/login.php'</script>";
    
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



?>


    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('../assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Your Cart
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if(count($carts_items)<=0 ) : ?>
                        <p class="bg-success text-center p-3 h4">Cart is Empty</p>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th width="15%">Quantity</th>
                                        <th width="15%">Update</th>
                                        <th>Subtotal</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($carts_items as $carts_item) :?>
                                    <tr>
                                        <input class="pro_id" type="hidden" value="<?php echo $carts_item->id?>"/>
                                        <td>
                                            <img src="../assets/img/<?php echo $carts_item->image?>" height="60" width="60" style="border-radius:50%">
                                        </td>
                                        <td>
                                        <?php echo $getProduct($carts_item->product_id)->name ?><br>
                                            <small>1000g</small>
                                        </td>
                                        <td >
                                            <span class="pro_price"><?php echo $getProduct($carts_item->product_id)->new_price ?></span>
                                         EGP
                                        </td>
                                  
                                        <td>
                                            <input class="pro_amount form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $carts_item->quantity ?>" name="vertical-spin">
                                        </td>
                                        <td>
                                        <button value="<?php echo $carts_item->id?>"  class="btn-update btn btn-primary" > UPDATE
                                    </button> 
                                          
                                        </td>
                                        <td class="total_price">
                                        <?php echo $carts_item->price ?> EGP
                                        </td>
                                        <td>
                                        <button value="<?php echo $carts_item->id?>"  class="btn-delete btn bg-transparent text-danger btn-light" >
                                            <i class="fa fa-trash "></i>
                                        </button> 
                                            
                                        </td>
                                    </tr>
                                   <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif?>
                    </div>
                    <div class="col">
                        <a href="<?php echo APPURL?>/products/shop.php" class="btn btn-default">Continue Shopping</a>
                    </div>
                    <?php if(count($carts_items)>0 ) : ?>
                    <div class="col text-right" id="checkout">
                        <div class="clearfix"></div>
                        <h6 class="mt-3 ">Total: <span class="total_need"><?php echo $total_needed ?> </span>EGP</h6> 
                        <a href="<?php echo APPURL?>/products/checkout.php" class="btn btn-lg btn-primary" >Checkout <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </div>

    <?php require("../includes/footer.php");?>

    <script>
        $(document).ready(function() {
            $(".form-control").keyup(function(){
                var value = $(this).val();
                value = value.replace(/^(0*)/,"");
                $(this).val(1);
            });

        })
        $(".pro_amount").mouseup(function () {
                  
                  var $el = $(this).closest('tr');
                  var pro_amount = $el.find(".pro_amount").val();
                  var pro_price = $el.find(".pro_price").html();
                  var pro_id =$el.find(".pro_id").val();
                  var total = pro_amount * pro_price;
                  var $el_2 = $(this).closest('h6');
                  var total_need = $(".total_need").html();
                  
                  $el.find(".total_price").html("");        

                  $el.find(".total_price").append(total+' EGP');

                  $(".btn-update").on('click', function(e) {
                    var id = $(this).val();
                      $.ajax({
                        type: "POST",
                        url: "update_product.php",
                        data: {
                          update: "update",
                          id: pro_id,
                          quantity: pro_amount,
                          price:total

                        },

                        success: function() {
                            $(".total_need").html("");
                            var total_p = 0;
                            $('table tr').each(function(e) {
                              
                                
                            var value = parseInt($('.total_price', this).text());                            
                            if (!isNaN(value)) {
                             total_p += value;
                            
                            }
            });
            $('.total_need').text( total_p + " ");
                          
                         //window.location.reload();
                        }
                      })
                    });
      });
      $(".btn-delete").on('click', function(e) {                        
                        var id = $(this).val();
                        var this_e = $(this)
                      $.ajax({
                        type: "POST",
                        url: "delete_product.php",
                        data: {
                          delete: "delete",
                          id: id,

                        },

                        success: function() {                            
                            $(this_e).parent().parent().remove();
                            $(".total_need").html("");
                            var total_p = 0;
                            number =  $('.badge_number').text()-1;
                            $('table tr').each(function(e) {
                             
                            var value = parseInt($('.total_price', this).text());                        
                            if (!isNaN(value)) {
                             total_p += value;
                            }
                                });
                             $('.total_need').text( total_p + " ");
                            $('.badge_number').text(number);                            
                            if ($('tbody tr').length===0) {
                                $('.col-md-12').html('<p class="bg-success text-center p-3 h4">Cart is Empty</p>');
                                $('#checkout').html('');
                            }
                            
                        }
                      })                    
               
      });
    </script>

