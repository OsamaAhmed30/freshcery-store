
<?php require_once("../includes/header.php");?>

<?php
if (isset($_SESSION['name'])) {
   
echo "<script> window.location.href='".APPURL."'</script>";

 }

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['submit']))
     {
        if (empty($_POST['email']) OR empty($_POST['password'])) 
        {
            echo "<script>window.onload=function(){
                document.getElementById('message').innerText='some inputs are empty';
            };</script>";
           
        }
        else{
           
            $email=test_input($_POST['email']);
            $password=test_input($_POST['password']); 
            
            $login = $conn->query("SELECT * FROM users WHERE  email = '$email'");
            $login->execute();
            $user = $login->fetch(PDO::FETCH_ASSOC);
            
            
            if ($login->rowCount()>0) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id']=$user['id'];
                    $_SESSION['name']=$user['fullname'];
                    $_SESSION['username']=$user['username'];
                    $_SESSION['email']=$user['email'];
                    $_SESSION['image']=$user['image'];
                 
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
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style='background-image: url("<?php echo APPURL?>/assets/img/bg-header.jpg");'>
                <div class="container">
                    <h1 class="pt-5">
                        Login Page
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>

                    <div class="card card-login mb-5">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                <div id="message" style="color: red;background-color:#ffe5ec"></div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" type="email"  name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input class="form-control" type="password"  name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 d-flex justify-content-between align-items-center">
                                        <!-- <div class="checkbox">
                                            <input id="checkbox0" type="checkbox" name="remember">
                                            <label for="checkbox0" class="mb-0"> Remember Me? </label>
                                        </div> -->
                                        <!-- <a href="login.html" class="text-light"><i class="fa fa-bell"></i> Forgot password?</a> -->
                                    </div>
                                </div>
                                <div class="form-group row text-center mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require "../includes/footer.php";?>

