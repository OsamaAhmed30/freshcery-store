
<?php require("../includes/header.php");?>
<?php


if (isset($_SESSION['name'])) {
   
    echo "<script> window.location.href='".APPURL."'</script>";
}

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
            $image="user-1.avif";
            
            //check email existing
            $login = $conn->query("SELECT * FROM users WHERE  email = '$email'");
            $login->execute();
            $user = $login->fetch(PDO::FETCH_ASSOC);

            if($user){
                echo "<script>window.onload=function(){
                    document.getElementById('message').innerText='this email already has account';
                };</script>";
               
            }
            else{

        if ($_POST['password'] == $_POST['confirm_password']) {
            $insert = $conn->prepare("INSERT INTO users(fullname,email,username,password , image) VALUES (:fullname , :email , :username , :password,:image)");
        $insert->execute([
            ":fullname"=>$fullname,
            ":email"=>$email,
            ":username"=>$username,
            ":password"=>password_hash($password,PASSWORD_DEFAULT),
            ":image"=>$image,
        ]);
        echo "<script>window.location.href='login.php'</script>";
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

<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style='background-image: url("<?php echo APPURL ?>/assets/img/bg-header.jpg");'>
            <div class="container">
                <h1 class="pt-5">
                    Register Page
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>

                <div class="card card-login mb-5">
                    <div class="card-body">

                        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input name="fullname" class="form-control" type="text" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input name="email" class="form-control" type="email" placeholder="Email">
                                    <div id="message" style="color: red;background-color:#ffe5ec"></div>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input name="username" class="form-control" type="text" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input name="confirm_password" class="form-control" type="password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <input id="checkbox0" type="checkbox" name="terms">
                                        <label for="checkbox0" class="mb-0">I Agree with <a href="terms.html" class="text-light">Terms & Conditions</a> </label>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("../includes/footer.php"); ?>