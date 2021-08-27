<?php

namespace Celf\UI\components\filter\tipoReclamo;

use Celf\UI\components\filter\model\UITipoReclamoCriteria;

use Celf\UI\components\grid\model\TipoReclamoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

use Celf\UI\service\finder\AreaFinder;
use Celf\UI\service\UIServiceFactory;
use Celf\UI\components\filter\model\UIAreaCriteria;

use Celf\UI\utils\CelfUIUtils;

/**
 * Filtro para buscar tipoReclamos
 * 
 * @author Marcos
 * @since 13/05/2020
 */
class TipoReclamoFilter extends Filter{
		
	public function getType(){
		
		return "TipoReclamoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new TipoReclamoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UITipoReclamoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarTipoReclamo");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		$this->addProperty("area");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("tipoReclamo.nombre") );
		$xtpl->assign("lbl_area",  $this->localize("tipoReclamo.area") );
		
		
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "TipoReclamoModificar") );
		
		
	}
	
	public function getAreas(){
		
		$conceptos = UIServiceFactory::getUIAreaService()->getList( new UIAreaCriteria() );
		
		return $conceptos;
		
	}
	
	public function getAreaFinderClazz(){
		
		return get_class( new AreaFinder() );
		
	}
	
	
}
?>