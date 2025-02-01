<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['submit']))
     {
        if (empty($_POST['fullname'] )||empty( $_POST['email']) || empty($_POST['username']) ||empty($_POST['password'])) 
        {
            echo "<script> alert('Some Fields are empty')";
        }
        else{
            $fullname=test_input($_POST['fullname']);
            $username=test_input($_POST['username']);
            $email=test_input($_POST['email']);
            $password=test_input($_POST['password']);
            if(empty($_FILES['image']['name'])){
              $image ="user-1.avif";
        }
          else{
            $target_dir = $_SERVER['DOCUMENT_ROOT'] ."/Freshcery/assets/img/user/";
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
            
            //check email existing
            $login = $conn->query("SELECT * FROM admins WHERE  email = '$email'");
            $login->execute();
            $user = $login->fetch(PDO::FETCH_ASSOC);

            if($user){
                echo "<script>window.onload=function(){
                    document.getElementById('message').innerText='this email already has account';
                };</script>";
               
            }
            else{

        if ($_POST['password'] == $_POST['confirm_password']) {
            $insert = $conn->prepare("INSERT INTO admins(fullname,email,username,password , image) VALUES (:fullname , :email , :username , :password,:image)");
        $insert->execute([
            ":fullname"=>$fullname,
            ":email"=>$email,
            ":username"=>$username,
            ":password"=>password_hash($password,PASSWORD_DEFAULT),
            ":image"=>$image,
        ]);
        echo "<script>window.location.href='admins.php'</script>";
      }
    
        else{

            echo "<script> alert('Password and confirm password doesnt match'); </script>";
        }
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
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="fullname" id="form2Example1" class="form-control" placeholder="fullname" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="confirm_password" id="form2Example1" class="form-control" placeholder="confirm password" />
                </div>
                <div class="form-outline mb-4">
                  <input type="file" name="image" id="form2Example1" class="form-control" placeholder="Image" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require_once("../admin-includes/footer.php"); ?>
