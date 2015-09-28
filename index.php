<?php ob_start(); session_start(); header('Cache-Control: max-age=900'); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome to PHI-base</title>
<link rel="STYLESHEET" href="tc.css" type="text/css">

</head>
<body>

  

 <div id="maincontainer">
    <header class="mainHeader">
	<img src="imgs/topimage3.png">
	<nav>
	 <ul>
	   <li class="active"><a href="index.php">Search</a></li>	
	   <li ><a href="composer.php">SPARQL Composer</a></li>
	

	 </ul>
	</nav>
   </header>
     <!--   
     <div id="topsection">
        <div class="innertube"><h1>CSS Fixed Layout #2.2- (Fixed-Fixed)</h1>
        </div>
     </div>
     -->

   <div id="contentwrapper">
      <div id="contentcolumn">
         <div class="innertube"><!--<b>Content Column: <em>Fixed</em></b>-->
           <form action="index.php" method="post"> 
		<fieldset id="fieldset1">
                  <legend>
                    <b>Please enter a SPARQL Query or click on one of the Sample Queries</b>
                  </legend>
			<div>
			   <!--
			   <label>
			    <h3>SPARQL Endpoint</h3><input id="endpointname" type="text" value="<?php  echo $endpoint; ?>" name="endpoint"/>
			   </label>
			   -->	
			   <label>
			      <!--<h3>SPARQL Query</h3>-->	
			      <textarea id="sparql" name="sparql">SELECT * WHERE {?S ?P ?O} LIMIT 50</textarea>
			   </label>
			   
			   <label>			   					
				<div>
				Output:
				<SELECT name="output">
				<option value="HTML">HTML</option>
				<option value=“HTMLX”>HTMLX</option>
				<option value="JSON">JSON</option>
				<option value="CSV">CSV</option>
				<option value="TSV">TSV</option>
				<option value="XML">XML</option>				
				</SELECT>
				</div>  
			   </label>
		
			   <input type="submit" value="Execute!" />		
			</div>						
		</fieldset>
         </form>   
         
         <?php
			    $endpoint = 'http://oip.rothamsted.ac.uk/sparql/query';//$_POST['endpoint'];
			    $sparql = $_POST['sparql'];
			    $output = $_POST['output'];
			    			    
			    if ($endpoint != '' && $sparql != '') {        
					require_once( "includes/sparqllib.php" );					
					include_once 'includes/xml2array.php';
	
				$data = sparql_get($endpoint,$sparql);
				if( isset($data) )
				{
				//echo $endpoint."\n";
			        //echo $sparql."\n";
					//print "<p>Error: ".sparql_errno().": ".sparql_error()."</p>";
				//}
				
				if($output == 'HTML'){ 
					$html = ""; 
					$html .= "<table>";
					$html .= "<tr>";
					foreach( $data->fields() as $field )
					{
						$html.= "<th  BGCOLOR=\"#a0a61b\" align=\"center\"> <FONT COLOR=\"#FFF\"> $field</FONT></th>";
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
						$html.= "<tr bgcolor=\"$rowColor\">";
						//bgcolor="' . $rowColor
						foreach( $data->fields() as $field )
						{
							$html.= "<td>$row[$field]</td>";
						}
						$html.= "</tr>";
					}
					$html.= "</table>";
					$_SESSION['html_string'] = $html ;
					header( 'Location: html.php' );
				} else 
 										
                                        if( $output == “HTMLX” ){ 
					$htmlx = "<center>"; 
					$htmlx .= "<table border=\"0\">";

					foreach( $data as $row )
					{												
						foreach( $data->fields() as $field )
						{       $htmlx .= "<tr>";
							$htmlx .= "<td BGCOLOR=\"#a0a61b\" align=\"center\"> <FONT COLOR=\"#FFF\">$field: </FONT></td>";
							$htmlx .= "<td BGCOLOR=\"#dee197\">$row[$field]</td>";
							$htmlx.= "</tr>";
						}
						$htmlx .= "<tr>";
						$htmlx .= "<td></td><td></td>";
						$htmlx.= "</tr>";
					}
					$htmlx.= "</table></center>";
					$_SESSION['html_string'] = $htmlx ;
					header( 'Location: html1.php' );
				}
				
				else 
				if($output == 'JSON'){ // output JSON					
					$xml = "";
							$xml .= "<?xml version='1.0' ?>"; 
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
					$arrayData = xmlToArray(simplexml_load_string($xml));
					
					$json_string = json_encode($arrayData, JSON_PRETTY_PRINT);
					$_SESSION['json_string'] = $json_string ;
					header( 'Location: json.php' );
					echo $json_string;					
				  
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
	  	   		} // if( isset($data) )
	  	   		else {
				  echo '<p><font color="red">Please make sure you provide correct SPARQL Endpoint and Query!</font></p>';
				  echo $endpoint." ".$sparql;
			        }
			    } // end if ($endpoint != '' && $sparql != '')
			    
			    
			    
			  
		?>
		    	
         </div>
      </div>
    </div>

    <div id="rightcolumn">
        <div class="innertube">
          <h2>Sample Queries</h2> <ul class="a">
                       <!--
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
			-->
			
			<li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>  					
			  <script>
			  function a2() {
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\nPREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\nPREFIX pho: <http://oip.rothamsted.ac.uk/ontology/>\nPREFIX pcore: <http://purl.uniprot.org/core/>\nPREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\nSELECT ?interaction ?pathogen ?pathogen_name ?protein ?output ?output_name ?host_name WHERE {\n ?interaction a pho:interaction .\n ?interaction pho:has_pathogen ?pathogen .\n ?pathogen rdfs:label ?pathogen_name .\n FILTER regex(?pathogen_name,\"Gibberella zeae\") .\n ?interaction pho:has_host ?host .\n ?host rdfs:label ?host_name .\n FILTER regex(?host_name,\"wheat\",\"i\") .\n ?interaction pho:has_protein ?protein .\n ?interaction pho:has_output ?output . \n ?output rdfs:label ?output_name .\n}";			
			    }
			</script>
			<a onClick="a2();" style="cursor: pointer; cursor: hand;">Display proteins in the pathogen <i>Gibberella zeae</i> when the host is wheat.</a>
			</li>
				
			<li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>  					
			  <script>
			  function a1() {
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\nPREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\nPREFIX pho: <http://oip.rothamsted.ac.uk/ontology/>\nPREFIX pcore: <http://purl.uniprot.org/core/>\nPREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\nSELECT ?interaction ?pathogen ?pathogen_name ?host ?host_name WHERE {\n ?interaction a pho:interaction .\n ?interaction pho:has_pathogen ?pathogen .\n ?interaction pho:has_host ?host .\n ?host rdfs:label ?host_name .\n ?pathogen rdfs:label ?pathogen_name\n}";			
			    }
			</script>
			<a onClick="a1();" style="cursor: pointer; cursor: hand;">Display interaction with organisms and their role in that (display organisms scientific and common names in different columns)</a>
			</li>
						  
			  <li>
			  <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>  					
			  <script>
			  function a() {
			  var area = document.getElementById("sparql");
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\nPREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\nPREFIX pho: <http://oip.rothamsted.ac.uk/ontology/>\nPREFIX pcore: <http://purl.uniprot.org/core/>\nPREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\nSELECT ?uniprot ?seeAlso ?comment WHERE {\n ?interaction a pho:interaction .\n ?interaction pho:has_output ?phenotype .\n ?interaction pho:has_host <http://oip.rothmasted.ac.uk/resources/organism/4530> .\n <http://oip.rothmasted.ac.uk/resources/organism/4530> rdfs:label ?hlabel .\n ?phenotype rdfs:label ?phlabel .\n ?interaction pho:has_protein ?protein .\n filter regex(?phlabel, \"loss*\") .\n ?protein owl:sameAs ?uniprot .\n service <http://beta.sparql.uniprot.org/sparql/> {\n   ?uniprot rdfs:seeAlso ?seeAlso .\n   filter regex(str(?seeAlso), \"/Pfam\", \"i\") .\n   ?seeAlso rdfs:comment ?comment .\n }\n}";
			

			    }
			</script>
			<a onClick="a();" style="cursor: pointer; cursor: hand;">Display Pfam domains of proteins involved in the interaction with host rice and phenotype loss of pathogenicity</a>
			</li>
			</ul>
        </div>
    </div>

    <div id="footer"><p>PHI-base is a National Capability funded by Biotechnology and Biological Sciences Research Council (BBSRC, UK) and is being developed and maintained by scientists at Rothamsted Research.</p></div>

 </div><!-- close main container -->

</body>
</html>

