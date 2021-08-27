<?php

namespace Celf\UI\components\form\correo;

use Celf\UI\components\filter\model\UICorreoCriteria;

use Celf\UI\service\finder\CorreoFinder;



use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;



use Rasty\utils\LinkBuilder;

/**
 * Formulario para correo

 * @author Marcos
 * @since 04/05/2018
 */
class CorreoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Correo
	 */
	private $correo;
	
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		
		$this->addProperty("nombre");
		$this->addProperty("email");
		$this->addProperty("activo");
		
		
		$this->setBackToOnSuccess("Correos");
		$this->setBackToOnCancel("Correos");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "CorreoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		
		$xtpl->assign("lbl_nombre", $this->localize("correo.nombre") );
		$xtpl->assign("lbl_email", $this->localize("correo.email") );
		$xtpl->assign("lbl_activo", $this->localize("correo.activo") );
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getCorreo()
	{
	    return $this->correo;
	}

	public function setCorreo($correo)
	{
	    $this->correo = $correo;
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	
	
	
}
?>