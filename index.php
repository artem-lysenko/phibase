<?php ob_start(); session_start(); header('Cache-Control: max-age=900'); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Welcome to PHI-base RDF</title>
	<meta http-equiv="charset=utf-8">

	
	<link rel="STYLESHEET" href="style.css" type="text/css">
	<!-- next line is for mobile device optimisation -->
	<!-- <meta name="viewport" content="width-device-width, initial-scale=1.0"> -->		
</head>

<body class="body">
 <?php 
     //PHP code to read endpoint address from textfile
     //endpoint address must be the first line (code only reads the first line)
     $file="endpoint.txt"; $var=fopen($file,"r"); $endpoint=fgets($var); fclose($var); 
   ?> 
<header class="mainHeader">
	<img src="imgs/logo-1.png">
	<nav>
	<ul>
		<li class="active"><a href="index.php">Search</a></li>
		<li><a href="#">About</a></li>
		<li><a href="#">Release notes</a></li>
		<li><a href="#">Download</a></li>
		<li><a href="#">Disclaimer</a></li>
		<li><a href="#">Errors & contributions</a></li>
		<li><a href="#">Help</a></li>
		<li><a href="#">Consortium</a></li>
		
		 	 	 	 	 	 	 		
		
		
	</ul>
	</nav>
</header>

<div class="mainContent">
	<div class="content">
		<article class="topContent">
		<header><h2>Query PHI-base RDF</h2></header>
		<footer class="post-info">Enter you SPARQL query or click on a sidebar</footer>
		   <content>		   					
		   
		   <form action="index.php" method="post"> 

			<div>
			   <label>
			    <h3>SPARQL Endpoint</h3><input id="endpointname" type="text" value="<?php  echo $endpoint; ?>" name="endpoint"/>
			   </label>
				
			   <label>
			      <h3>SPARQL Query</h3>
			      <textarea id="sparql" name="sparql">  </textarea>
			   </label>
			   
			   <label>			   					
				<div>
				Output:
				<SELECT name="output">
				<option value="HTML">HTML</option>
				<option value="JSON">JSON</option>
				<option value="CSV">CSV</option>
				<option value="TSV">TSV</option>
				<option value="XML">XML</option>				
				</SELECT>
				</div>  
			   </label>
		
			   <input type="submit" value="Execute!" />		
			</div>						
                 </form> 
      
      
		   </content>
		</article>
		
		<article class="bottomContent">		
		   <content>		   					
		   
		   <?php
			    $endpoint = $_POST['endpoint'];
			    $sparql = $_POST['sparql'];
			    $output = $_POST['output'];
			    			    
			    if ($endpoint != '' && $sparql != '') {        
					require_once( "includes/sparqllib.php" );
					include_once 'includes/HTMLTable2JSON.php';
					//include_once 'includes/html2xml-09b.php';
	
				$data = sparql_get($endpoint,$sparql);
				if( !isset($data) )
				{
					print "<p>Error: ".sparql_errno().": ".sparql_error()."</p>";
				}
				
				if($output == 'HTML'){ 
					print "<table>";
					print "<tr>";
					foreach( $data->fields() as $field )
					{
						print "<th  BGCOLOR=\"#a0a61b\" align=\"center\"> <FONT COLOR=\"#FFF\"> $field</FONT></th>";
					}
					print "</tr>";
					$i = 1;
					foreach( $data as $row )
					{
						if ($i % 2 != 0) # An odd row
						    $rowColor = "#fdffcb";
						else # An even row
						    $rowColor = "#dee197"; 
						$i++;
						print "<tr bgcolor=\"$rowColor\">";
						//bgcolor="' . $rowColor
						foreach( $data->fields() as $field )
						{
							print "<td>$row[$field]</td>";
						}
						print "</tr>";
					}
					print "</table>";
				} else if($output == 'JSON'){ // output JSON
				
					$html = ""; 
					$html .= "<table>";
					$html .= "<tr>";
					foreach( $data->fields() as $field )
					{
						$html .= "<th> $field </th>";
					}
					$html .= "</tr>";
				
					foreach( $data as $row )
					{
					
						$html .= "<tr>";
						//bgcolor="' . $rowColor
						foreach( $data->fields() as $field )
						{
							$html .= "<td>$row[$field]</td>";
						}
						$html .= "</tr>";
					}
					$html .= "</table>";
				
					//include_once 'HTMLTable2JSON.php';
					//$helper = new HTMLTable2JSON();
					
					$helper = new HTMLTable2JSON();
					$json = $helper->tableToJSON('', false, null, null, null, null, null, true, null, null, $html);

					echo $json;  
				  
				  } else if($output == 'CSV'){ // output JSON
				
						$csv = ""; 
						$total = count( $data->fields() );
						$i=0;
						foreach( $data->fields() as $field )
						{
							$i++;
							$csv .= "$field" ;
							if ($i != $total) $csv .= ",";
						}
						//$csv = implode(",", $csv);
						
						foreach( $data as $row )
						{
							$i=0;
							$csv .= "<BR />";
							//bgcolor="' . $rowColor
							foreach( $data->fields() as $field )
							{
								$i++;
								$csv .= "$row[$field]";
								if ($i != $total) $csv .= ",";
							}
							//$html .= "</tr>";
						}																	
						 
						$_SESSION['csv_string'] = $csv ;
						header( 'Location: csv.php' );
						//echo $csv;  
				  	 }
				  	 else if($output == 'TSV'){ // output JSON
				
						$tsv = ""; 
						$total = count( $data->fields() );
						$i=0;
						foreach( $data->fields() as $field )
						{
							$i++;
							$tsv .= "$field" ;
							if ($i != $total) $tsv .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";					
						}
						//$csv .= "\n";
						//$tsv = implode(",", $tsv);
						foreach( $data as $row )
						{
							$i=0;
							$tsv .= "<BR />";
							//bgcolor="' . $rowColor
							foreach( $data->fields() as $field )
							{
								$i++;
								$tsv .= "$row[$field]";
								if ($i != $total) $tsv .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
							}
							//$html .= "</tr>";
						}						
						$_SESSION['tsv_string'] = $tsv ;
						header( 'Location: tsv.php' );
						//echo $tsv;  
				  	 } else if($output == 'XML'){						  							  
							  	
							  	$xml = "";
								$xml .= "<?xml version=\"1.0\"?>"; 
								$xml .= "<sparql>";
								$xml .= "<head>";
								foreach( $data->fields() as $field )
								{
									$xml .= "<variable name=\"$field\"/>";
								}
								$xml .= "</head>";
								$xml .= "<results>";
								foreach( $data as $row )
								{
					
									$xml .= "<result>";
									//bgcolor="' . $rowColor
									foreach( $data->fields() as $field )
									{
										$xml .= "<binding name=\"$field\">";
										$xml .= "<".$row["$field.type"].">"."$row[$field]"."</".$row["$field.type"].">";
										$xml .= "</binding>";
									}
									$xml .= "</result>";
								}
								$xml .= "</results>";
								$xml .= "</sparql>";															

								//session_start();
								$_SESSION['xml_string'] = $xml ;
								 header( 'Location: xml.php' );
								//echo $xml_string;  							

	  	   				}
			    } 
			    
			    
			    //else {
				//echo '<p>You need to fill in all required fields!!</p>';
			     //}
			  
		?>
		   </content>
		</article>
			
	</div>
</div>

<div  class="top-sidebar">
		<article>
				
			<ul class="a">
			<li>
			<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		        <script>
			  function saaa() {
			    var area = document.getElementById("sparql");
			    area.value = "SELECT * WHERE {?A ?B ?C} LIMIT 20";
			    document.getElementById("endpointname").value = "http://dbpedia.org/sparql";
			    }
			</script>
			<a onClick="saaa();" style="cursor: pointer; cursor: hand;">DBPedia Test</a>
			</li>
			
			  <li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script>
			  function aaa() {
			  
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\nPREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\nPREFIX pho: <http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#>\nPREFIX pcore: <http://purl.uniprot.org/core/>\nPREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\nSELECT ?interaction ?org ?same ?roleType ?org_sci_name WHERE {\n ?interaction a pho:interaction .\n ?interaction pho:has_participant ?org .\n ?org a pho:organism .\n ?org pho:has_role [\n\t a ?roleType ;\n\t pho:participant_of ?interaction;\n\t rdfs:label ?roleLabe \n ] .\n ?org owl:sameAs ?same .\n ?same a pcore:Taxon .\n ?same pcore:scientificName ?org_sci_name .\n ?same pcore:commonName ?name .\n}";
			
			

			    }
			</script>
			<a onClick="aaa();" style="cursor: pointer; cursor: hand;">Display interaction with organisms and theirs role in that (display organisms scientific and common names in different columns)</a>
			</li>
			  
			  
			  <li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>		   					
		   <script>
			  function xaa() {
			  
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl:
			<http://www.w3.org/2002/07/owl#>\nPREFIX rdf:
			<http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX
			rdfs:
			<http://www.w3.org/2000/01/rdf-schema#>\nPREFIX
			pho:
			<http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#>\nPREFIX
			pcore: <http://purl.uniprot.org/core/>\nPREFIX
			xsd:
			<http://www.w3.org/2001/XMLSchema#>\n\nSELECT
			?protein WHERE { ?protein a pho:protein }";
			
			   }
			</script>
			<a onClick="xaa();" style="cursor: pointer; cursor: hand;">Display proteins in the pathogen Fusarium graminearum that have lethal phenotype when the host is wheat. What Gene Ontology Biological Processes do they have, what KEGG pathways do they map to, and what Pfam domains do they have in common?</a>
			</li>
			  
			  
			  <li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>  					
			<script>
			  function a() {
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\n PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\n PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\n PREFIX pho: <http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#>\n PREFIX pcore: <http://purl.uniprot.org/core/>\n PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\n SELECT ?interaction ?org ?roleType ?roleLabel WHERE {\n ?interaction a pho:interaction .\n ?interaction pho:has_participant ?org .\n ?org a pho:organism .\n ?org pho:has_role [\n\t a ?roleType ; \n\t pho:participant_of ?interaction ; \n\t rdfs:label ?roleLabel \n ] \n}";
			

			    }
			</script>
			<a onClick="a();" style="cursor: pointer; cursor: hand;">Display interaction with organisms and theirs role in that</a>
			</li>
			</ul>
   					
			

		</article>	
</div>

<div  class="middle-sidebar">
		<article>
		xx
			
		</article>	
</div>

<!--
<div  class="bottom-sidebar">
		<article>
		        xx		 			
		</article>	
</div>	
-->	

<footer class="mainFooter">
     <p>PHI-base is a National Capability funded by Biotechnology and Biological Sciences Research Council (BBSRC, UK) and is being developed and maintained by scientists at Rothamsted Research.</p>
</footer>
	
</body>


</html>
