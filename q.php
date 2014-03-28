<?php
    $endpoint = $_POST['endpoint'];
    $sparql = $_POST['sparql'];
       			
    if ($endpoint != '' && $sparql != '') {        
	        require_once( "sparqllib.php" );
	
	$data = sparql_get($endpoint,$sparql);
	if( !isset($data) )
	{
		print "<p>Error: ".sparql_errno().": ".sparql_error()."</p>";
	}
	 
	print "<table>";
	print "<tr>";
	foreach( $data->fields() as $field )
	{
		print "<th>$field</th>";
	}
	print "</tr>";
	foreach( $data as $row )
	{
		print "<tr>";
		foreach( $data->fields() as $field )
		{
			print "<td>$row[$field]</td>";
		}
		print "</tr>";
	}
	print "</table>";
	    
    } else {
        echo '<p>You need to fill in all required fields!!</p>';
    }
?>
