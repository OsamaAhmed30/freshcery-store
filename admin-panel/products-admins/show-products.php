<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  $getProducts = $conn->query("SELECT * FROM Products");
  $getProducts->execute();
  $products = $getProducts->fetchAll(PDO::FETCH_OBJ);
?>

    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Products</h5>
              <a  href="./create-product.php" class="btn btn-primary mb-4 text-center float-right">Create Product</a>
            
              <table class="table text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">product</th>
                    <th scope="col">Old Price</th>
                    <th scope="col">New Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">expiration date</th>
                    <th scope="col">status</th>
                    <th scope="col">created At</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($products as $product) :?>
                  <tr>
                    <th scope="row"> <?php echo $product->id?></th>
                    <td><?php echo $product->name?></td>
                    <td><?php echo $product->old_price?></td>
                    <td><?php echo $product->new_price?></td>
                    <td><?php echo $product->quantity?></td>
                    <td><?php echo $product->exp_date?></td>
                     <td><?php echo $product->status? '<a href="#" class="btn btn-success  text-center ">Verfied</a>': '<a href="#" class="btn btn-danger  text-center ">UnVerfied</a>'?></td>
                     <td><?php echo $product->created_at?></td>

                     <td><a  href="./update-product.php?id=<?php echo $product->id?>" class="btn btn-warning text-white text-center ">Update </a></td>
                     <td><button value="<?php echo $product->id?>" class="btn btn-delete btn-danger ml-1">Delete </button></td>
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
                        url: "delete-product.php",
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