<?php
ob_start();
session_start();

if (isset($_SESSION['xml_string']) && !empty($_SESSION['xml_string'])) {
   //uncomment if you want to download file!
   header ("Content-type: text/xml");
   echo $_SESSION['xml_string'];
} else
     header( 'Location: index.php' ) ;
     

?>
