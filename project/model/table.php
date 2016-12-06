<?php
namespace model;
require_once('./classes/core/model.php');
use core\model as model;

class table extends model{
	
	public $name = "table";
	
	public $attributes = [
		"id" => "",
		"column1" => "col1",
		"column2" => "col2",
		"column3" => "col3"
	];
}