<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  if ($_GET['id']) {
    $order_id = $_GET['id'];

    $getOrder = $conn->query("SELECT * FROM orders WHERE id = $order_id");
    $getOrder->execute();
    $order = $getOrder->fetch(PDO::FETCH_OBJ);

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      echo $order->status;
   
        if (isset($_POST['submit']))
        {
            if (empty($_POST['status']))
            {
                echo "<script> alert('Some Fields are empty')";
            }
            else{
           
              $status=test_input($_POST['status']);
              
            
            $update = $conn->prepare("Update orders SET status=? WHERE id = $order_id");
            $update->execute([
               $status
            ]);
           echo "<script>window.location.href='show-orders.php'</script>";
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
              <h5 class="card-title ">Update Order</h5>
              <h6 class="card-title mb-5 ">Order Number : <?php echo $order->id ?></h6>
              <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select Category</label>
                    <select name="status" class="form-control" id="exampleFormControlSelect1">
                      <option>--select Status--</option>
                      <option value="Canceled" <?php echo $order->status == 'Canceled'?'selected': '' ?>  >Canceled</option> 
                      <option value="Prepared" <?php echo $order->status == 'Prepared'?'selected': '' ?>  >Prepared</option> 
                      <option value="Finished" <?php echo $order->status == 'Finished'?'selected': '' ?>  >Finished</option> 
                      <option value="delivered" <?php echo $order->status == 'delivered'?'selected': '' ?>  >delivered</option> 
                    </select>
                </div>
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Update</button>
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require_once("../admin-includes/footer.php"); ?>
