<?php
namespace project\model;

use base\model\entity\Entity;

class Table extends Entity
{
	protected $name = "table";

	public $attributes = [
		"id" => "",
		"column1" => "col1",
		"column2" => "col2",
		"column3" => "col3",
		"column4" => "col3",
		"column5" => "col3",
	];
}