<?php 
  require_once("./admin-includes/header.php");
  require_once("./admin-includes/checkLogin.php");

  
$count = function ($cat) use($conn){
  $getItems = $conn->query("SELECT * FROM $cat");
  $getItems->execute();
  $items = $getItems->fetchAll(PDO::FETCH_OBJ);
  return count($items);
}


?>
    <div class="container-fluid">
            
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of products: <?php echo $count('products')?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Orders</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of orders: <?php echo $count('orders')?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              
              <p class="card-text">number of categories:<?php echo $count('categories')?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $count('admins')?></p>
              
            </div>
          </div>
        </div>
      </div>
  
          
    </div>
<?php require_once("./admin-includes/footer.php"); ?>

