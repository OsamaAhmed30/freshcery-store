<?php require("../includes/header.php");

$id = $_GET['id'];
if (!isset($id) || empty($id)) {
    echo "<script>window.location.href='".APPURL."/not-found.php'</script>";

}
else{
    $getOrders = $conn->query("SELECT * FROM orders  where user_id = '$_SESSION[user_id]' ");
        $getOrders->execute();
        $orders = $getOrders->fetchAll(PDO::FETCH_OBJ);  
        
    }



?>



    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Your Transactions
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Invoice</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Payment Status</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order): ?>
                                    <tr>
                                        
                                        <td>
                                        <?php echo $order->id; ?>
                                        </td>
                                        <td>
                                        <?php echo $order->created_at; ?>
                                        </td>
                                        <td>
                                        <?php echo $order->total; ?>
                                        </td>
                                        <td>
                                        <?php echo $order->payment_status; ?>
                                        </td>
                                        <td>
                                        <?php echo $order->status; ?>
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                      
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php require("../includes/footer.php");?>

