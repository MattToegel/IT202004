<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getDB(){
  global $db;
  if(!isset($db)){
    require (__DIR__."/account.php") ; 
    $db = mysqli_connect($hostname,$username,$password, $project );
    if (mysqli_connect_errno()){      
       // echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
   // print "You have successfully connected to MySQL database.<br>";
    mysqli_select_db( $db, $project );
  }
  return $db;
}
$db = getDB();//This is valid
?>
