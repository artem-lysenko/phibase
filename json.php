<?php
ob_start();
session_start();
//uncomment if you want to download file!
header('Content-type: text/javascript');

echo $_SESSION['json_string'];
?>
