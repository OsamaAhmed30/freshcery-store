<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");
  // ctegories
  $getCategories = $conn->query("SELECT * FROM categories");
  $getCategories->execute();
  $categories = $getCategories->fetchAll(PDO::FETCH_OBJ);

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    echo $_POST['name'];
   echo $_POST['old_price'];
   echo $_POST['description'];
   echo $_POST['category_id'];
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
           $insert = $conn->prepare("INSERT INTO products(name,quantity,old_price,new_price,category_id,exp_date,status,description, image) VALUES (:name,:quantity,:old_price,:new_price,:category_id,:exp_date,:status , :description ,:image)");
          $insert->execute([
              ":name"=>$name,
              ":quantity"=>$quantity,
              ":old_price"=>$old_price,
              ":new_price"=>$new_price,
              ":category_id"=>$category_id,
              ":exp_date"=>$exp_date,
              ":status"=>$status,
              ":description"=>$description,
              ":image"=>$image,
          ]);
          echo "<script>window.location.href='show-products.php'</script>";
     
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
              <h5 class="card-title mb-5 d-inline">Create Products</h5>
              <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <label>Title</label>

                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Name" />
                </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Quantity</label>
                    <input type="text" name="quantity" id="form2Example1" class="form-control" placeholder="Quantity" />
                </div>
                <div class="form-outline mb-4 mt-4">
                    <label>Old Price</label>
                    <input type="text" name="old_price" id="form2Example1" class="form-control" placeholder="Old price" />
                </div>
                <div class="form-outline mb-4 mt-4">
                    <label>New Price</label>
                    <input type="text" name="new_price" id="form2Example1" class="form-control" placeholder="New price" />
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select name="category_id" class="form-control" id="exampleFormControlSelect1">
                      <option>--select category--</option>
                      <?php foreach($categories as $category): ?>
                      <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>

              <div class="form-group">
                  <label for="exampleFormControlSelect1">Select Expiration Date</label>
                  <input type="date" name="exp_date" id="form2Example1" class="form-control" placeholder="Expiration Date" />
              </div>

                <div class="form-outline mb-4 mt-4">
                    <label>Image</label>

                    <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                </div>
                <div class="form-outline mb-4 mt-4">
                 <div class="form-check">
                 <input class="form-check-input" type="checkbox" name="status" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Verified
                </label>
                </div>
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require_once("../admin-includes/footer.php"); ?>
