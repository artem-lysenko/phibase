$(document).ready(function() {
  $("h1").click(function() {
    $('#sparql').html("prefix owl: <http://www.w3.org/2002/07/owl#> prefix rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#> prefix rdfs: <http://www.w3.org/2000/01/rdf-schema#> prefix pho: <http://rdf.phibase.org/ontology/phibase-rdf-ontology.owl#> prefix pcore: <http://purl.uniprot.org/core/> prefix xsd: <http://www.w3.org/2001/XMLSchema#> select ?interaction ?org ?roleType ?roleLabel where { ?interaction a pho:interaction . ?interaction pho:has_participant ?org . ?org a pho:organism . ?org pho:has_role [ a ?roleType ;                 pho:pho:participant_of ?interaction ;                 rdfs:label ?roleLabel ] } ");
   //document.getElementById("sparql").innerHTML = "<p>prefix owl: <http://www.w3.org/2002/07/owl#></p> <p>prefix owl: <http://www.w3.org/2002/07/owl#></p> prefix owl: <http://www.w3.org/2002/07/owl#>";
  });
});
