<?php
ob_start();
session_start();

if (isset($_SESSION['tsv_string']) && !empty($_SESSION['tsv_string'])) {
   //uncomment if you want to download file!
   //header('Content-type: text/csv');
   echo $_SESSION['tsv_string'];
} else
     header( 'Location: index.php' ) ;
?>
