<?php
ob_start();
session_start();

if (isset($_SESSION['html_string']) && !empty($_SESSION['html_string'])) {
   //uncomment if you want to download file!
   header ("Content-type: text/html");
   echo $_SESSION['html_string'];
} else
     header( 'Location: index.php' ) ;
     

?>
