<?php
namespace base\model;

abstract class DataMapper{
	
	abstract protected function connect();
	abstract protected function disconnect();
	
	abstract protected function fetchColumns( $tableName );
	
	abstract protected function insert( $tableName, $values );
	abstract protected function select( $tableName );
	abstract protected function update( $tableName, $values );
	abstract protected function delete( $tableName );
	abstract protected function where( $conditions );
	abstract protected function limit( $limit );
}
