
    <?php
        require("../includes/header.php");
        if (!isset($_SERVER['HTTP_REFERER'])) {
            echo "<script>window.location.href='".APPURL."/not-found.php'</script>";
              exit;
          }
          
        $getOrder = $conn->query("SELECT * FROM orders  where user_id = '$_SESSION[user_id]' ORDER BY id DESC LIMIT 1");
        $getOrder->execute();
        $order = $getOrder->fetch(PDO::FETCH_OBJ);    
    ?>
  <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style='background-image: url("<?php echo APPURL?>/assets/img/bg-header.jpg");'>
                <div class="container">
                    <h1 class="pt-5">
                        Pay with Paypal
                    </h1>
                    <p class="lead">
                    Please Pay <span style="color:yellow ; text-decoration: underline; font-weight: 900;"> <?php echo $order->total; ?> EGP</span>.
                    </p>

                    <div class="card card-login mb-5">
                    <div class="card-body">
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script
            src="https://www.paypal.com/sdk/js?client-id={{Client ID}}&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
            data-sdk-integration-source="developer-studio"
        ></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                    <script>
                        paypal.Buttons({
                        // Sets up the transaction when a payment button is clicked
                        createOrder: (data, actions) => {
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                                value: '<?php echo $order->total; ?>' // Can also reference a variable or function
                                }
                            }]
                            });
                        },
                        // Finalize the transaction after payer approval
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                                //change payment status to Paid
                                $.ajax({
                                type: "POST",
                                url: "update_status.php",
                                data: {
                                
                                },
        
}   )
     
                             window.location.href='success.php';
                            });
                        }
                        }).render('#paypal-button-container');
                    </script>
                  
              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
          
       
  
        <?php
        require("../includes/footer.php");
    
    ?>