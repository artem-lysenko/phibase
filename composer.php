<?php ob_start(); session_start(); header('Cache-Control: max-age=900'); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Welcome to PHI-base</title>
	<meta http-equiv="charset=utf-8">
	
	<link rel="STYLESHEET" href="style.css" type="text/css">
	
	<!--<link rel="STYLESHEET" href="s.css" type="text/css">-->
	<!-- next line is for mobile device optimisation -->
	<meta name="viewport" content="width=550, initial-scale=1, maximum-scale=1">
		
</head>

<body class="body">
<script type="text/javascript">


	    function clearMultiple(list)
	    {
	      for(i=0;i<list.length;i++) {
	      
		list[i].selected=false;
		
	      }
	    }

	    function deactivateMultiple(list)
	    {
	      clearMultiple(list.options)
	      list.disabled=true;
	    }

	    function clearAll()
	    {
	    
	      thisform = document.getElementById("search");

	      //chosen    
	      thisform.cdi.value='all';
	      thisform.cge.value='all';
	      thisform.cho.value='all';
	      thisform.cpa.value='all';
	      thisform.cch.value='all';
	      
	      //choicelist
	      thisform.cldi[0].checked=true;
	      thisform.clpa[0].checked=true;
	      thisform.clho[0].checked=true;
	      thisform.clph[0].checked=true;
	      thisform.clch[0].checked=true;
	      
	      //choice
	      thisform.chphl[0].checked=true;
	      thisform.chchl[0].checked=true;
	      thisform.chlev[0].checked=true;
	      thisform.chevl[0].checked=true;
	      deactivateMultiple(document.getElementById("cph"));
	      deactivateMultiple(document.getElementById("cev"));
	      deactivateMultiple(document.getElementById("cch"));
	    
	    }



	function getsupport (ch )
	{
	  thisform = document.getElementById("search");
	  thisform.hchem.value='yes';
	  thisform.chemacc.value=ch;
	  //name='chem_".$allChems[$c]['chemical_id']."'
	  //document.supportform.supporttype.value = selectedtype ;
	  thisform.submit() ;
	}

	function getphi (ph )
	{
		thisform = document.getElementById("search");

		thisform.detail.value='yes';
		thisform.phi_acc.value=ph;//  
		thisform.hchem.value='';
		thisform.name="sent_"+ph;
		thisform.submit() ;
	}
	
	</script>
	
<header class="mainHeader">
	<img src="imgs/topimage3.png">
	<nav><ul>
	<li><a href="index.php">Search</a></li>	
	<li class="active"><a href="composer.php">SPARQL Composer</a></li>
	<li><a href="#">SPARQL Composer 2</a></li>
	<li><a href="#">Project Overview</a></li>
	<li><a href="#">Meet the Team</a></li>
	<li><a href="#">Contact us</a></li>

	</ul></nav>
</header>

<div class="mainContent">
	<div class="content">
		<article class="topContent">

		   <content>			   

           <form action="composer.php" method="post" target="_self" id="search"> 
		   <input type="hidden" name="check_submit" value="1" />
			
		   <small>
		 <fieldset id="fieldset1">
                  <legend>
                    <b class='search'>
                      Quick Search</b>
                  </legend>
                  <table  width="100%" border="0"  cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="30%">
                        &nbsp;Search                                                
                          <select name="chdb" class="resizedSelect"> 
<option selected value='all'>all</option><option value='gene_name'>Gene name</option><option value='host'>Host</option><option value='pubmed'>PubMed ID</option><option value='phibase'>PHI-base Acc</option>                          </select> for                                                                          
                         </td>
                         <td width="35%">
                         <input type="text" placeholder="e.g. ACE*, Candida a* or PHI:441" id="ft" name='ft' class="resizedTextbox"  value=''  onKeyPress='this.form.quick.value="yes";' />
                        </td>
                         <td width="35%">
                        &nbsp;order by                      <select name="chor">            <option value='phi_base_acc'>PHI-base accession</option><option selected value='gene_name'>Gene name</option><option value='embl_value_disp'>embl_value_disp</option><option value='ph_value_disp'>Phenotype of mutant</option><option value='patho_name'>Pathogen species</option><option value='dis_name'>Disease name</option><option value='host_name'>Experimental host</option>                        </select>
                        
                        <!-- internal use only! -->
                        <!--this.form.term.focus();"> -->
                        
                        </td>
                      </tr>
                      
                      <tr> 
                         <td>
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
			 </td>
                        <td></td>
                        <td></td>
                        
                      </tr>
                      <tr>
                     <td>
                      <input type="submit" value="Go" name="sntf" onClick="this.form.phi_acc.value='';this.form.detail.value='';this.form.hchem.value='';this.form.quick.value='yes';" />
                      </td>
                      <td>
                       <input name="Clear" type="button" value="Clear" onClick="this.form.chdb.value='all';this.form.chor.value='gene_name';this.form.ft.value='';this.form.quick.value='';"/>
                        
                      </td>
                    </tr>
                  </table>
                </fieldset>
                
                
                </small>
                				
                 </form>  
      

		  
	   					
		   
		   
		   </content>
		   <?php
			   
			    $endpoint = 'http://oip.rothamsted.ac.uk/sparql/query';//$_POST['endpoint'];
			    //$sparql = $_POST['sparql'];
			    $output = $_POST['output'];
			    
			      //Check whether the form has been submitted
	                  $chdb = $_POST['chdb'];
	                  
                           $ft = $_POST['ft']; //the text field!
                          
	                  $chor = $_POST['chor'];//order by!
	                  
	                  $check_submit = $_POST['check_submit'];
			    		    
			    if ($chdb != '' && $ft != '' && $chor != '' ) {        
					require_once( "includes/sparqllib.php" );					
					include_once 'includes/xml2array.php';
				 //if($check_submit == 1){
                                   //echo "chdb: $chdb <br />";
                                   //echo "ft: $ft <br />";
	                           //echo "chor: $chor <br />";
	                           $sparql_prefixes = 
	                           "prefix : <http://oip.rothamsted.ac.uk/ontology/> prefix xsd: <http://www.w3.org/2001/XMLSchema#>  prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> prefix apf: <http://jena.hpl.hp.com/ARQ/property#> prefix text: <http://jena.apache.org/text#> ";
			            //echo "$sparql_prefixes <br />";
				    $relation = "";
			            switch ($chdb):
				     case "all":
					$relation = "all";
					break;
				     case "gene_name":
					$relation = "gene";
					break;					
				     case "host":
					$relation = "host";
					break;
				     case "pubmedID":					
					$relation = "pubmedID";
					break;
				     case "pubmedAcc":					
					$relation = "pubmedAcc";
					break;				     
				     endswitch;

			         // } // end if($check_submit == 1){
	   			       $sparql = "
					            select distinct ?item ?label where { 
					            ?item a :$relation .
					            ?item text:query ?$ft .
					            ?item rdfs:label ?label .
					            } 
					            order by ?$chor
					            ";
					
					
	                       $ssparql =  $sparql_prefixes.$sparql;
	                       print "$ssparql <br />";
				$data = sparql_get($endpoint,$ssparql);
				if( isset($data) )
				{
				//echo $endpoint."\n";
			        //echo $sparql."\n";
					//print "<p>Error: ".sparql_errno().": ".sparql_error()."</p>";
				//}
				
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
		</article>	
	</div>
</div>

<aside class="top-sidebar">
<article><h2>Sample Queries</h2> <ul class="a">
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
			area.value = "PREFIX owl: <http://www.w3.org/2002/07/owl#>\nPREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>\nPREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>\nPREFIX pho: <http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#>\nPREFIX pcore: <http://purl.uniprot.org/core/>\nPREFIX xsd: <http://www.w3.org/2001/XMLSchema#>\n\nSELECT ?protein WHERE { ?protein pho:protein }";
			
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
</article">
</aside>



<footer class="mainFooter"><p>PHI-base is a National Capability funded by Biotechnology and Biological Sciences Research Council (BBSRC, UK) and is being developed and maintained by scientists at Rothamsted Research.</p></footer>
	
</body>


</html>
