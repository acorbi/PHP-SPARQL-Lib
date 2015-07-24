# PHP SPARQL Lib
Copyright 2010,2011,2012 Christopher Gutteridge & University of Southampton
Licensed as LGPL

## Info
* Forked code.
* Refactored code to support PHP 5.x namespaces, composer and autoload classes;
* Full documentation: http://graphite.ecs.soton.ac.uk/sparqllib/

## Example:

```php
$db = new \SparQL\Connection( "http://rdf.ecs.soton.ac.uk/sparql/" );
$db->ns( "foaf","http://xmlns.com/foaf/0.1/" );

$sparql = "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 5";
$result = $db->query( $sparql );

$fields = $result->field_array();

print "<p>Number of rows: " . $result->num_rows() . " results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
```


