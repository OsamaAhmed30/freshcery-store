<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");
  // ctegories
  $getCategories = $conn->query("SELECT * FROM categories");
  $getCategories->execute();
  $categories = $getCategories->fetchAll(PDO::FETCH_OBJ);
  if ($_GET['id']) {
    $product_id = $_GET['id'];

    $getProduct = $conn->query("SELECT * FROM products WHERE id = $product_id");
    $getProduct->execute();
    $product = $getProduct->fetch(PDO::FETCH_OBJ);
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
   
        if (isset($_POST['submit']))
        {
            if (empty($_POST['name'])|| empty($_POST['old_price'])||empty($_POST['description'])||empty($_POST['category_id']))
            {
                echo "<script> alert('Some Fields are empty')";
            }
            else{
              $name=test_input($_POST['name']);
              $quantity=test_input($_POST['quantity']);
              $old_price=test_input($_POST['old_price']);
              $new_price=test_input($_POST['new_price']) ?? $_POST['old_price'];
              $category_id=test_input($_POST['category_id']);
              $exp_date=test_input($_POST['exp_date']);
              $description=test_input($_POST['description']);
              $status=test_input($_POST['status'])== 'on'? 1 : 0;
              if(empty($_FILES['image']['name'])){
                $image ='product.svg';
          }
            else{
             $target_dir = $_SERVER['DOCUMENT_ROOT'] ."/Freshcery/assets/img/";
              $target_file = $target_dir . basename($_FILES["image"]["name"]);
              $uploadOk = 1;
              $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
              $check = getimagesize($_FILES["image"]["tmp_name"]);
              if($check !== false) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                  $image=$_FILES['image']['name'];
                  }
                }  
            }
            $update = $conn->prepare("Update products SET name=?,quantity=?,old_price=?,new_price=?,category_id=?,exp_date=?,status=? , description=? ,image=? WHERE id = $product_id");
            $update->execute([
               $name,
               $quantity,
               $old_price,
               $new_price,
               $category_id,
               $exp_date,
               $status,
               $description,
               $image,
            ]);

        
            echo "<script>window.location.href='show-products.php'</script>";
      
        }
      
        
        }
    }
}
  function test_input($data)
  {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      
  }

?>
    <div class="container-fluid">
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Products</h5>
              <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <label>Title</label>
                  <input type="text" name="name" value="<?php echo $product->name?>" id="form2Example1" class="form-control" placeholder="Name" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Quantity</label>
                    <input type="text" name="quantity" value="<?php echo $product->quantity?>" id="form2Example1" class="form-control" placeholder="Quantity" />
                </div>
                <div class="form-outline mb-4 mt-4">
                    <label>Old Price</label>
                    <input type="text" name="old_price" id="form2Example1" class="form-control" value="<?php echo $product->old_price?>" placeholder="Old price" />
                </div>
                <div class="form-outline mb-4 mt-4">
                    <label>New Price</label>
                    <input type="text" name="new_price" id="form2Example1" class="form-control" value="<?php echo $product->new_price?>" placeholder="New price" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $product->description?></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                      <option>--select category--</option>
                      <?php foreach($categories as $category): ?>
                      <option value="<?php echo $category->id ?>" <?php echo $category->id == $product->category_id?'selected': '' ?>  ><?php echo $category->name ?></option> 
                      <?php endforeach; ?>
                    </select>
                </div>

              <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Expiration Date</label>
                  <input type="date" name="exp_date" id="form2Example1" class="form-control" value="<?php echo $product->exp_date?>" placeholder="Expiration Date" />
              </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Image</label>

                    <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                </div>
                <div class="form-outline mb-4 mt-4">
                 <div class="form-check">
                 <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault" <?php  echo $product->status ? 'checked':'' ?>>
                <label class="form-check-label" for="flexCheckDefault">
                  Verified
                </label>
                </div>
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require_once("../admin-includes/footer.php"); ?>
