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
	

	</ul></nav>
</header>

<div class="mainContent">
	<div class="content">
		<article class="topContent">

		   <content>			   

           <form action="composer.php" method="post" target="_self" id="search"> 
		   <input type="hidden" name="quick_search" value="1" />
		   <input type="hidden" name="advanced_search" value="0">
			
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
                          <select name="qs_search_for" class="resizedSelect"> 
                             <option selected value='all'>all</option>
                             <option value='gene_name'>Gene name</option>
                             <option value='host'>Host</option>
                             <option value='pubmedID'>PubMed ID</option>           
                           </select> 
                         for
                         </td>
                         <td width="35%">
                         <input type="text" placeholder="e.g. ACE*, Candida a* or PHI:441" id="ft" name='qs_search_text' class="resizedTextbox"  value=''  onKeyPress='this.form.quick.value="yes";' />
                        </td>
                         <td width="35%">
                        &nbsp;order by                      <select name="qs_order_by">            <option value='phi_base_acc'>PHI-base accession</option><option selected value='gene_name'>Gene name</option><option value='embl_value_disp'>embl_value_disp</option><option value='ph_value_disp'>Phenotype of mutant</option><option value='patho_name'>Pathogen species</option><option value='dis_name'>Disease name</option><option value='host_name'>Experimental host</option>                        </select>
                        
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
                       <input name="Clear" type="button" value="Clear" onClick="this.form.qs_search_for.value='all';this.form.qs_order_by.value='gene_name';this.form.qs_search_text.value='';this.form.quick.value='';"/>
                        
                      </td>
                    </tr>
                  </table>
                </fieldset>
                
                
                </small>
                				
                 </form>  
      

		  
	   					
		   
		   
		   </content>
		   
		</article>	
		
		<article class="topContent">

		   <content>			   

           <form action="composer.php" method="post" target="_self" id="search"> 
		   <input type="hidden" name="quick_search" value="0" />
		   <input type="hidden" name="advanced_search" value="1">
			
		   <small>
		 <fieldset id="fieldset1">
                  <legend>
                    <b class='search'>
                      Advanced Search</b>
                  </legend>
                  <table  width="100%" border="0"  cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="20%">
                                                                                                                               
                      </td>
                      <td width="15%">
                          &nbsp;Search Gene:                                                                                                      
                      </td>
                      <td width="65%">
                          
                        <select name="adv_gene_name" class="resizedSelect"> 
                          <option selected value='all'>all</option>
			  <option value='1-phosphatidylinositol-4,5-bisphosphate phosphodiesterase delta 1'>1-phosphatidylinositol-4,5-bisphosphate phosphodiesterase delta 1</option>
			  <option value='3hnr'>3hnr</option>
			  <option value='7,8-LDS'>7,8-LDS</option>
			  <option value='AaFUS3'>AaFUS3</option>
			  <option value='AaGa1'>AaGa1</option>
			  <option value='AaNoxA'>AaNoxA</option>
			  <option value='AaNoxB'>AaNoxB</option>
			  <option value='AaNoxR'>AaNoxR</option>
			  <option value='AaNPS6'>AaNPS6</option>
			  <option value='Aapg1'>Aapg1</option>
			  <option value='aapk1'>aapk1</option>
			  <option value='AAR1'>AAR1</option>
			  <option value='AaSLT2'>AaSLT2</option>
			  <option value='ABC1'>ABC1</option>
			  <option value='ABC2'>ABC2</option>
			  <option value='ABC3'>ABC3</option>
			  <option value='ABC4'>ABC4</option>
			  <option value='Abd1'>Abd1</option>
			</select>
                                                                                                                                                                   
                        </td>
                    </tr>
                    
                    <tr>
                      <td align="right" width="20%">
                             And &nbsp;                                                                                                 
                      </td>
                      <td width="15%">
                          &nbsp;Disease:                                                                                                      
                      </td>
                      <td width="65%">
                          
                        <select name="adv_disease_name" class="resizedSelect"> 
                          <option selected value='all'>all</option>
			  <option value='Alternaria brown spot'>Alternaria brown spot</option>
			  <option value='Alternaria leaf blotch'>Alternaria leaf blotch</option>
			  <option value='Anthracnose'>Anthracnose</option>
			  <option value='Anthracnose disease'>Anthracnose disease</option>
			  <option value='Anthracnose stalk rot and leaf blight of maize'>Anthracnose stalk rot and leaf blight of maize</option>
			</select>
                                                                                                                                                                   
                        </td>
                    </tr>
                    
                    <tr>
                      <td align="right" width="20%">
                             And &nbsp;                                                                                                 
                      </td>
                      <td width="15%">
                          &nbsp;Host:                                                                                                      
                      </td>
                      <td width="65%">
                          
                        <select name="adv_host_name" class="resizedSelect"> 
                          <option selected value='all'>all</option>
			  <option value='Aeschynomene virginica'>Aeschynomene virginica</option>
			  <option value='Agaricus bisporus'>Agaricus bisporus</option>
			  <option value='Alfalfa'>Alfalfa</option>
			  <option value='Almond'>Almond</option>
			  <option value='American Chestnut tree'>American Chestnut tree</option>
			  <option value='Amoebae'>Amoebae</option>
			  <option value='Aphid'>Aphid</option>
			  <option value='Apple'>Apple</option>
			</select>
                                                                                                                                                                   
                        </td>
                    </tr>
                    
                    <tr>
                      <td align="right" width="20%">
                             And &nbsp;                                                                                                 
                      </td>
                      <td width="15%">
                          &nbsp;Pathogen:                                                                                                      
                      </td>
                      <td width="65%">
                          
                        <select name="adv_pathogen_name" class="resizedSelect"> 
                          <option selected value='all'>all</option>
			  <option value='Acinetobacter baumannii'>Acinetobacter baumannii</option>
			  <option value='Agrobacterium tumefaciens'>Agrobacterium tumefaciens</option>
			  <option value='Agrobacterium vitis'>Agrobacterium vitis</option>
			  <option value='Alternaria alternata'>Alternaria alternata</option>
			  <option value='Alternaria brassicicola'>Alternaria brassicicola</option>
			  <option value='Alternaria citri'>Alternaria citri</option>
			</select>
                                                                                                                                                                   
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
                      <input type="submit" value="Go" name="detailed_search_btn" onClick="" />
                      </td>
                      <td>
                       <input name="Clear" type="button" value="Clear" onClick=""/>
                        
                      </td>
                    </tr>
                  </table>
                </fieldset>
                
                
                </small>
                				
                 </form>  
      

		  
	   					
		   
		   
		   </content>
		   <?php
			   
			     
			     
			     //$sparql = $_POST['sparql'];
			     $qs = $_POST['quick_search'];
			     $as = $_POST['advanced_search'];
			    
			     $qs_search_for = "";	                  
                             $qs_search_text = ""; //the text field!                          
	                     $qs_order_by = "";//order by!
			    
			     $adv_gene_name   = "";
			     $adv_disease_name = "";
                             $adv_host_name = "";
                             $adv_pathogen_name = "";
                               
                               
                             $sparql_prefixes = 
	                           "prefix : <http://oip.rothamsted.ac.uk/ontology/> prefix xsd: <http://www.w3.org/2001/XMLSchema#>  prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> prefix apf: <http://jena.hpl.hp.com/ARQ/property#> prefix text: <http://jena.apache.org/text#> ";
			            //echo "$sparql_prefixes <br />";				    
			     $sparql = "";
				    
			    if($qs == "1" && $as=="0"){
			       //echo "QS";
			       //Check whether the form has been submitted
	                       $qs_search_for = $_POST['qs_search_for'];	                  
                               $qs_search_text = $_POST['qs_search_text']; //the text field!                          
	                       $qs_order_by = $_POST['qs_order_by'];//order by!
	                       
	                       switch ($qs_search_for):
				     case "all":
					$sparql = "select * where {?S ?O ?P} limit 20";
					break;
				     case "gene_name":
				        //echo "gene_name";
					$sparql = "select ?item ?label {
                                                   ?item a :gene .
                                                  ?item text:query \"$qs_search_text\" .    
                                                  ?item rdfs:label ?label .
                                                  }";
					break;	
					
				      case "host":
					$sparql = "select ?item ?label {
                                                    ?interaction :has_host ?item .
                                                    ?item text:query \"$qs_search_text\" .    
                                                    ?item rdfs:label ?label .
                                                  }";
				      break;
				      
				      case "pubmedID":
					$sparql = "select ?item ?label {
                                                    ?item a :citation .
                                                    ?item :is_about ?interaction .
                                                    ?item text:query \"$qs_search_text\" .    
                                                    ?item rdfs:label ?label .
                                                  }";
				      break;	
				    // case "pubmedAcc":					
					//$relation = "pubmedAcc";
					//break;				     
				     endswitch;
				     
				  //$ssparql =  $sparql_prefixes.$sparql;    
				  execute_sparql_query($sparql_prefixes.$sparql);
			    } else
			      if($qs == "0" && $as=="1"){
			       echo "AS";
			       $adv_gene_name   = $_POST['adv_gene_name'];
			       $adv_disease_name = $_POST['adv_disease_name'];
                               $adv_host_name = $_POST['adv_host_name'];
                               $adv_pathogen_name = $_POST['adv_pathogen_name'];
                               
                               $sparql = "
                                select ?interaction ?gene ?disease ?host ?pathogen ?phenotype ?evidence where {
				?interaction :has_gene ?gene .
				?gene rdfs:value \"$adv_gene_name\" .
				?interaction :has_disease ?disease .
				?disease rdfs:value \"$adv_disease_name\" .
				?interaction :has_host ?host .
				?host rdfs:value \"$adv_host_name\".
				?interaction :has_pathogen ?pathogen .
				?pathogen rdfs:value \"$adv_pathogen_name\" 
				}";
				
				echo $sparql;
				 //$ssparql =  $sparql_prefixes.$sparql;
				execute_sparql_query($sparql_prefixes.$sparql);
				 
				/*
				?interaction :has_output ?phenotype .
				?phenotype rdfs:value \"\" .
				?interaction :preceded_by ?evidence .
				?evidence rdfs:value \"\" 
				}
                               ";
                               */

			      //echo $adv_gene_name;
			      //echo $adv_disease_name;
			      //echo $adv_host_name;
			      //echo $adv_pathogen_name;
			          
			    }
			      	                  
			    		    
			    //if ($qs_search_for != '' && $qs_search_text != '' && $qs_order_by != '' ) {        
			    function execute_sparql_query($sparql){
 			         $endpoint = 'http://oip.rothamsted.ac.uk/sparql/query';//$_POST['endpoint'];
 			         $output = $_POST['output'];
				 require_once( "includes/sparqllib.php" );					
				 include_once 'includes/xml2array.php';
				 
	                           			            			
			         // } // end if($check_submit == 1){
			         /*
	   			       $sparql = "
					            select distinct ?item ?label where { 
					            ?item a :$relation .
					            ?item text:query ?$qs_search_text .
					            ?item rdfs:label ?label .
					            } 
					            order by ?$qs_order_by
					            ";
					
				*/	
	                      
	                       //print "$ssparql kkk <br />";
	                         
				$data = sparql_get($endpoint,$sparql);
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
