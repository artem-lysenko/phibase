***
- this php sparql client uses the "Simple library to query SPARQL from PHP sparqllib.php"
- more info here: http://graphite.ecs.soton.ac.uk/sparqllib/

- index.php has the form where we can specify a SPARQL endpoint and a query (it reads endpoint name from 1st line of endpoint.txt)
- p.php processes the the request and displays the results
- endpoint.txt has a preset endpoint name (only 1st line will be read)
- fill_sparql.js has js code to handle clicking on labels and automatically filling the sparql area (Click on the text at the bottom of the form!)
- auto filling still has alignment/spacing issues, I'll fix these later!
