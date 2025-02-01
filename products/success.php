<?php require "../includes/header.php"; 
if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script>window.location.href='".APPURL."/not-found.php'</script>";

      exit;
    

  }
  
$emptyCart = $conn->exec("DELETE FROM carts WHERE user_id='$_SESSION[user_id]'");
$getOrder = $conn->query("SELECT * FROM orders  where user_id = '$_SESSION[user_id]' ORDER BY id DESC LIMIT 1");
$getOrder->execute();
$order = $getOrder->fetch(PDO::FETCH_OBJ);   
$order_id = $order->id;
$updateOrder = $conn->prepare("UPDATE orders SET payment_status = 'paid' WHERE id = $order_id");
$updateOrder->execute();

?>

<div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Payment has been a success 
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                    <a href="<?php echo APPURL; ?>" class="btn btn-primary text-uppercase">home</a>

                  
                </div>
            </div>
</div>

<?php require "../includes/footer.php"; ?>
