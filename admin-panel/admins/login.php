<?php 
  require_once("../admin-includes/header.php");
  if (isset($_SESSION['admin_id'])) {
     
    echo "<script> window.location.href='".APPURL."/index.php'</script>";
  }
  if ($_SERVER['REQUEST_METHOD']=="POST") {
    if (isset($_POST['submit'])) {
      if (empty($_POST['email']) OR empty($_POST['password'])) 
        {
            echo "<script>window.onload=function(){
               let message = document.getElementById('message');
               message.innerText='some inputs are empty';
               message.classList.remove('d-none');
               
            };</script>";
           
        }
        else{
           
            $email=test_input($_POST['email']);
            $password=test_input($_POST['password']); 
            
            $login = $conn->query("SELECT * FROM admins WHERE  email = '$email'");
            $login->execute();
            $admin = $login->fetch(PDO::FETCH_ASSOC);
            
            
            if ($login->rowCount()>0) {
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin_id']=$admin['id'];
                    $_SESSION['name-admin']=$admin['fullname'];
                    $_SESSION['username-admin']=$admin['username'];
                    $_SESSION['email-admin']=$admin['email'];
                    $_SESSION['image-admin']=$admin['image'];
                 
                    echo "<script> window.location.href='".APPURL."'</script>";
                }
                else {
                    echo "<script>window.onload=function(){
                        document.getElementById('message').innerText='Wrong Password';
                    };</script>";
                };
            }
            else {
                echo "<script>window.onload=function(){
                    document.getElementById('message').innerText='Email Not found';
                };</script>";
            };
           
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
              <h5 class="card-title mt-5">Login</h5>
              <form method="POST" class="p-auto" action="login.php">
              <div id="message" class="text-center d-none p-2 bg-danger mb-3"></div>
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input type="email" name="email" id="form2Example1" class="form-control" placeholder="Email" />
                   
                  </div>

                  
                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" placeholder="Password" class="form-control" />
                    
                  </div>



                  <!-- Submit button -->
                  <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>

                 
                </form>

            </div>
       </div>
     </div>
    </div>
</div>

<?php require_once("../admin-includes/footer.php"); ?>
