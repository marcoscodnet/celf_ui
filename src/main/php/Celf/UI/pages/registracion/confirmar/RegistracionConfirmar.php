<?php
namespace Celf\UI\pages\registracion\confirmar;

use Celf\UI\service\UIServiceFactory;

use Celf\UI\service\UIRegistracionService;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Registracion;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\exception\RastyException;

/**
 * Page para confirmar una registración
 * 
 * @author Marcos
 * @since 11/05/2020
 *
 */
class RegistracionConfirmar extends CelfPage{

	/**
	 * Registracion a confirmar.
	 * @var Registracion
	 */
	private $registracion;

	private $mensajeError;
	
	public function isSecure(){
		return false;
	}
	
	
	public function __construct(){
		
		//inicializamos la Registracion.
		$registracion = new Registracion();
		
		$this->setRegistracion($registracion);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("SolicitarPrestamo");//FIXME home public
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "registracion.confirmar.title" );
	}

	public function getType(){
		
		return "RegistracionConfirmar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		if($this->mensajeError){
			
			$xtpl->assign("error", $this->mensajeError);
			$xtpl->parse("main.error");
		}
		
	}

	public function getMsgError(){
		return $this->mensajeError;
	}

	public function getRegistracion()
	{
	    return $this->registracion;
	}

	public function setRegistracion($registracion)
	{
	    $this->registracion = $registracion;
	}
	
	public function setCodigoValidacion($codigoValidacion)
	{
		
	    $registracion = UIServiceFactory::getUIRegistracionService()->getByCodigoValidacion($codigoValidacion);
	    
	    if( !$registracion )
	    	$this->setMensajeError("registracion.confirmar.codigoInvalido");
	    else{
			//chequeamos que no esté expirada.
			$hoy = new \DateTime();
			
			if( $registracion->getFechaExpiracion() < $hoy ){
				$this->setMensajeError("registracion.confirmar.codigoExpirado");
			}
		    	
	    }
	    	
	    $this->setRegistracion($registracion);	
	    
	}

	public function getMensajeError()
	{
	    return $this->mensajeError;
	}

	public function setMensajeError($mensajeError)
	{
	    $this->mensajeError = $mensajeError;
	}
}
?>