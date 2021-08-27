<?php

namespace Celf\UI\components\filter\area;

use Celf\UI\components\filter\model\UIAreaCriteria;

use Celf\UI\components\grid\model\AreaGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar areas
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class AreaFilter extends Filter{
		
	public function getType(){
		
		return "AreaFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new AreaGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIAreaCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarArea");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("area.nombre") );
		
		
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "AreaModificar") );
		
		
	}
	
	
	
	
}
?>