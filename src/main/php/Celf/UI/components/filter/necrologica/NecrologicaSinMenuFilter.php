<?php

namespace Celf\UI\components\filter\necrologica;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Celf\UI\components\grid\model\NecrologicaSinMenuGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar necrologicas
 * 
 * @author Marcos
 * @since 16/03/2018
 */
class NecrologicaSinMenuFilter extends Filter{
		
	
	
	public function getType(){
		
		return "NecrologicaSinMenuFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new NecrologicaSinMenuGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UINecrologicaCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarPista");
		
		//agregamos las propiedades a popular en el submit.
		
		//$this->addProperty("pistaOArtista");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		
		
		parent::parseXTemplate($xtpl);
		
		
		
		
	}
}
?>