<?php
namespace Celf\UI\components\grid\formats;

use Celf\UI\utils\CelfUIUtils;

use Celf\Core\model\Categoria;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar la categoria
 *
 * @author Marcos
 * @since 05-05-2018
 *
 */

class GridCategoriaFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  Locale::localize( Categoria::getLabel( $value ) );
		else $value;	
	}		
	
	
	
	public function getPattern(){
		return $this->pattern;
	}
	
}