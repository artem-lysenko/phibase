<?php
ob_start();
session_start();
if (isset($_SESSION['json_string']) && !empty($_SESSION['json_string'])) {
    //uncomment if you want to download file!
   header('Content-type: text/javascript');
   echo $_SESSION['json_string'];
} else
     header( 'Location: index.php' ) ;
?>
