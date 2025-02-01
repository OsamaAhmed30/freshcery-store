<?php require("../includes/header.php");

    // ctegories
    $getCategories = $conn->query("SELECT * FROM categories");
    $getCategories->execute();
    $categories = $getCategories->fetchAll(PDO::FETCH_OBJ);
    //mostProducts
    $getMostProducts = $conn->query("SELECT * FROM Products WHERE status = 1");
    $getMostProducts->execute();
    $mostProducts = $getMostProducts->fetchAll(PDO::FETCH_OBJ);

    
    //get Categories_id of exist products
    $getExistCatId = $conn->query("SELECT category_id FROM Products WHERE status = 1");
    $getExistCatId->execute();
    $existCatId = $getExistCatId->fetchAll(PDO::FETCH_COLUMN, 0);
   
    function calcDiscount($old,$new){
        return (($old - $new)/$old) * 100;
    }
    $getCategoryProducts =function ($cat_id) use ($conn){
        $getCatProducts = $conn->query("SELECT * FROM Products WHERE status = 1 AND category_id = '$cat_id'");
        $getCatProducts->execute();
         $CatProducts =  $getCatProducts->fetchAll(PDO::FETCH_OBJ);
        return $CatProducts ;
    };

?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Shopping Page
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
        <div class="row">
                <div class="col-md-12">
                    <div class="shop-categories owl-carousel mt-5">
                        <?php foreach($categories as $category):?>
                        <div class="item">
                            <a href="shop.html">
                                <div class="media d-flex align-items-center justify-content-center">
                                    <span class="d-flex mr-2 w-25"><img class="rounded-circle" src="<?php echo APPURL .'/assets/img/'.$category->image?>" /></span>
                                    <div class="media-body">
                                        <h5><?php echo $category->name?></h5>
                                        <p><?php echo $category->description?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>
            </div>
        </div>

        <section id="most-wanted">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Most Wanted</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($mostProducts as $mostProduct):?>
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
                                                Until <?php echo $mostProduct->exp_date ?>
                                            </span>
                                            <span class="badge badge-primary">
                                            <?php echo round(calcDiscount($mostProduct->old_price,$mostProduct->new_price)) ?>% OFF
                                            </span>
                                        </div>
                                        <img  src="<?php echo APPURL .'/assets/img/'.$mostProduct->image?>" alt="Card image 2" class="card-img-top"  width = "200px"  height="250px">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail-product.html"><?php echo $mostProduct->name?></a>
                                        </h4>
                                        <div class="card-price">
                                            <span class="discount"><?php echo round($mostProduct->old_price) ?> EGP</span>
                                            <span class="reguler"><?php echo round($mostProduct->new_price) ?> EGP</span>
                                            <span class="reguler">Avilable Amount : <?php echo $mostProduct->quantity ?></span>
                                        </div>
                                        <form action="" id="">
                                            <input type="hidden" name="id" value="<?php echo $mostProduct->id?>" >
                                            <input class="form-control mb-2" type="number" min="1" max="<?php echo $mostProduct->quantity ?> " data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="1" name="quantity">
                                            <button type="submit" id="add" name="submit" class="add btn btn-block btn-primary">
                                            Add to Cart
                                            </button>
                                    </form>

                                    </div>
                                </div>
                            </div>
                           <?php endforeach?>
                       
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php foreach($categories as $category):?>
            <?php if (in_array($category->id ,$existCatId)) :?>
        <section id="<?php echo $category->name ?>" class="gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title"><?php echo $category->name?></h2>
                    <div class="product-carousel owl-carousel">
                    <?php foreach($getCategoryProducts($category->id) as $product):?>
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
                                                Until <?php echo $product->exp_date ?>
                                            </span>
                                            <span class="badge badge-primary">
                                            <?php echo round(calcDiscount($product->old_price,$product->new_price)) ?>% OFF
                                            </span>
                                        </div>
                                        <img  src="<?php echo APPURL .'/assets/img/'.$product->image?>" alt="Card image 2" class="card-img-top"  width = "200px"  height="250px">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail-product.html"><?php echo $product->name?></a>
                                        </h4>
                                        <div class="card-price">
                                            <span class="discount"><?php echo round($product->old_price) ?> EGP</span>
                                            <span class="reguler"><?php echo round($product->new_price) ?> EGP</span>
                                            <span class="reguler">Avilable Amount : <?php echo $product->quantity ?></span>
                                        </div>
                                        <form action="" id="">
                                            <input type="hidden" name="id" value="<?php echo $product->id?>" >
                                            <input class="form-control mb-2" type="number" min="1" max="<?php echo $product->quantity ?> " data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="1" name="quantity">
                                            <button type="submit" id="add" name="submit" class="add btn btn-block btn-primary">
                                            Add to Cart
                                            </button>
                                    </form>

                                    </div>
                                </div>
                            </div>
                           <?php endforeach?>
                       
                    </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif ?>
        <?php endforeach ?>
    </div>
 

   <?php require("../includes/footer.php");?>

<script>
    $(document).on('click',".add", function(e) {

                    e.preventDefault();
                    var quantity = $(this).closest("form").find("input[name='quantity']").val();
                    var pro_id = $(this).closest("form").find("input[name='id']").val();
                    console.log(e);
                    
                       $.ajax({
                        type: "POST",
                        url: "add_product.php",
                        data: {
                          submit: "submit",
                          id: pro_id,
                          quantity: quantity,
                        },
                        success: function(response) {
                            
                            console.log("response : " , response);
                            $.ajax({
                            type: "get",
                            url: "cart_count.php",
                            success: function(carts_count) {
                            
                            //console.log("response : " , carts_count);
                            console.log( $("#cart_count").text());
                            
                            $("#cart_count").text(carts_count)
                        
                        }})
                          
                        
                        }})
      }
     );
  
    
</script>