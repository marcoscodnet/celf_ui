<?php

namespace Celf\UI\components\filter\instanciaReclamo;

use Celf\UI\components\filter\model\UIInstanciaReclamoCriteria;

use Celf\UI\components\grid\model\InstanciaReclamoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

use Celf\UI\service\finder\EstadoReclamoFinder;
use Celf\UI\service\UIServiceFactory;
use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Celf\UI\utils\CelfUIUtils;

use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar instanciaReclamos
 * 
 * @author Marcos
 * @since 1t/05/2020
 */
class InstanciaReclamoFilter extends Filter{
		
	
	private $reclamo;
	
	public function getType(){
		
		return "InstanciaReclamoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new InstanciaReclamoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIInstanciaReclamoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarReclamo");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("estadoReclamo");
		
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		//$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("lbl_estadoReclamo", $this->localize("instanciaReclamo.estadoReclamo") );
		
		$reclamo = UIServiceFactory::getUIReclamoService()->get( RastyUtils::getParamGET("reclamoOid") );
		
		if( !empty( $reclamo)  ){
			$xtpl->assign("lbl_reclamo",  $reclamo->__toString() );
			$xtpl->assign("reclamoOid",  $reclamo->getOid() );
			
		}
		
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		$reclamo = UIServiceFactory::getUIReclamoService()->get( RastyUtils::getParamPOST("reclamoOid") );
		
		$entity->setReclamo( $reclamo );		
		
	}
	
	
	
	public function getEstadoReclamos(){
		
		$conceptos = UIServiceFactory::getUIEstadoReclamoService()->getList( new UIEstadoReclamoCriteria() );
		
		return $conceptos;
		
	}
	
	public function getEstadoReclamoFinderClazz(){
		
		return get_class( new EstadoReclamoFinder() );
		
	}
	
	
	

    public function getReclamo()
    {
        return $this->reclamo;
    }

    public function setReclamo($reclamo)
    {
        $this->reclamo = $reclamo;
    }
}
?>