<?php
namespace core;
abstract class dataMapper{
	
	abstract protected function connect();
	abstract protected function disconnect();
	
	abstract protected function fetchColumns( $modelName );
	
	abstract protected function create( $modelName, $values );
	abstract protected function read( $modelName );
	abstract protected function update( $modelName, $values );
	abstract protected function delete( $modelName );
}
?>