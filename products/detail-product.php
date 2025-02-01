<?php 
    require("../includes/header.php");
    $id = $_GET['id'];
    if (!isset($id) || empty($id)) {
        echo "<script>window.location.href='".APPURL."/not-found.php'</script>";

    }
    else{
     $getProductDetails=$conn->query("SELECT * FROM Products WHERE id = '$id' AND status = 1");
     $getProductDetails->execute();
     $product_details=$getProductDetails->fetch(PDO::FETCH_OBJ);

     //print_r($product_details->new_price);
     //echo ($product_details->new_price);

    //related_products
     $getRelatedProducts =$conn->query("SELECT * FROM Products WHERE category_id = '$product_details->category_id' AND status = 1 AND id != '$product_details->id'");
     $getRelatedProducts->execute();
     $relatedProducts=$getRelatedProducts->fetchAll(PDO::FETCH_OBJ);
   
     if (isset($_SESSION['name'])) {
        $user_id=$_SESSION['user_id'];
        $cart_items = function($id) use($conn,$user_id){
            $getCartItems = $conn->query("SELECT *  FROM carts WHERE product_id = '$id' AND user_id = '$user_id'" );
            $getCartItems->execute();
            return $getCartItems->fetch(PDO::FETCH_OBJ);
        };
       
     }
     else
     { 
        
        echo "<script>window.location.href='".APPURL."/auth/login.php'</script>";
        
     }
     if ($_SERVER["REQUEST_METHOD"] == "POST") 
     {
         if (isset($_POST['submit']))
          {
             if (empty($_POST['id'])) 
             {
                 echo "<script> alert('Some Fields are empty')</script>";
             }
             else{
               if (!Empty($cart_items($_POST['id']))) {
                $price= $product_details->new_price * $_POST['quantity'];
                $update = $conn->prepare("UPDATE carts SET quantity = '$_POST[quantity]', price='$price' WHERE product_id='$id' AND user_id = '$user_id'");
                 $update->execute();
                }
               else {
                $quantity=$_POST['quantity'];
                $insert = $conn->prepare("INSERT INTO carts(product_id,user_id,price,quantity ,image ) VALUES (:product_id , :user_id , :price , :quantity,:image)");
               $insert->execute([
                 ":product_id"=>$id,
                 ":user_id"=>$user_id,
                 ":quantity"=>$quantity,
                 ":price"=>$product_details->new_price,
                 ":image"=>$product_details->image
                ]);
               }
             }
              
         }
        
         
     }



     function calcDiscount($old,$new){
        return (($old - $new)/$old) * 100;
    }
    }
?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL."/assets/img/bg-header.jpg"?>')">
                <div class="container">
                    <h1 class="pt-5">
                        <?php echo $product_details->name;?>
                    </h1>
                    <p class="lead">
                    <?php echo $product_details->description;?>.
                    </p>
                </div>
            </div>
        </div>
        <div class="product-detail">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="slider-zoom">
                            <a href="<?php echo APPURL .'/assets/img/'. $product_details->image;?>" class="cloud-zoom" rel="transparentImage: 'data:image/jpg;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10" id="cloudZoom">
                                <img alt="Detail Zoom thumbs image" src="<?php echo APPURL .'/assets/img/'. $product_details->image;?>" style="width: 100%;">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <strong>Overview</strong><br>
                            <?php echo $product_details->description?>
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <strong>Price</strong> (/Pack)<br>
                                    <span class="price"><?php echo $product_details->new_price; ?> EGP</span>
                                    <span class="old-price"><?php echo $product_details->old_price; ?> EGP</span>
                                </p>
                            </div>
                           
                        </div>
                        <form action="" class="form-submit">
                            <div class="row">
                                <input class="form-control" type="hidden"  value="<?php echo $product_details->id ?>" name="id">
                            </div>
                                <p class="mb-1">
                                    <strong>Quantity</strong>
                                </p>
                            <div class="row">
                                <div class="col-sm-5">
                                
                                    <input class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo !Empty($cart_items($product_details->id)) ?   $cart_items($product_details->id)->quantity : $product_details->quantity  ?>" name="quantity">
                                    
                                </div>
                                <div class="col-sm-6"><span class="pt-1 d-inline-block">Pack (1000 gram)</span></div>
                                <div id="popup"  class="popup">
                                        <span class="popuptext" id="myPopup"></span>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center">
                                <?php if(!Empty($cart_items($product_details->id))) :?>
                                    <button  name="submit" type="submit" id="input_submit" class="input_submit mt-3 btn btn-primary btn-lg" ><i class='fa fa-shopping-basket'></i> Update Cart
                                    </button> 
                                <?php else: ?>
                                    <button  name="submit" type="submit" id="input_submit" class="input_submit mt-3 btn btn-primary btn-lg" ><i class='fa fa-shopping-basket'></i> Add to Cart
                                    </button> 
                                <?php endif; ?>
                                <div class="col">
                                    <a href="<?php echo APPURL?>/products/shop.php" class="mt-3 btn  mt-3 btn-default">Continue Shopping</a>
                                </div>
                            </div>
                        </form>
                            
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
        <?php if (!Empty($relatedProducts)): ?>
        <section id="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Related Products</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($relatedProducts as $relatedProduct):?>
                            <div class="item">
                                <div class="card card-product">
                                    <div class="card-ribbon">
                                        <div class="card-ribbon-container right">
                                            <span class="ribbon ribbon-primary">SPECIAL</span>
                                        </div>
                                    </div>
                                    <div class="card-badge">
                                        <div class="card-badge-container left">
                                            <span class="badge badge-default">
                                                Until <?php echo $relatedProduct->exp_date ?>
                                            </span>
                                            <span class="badge badge-primary">
                                            <?php echo round(calcDiscount($relatedProduct->old_price,$relatedProduct->new_price)) ?>% OFF
                                            </span>
                                        </div>
                                        <a href="<?php echo APPURL?>/products/detail-product.php?id=<?php echo $relatedProduct->id ?>"><img src='<?php echo APPURL ."/assets/img/".$relatedProduct->image?>' alt="Card image 2" class="card-img-top"></a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail-product.html"><?php echo $relatedProduct->name; ?></a>
                                        </h4>
                                        <div class="card-price">
                                            <span class="discount"><?php echo $relatedProduct->new_price; ?> EGP</span>
                                            <span class="reguler"><?php echo $relatedProduct->old_price; ?> EGP</span>
                                        </div>
                        <form action="" class="form-submit-re">
                        <div class="row">
                        <input class="form-control" type="hidden"  value="<?php echo $relatedProduct->id ?>" name="id">
                        </div>
                        <p class="mb-1">
                            <strong>Quantity</strong>
                        </p>
                        <div class="row">
                            <div class="">
                            <?php if(!Empty($cart_items($relatedProduct->id))) :?>
                                <input class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $cart_items($relatedProduct->id)->quantity ?>" name="quantity">
                                <?php else :?>
                                    <input class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $relatedProduct->quantity ?>" name="quantity">
                                <?php endif;?>
                            </div>
                            
                            <div id="popup"  class="popup">
                                    <span class="popuptext" id="myPopup"></span>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-2"></div>
                            <div >Pack (1000 gram)</div>
                            </div>
                            <div class="row">
                            <?php if(!Empty($cart_items($relatedProduct->id))) :?>
                            <button  name="submit" type="submit" id="input_submit_related" class="input_submit_related mt-3 btn btn-primary btn-lg" ><i class='fa fa-shopping-basket'></i> Update Cart
                            </button> 
                            <?php else: ?>
                                <button  name="submit" type="submit" id="input_submit_related" class="input_submit_related mt-3 btn btn-primary btn-lg" ><i class='fa fa-shopping-basket'></i> Add to Cart
                                </button> 
                            <?php endif; ?>
                            </div>
                            </form>

                                    </div>
                                </div>
                            </div>
                          <?php endforeach ?>
                           
                         
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif ; ?>
    </div>
 <?php require("../includes/footer.php");?>
    <script>
        $(document).ready(function() {
            $(".form-control").keyup(function(){
                var value = $(this).val();
                value = value.replace(/^(0*)/,"");
                $(this).val(1);
            });

        });
        $(".input_submit").on('click',function(e) {
           e.preventDefault();          
           var form_submit = $(".form-submit").serialize()+'&submit=submit';
        $.ajax({
                url:"detail-product.php?id=<?php echo $id?>",
                method:'post',
                data:form_submit,
                success:function(){
                var mypopup =  document.getElementById('myPopup');
                mypopup.innerText='Added successfully';
                mypopup.classList.toggle("show");

                setTimeout(function(){
                   window.location.href="../shop.php";
                },1500);
            
        }
    })
})

    </script>

