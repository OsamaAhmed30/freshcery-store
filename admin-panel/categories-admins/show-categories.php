<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  // ctegories
  $getCategories = $conn->query("SELECT * FROM categories");
  $getCategories->execute();
  $categories = $getCategories->fetchAll(PDO::FETCH_OBJ);
?>

    <div class="container-fluid">

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($categories as $category):?>
                  <tr>
                    <th scope="row"><?php echo $category->id?></th>
                    <td><?php echo $category->name?></td>
                    <td><a  href="./update-category.php?id=<?php echo $category->id?>" class="btn btn-warning text-white text-center ">Update </a></td>
                    <td><button value="<?php echo $category->id?>" class="btn btn-delete btn-danger ml-1">Delete </button></td>
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
                        url: "delete-category.php",
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