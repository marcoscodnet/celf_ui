<?php

namespace Celf\UI\components\filter\estadoReclamo;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Celf\UI\components\grid\model\EstadoReclamoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;


use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar estadoReclamos
 * 
 * @author Marcos
 * @since 14/05/2020
 */
class EstadoReclamoFilter extends Filter{
		
	public function getType(){
		
		return "EstadoReclamoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new EstadoReclamoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIEstadoReclamoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarEstadoReclamo");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("estadoReclamo.nombre") );
		
		
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "EstadoReclamoModificar") );
		
		
	}
	

	
}
?>