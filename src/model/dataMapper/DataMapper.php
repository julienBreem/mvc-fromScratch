<?php
namespace base\model\dataMapper;

interface DataMapper
{	
	function connect();
	function disconnect();
	
	function fetchColumns( $tableName );
	
	function insert( $tableName, $values );
	function select( $tableName );
	function update( $tableName, $values );
	function delete( $tableName );
	function where( $conditions );
	function limit( $limit );
}
