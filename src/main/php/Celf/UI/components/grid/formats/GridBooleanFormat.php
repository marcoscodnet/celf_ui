<?php
namespace Celf\UI\components\grid\formats;


use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\conf\RastyConfig;

/**
 * Formato para renderizar un boolean en la grilla
 *
 * @author Bernardo Iribarne (bernardo.iribarne@codnet.com.ar)
 * @since 27-08-2014
 *
 */

class GridBooleanFormat extends GridValueFormat{

	
	public function __construct(){
	}
	
	public function format( $value, $item=null ){
		
		if( $value )
			$src = RastyConfig::getInstance()->getWebPath() . "css/images/true.png";
		else
			$src = RastyConfig::getInstance()->getWebPath() . "css/images/false.png";
		
		return "<img border=0 style=\"vertical-align:middle;\" src=\"$src\" >";
	}		
	
	public function getPattern(){
		return "";
	}
	
}