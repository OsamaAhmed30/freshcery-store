<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  if (isset($_GET['id'])) {
    $category_id=$_GET['id'] ;

  
 // ctegories
 $getCategory = $conn->query("SELECT * FROM categories WHERE id = $category_id");
 $getCategory->execute();
 $category = $getCategory->fetch(PDO::FETCH_OBJ);
 if ($_SERVER["REQUEST_METHOD"] == "POST") 
 {
     
     if (isset($_POST['submit']))
      {
         if (empty($_POST['name'] )||empty( $_POST['description'])) 
         {
             echo "<script> alert('Some Fields are empty')";
         }
         else{
             $name=test_input($_POST['name'])?? $category->name;
             $description=test_input($_POST['description'])?? $category->description;
             if(empty($_FILES['image']['name'])){
               $image =$category->image;
         }
           else{
             $image=$_FILES['image']['name'];
           }
             ;
             $update = $conn->prepare("UPDATE categories SET name =?,description = ?, image=? WHERE id = $category_id ");
         $update->execute([
            $name,
            $description,
            $image,
         ]);
         echo "<script>window.location.href='show-categories.php'</script>";
         }
     
         
     }
           
     }
   
    }
    else{
      echo "<script>window.location.href='show-categories.php'</script>";
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
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" value="<?php echo $category->name?>" placeholder="name" />
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" placeholder="Image" />
                </div>
                <div class="form-group">
                   <textarea name="description" class="form-control" placeholder="Description"><?php echo $category->description?></textarea>
                </div>
      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>

      <?php require_once("../admin-includes/footer.php"); ?>
