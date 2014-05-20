<?php
ob_start();
session_start();
header ("Content-type: text/xml");

echo $_SESSION['xml_string'];
?>
