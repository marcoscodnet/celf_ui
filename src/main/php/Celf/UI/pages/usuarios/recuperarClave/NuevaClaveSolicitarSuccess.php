<?php
namespace Celf\UI\pages\usuarios\recuperarClave;

use Celf\UI\service\UIServiceFactory;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Registracion;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Page para el success de la solicitud de
 * nueva clave
 * 
 * @author Marcos
 * @since 12/05/2020
 *
 */
class NuevaClaveSolicitarSuccess extends CelfPage{

	private $username;
	
	public function isSecure(){
		return false;
	}
	
	
	public function __construct(){
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("SolicitarPrestamo");//FIXME home public
//		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "solicitarNuevaClaveSuccess.title" );
	}

	public function getType(){
		
		return "NuevaClaveSolicitarSuccess";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		if( $this->username ){
			
			$xtpl->assign("nombre", $this->username );
			$xtpl->parse("main.ok");
		}else{
			$xtpl->assign("msg", "Ocurrió un error no esperado." );
			$xtpl->parse("main.nook");
		}
	}
					
	public function getMsgError(){
		return "";
	}

	public function getUsername()
	{
	    return $this->username;
	}

	public function setUsername($username)
	{
	    $this->username = $username;
	}
}
?>