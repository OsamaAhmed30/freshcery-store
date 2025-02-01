<?php 
        define("APPURL","http://localhost/Freshcery/admin-panel");
        session_start();
        session_unset();
        session_destroy();
        echo "<script> window.location.href='".APPURL."/admins/login.php'</script>";
  

?>