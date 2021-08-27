<?php
namespace Celf\UI\pages\registracion\agregar;

use Celf\UI\service\UIServiceFactory;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Registracion;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para el success de una registración
 * 
 * @author Marcos
 * @since 09/05/2020
 *
 */
class RegistracionAgregarSuccess extends CelfPage{

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
		return $this->localize( "registracion.agregar.title" );
	}

	public function getType(){
		
		return "RegistracionAgregarSuccess";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		if( $this->getRegistracion() ){
			
			$xtpl->assign("nombre", $this->getRegistracion()->getNombre() );
			$xtpl->parse("main.ok");
		}else{
			$xtpl->assign("msg", "Ocurrió un error no esperado." );
			$xtpl->parse("main.nook");
		}
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
	
	public function setRegistracionOid($oid)
	{
		$reg = UIServiceFactory::getUIRegistracionService()->get($oid);
	    $this->setRegistracion($reg);
	}
}
?>