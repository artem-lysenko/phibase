<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" media="screen" href="style.css"/>
<title>SPARQL Query Form</title>

</head>
   <body> 
   <?php 
     //PHP code to read endpoint address from textfile
     //endpoint address must be the first line (code only reads the first line)
     $file="endpoint.txt"; $var=fopen($file,"r"); $endpoint=fgets($var); fclose($var); 
   ?> 
      <form action="q.php" method="post"> 

	<div>
 	  <h1>SPARQL Query Form :</h1>
	   <label>
	    <span>SPARQL Endpoint</span><input id="name" type="text" value="<?php  echo $endpoint; ?>" name="endpoint"/>
	   </label>
				
	   <label>
	    <span>SPARQL Query</span>
	    <textarea id="feedback" name="sparql">  </textarea>
	   </label>
		
	   <input type="submit" value="Execute!" />
		
	</div>

      </form> 
   </body> 
</html> 
       
 
 
