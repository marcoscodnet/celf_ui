<?php

namespace Celf\UI\components\filter\necrologica;

use Celf\UI\components\filter\model\UINecrologicaCriteria;

use Celf\UI\components\grid\model\NecrologicaGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar necrologicas
 * 
 * @author Marcos
 * @since 04/05/2018
 */
class NecrologicaFilter extends Filter{
		
	
	
	public function getType(){
		
		return "NecrologicaFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new NecrologicaGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UINecrologicaCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarNecrologica");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		/*$this->fillInput("nombre", $this->getInitialText() );
		$this->fillInput("artista", $this->getInitialText() );
		*/
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("necrologica.nombre") );
		$xtpl->assign("lbl_fechaDesde",  $this->localize("criteria.fechaDesde") );
		$xtpl->assign("lbl_fechaHasta",  $this->localize("criteria.fechaHasta") );
		
		
		
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "NecrologicaModificar") );
		
		
	}
}
?>