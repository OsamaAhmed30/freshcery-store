<?php require("../includes/header.php");

if (!$_SESSION['user_id']) {
    echo "<script> window.location.href='".APPURL."/auth/login.php'</script>";
}

else {
   $user_id= $_SESSION['user_id'];
   $getUser = $conn->query("SELECT * FROM users WHERE id = $user_id");
   $getUser->execute();
   $user = $getUser->fetch(PDO::FETCH_OBJ);

   if ($_SERVER["REQUEST_METHOD"]=='POST') {
    if (!empty($_POST['fullname'])||!empty($_POST['email'])) {
        if(isset($_POST['submit'])){
            $fullname=$_POST['fullname'];
            $email=$_POST['email'];
            $updateUser=$conn->prepare("UPDATE users SET fullname =?,address =?,city =?,country=?,postal_code =?,email=?,phone_number=?");
            $updateUser->execute([
               $fullname,
                $_POST['address'],
                $_POST['city']??"",
                $_POST['country']??"",
                $_POST['postal_code']??"",
                $email,
                $_POST['phone_number']??""
            ]);
            echo "<script>window.location.href='".APPURL."/index.php'</script>";

    }
  
   }

} 
}

   



?>



    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Settings
                    </h1>
                    <p class="lead">
                        Update Your Account Info
                    </p>
                </div>
            </div>
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xs-12 col-sm-6">
                        <h5 class="mb-3">ACCOUNT DETAILS</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="" method="post" class="bill-detail">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" placeholder="Full Name" name="fullname" value="<?php echo $user->fullname; ?>" type="text">
                                    </div>
                                   
                                </div>
                               
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Address"  name="address" ><?php echo $user->address; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Town / City" type="text" name="city" value="<?php echo $user->city; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="State / Country" type="text" name="country" value="<?php echo $user->country; ?>">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Postcode / Zip" name="postal_code" value="<?php echo $user->postal_code; ?>" type="text">
                                </div>
                                <div class="form-group">
                                   
                                    <input class="form-control" name="email" placeholder="Email Address" value="<?php echo $user->email; ?>" type="email">
                                </div>
                                <div class="form-group">
                                        <input class="form-control" placeholder="Phone Number" name="phone_number" value="<?php echo $user->phone_number; ?>" type="tel">
                                    
                                </div>
                               
                               
                                <div class="form-group text-right">
                                    <input type="submit" name="submit" class="btn btn-primary" value="UPDATE">
                                    <div class="clearfix">
                                </div>
                            </fieldset>
                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <?php require("../includes/footer.php");?>
