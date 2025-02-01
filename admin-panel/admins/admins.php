<?php 
  require_once("../admin-includes/header.php");
  require_once("../admin-includes/checkLogin.php");

  $getAdmins = $conn->query("SELECT * FROM admins");
  $getAdmins->execute();
  $admins = $getAdmins->fetchAll(PDO::FETCH_OBJ);
?>
    <div class="container-fluid">
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
             <div class="d-flex justify-content-between">
             <h5 class="card-title mb-4">Admins</h5>
             <a  href="<?php echo APPURL?>/admins/create.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
             </div>
              <table class="table text-center w-100 ">
                <thead>
                  <tr>
                    <th >#</th>
                    <th>image</th>
                    <th>username</th>
                    <th >email</th>
                    <th>fullname</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($admins as $admin):?>
                    <tr>
                    <td class="align-middle"><?php echo $admin->id?></td>
                    <td class="w-auto"><img class="avatar-header" src="<?php echo ROOTURL."/assets/img/user/". $admin->image?>"/></td>
                    <td class="align-middle"><?php echo $admin->username?></td>
                    <td class="align-middle"><?php echo $admin->email?></td>
                    <td class="align-middle"><?php echo $admin->fullname?></td>
                    <td class="align-middle">

                    <a href="./update.php?id=<?php echo $admin->id ?>"  class="btn btn-primary text-light mr-1">Update</a>
                    <?php if($admin->id !=$_SESSION['admin_id']):?>                   <button value="<?php echo $admin->id?>" class="btn btn-delete btn-danger ml-1">Delete </button></td>
                    <?php endif?>
                    </tr>

                  <?php endforeach ?>
                 
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

      <?php require_once("../admin-includes/footer.php"); ?>
<script>

$(".btn-delete").on('click', function(e) {                        
                        var id = $(this).val();
                        var this_e = $(this)
                        console.log(id);
                        console.log(this_e);
                        
                      $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: {
                          delete: "delete",
                          id: id,

                        },

                        success: function() {                            
                            $(this_e).parent().parent().remove();
                                
                        }
                      })                    
               
      });
</script>