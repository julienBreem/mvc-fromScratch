<?php
namespace service;
require_once("./classes/core/model.php");
use core\model as model;

class autoGenModel extends model{
	
	protected $name;
	
	public function __construct($name)
    {
		$this->name = $name;
	}
	
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}
}
?>