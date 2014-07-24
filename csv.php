<?php
ob_start();
session_start();

if (isset($_SESSION['csv_string']) && !empty($_SESSION['csv_string'])) {
   //uncomment if you want to download file!
   //header('Content-type: text/csv');
   echo $_SESSION['csv_string'];
} else
     header( 'Location: index.php' ) ;
?>
