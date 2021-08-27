<?php

namespace Celf\UI\components\form\tipoReclamo;

use Celf\UI\components\filter\model\UITipoReclamoCriteria;

use Celf\UI\service\finder\TipoReclamoFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Celf\UI\service\finder\AreaFinder;

use Celf\UI\components\filter\model\UIAreaCriteria;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para tipoReclamo

 * @author Marcos
 * @since 13/05/2020
 */
class TipoReclamoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var TipoReclamo
	 */
	private $tipoReclamo;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("area");
		$this->addProperty("nombre");
		
		
		$this->setBackToOnSuccess("TipoReclamos");
		$this->setBackToOnCancel("TipoReclamos");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "TipoReclamoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_area", $this->localize("tipoReclamo.area") );
		$xtpl->assign("lbl_nombre", $this->localize("tipoReclamo.nombre") );
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getTipoReclamo()
	{
	    return $this->tipoReclamo;
	}

	public function setTipoReclamo($tipoReclamo)
	{
	    $this->tipoReclamo = $tipoReclamo;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
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