<?php

namespace Celf\UI\components\form\reclamo;

use Celf\UI\components\filter\model\UIReclamoCriteria;

use Celf\UI\service\finder\ReclamoFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Celf\UI\service\finder\TipoReclamoFinder;

use Celf\UI\components\filter\model\UITipoReclamoCriteria;

use Celf\UI\service\finder\EstadoReclamoFinder;

use Celf\UI\components\filter\model\UIEstadoReclamoCriteria;

use Rasty\utils\LinkBuilder;

use Rasty\utils\Logger;

/**
 * Formulario para reclamo

 * @author Marcos
 * @since 18/05/2020
 */
class ReclamoSinMenuForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Reclamo
	 */
	private $reclamo;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("tipoReclamo");
		$this->addProperty("telefono");
		$this->addProperty("suministro");
		$this->addProperty("nombre");
		//$this->addProperty("estadoReclamo");
		
		$this->setBackToOnSuccess("ReclamosSinMenu");
		$this->setBackToOnCancel("ReclamosSinMenu");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "ReclamoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_tipoReclamo", $this->localize("reclamo.tipoReclamo") );
		$xtpl->assign("lbl_telefono", $this->localize("reclamo.telefono") );
		$xtpl->assign("lbl_suministro", $this->localize("reclamo.suministro") );
		$xtpl->assign("lbl_nombre", $this->localize("reclamo.nombre") );
		$xtpl->assign("lbl_estadoReclamo", $this->localize("reclamo.estado") );
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getReclamo()
	{
	    return $this->reclamo;
	}

	public function setReclamo($reclamo)
	{
	    $this->reclamo = $reclamo;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	public function getTipoReclamos(){
		
		$conceptos = UIServiceFactory::getUITipoReclamoService()->getList( new UITipoReclamoCriteria() );
		
		return $conceptos;
		
	}
	
	public function getTipoReclamoFinderClazz(){
		
		return get_class( new TipoReclamoFinder() );
		
	}

	public function getEstadoReclamos(){
		
		$conceptos = UIServiceFactory::getUIEstadoReclamoService()->getList( new UIEstadoReclamoCriteria() );
		
		return $conceptos;
		
	}
	
	public function getEstadoReclamoFinderClazz(){
		
		return get_class( new EstadoReclamoFinder() );
		
	}
	
	
}
?>