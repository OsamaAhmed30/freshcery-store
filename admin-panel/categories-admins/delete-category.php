<?php 
  require_once("../admin-includes/header.php");
  if (!isset($_SERVER['HTTP_REFERER'])) {
    echo "<script> window.location.href='http://localhost/Freshcery'</script>";
      exit;
    

  }
        if(isset($_POST['delete'])){
            if (isset($_POST['id'])) {
                $id = $_POST['id'];   
                $getCategory = $conn->query("SELECT image FROM categories WHERE id = '$id'");
                $getCategory->execute();
                $category= $getCategory->fetch(PDO::FETCH_OBJ);
                unlink($_SERVER['DOCUMENT_ROOT'] ."/Freshcery/assets/img/".$category->image);
             $conn->exec("DELETE FROM categories WHERE id='$id'");
            }
        }
    




?>
   
  

