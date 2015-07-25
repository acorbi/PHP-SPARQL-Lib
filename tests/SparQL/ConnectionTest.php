<?php

namespace SparQL;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-07-25 at 01:34:00.
 */
class ConnectionTest extends \PHPUnit_Framework_TestCase
{

	const SPARQL_URL = 'http://rdf.ecs.soton.ac.uk/sparql/';
	protected static $SPARQL_NS = array("foaf" => "http://xmlns.com/foaf/0.1/");


	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{

	}

	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		
	}


	/**
	 * @covers SparQL\Connection::query
	 * @covers SparQL\Connection::ns
	 */
	public function testQueryOk()
	{
		$connection = new Connection(self::SPARQL_URL);
		foreach (self::$SPARQL_NS as $key => $value)
		{
			$connection->ns($key, $value);
		}

		$result = $connection->query("SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 5");

		$this->assertEquals(5, $result->numRows());
	}

	/**
	 * @covers SparQL\Connection::get
	 * @covers SparQL\Connection::query
	 * @covers SparQL\Connection::ns
	 */
	public function testGetOk()
	{
		$result = Connection::get(self::SPARQL_URL, "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 5", self::$SPARQL_NS);
		$this->assertEquals(5, count($result));
	}

	/**
	 * @expectedException \SparQL\Exception
	 */
	function test_wrongSparQLDataSet()
	{
		Connection::get("http://localhost/", "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 5", self::$SPARQL_NS);
	}

	/**
	 * @expectedException \SparQL\Exception
	 */
	function test_wrongSparQLDataSet2()
	{
		Connection::get(self::SPARQL_URL, "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 5");
	}

	function test_navigateSparQLDataSet()
	{
		$result = Connection::get(self::SPARQL_URL, "SELECT * WHERE { ?person a foaf:Person . ?person foaf:name ?name } LIMIT 2", self::$SPARQL_NS);

		$this->assertEquals(2, count($result));

		$this->assertEquals($result[0]["person.type"], "bnode");
		$this->assertEquals($result[0]["name.type"], "literal");
		$this->assertEquals($result[0]["name.datatype"], "http://www.w3.org/2001/XMLSchema#string");

		$this->assertEquals($result[1]["person.type"], "bnode");
		$this->assertEquals($result[1]["name.type"], "literal");
		$this->assertEquals($result[1]["name.datatype"], "http://www.w3.org/2001/XMLSchema#string");

	}

}