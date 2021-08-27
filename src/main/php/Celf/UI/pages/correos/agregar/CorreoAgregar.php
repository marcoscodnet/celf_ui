<?php
namespace Celf\UI\pages\correos\agregar;

use Celf\UI\pages\CelfPage;

use Rasty\utils\XTemplate;
use Celf\Core\model\Correo;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

/**
 * Página para agregar e-mails
 * 
 * @author Marcos
 * @since 08/05/2018
 *
 * @Rasty\security\annotations\Secured( permission='AGREGAR E-MAIL' )
 */

class CorreoAgregar extends CelfPage{

	/**
	 * Correo a agregar.
	 * @var Correo
	 */
	private $Correo;

	
	
	public function __construct(){
		
		//inicializamos el Correo.
		$Correo = new Correo();
		
		$Correo->setActivo(true);
		$this->setCorreo($Correo);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Correos");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "correo.agregar.title" );
	}

	public function getType(){
		
		return "CorreoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$correoForm = $this->getComponentById("correoForm");
		$correoForm->fillFromSaved( $this->getCorreo() );
		
	}


	public function getCorreo()
	{
	    return $this->Correo;
	}

	public function setCorreo($Correo)
	{
	    $this->Correo = $Correo;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>