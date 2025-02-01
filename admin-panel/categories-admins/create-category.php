<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      if (isset($_POST['submit']))
       {
          if (empty($_POST['name'] )) 
          {
              echo "<script> alert('Some Fields are empty')";
          }
          else{
            $name=test_input($_POST['name']);
             $description=test_input($_POST['description']);
             if(empty($_FILES['image']['name'])){
               $image ='product.svg';
         }
           else{
             $image=$_FILES['image']['name'];
           }
           $insert = $conn->prepare("INSERT INTO categories(name,icon,description, image) VALUES (:name , :description ,:image)");
          $insert->execute([
              ":name"=>$name,
              ":description"=>$description,
              ":image"=>$image,
          ]);
          echo "<script>window.location.href='show-categories.php'</script>";
     
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
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
              <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-outline mb-4 mt-4">
                  <label>Image</label>

                  <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  <?php require_once("../admin-includes/footer.php"); ?>
