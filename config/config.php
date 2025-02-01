<?php

    if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
      echo "<script> window.location.href='http://localhost/Freshcery'</script>";
        exit;
      

    }
  
 

//host
define("HOST","localhost");
//database name 
define("DBNAME","freshcery");
//username
define("USER","root");
//password
define("PASS","");



try {
    $conn = new PDO("mysql:host=". HOST.";dbname=".DBNAME,USER, PASS);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die($e->getMessage());
  }

