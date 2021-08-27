<?php
namespace Celf\UI\pages\registracion\agregar;

use Celf\UI\service\UIServiceFactory;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Registracion;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para agregar una registración
 * 
 * @author Marcos
 * @since 05/05/2020
 *
 */
class RegistracionAgregar extends CelfPage{

	/**
	 * Registracion a agregar.
	 * @var Registracion
	 */
	private $registracion;

	
	public function isSecure(){
		return false;
	}
	
	
	public function __construct(){
		
		//inicializamos la Registracion.
		/*$registracion = new Registracion();
		
		$this->setRegistracion($registracion);*/
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "registracion.agregar.title" );
	}

	public function getType(){
		
		return "RegistracionAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$registracionForm = $this->getComponentById("registracionForm");
		$registracionForm->fillFromSaved( $this->getRegistracion() );
		
	}


					
	public function getMsgError(){
		return "";
	}

	public function getRegistracion()
	{
	    return $this->registracion;
	}

	public function setRegistracion($registracion)
	{
	    $this->registracion = $registracion;
	}
	
	public function getBackToOnSuccess(){
		
		return $this->getLinkRegistracionSuccess();
		
	}
	
	public function getBackToOnCancel(){
		
		return $this->getLinkSolicitudOnline();
		
	}
	
	
}
?>