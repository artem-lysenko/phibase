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
	    <textarea id="sparql" name="sparql">  </textarea>
	   </label>
		
	   <input type="submit" value="Execute!" />		
	</div>
	
	<div>
	    <h1>Display interaction with organisms and theirs role in that</h1>
	    
	 </div>
	 
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	  $("h1").click(function() {
	    $('#sparql').html("prefix owl: <http://www.w3.org/2002/07/owl#> prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> prefix pho: <http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#> prefix pcore: <http://purl.uniprot.org/core/> prefix xsd: <http://www.w3.org/2001/XMLSchema#> select ?interaction ?org ?roleType ?roleLabel where { ?interaction a pho:interaction . ?interaction pho:has_participant ?org . ?org a pho:organism . ?org pho:has_role [ a ?roleType ;   pho:pho:participant_of ?interaction ;   rdfs:label ?roleLabel ] } ");   }); });
	</script>
	
	

      </form> 
   </body> 
</html> 
       
 
 
