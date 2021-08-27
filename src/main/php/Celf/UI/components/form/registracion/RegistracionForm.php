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
 * Formulario para Registracion

 * @author Marcos
 * @since 05/05/2020
 */
class RegistracionForm extends Form{
		
	

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
	
	private $emailRepetir;
	private $claveRepetir;

	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		
		$this->addProperty("documento");
		$this->addProperty("nombre");
		$this->addProperty("apellido");
		
		$this->addProperty("email");
		$this->addProperty("clave");
		
		$this->addProperty("celular");
		$this->addProperty("calle");
		$this->addProperty("numero");
		$this->addProperty("piso");
		$this->addProperty("depto");
		
		
		$this->setBackToOnSuccess("RegistracionAgregarSuccess"); 
		$this->setBackToOnCancel("Login");
		
	}
	

	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		//agregamos el email y clave repetir.
		$this->setEmailRepetir( RastyUtils::getParamPOST('emailRepetir') );
		$this->setClaveRepetir( RastyUtils::getParamPOST('claveRepetir') );
		
		
		
		//uppercase 
		/*$entity->setNombre( strtoupper( $entity->getNombre() ) );
		$entity->setApellido( strtoupper( $entity->getApellido() ) );*/
		
		
	
	}
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "RegistracionForm";
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_submit", $this->localize("registracion.continuar") );
		
		
		$xtpl->assign("nombre_legend", $this->localize("registracion.nombre.legend") );
		
		$xtpl->assign("lbl_documento", $this->localize("registracion.documento") );
		
		$xtpl->assign("lbl_nombre", $this->localize("registracion.nombre") );
		$xtpl->assign("lbl_apellido", $this->localize("registracion.apellido") );
		
		
		$xtpl->assign("usuario_legend", $this->localize("registracion.usuario.legend") );
		$xtpl->assign("lbl_email", $this->localize("registracion.email") );
		$xtpl->assign("lbl_clave", $this->localize("registracion.clave") );
		$xtpl->assign("claveFormato", $this->localize("registracion.clave.formato") );
		$xtpl->assign("lbl_emailRepetir", $this->localize("registracion.emailRepetir") );
		$xtpl->assign("lbl_claveRepetir", $this->localize("registracion.claveRepetir") );
		
		$xtpl->assign("datos_legend", $this->localize("registracion.datos.legend") );
		
		$xtpl->assign("lbl_celular", $this->localize("registracion.celular") );
		$xtpl->assign("lbl_calle", $this->localize("registracion.calle") );
		$xtpl->assign("lbl_numero", $this->localize("registracion.numero") );
		$xtpl->assign("lbl_piso", $this->localize("registracion.piso") );
		$xtpl->assign("lbl_depto", $this->localize("registracion.depto") );
		
		
			
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

	

	public function getEmailRepetir()
	{
	    return $this->emailRepetir;
	}

	public function setEmailRepetir($emailRepetir)
	{
	    $this->emailRepetir = $emailRepetir;
	}

	public function getClaveRepetir()
	{
	    return $this->claveRepetir;
	}

	public function setClaveRepetir($claveRepetir)
	{
	    $this->claveRepetir = $claveRepetir;
	}
	
	
	
	public function getClaveProperties(){
		
		return array("data-custom" => "checkFormatoClave", 
						"data-custom-msg" => "formato incorrecto");
	}
	
}
?>