<?php

namespace Celf\UI\components\filter\reclamo;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Celf\UI\components\grid\model\ReclamoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;



use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar reclamos
 * 
 * @author Marcos
 * @since 15/05/2020
 */
class ReclamoFilter extends Filter{
		
	public function getType(){
		
		return "ReclamoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new ReclamoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIReclamoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarReclamo");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("usuario");
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("tipoReclamo");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_fechaDesde",  $this->localize("criteria.fechaDesde") );
		$xtpl->assign("lbl_fechaHasta",  $this->localize("criteria.fechaHasta") );
		$xtpl->assign("lbl_tipoReclamo", $this->localize("reclamo.tipoReclamo") );
		$xtpl->assign("lbl_usuario", $this->localize("reclamo.usuario") );
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "ReclamoModificar") );
		
		
	}
	
	
	
	
	
	
}
?>