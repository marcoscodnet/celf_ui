<?php

namespace Celf\UI\layouts;

use Rasty\Layout\layout\Rasty\Layout;

use Rasty\utils\XTemplate;


class CelfLoginMetroLayout extends CelfMetroLayout{

	public function getXTemplate($file_template=null){
		return parent::getXTemplate( dirname(__DIR__) . "/layouts/CelfLoginMetroLayout.htm" );
	}

	public function getType(){
		
		return "CelfLoginMetroLayout";
		
	}	

}
?>