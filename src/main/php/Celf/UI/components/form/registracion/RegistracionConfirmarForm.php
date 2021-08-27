<?php

namespace Celf\UI\components\form\registracion;




use Celf\UI\utils\CelfUIUtils;

use Celf\UI\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;

use Celf\Core\model\Registracion;

use Rasty\utils\LinkBuilder;

/**
 * Formulario para confirmar una Registracion

 * @author Marcos
 * @since 11/05/2020
 */
class RegistracionConfirmarForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Registracion
	 */
	private $registracion;

	private $captcha;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("oid");
		$this->addProperty("codigoValidacion");
		
		$this->setBackToOnSuccess("RegistracionConfirmarSuccess"); 
		$this->setBackToOnCancel("SolicitarPrestamoWidget");
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos el captcha.
		$this->setCaptcha( RastyUtils::getParamPOST('captcha') );
	
	}
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "RegistracionConfirmarForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("registracionConfirmar_legend", $this->localize("registracion.confirmar.legend") );
		
		$xtpl->assign("lbl_nombre", $this->localize("registracion.nombre") );
		
		$xtpl->assign("lbl_securitycode", $this->localize("registracion.securitycode") );
		$xtpl->assign("lbl_captcha", $this->localize("registracion.captcha") );
		$xtpl->assign ( 'sid_captcha', md5(time()) );
				
		
		if( $this->getRegistracion() ){
			
			$xtpl->assign("nombre", $this->getRegistracion()->getNombre() );
			$xtpl->parse("main.ok");
			$xtpl->parse("main.submit");
		}else{
			$xtpl->parse("main.nook");
		}
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getRegistracion()
	{
	    return $this->registracion;
	}

	public function setRegistracion($registracion)
	{
	    $this->registracion = $registracion;
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}


	public function getCaptcha()
	{
	    return $this->captcha;
	}

	public function setCaptcha($captcha)
	{
	    $this->captcha = $captcha;
	}
}
?>