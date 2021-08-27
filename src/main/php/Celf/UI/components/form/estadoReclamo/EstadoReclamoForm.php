<?php

namespace Celf\UI\components\form\estadoReclamo;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Celf\UI\service\finder\EstadoReclamoFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;



use Rasty\utils\LinkBuilder;

/**
 * Formulario para estadoReclamo

 * @author Marcos
 * @since 14/05/2020
 */
class EstadoReclamoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var EstadoReclamo
	 */
	private $estadoReclamo;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("orden");
		$this->addProperty("nombre");
		
		
		$this->setBackToOnSuccess("EstadoReclamos");
		$this->setBackToOnCancel("EstadoReclamos");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "EstadoReclamoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_orden", $this->localize("estadoReclamo.orden") );
		$xtpl->assign("lbl_nombre", $this->localize("estadoReclamo.nombre") );
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getEstadoReclamo()
	{
	    return $this->estadoReclamo;
	}

	public function setEstadoReclamo($estadoReclamo)
	{
	    $this->estadoReclamo = $estadoReclamo;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	
	
}
?>