<?php
namespace project\view;

use base\view\HtmlView;

class site extends HtmlView
{
	public function __construct()
    {
        parent::__construct();
		$this->title = "Site";
	}
	
}
