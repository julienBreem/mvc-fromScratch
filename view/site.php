<?php
namespace view;
require('./classes/core/view.php');
use core\view as view;
class site extends view{
	public function __construct()
    {
		$this->title = "Site";
	}
	
}
