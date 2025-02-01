<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  if (!$_GET['id']) {
    echo "<script> window.location.href='".ROOTURL."/not-found.php'</script>";

  }
else{
  $admin_id = $_GET['id'];
  $getAdmin = $conn->prepare("SELECT * FROM admins WHERE  id = '$admin_id'");
  $getAdmin->execute();
  $admin =  $getAdmin->fetch(PDO::FETCH_OBJ);
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
      
      if (isset($_POST['submit']))
       {
          if (empty($_POST['fullname'] )||empty( $_POST['email']) || empty($_POST['username'])) 
          {
              echo "<script> alert('Some Fields are empty')";
          }
          else{
              $fullname=test_input($_POST['fullname'])?? $admin->fullname;
              $username=test_input($_POST['username'])?? $admin->username;
              $email=test_input($_POST['email'])?? $admin->email;
              if(empty($_FILES['image']['name'])){
                $image =$admin->image;
          }
            else{
              $image=$_FILES['image']['name'];
            }
              ;
              $update = $conn->prepare("UPDATE admins SET fullname =?,email=?,username = ?, image=? WHERE id = $admin_id ");
          $update->execute([
             $fullname,
              $email,
              $username,
              $image,
          ]);
          echo "<script>window.location.href='admins.php'</script>";
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
              <h5 class="card-title mb-5 d-inline">Update Admin</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" value="<?php echo $admin->email; ?>" placeholder="email" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="fullname" id="form2Example1" class="form-control" placeholder="fullname" value="<?php echo $admin->fullname; ?>" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" value="<?php echo $admin->username; ?>"/>
                </div>
                <div class="form-outline mb-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" placeholder="Image" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require_once("../admin-includes/footer.php"); ?>
