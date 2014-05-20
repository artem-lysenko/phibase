<?php
ob_start();
session_start();
//uncomment if you want to download file!
//header('Content-type: text/csv');

echo $_SESSION['csv_string'];
?>
